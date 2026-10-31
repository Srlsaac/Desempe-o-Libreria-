<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');

        $books = Book::with(['author', 'category'])
            ->where('active', true)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhereHas('author', function ($a) use ($search) {
                            $a->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('title')
            ->paginate(9)
            ->withQueryString();

        return view('catalog.index', compact('books', 'search'));
    }

    public function show(Book $book): View
    {
        abort_unless($book->active, 404);

        $book->load(['author', 'category']);

        return view('catalog.show', compact('book'));
    }
}
