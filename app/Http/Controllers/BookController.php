<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with(['category', 'author'])->orderBy('title')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create', [
            'categories' => Category::orderBy('name')->get(),
            'authors' => Author::orderBy('name')->get(),
        ]);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['copies_available'] = $data['copies_total'];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('exito', 'Libro creado correctamente.');
    }

    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Category::orderBy('name')->get(),
            'authors' => Author::orderBy('name')->get(),
        ]);
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();

        $prestadas = $book->copies_total - $book->copies_available;

        if ($data['copies_total'] < $prestadas) {
            return back()->withInput()->withErrors([
                'copies_total' => "No puede ser menor a las copias prestadas actualmente ({$prestadas}).",
            ]);
        }

        $data['copies_available'] = $data['copies_total'] - $prestadas;

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers');
        } else {
            unset($data['cover_image']);
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('exito', 'Libro actualizado correctamente.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        if ($book->loans()->exists()) {
            return back()->with('error', 'No se puede eliminar: el libro tiene préstamos asociados.');
        }

        if ($book->cover_image) {
            Storage::delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('exito', 'Libro eliminado correctamente.');
    }
}
