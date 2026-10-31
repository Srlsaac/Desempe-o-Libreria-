@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Catálogo de libros</h1>

    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-4">
        <div class="col-md-9">
            <input type="text" name="q" value="{{ $search }}" class="form-control"
                   placeholder="Buscar por título o autor">
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($books as $book)
            <div class="col-md-4">
                <div class="card h-100">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}" class="card-img-top" alt="Portada"
                             style="height: 260px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text mb-1">{{ $book->author->name }}</p>
                        <p class="text-muted small mb-2">{{ $book->category->name }}</p>

                        @if ($book->copies_available > 0)
                            <span class="badge text-bg-success">Disponible</span>
                        @else
                            <span class="badge text-bg-danger">Sin copias</span>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('catalog.show', $book) }}" class="btn btn-outline-primary btn-sm">Ver detalle</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No se encontraron libros.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection
