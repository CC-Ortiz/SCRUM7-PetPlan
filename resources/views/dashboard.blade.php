<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-dog"></i>
                <h2>PetPlan</h2>
            </div>
        </div>
       <nav class="sidebar-nav">
    <ul>
        <li>
            <a href="dashboard.html" class="nav-btn active">
                📊 Dashboard
            </a>
        </li>
        <li>
            <a href="mascotas.html" class="nav-btn">
                🐶 Mascotas
            </a>
        </li>
        <li>
            <a href="citas.html" class="nav-btn">
                📅 Citas
            </a>
        </li>
        <li>
            <a href="vacunas.html" class="nav-btn">
                💉 Vacunas
            </a>
        </li>
        <li>
            <a href="historial.html" class="nav-btn">
                📋 Historial Clínico
            </a>
        </li>
        <li>
            <a href="error404.html" class="nav-btn">
                👤 Perfil
            </a>
        </li>

    </ul>
</nav>
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="avatar">
                    DR
                </div>
                <div class="user-info">
                    <span class="user-name">
                        Administrador
                    </span>
                    <span class="user-role">
                        Veterinario
                    </span>
                </div>
            </div>
        </div>
    </aside>
    <!-- MAIN -->
    <main class="main-content">
        <header class="topbar">
            <h2>Bienvenido.</h2>
        </header>
        <div class="views-container">
            <h1 class="page-title">
                Resumen General
            </h1>
            <!-- ESTADISTICAS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon green-bg">
                        🐶
                    </div>
                    <div class="stat-details">
                        <h3>Mascotas Registradas</h3>
                        <p class="stat-number">124</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon light-green-bg">
                        📅
                    </div>
                    <div class="stat-details">
                        <h3>Citas Programadas</h3>
                        <p class="stat-number">18</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon outline-bg">
                        💉
                    </div>
                    <div class="stat-details">
                        <h3>Vacunas Pendientes</h3>
                        <p class="stat-number">32</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon outline-bg">
                        📋
                    </div>
                    <div class="stat-details">
                        <h3>Historiales Activos</h3>
                        <p class="stat-number">124</p>
                    </div>
                </div>
            </div>

            <!-- ACTIVIDAD -->
            <div class="card">
                <div class="card-header">
                    <h2>Actividad Reciente</h2>
                </div>
                <ul class="activity-list">
                    <li>
                        <div class="activity-icon">
                            🐶
                        </div>
                        <div class="activity-text">
                            <p>
                                Se registró una nueva mascota:
                                <strong>Max</strong>
                            </p>
                            <span class="time">
                                Hace 10 minutos
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon">
                            📅
                        </div>

                        <div class="activity-text">
                            <p>
                                Nueva cita programada para
                                <strong>Luna</strong>
                            </p>
                            <span class="time">
                                Hace 30 minutos
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon">
                            💉
                        </div>
                        <div class="activity-text">
                            <p>
                                Vacuna aplicada a
                                <strong>Rocky</strong>
                            </p>
                            <span class="time">
                                Hace 1 hora
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</div>
</body>
</html>