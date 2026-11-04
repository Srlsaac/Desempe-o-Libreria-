@extends('layouts.bootstrap')

@section('title', 'Crear cuenta · LibreApp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-5 auth-side d-none d-lg-flex flex-column justify-content-center p-5">
                        <i class="bi bi-journal-bookmark display-4 mb-3"></i>
                        <h2 class="h3">Únete a LibreApp</h2>
                        <p class="mb-0">Crea tu cuenta para pedir libros en préstamo y llevar el control de tus lecturas.</p>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5">
                            <h1 class="h3 mb-1">Crear cuenta</h1>
                            <p class="text-muted mb-4">Solo te tomará un minuto.</p>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           required autofocus autocomplete="name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           required autocomplete="username">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input id="password" type="password" name="password"
                                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                                               required autocomplete="new-password">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                               class="form-control form-control-lg" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg">Registrarme</button>
                                </div>
                            </form>

                            <p class="text-center mt-4 mb-0">
                                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
