@extends('layouts.app')

@section('titulo', 'Recuperar Contraseña')

@section('nav-links')
    <li> <a href="{{ route('login') }}" class="btn btn-primary"> Iniciar Sesión </a> </li>
    <li><a href="{{ route('inicio') }}"> Inicio </a></li>
@endsection

@section('contenido')
    <div class="container-login">
        <div class="login-card">    
            <div class="login-header">
                <h1> Crea tu contraseña nueva </h1>
                <p> Escribe una contraseña de al menos 8 caracteres </p>

                <form method="POST" action="{{ route('password.update') }}" novalidate>
                    @csrf
                    <div class="form-grupo">
                        <input type="hidden" name="token" value="{{ $token }}">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $email) }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="password"> Contraseña Nueva </label>
                            <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="new-password" required autofocus>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="password_confirmation"> Confirma la contraseña </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" autocomplete="new-password" required>
                            <button type="submit" class="btn btn-primary"> Guardar contraseña </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection