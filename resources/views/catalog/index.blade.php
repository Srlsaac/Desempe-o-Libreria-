@extends('layouts.bootstrap')

@section('content')
    <div class="mb-4">
        <h1 class="h2 mb-1">Catálogo de libros</h1>
        <p class="text-muted mb-0">Encuentra tu próxima lectura.</p>
    </div>

    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-4">
        <div class="col-md-9">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="q" value="{{ $search }}" class="form-control"
                       placeholder="Buscar por título o autor">
            </div>
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @if ($search)
        <p class="text-muted">
            Resultados para <strong>{{ $search }}</strong> &middot;
            <a href="{{ route('catalog.index') }}">Limpiar búsqueda</a>
        </p>
    @endif

    <div class="row g-4">
        @forelse ($books as $book)
            <div class="col-sm-6 col-lg-4">
                @include('partials.book-card')
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">No se encontraron libros.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection
