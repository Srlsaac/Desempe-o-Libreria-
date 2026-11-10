@extends('layouts.bootstrap')

@section('title', 'Nueva contraseña · LibreApp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 mb-1">Crea tu nueva contraseña</h1>
                    <p class="text-muted mb-4">Elige una contraseña que no hayas usado antes.</p>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   required autofocus autocomplete="username">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña nueva</label>
                            <input id="password" type="password" name="password"
                                   class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   required autocomplete="new-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control form-control-lg" required autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">Cambiar contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
