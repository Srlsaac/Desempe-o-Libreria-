<?php

use App\Http\Controllers\AdminLoanController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'home'])->name('home');
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/libros/{book}', [CatalogController::class, 'show'])->name('catalog.show');
Route::view('/privacidad', 'legal.privacy')->name('privacy');

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.loans.index');
    }

    return redirect()->route('loans.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mis-prestamos', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/libros/{book}/prestamo', [LoanController::class, 'store'])->name('loans.store');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('authors', AuthorController::class)->except('show');
        Route::resource('books', BookController::class)->except('show');

        Route::get('loans', [AdminLoanController::class, 'index'])->name('loans.index');
        Route::patch('loans/{loan}/approve', [AdminLoanController::class, 'approve'])->name('loans.approve');
        Route::patch('loans/{loan}/reject', [AdminLoanController::class, 'reject'])->name('loans.reject');
        Route::patch('loans/{loan}/return', [AdminLoanController::class, 'markReturned'])->name('loans.return');
    });

require __DIR__.'/auth.php';
