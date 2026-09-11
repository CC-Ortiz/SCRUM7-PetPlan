<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Iniciar Sesión</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-dog"></i>
                <span>PetPlan</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/registro') }}" class="btn btn-secundary">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- LOGIN -->
    <main>
        <div class="container-login">
            <div class="login-card">
                <div class="login-header">
                    <i class="fas fa-paw"></i>
                    <h1>Bienvenido</h1>
                    <p>Inicia sesión para acceder a PetPlan</p>
                </div>

                <form action="dashboard.html" method="POST">
                    <div class="form-grupo">
                        <label for="email">Correo Electrónico</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="correo@ejemplo.com"
                            required
                        >
                    </div>
                    <div class="form-grupo">
                        <label for="password">Contraseña</label>
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
                            <input type="checkbox">
                            Recordarme
                        </label>
                        <a href="#">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary login-btn"
                        >
                        Iniciar Sesion
                    </button>
                </form>
                <div class="login-footer">
                    <p>
                        ¿No tienes una cuenta?
                        <a href="registro.html">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>