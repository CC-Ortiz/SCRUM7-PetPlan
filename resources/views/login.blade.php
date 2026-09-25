@extends('layouts.app')

@section('titulo', 'Iniciar Sesión')

@section('nav-links')
    <li><a href="{{ route('inicio') }}">Inicio</a></li>
    <li><a href="{{ route('registro') }}" class="btn btn-secundary">Registrarse</a></li>
@endsection

@section('contenido')
    <main>
        <div class="container-login">
            <div class="login-card">
                <div class="login-header">
                    <i class="fas fa-paw"></i>
                    <h1>Bienvenido</h1>
                    <p>Inicia sesión para acceder a PetPlan</p>
                </div>

                @if ($errors->any())
                    <div class="badge danger" style="display:block; margin-bottom: 16px; padding: 12px;">
                        <ul style="margin:0; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <div class="form-grupo">
                        <label for="email"> Correo Electrónico </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            required
                        >
                    </div>
                    <div class="form-grupo">
                        <label for="password"> Contraseña </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="********"
                            required
                        >
                    </div>
                    <div class="login-options">
                        <label>
                            <input type="checkbox" name="remember">
                            Recordarme
                        </label>
                        <a href="{{ route('pass_recovery') }}"> ¿Olvidaste tu contraseña? </a>
                    </div>
                    <button type="submit" class="btn btn-primary login-btn"> Iniciar Sesion </button>
                </form>
                <div class="login-footer">
                    <p>
                        ¿No tienes una cuenta?
                        <a href="{{ route('registro') }}">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
