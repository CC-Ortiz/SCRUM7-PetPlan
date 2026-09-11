<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Agendar Cita</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="page-header">
<div class="container">
    <h1>Agendar Cita</h1>
    <a href="javascript:history.back()" class="btn btn-secundary">Volver</a>
</div>
</header>
<main class="container">
<div class="form-card">
    <form>
        <div class="form-grupo">
            <label>Mascota</label>
            <select>
                <option>Max</option>
                <option>Luna</option>
                <option>Rocky</option>
            </select>
        </div>
        <div class="form-grupo">
            <label>Fecha</label>
            <input type="date" required>
        </div>
        <div class="form-grupo">
            <label>Hora</label>
            <input type="time" required>
        </div>
        <div class="form-grupo">
            <label>Categoría</label>
            <select>
                <option>Consulta General</option>
                <option>Vacunación</option>
                <option>Control</option>
                <option>Baño</option>
            </select>
        </div>
        <div class="form-grupo">
            <label>Observaciones</label>
            <textarea rows="4" placeholder="Escribe cualquier observación relevante..."></textarea>
        </div>
        <button class="btn btn-primary">
            Confirmar Cita
        </button>
    </form>
</div>
</main>
</body>
</html>
