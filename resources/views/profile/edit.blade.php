@extends('layouts.bootstrap')

@section('title', 'Mi perfil · LibreApp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="h2 mb-4">Mi perfil</h1>

            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h2 class="h5">Información personal</h2>
                    <p class="text-muted small">Actualiza tu nombre y tu correo electrónico.</p>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success">Cambios guardados.</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h2 class="h5">Cambiar contraseña</h2>
                    <p class="text-muted small">Usa una contraseña larga y difícil de adivinar.</p>

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success">Contraseña actualizada.</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña actual</label>
                            <input id="current_password" type="password" name="current_password"
                                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                   autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña nueva</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                   autocomplete="new-password">
                            @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña nueva</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control" autocomplete="new-password">
                        </div>

                        <button class="btn btn-primary">Cambiar contraseña</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h2 class="h5">Privacidad y datos personales</h2>
                    <p class="text-muted small mb-2">
                        Puedes consultar en cualquier momento cómo tratamos tus datos.
                    </p>

                    @if ($user->privacy_accepted_at)
                        <p class="mb-2">
                            Autorizaste el tratamiento de tus datos el
                            <strong>{{ $user->privacy_accepted_at->format('d/m/Y \a \l\a\s H:i') }}</strong>
                            (política versión {{ $user->privacy_policy_version }}).
                        </p>
                    @endif

                    <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Leer la política de tratamiento de datos</a>
                </div>
            </div>

            @unless ($user->isAdmin())
                <div class="card shadow-sm border-danger-subtle">
                    <div class="card-body p-4">
                        <h2 class="h5 text-danger">Eliminar cuenta</h2>
                        <p class="text-muted small">
                            Esta acción no se puede deshacer. Al eliminar tu cuenta:
                        </p>
                        <ul class="text-muted small">
                            <li>Tu nombre y tu correo se reemplazan por datos genéricos y dejas de poder iniciar sesión.</li>
                            <li>Tus solicitudes pendientes se rechazan.</li>
                            <li>El historial de préstamos se conserva sin tus datos personales.</li>
                            <li>No puedes eliminarla si tienes libros prestados sin devolver.</li>
                        </ul>

                        @if ($errors->userDeletion->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->userDeletion->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse"
                                data-bs-target="#eliminarCuenta"
                                aria-expanded="{{ $errors->userDeletion->any() ? 'true' : 'false' }}">
                            Eliminar mi cuenta
                        </button>

                        <div class="collapse mt-3 {{ $errors->userDeletion->any() ? 'show' : '' }}" id="eliminarCuenta">
                            <form method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('DELETE')

                                <div class="mb-3">
                                    <label for="delete_password" class="form-label">Confirma tu contraseña</label>
                                    <input id="delete_password" type="password" name="password"
                                           class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                           autocomplete="current-password">
                                </div>

                                <div class="form-check mb-3">
                                    <input id="confirmacion" type="checkbox" name="confirmacion" value="1"
                                           class="form-check-input">
                                    <label for="confirmacion" class="form-check-label">
                                        Entiendo que la eliminación de mi cuenta es definitiva.
                                    </label>
                                </div>

                                <button class="btn btn-danger">Eliminar definitivamente</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
@endsection
