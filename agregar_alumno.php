<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearAlumno($_POST['nombre'], $_POST['edad'], $_POST['fechaNacimiento']);
    if ($id) {
        header("Location: index.php?mensaje=Alumno agregado con éxito");
        exit;
    } else {
        $error = "No se pudo crear el alumno.";
    }
}
?>
<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Alumno</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Alumno</h1>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Edad: <input type="number" name="edad" required></label>
            <label>Fecha de nacimiento: <input type="date" name="fechaNacimiento" required></label>
            <input type="submit" value="Crear Alumno">
        </form>
        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>

</html>