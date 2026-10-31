<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::withCount('books')->orderBy('name')->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request): RedirectResponse
    {
        Author::create($request->validated());

        return redirect()->route('admin.authors.index')
            ->with('exito', 'Autor creado correctamente.');
    }

    public function edit(Author $author): View
    {
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->validated());

        return redirect()->route('admin.authors.index')
            ->with('exito', 'Autor actualizado correctamente.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        if ($author->books()->exists()) {
            return back()->with('error', 'No se puede eliminar: el autor tiene libros asociados.');
        }

        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('exito', 'Autor eliminado correctamente.');
    }
}
