@extends('layouts.bootstrap')

@section('content')
    <a href="{{ route('catalog.index') }}" class="btn btn-link px-0 mb-3">&larr; Volver al catálogo</a>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-4 col-lg-3">
                    <div class="cover-wrap cover-wrap-lg rounded-3">
                        <div class="book-cover-placeholder"><i class="bi bi-book"></i></div>
                        @if ($book->cover_url)
                            <img src="{{ $book->cover_url }}" alt="Portada de {{ $book->title }}"
                                 class="cover-img" onerror="this.remove()">
                        @endif
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <span class="badge rounded-pill text-bg-light border mb-2">{{ $book->category->name }}</span>
                    <h1 class="h2">{{ $book->title }}</h1>
                    <p class="text-muted fs-5">{{ $book->author->name }}</p>

                    <ul class="list-unstyled text-muted small mb-3">
                        @if ($book->year)
                            <li><i class="bi bi-calendar3 me-1"></i>Año: {{ $book->year }}</li>
                        @endif
                        @if ($book->isbn)
                            <li><i class="bi bi-upc me-1"></i>ISBN: {{ $book->isbn }}</li>
                        @endif
                    </ul>

                    @if ($book->description)
                        <p>{{ $book->description }}</p>
                    @endif

                    <p class="mb-3">
                        <strong>Disponibilidad:</strong>
                        @if ($book->copies_available > 0)
                            <span class="badge text-bg-success">
                            {{ $book->copies_available }} de {{ $book->copies_total }} copias disponibles
                        </span>
                        @else
                            <span class="badge text-bg-danger">Sin copias disponibles</span>
                        @endif
                    </p>

                    @auth
                        @unless (auth()->user()->isAdmin())
                            @if ($book->copies_available > 0)
                                <form method="POST" action="{{ route('loans.store', $book) }}">
                                    @csrf
                                    <button class="btn btn-primary btn-lg">Solicitar préstamo</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>Sin copias disponibles</button>
                            @endif
                        @endunless
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Inicia sesión para solicitar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
