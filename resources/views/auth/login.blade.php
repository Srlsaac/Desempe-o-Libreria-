@extends('layouts.bootstrap')

@section('title', 'Iniciar sesión · LibreApp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-5 auth-side d-none d-lg-flex flex-column justify-content-center p-5">
                        <i class="bi bi-book-half display-4 mb-3"></i>
                        <h2 class="h3">Bienvenido de nuevo</h2>
                        <p class="mb-0">Inicia sesión para solicitar libros y revisar el estado de tus préstamos.</p>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5">
                            <h1 class="h3 mb-1">Iniciar sesión</h1>
                            <p class="text-muted mb-4">Ingresa con tu correo y contraseña.</p>

                            @if (session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           required autofocus autocomplete="username">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-4">
                                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                                    <label for="remember_me" class="form-check-label">Recordarme</label>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg">Entrar</button>
                                </div>
                            </form>

                            <p class="text-center mt-4 mb-0">
                                ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
