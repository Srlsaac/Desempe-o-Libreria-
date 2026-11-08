<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#1f2a2e">
    <title>@yield('title', config('app.name'))</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/libreapp.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark navbar-library sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-book-half me-1"></i>LibreApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}" href="{{ route('catalog.index') }}">Catálogo</a>
                </li>
                @auth
                    @if (auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}" href="{{ route('admin.loans.index') }}">Préstamos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">Libros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}" href="{{ route('admin.authors.index') }}">Autores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Categorías</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.index') }}">Mis préstamos</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                @auth
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-gold btn-sm px-3" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container flex-grow-1 py-4 py-md-5">
    @if (session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer class="footer-library mt-auto">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-5">
                <h5><i class="bi bi-book-half me-1"></i>LibreApp</h5>
                <p class="small mb-0">Biblioteca virtual para explorar el catálogo y gestionar préstamos de libros.</p>
            </div>
            <div class="col-6 col-md-3">
                <h6 class="text-uppercase small">Explorar</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="mb-1"><a href="{{ route('catalog.index') }}">Catálogo</a></li>
                    <li class="mb-1"><a href="{{ route('privacy') }}">Política de privacidad</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4">
                <h6 class="text-uppercase small">Tu cuenta</h6>
                <ul class="list-unstyled small mb-0">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li class="mb-1"><a href="{{ route('admin.loans.index') }}">Panel de administración</a></li>
                        @else
                            <li class="mb-1"><a href="{{ route('loans.index') }}">Mis préstamos</a></li>
                        @endif
                        <li class="mb-1"><a href="{{ route('profile.edit') }}">Mi perfil</a></li>
                    @else
                        <li class="mb-1"><a href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li class="mb-1"><a href="{{ route('register') }}">Registrarse</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="small mb-0">&copy; {{ date('Y') }} LibreApp &middot; Proyecto de Laravel</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
