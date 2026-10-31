<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('catalog.index') }}">{{ config('app.name') }}</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('catalog.index') }}">Catálogo</a></li>
            @auth
                @if (auth()->user()->isAdmin())
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.loans.index') }}">Préstamos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.books.index') }}">Libros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.authors.index') }}">Autores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">Categorías</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}">Mis préstamos</a></li>
                @endif
            @endauth
        </ul>
        <ul class="navbar-nav">
            @auth
                <li class="nav-item d-flex align-items-center text-white me-3">{{ auth()->user()->name }}</li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
            @endauth
        </ul>
    </div>
</nav>

<main class="container py-4">
    @if (session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
