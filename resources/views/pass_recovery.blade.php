@extends('layouts.app')

@section('titulo', 'Recuperación de Contraseña')

@section('nav-links')
    <li> <a href="{{ route('login') }}" class="btn btn-primary"> Iniciar Sesión </a> </li>
    <li><a href="{{ route('inicio') }}"> Inicio </a></li>
@endsection

@section('contenido')
    <div class="container-login">
        <div class="login-card">
            <div class="login-header">
                <h1> Recupera tu contraseña </h1>
                <p> Escribe el correo de tu cuenta y te enviaremos un enlace para crear una contraseña nueva. </p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <form method="POST" action="{{ route('password.send') }}" novalidate>
                        @csrf
                    <div class="form-grupo">
                        <label for="email"> Correo Electrónico </label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="correo@ejemplo.com"
                                   autocomplete="email" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                        <button type="submit" class="btn btn-primary"> Enviar enlace </button>
                </form>
            </div>
        </div>
    </div>
@endsection