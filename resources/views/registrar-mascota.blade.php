<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPlan | Registrar Mascota</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="page-header">

<div class="container">

    <h1>Registrar Mascota</h1>

    <a href="javascript:history.back()" class="btn btn-secundary">
        Volver
    </a>

</div>

</header>

<main class="container">
<div class="form-card">
    <form>
        <div class="form-grupo">
            <label>Nombre</label>
            <input type="text">
        </div>
        <div class="form-grupo">
            <label>Especie</label>
            <select>
                <option>Perro</option>
                <option>Gato</option>
                <option>Ave</option>
                <option>Otro</option>
            </select>
        </div>
        <div class="form-grupo">
            <label>Raza</label>
            <input type="text" required 
            placeholder="Raza de la mascota">
        </div>
        <div class="form-grupo">
            <label>Fecha de Nacimiento</label>
            <input type="date" required>
        </div>
        <div class="form-grupo">
            <label>Peso (kg)</label>
            <input type="number" required
            placeholder="Peso de la mascota">
        </div>
        <div class="form-grupo">
            <label>Color</label>
            <input type="text" required
            placeholder="Color de la mascota">
        </div>
        <div class="form-grupo">
            <label>Observaciones</label>
            <textarea rows="4" placeholder="Escribe cualquier observación relevante..."></textarea>
        </div>
        <button class="btn btn-primary">
            Guardar Mascota
        </button>
    </form>
</div>
</main>
</body>
</html>
