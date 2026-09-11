<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Mi Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

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
                    <a href="dashboard-cliente.html" class="nav-btn active">
                        🏠 Inicio
                    </a>
                </li>
                <li>
                    <a href="mascotas.html" class="nav-btn">
                        🐶 Mis Mascotas
                    </a>
                </li>
                <li>
                    <a href="citas.html" class="nav-btn">
                        📅 Mis Citas
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
                        👤 Mi Perfil
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="avatar">
                    JD
                </div>
                <div class="user-info">
                    <span class="user-name">
                        Juan Díaz
                    </span>
                    <span class="user-role">
                        Cliente
                    </span>
                </div>
            </div>
        </div>
    </aside>
    <!-- CONTENIDO -->
    <main class="main-content">
        <header class="topbar">
            <h2>Bienvenido, Juan 👋</h2>
        </header>
        <div class="views-container">
            <h1 class="page-title">
                Resumen de tus Mascotas
            </h1>
            <!-- ESTADÍSTICAS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon green-bg">
                        🐶
                    </div>
                    <div>
                        <h3>Mascotas Registradas</h3>
                        <p class="stat-number">3</p>
                    </div>
                </div>
                <div class="stat-card">

                    <div class="stat-icon blue-bg">
                        📅
                    </div>
                    <div>
                        <h3>Citas Pendientes</h3>
                        <p class="stat-number">2</p>
                    </div>
                </div>
                <div class="stat-card">

                    <div class="stat-icon green-bg">
                        💉
                    </div>

                    <div>
                        <h3>Vacunas Próximas</h3>
                        <p class="stat-number">1</p>
                    </div>
                </div>
            </div>
            <!-- PRÓXIMAS CITAS -->
            <div class="card">

                <div class="card-header">
                    <h2>Próximas Citas</h2>
                </div>
                <ul class="activity-list">
                    <li>
                        <div class="activity-icon">
                            📅
                        </div>
                        <div class="activity-text">
                            <p>
                                <strong>Max</strong> - Consulta General
                            </p>
                            <span class="time">
                                25/06/2026 - 10:00 AM
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon">
                            💉
                        </div>
                        <div class="activity-text">
                            <p>
                                <strong>Luna</strong> - Vacunación
                            </p>
                            <span class="time">
                                30/06/2026 - 03:00 PM
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <br>
            <!-- RECORDATORIOS -->
            <div class="card">
                <div class="card-header">
                    <h2>Recordatorios</h2>
                </div>
                <ul class="activity-list">
                    <li>
                        <div class="activity-icon">
                            🔔
                        </div>
                        <div class="activity-text">
                            <p>
                                La vacuna contra la rabia de
                                <strong>Max</strong>
                                vence el próximo mes.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</div>
</body>
</html>