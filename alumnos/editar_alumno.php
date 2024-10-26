<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: principal.php");
    exit;
}
$alumno = obtenerAlumnoPorId($_GET['id']);

if (!$alumno) {
    header("Location: principal.php?mensaje=Alumno no encontrado");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarAlumno($_GET['id'], $_POST['nombre'], $_POST['curso'], $_POST['nota1'], $_POST['nota2'], $_POST['nota3']);
    if ($count > 0) {
        header("Location: principal.php?mensaje=Alumno actualizado con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar el Alumno.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar alumno</h1>
        <hr>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($alumno['nombre']); ?>" required></label>
            <label>Curso: <textarea name="curso" required><?php echo htmlspecialchars($alumno['curso']); ?></textarea></label>
            <label>Nota 1: <input type="number" name="nota1" value="<?php echo htmlspecialchars($alumno['nota1']); ?>" required></label>
            <label>Nota 2: <input type="number" name="nota2" value="<?php echo htmlspecialchars($alumno['nota2']); ?>" required></label>
            <label>Nota 3: <input type="number" name="nota3" value="<?php echo htmlspecialchars($alumno['nota3']); ?>" required></label><hr>
            <input type="submit" value="Actualizar Alumno">
        </form>
        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>

</html>