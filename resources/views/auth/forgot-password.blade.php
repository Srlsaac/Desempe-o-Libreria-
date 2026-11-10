@extends('layouts.bootstrap')

@section('title', 'Recuperar contraseña · LibreApp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 mb-1">¿Olvidaste tu contraseña?</h1>
                    <p class="text-muted mb-4">
                        Escribe tu correo y te enviaremos un enlace para crear una nueva.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   required autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">Enviar enlace</button>
                        </div>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        <a href="{{ route('login') }}">Volver a iniciar sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
