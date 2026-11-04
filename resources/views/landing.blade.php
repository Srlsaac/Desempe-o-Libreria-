@extends('layouts.bootstrap')

@section('content')

    <section class="hero p-4 p-md-5 mb-5 fade-up">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge rounded-pill text-bg-light mb-3">Biblioteca virtual</span>
                <h1 class="display-5 fw-bold mb-3">Tu biblioteca, siempre abierta</h1>
                <p class="lead mb-4">
                    Explora el catálogo, solicita préstamos en línea y lleva el control de tus lecturas desde un solo lugar.
                </p>

                <form action="{{ route('catalog.index') }}" method="GET" class="row g-2">
                    <div class="col-sm-8">
                        <input type="text" name="q" class="form-control form-control-lg"
                               placeholder="Busca por título o autor" aria-label="Buscar libros">
                    </div>
                    <div class="col-sm-4 d-grid">
                        <button class="btn btn-gold btn-lg">Buscar</button>
                    </div>
                </form>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-light">Ver todo el catálogo</a>
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.loans.index') : route('loans.index') }}"
                           class="btn btn-outline-light">
                            {{ auth()->user()->isAdmin() ? 'Ir al panel' : 'Mis préstamos' }}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Crear cuenta</a>
                    @endauth
                </div>
            </div>

            <div class="col-lg-5 text-center d-none d-lg-block">
                <svg viewBox="0 0 320 260" class="img-fluid hero-illustration" role="img" aria-label="Pila de libros">
                    <ellipse cx="160" cy="240" rx="130" ry="12" fill="rgba(0,0,0,.18)"/>
                    <rect x="40" y="190" width="240" height="44" rx="6" fill="#c9a24b"/>
                    <rect x="60" y="200" width="200" height="4" rx="2" fill="rgba(255,255,255,.55)"/>
                    <rect x="58" y="142" width="214" height="44" rx="6" fill="#f3e9cf"/>
                    <rect x="78" y="152" width="170" height="4" rx="2" fill="#c9a24b"/>
                    <rect x="48" y="94" width="232" height="44" rx="6" fill="#4d8a78"/>
                    <rect x="68" y="104" width="190" height="4" rx="2" fill="rgba(255,255,255,.55)"/>
                    <rect x="72" y="50" width="190" height="40" rx="6" fill="#faf7f0"/>
                    <rect x="92" y="60" width="120" height="4" rx="2" fill="#2f5d50"/>
                </svg>
            </div>
        </div>
    </section>

    <section class="mb-5 fade-up fade-up-2">
        <div class="row g-3 text-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body py-4">
                        <span class="stat-icon mb-2"><i class="bi bi-book"></i></span>
                        <p class="display-6 fw-bold mb-0 stat-number">{{ $booksCount }}</p>
                        <p class="text-muted mb-0">Libros en el catálogo</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body py-4">
                        <span class="stat-icon mb-2"><i class="bi bi-people"></i></span>
                        <p class="display-6 fw-bold mb-0 stat-number">{{ $authorsCount }}</p>
                        <p class="text-muted mb-0">Autores</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body py-4">
                        <span class="stat-icon mb-2"><i class="bi bi-tags"></i></span>
                        <p class="display-6 fw-bold mb-0 stat-number">{{ $categoriesCount }}</p>
                        <p class="text-muted mb-0">Categorías</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5 fade-up fade-up-3">
        <div class="text-center mb-4">
            <h2 class="section-title">¿Cómo funciona?</h2>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <span class="step-icon mb-3"><i class="bi bi-search"></i></span>
                <h3 class="h5">1. Explora</h3>
                <p class="text-muted mb-0">Busca por título o autor y revisa la disponibilidad de cada libro.</p>
            </div>
            <div class="col-md-4">
                <span class="step-icon mb-3"><i class="bi bi-journal-bookmark"></i></span>
                <h3 class="h5">2. Solicita</h3>
                <p class="text-muted mb-0">Crea tu cuenta y pide el préstamo. Puedes tener hasta 3 en curso a la vez.</p>
            </div>
            <div class="col-md-4">
                <span class="step-icon mb-3"><i class="bi bi-calendar-check"></i></span>
                <h3 class="h5">3. Disfruta</h3>
                <p class="text-muted mb-0">Cuando el administrador lo aprueba, tienes 15 días para leerlo y devolverlo.</p>
            </div>
        </div>
    </section>

    @if ($latest->isNotEmpty())
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h2 class="section-title mb-0">Últimas incorporaciones</h2>
                <a href="{{ route('catalog.index') }}">Ver todo el catálogo</a>
            </div>
            <div class="row g-4">
                @foreach ($latest as $book)
                    <div class="col-sm-6 col-lg-4">
                        @include('partials.book-card')
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mb-5">
        <div class="text-center mb-4">
            <h2 class="section-title">Preguntas frecuentes</h2>
        </div>

        <div class="accordion shadow-sm" id="faq">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1"
                            aria-expanded="true" aria-controls="faq1">
                        ¿Necesito una cuenta para ver el catálogo?
                    </button>
                </h3>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                    <div class="accordion-body text-muted">
                        No. Cualquiera puede explorar y buscar libros. La cuenta solo es necesaria para solicitar un préstamo.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2"
                            aria-expanded="false" aria-controls="faq2">
                        ¿Cuántos libros puedo pedir a la vez?
                    </button>
                </h3>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body text-muted">
                        Hasta 3 préstamos en curso al mismo tiempo, contando las solicitudes pendientes y los préstamos activos.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3"
                            aria-expanded="false" aria-controls="faq3">
                        ¿Cuánto tiempo puedo quedarme con el libro?
                    </button>
                </h3>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body text-muted">
                        15 días, contados desde que el administrador aprueba la solicitud. La fecha de vencimiento aparece en "Mis préstamos".
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4"
                            aria-expanded="false" aria-controls="faq4">
                        ¿Cómo sé si mi solicitud fue aprobada?
                    </button>
                </h3>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body text-muted">
                        En "Mis préstamos" ves el estado de cada solicitud: pendiente, activo, devuelto o rechazado.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5"
                            aria-expanded="false" aria-controls="faq5">
                        ¿Cómo devuelvo un libro?
                    </button>
                </h3>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faq">
                    <div class="accordion-body text-muted">
                        Lo entregas al administrador, que registra la devolución. El préstamo pasa a "devuelto" y la copia vuelve a estar disponible para otros lectores.
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
        <section class="cta-band p-5 text-center">
            <h2 class="mb-2">Empieza hoy</h2>
            <p class="mb-4">Crea tu cuenta y solicita tu primer libro.</p>
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <a href="{{ route('register') }}" class="btn btn-gold btn-lg">Crear cuenta</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Iniciar sesión</a>
            </div>
        </section>
    @endguest

@endsection
