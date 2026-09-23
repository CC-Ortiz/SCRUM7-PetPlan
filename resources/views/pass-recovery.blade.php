@extends('layouts.app')

@section('titulo', 'Recuperar Contraseña')

@section('nav-links')
    <li> <a href="{{ route('login') }}" class="btn btn-primary"> Iniciar Sesión </a> </li>
    <li><a href="{{ route('inicio') }}"> Inicio </a></li>
@endsection

@section('contenido')
{{-- resources/views/auth/restablecer-password.blade.php (solo contenido) --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h4 mb-2"> Crea tu contraseña nueva </h1>
                    <p class="text-muted mb-4"> Escribe una contraseña de al menos 8 caracteres. </p>

                    <form method="POST" action="{{ route('password.update') }}" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label"> Correo electrónico </label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $email) }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"> Contraseña nueva </label>
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   autocomplete="new-password" required autofocus>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label"> Confirma la contraseña </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100"> Guardar contraseña </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection