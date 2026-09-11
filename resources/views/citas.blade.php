<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Citas</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="page-header">
    <div class="container">
    <h1>Gestión de Citas</h1>
    <a href="javascript:history.back()" class="btn btn-secundary">
        Volver
    </a>
</div>
</header>
<main class="container">
<div class="section-header">
    <h2>Citas Programadas</h2>
    <a href="agendar-citas.html" class="btn btn-primary">
        + Agendar Cita
    </a>
</div>
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Categoría</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Max</td>
                <td>25/06/2026</td>
                <td>10:00 AM</td>
                <td>Consulta</td>
                <td>
                    <span class="badge success">
                        Programada
                    </span>
                </td>
            </tr>

            <tr>
                <td>Luna</td>
                <td>27/06/2026</td>
                <td>03:00 PM</td>
                <td>Vacunación</td>
                <td>
                    <span class="badge warning">
                        Pendiente
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</main>
</body>
</html>
