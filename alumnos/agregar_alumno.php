<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearAlumno($_POST['nombre'], $_POST['curso'], intval($_POST['nota1']), intval($_POST['nota2']), intval($_POST['nota3']));
    if ($id) {
        header("Location: principal.php?mensaje=Alumno agregado con éxito");
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
        <h1>Agregar Nuevo Alumno</h1><hr>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Curso: <input type="text" name="curso" required></label>
            <label>Nota 1: <input type="number" name="nota1" required></label>
            <label>Nota 2: <input type="number" name="nota2" required></label>
            <label>Nota 3: <input type="number" name="nota3" required></label><hr>
            <input type="submit" value="Agregar Alumno">
        </form>
        <a href="index.php" class="button">Volver a la lista de alumnos</a>
    </div>
</body>

</html>