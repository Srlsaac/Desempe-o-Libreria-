<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(): View
    {
        $loans = auth()->user()
            ->loans()
            ->with('book.author')
            ->latest()
            ->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function store(Book $book): RedirectResponse
    {
        abort_unless($book->active, 404);

        $user = auth()->user();

        if ($book->copies_available < 1) {
            return back()->with('error', 'Este libro no tiene copias disponibles.');
        }

        $enCurso = $user->loans()->whereIn('status', ['pending', 'active'])->count();

        if ($enCurso >= 3) {
            return back()->with('error', 'No puedes tener más de 3 préstamos activos al mismo tiempo.');
        }

        Loan::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->route('loans.index')
            ->with('exito', 'Solicitud enviada. Espera la aprobación del administrador.');
    }
}
