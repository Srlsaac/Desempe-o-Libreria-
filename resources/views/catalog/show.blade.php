@extends('layouts.bootstrap')

@section('content')
    <a href="{{ route('catalog.index') }}" class="btn btn-link px-0 mb-3">&larr; Volver al catálogo</a>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}" class="img-fluid rounded" alt="Portada">
                    @else
                        <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center"
                             style="height: 300px;">Sin portada</div>
                    @endif
                </div>

                <div class="col-md-9">
                    <h1 class="h3">{{ $book->title }}</h1>
                    <p class="mb-1"><strong>Autor:</strong> {{ $book->author->name }}</p>
                    <p class="mb-1"><strong>Categoría:</strong> {{ $book->category->name }}</p>
                    @if ($book->year)
                        <p class="mb-1"><strong>Año:</strong> {{ $book->year }}</p>
                    @endif
                    @if ($book->isbn)
                        <p class="mb-1"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    @endif

                    <p class="mt-3">{{ $book->description }}</p>

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
                                    <button class="btn btn-primary">Solicitar préstamo</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>Sin copias disponibles</button>
                            @endif
                        @endunless
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Inicia sesión para solicitar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
