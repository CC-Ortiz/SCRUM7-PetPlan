<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Vacunas</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="page-header">

    <div class="container">

        <h1>Control de Vacunas</h1>

        <a href="javascript:history.back()" class="btn btn-secundary">
            Dashboard
        </a>

    </div>

</header>

<main class="container">

    <div class="section-header">

        <h2>Vacunas Registradas</h2>

        <a href="historial.html" class="btn btn-primary">
            Ver Historial Clínico
        </a>

    </div>

    <div class="table-card">
        <table>

            <thead>
                <tr>
                    <th>Mascota</th>
                    <th>Vacuna</th>
                    <th>Fecha Aplicación</th>
                    <th>Próximo Refuerzo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Max</td>
                    <td>Rabia</td>
                    <td>10/05/2026</td>
                    <td>10/05/2027</td>
                    <td>
                        <span class="badge success">
                            Vigente
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Luna</td>
                    <td>Triple Felina</td>
                    <td>15/02/2026</td>
                    <td>15/08/2026</td>
                    <td>
                        <span class="badge warning">
                            Próxima
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Rocky</td>
                    <td>Parvovirus</td>
                    <td>01/03/2025</td>
                    <td>01/03/2026</td>
                    <td>
                        <span class="badge danger">
                            Vencida
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>