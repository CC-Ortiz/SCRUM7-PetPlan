<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | @yield('titulo', 'Panel')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('estilos')
</head>
<body>

<div class="app-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-dog"></i>
                <h2> PetPlan </h2>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        🏠 Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('mascotas.index') }}" class="nav-btn {{ request()->routeIs('mascotas.*') ? 'active' : '' }}">
                        🐶 Mis Mascotas
                    </a>
                </li>
                <li>
                    <a href="{{ route('citas.index') }}" class="nav-btn {{ request()->routeIs('citas.*') ? 'active' : '' }}">
                        📅 Mis Citas
                    </a>
                </li>
                <li>
                    <a href="{{ route('vacunas.index') }}" class="nav-btn {{ request()->routeIs('vacunas.*') ? 'active' : '' }}">
                        💉 Vacunas
                    </a>
                </li>
                <li>
                    <a href="{{ route('historial.index') }}" class="nav-btn {{ request()->routeIs('historial.*') ? 'active' : '' }}">
                        📋 Historial Clínico
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="avatar">
                    {{ strtoupper(mb_substr(auth()->user()->nombre, 0, 1).mb_substr(auth()->user()->apellido, 0, 1)) }}
                </div>
                <div class="user-info">
                    <span class="user-name">
                        {{ auth()->user()->nombreCompleto() }}
                    </span>
                    <span class="user-role">
                        Cliente
                    </span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="nav-btn" style="width:100%; border:none; cursor:pointer; text-align:left;">
                    🚪 Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>
    <!-- CONTENIDO -->
    <main class="main-content">
        <header class="topbar">
            <h2>Bienvenido, {{ auth()->user()->nombre }} 👋</h2>
        </header>
        <div class="views-container">
            @if (session('status'))
                <div class="badge success" style="display:block; margin-bottom: 16px; padding: 12px;">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="badge danger" style="display:block; margin-bottom: 16px; padding: 12px;">
                    <ul style="margin:0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('contenido')
        </div>
    </main>
</div>
</body>
</html>
