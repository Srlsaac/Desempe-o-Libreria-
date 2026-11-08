<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
            'confirmacion' => ['accepted'],
        ], [
            'password.required' => 'Escribe tu contraseña para confirmar.',
            'password.current_password' => 'La contraseña no es correcta.',
            'confirmacion.accepted' => 'Marca la casilla para confirmar que entiendes las consecuencias.',
        ]);

        $user = $request->user();

        abort_if($user->isAdmin(), 403);

        if ($user->loans()->where('status', 'active')->exists()) {
            return back()->withErrors([
                'loans' => 'No puedes eliminar tu cuenta mientras tengas libros prestados. Devuélvelos primero.',
            ], 'userDeletion');
        }

        DB::transaction(function () use ($user) {
            $user->loans()->where('status', 'pending')->update(['status' => 'rejected']);
            $user->loans()->update(['notes' => null]);

            DB::table('sessions')->where('user_id', $user->id)->delete();

            $user->forceFill([
                'name' => 'Usuario eliminado',
                'email' => 'eliminado-'.$user->id.'-'.Str::lower(Str::random(8)).'@eliminado.invalid',
                'password' => Hash::make(Str::random(40)),
                'remember_token' => null,
                'documento' => null,
                'telefono' => null,
                'email_verified_at' => null,
                'anonymized_at' => now(),
            ])->save();
        });

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('exito', 'Tu cuenta fue eliminada y tus datos personales fueron anonimizados.');
    }
}
