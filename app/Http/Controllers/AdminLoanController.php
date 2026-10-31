<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminLoanController extends Controller
{
    public function index(Request $request): View
    {
        $filtro = $request->query('filtro');

        $loans = Loan::with(['book', 'user'])
            ->when($filtro === 'pendientes', fn ($q) => $q->where('status', 'pending'))
            ->when($filtro === 'activos', fn ($q) => $q->where('status', 'active'))
            ->when($filtro === 'vencidos', fn ($q) => $q->where('status', 'active')->whereDate('due_date', '<', today()))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $vencidosCount = Loan::where('status', 'active')
            ->whereDate('due_date', '<', today())
            ->count();

        return view('loans.admin', compact('loans', 'filtro', 'vencidosCount'));
    }

    public function approve(Loan $loan): RedirectResponse
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Solo se pueden aprobar solicitudes pendientes.');
        }

        try {
            DB::transaction(function () use ($loan) {
                $book = Book::whereKey($loan->book_id)->lockForUpdate()->first();

                if ($book->copies_available < 1) {
                    throw new \RuntimeException('El libro ya no tiene copias disponibles.');
                }

                $book->decrement('copies_available');

                $loan->update([
                    'status' => 'active',
                    'loan_date' => today(),
                    'due_date' => today()->addDays(15),
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('exito', 'Préstamo aprobado.');
    }

    public function reject(Loan $loan): RedirectResponse
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Solo se pueden rechazar solicitudes pendientes.');
        }

        $loan->update(['status' => 'rejected']);

        return back()->with('exito', 'Solicitud rechazada.');
    }

    public function markReturned(Loan $loan): RedirectResponse
    {
        if ($loan->status !== 'active') {
            return back()->with('error', 'Solo se pueden devolver préstamos activos.');
        }

        DB::transaction(function () use ($loan) {
            $loan->book()->increment('copies_available');

            $loan->update([
                'status' => 'returned',
                'return_date' => today(),
            ]);
        });

        return back()->with('exito', 'Libro marcado como devuelto.');
    }
}
