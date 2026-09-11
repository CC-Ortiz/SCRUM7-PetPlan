<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-dog"></i>
                <span>PetPlan</span>
            </div>

            <nav>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}"> Inicio </a></li>
                </ul>
            </nav>
        </div>
    </header>

<section class="register-section">
    <div class="register-container">
        <h1> Crear Cuenta </h1>
        <div class="register-grid">
            <!-- CLIENTE -->
            <div class="register-card">
                <div class="register-icon"> 🐾 </div>
                    <form action="login.html" method="POST">
                        <div class="form-grupo">
                            <label>Nombre Completo</label>
                            <input type="text" name="name_user" placeholder="Nombre y apellido" required>
                        </div>

                        <div class="form-grupo">
                            <label>Correo Electrónico</label>
                            <input type="email" name="email_user" required placeholder="correo@ejemplo.com">
                        </div>

                        <div class="form-grupo">
                            <label>Teléfono</label>
                            <input type="number" name="phone_user" required placeholder="Número de teléfono">
                        </div>

                        <div class="form-grupo">
                            <label>Contraseña</label>
                            <input type="password" name="pass_user" required placeholder="********">
                        </div>

                        <button class="btn btn-primary"> Registrarme </button>
                    </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<!--Jeilo Verde-->