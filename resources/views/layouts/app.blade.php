<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | @yield('titulo', 'Inicio')</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @stack('estilos')
</head>
<body>

    <header>
        <div class="container header-container">
            <div class="logo">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('favicon.ico') }}" alt="36" width="36">
                </a>
                <span> PetPlan </span>
            </div>

            <nav>
                <ul class="nav-links">
                    @yield('nav-links')
                </ul>
            </nav>
        </div>
    </header>

    @yield('contenido')

    <footer>
        <div class="container text-center">
            <h3>PetPlan</h3>
            <p> Plataforma para la gestión de citas, vacunas e historial clínico de mascotas.</p>
            <p>© {{ date('Y') }} PetPlan. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
