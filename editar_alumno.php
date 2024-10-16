<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$alumno = obtenerAlumnoPorId($_GET['id']);

if (!$alumno) {
    header("Location: index.php?mensaje=Alumno no encontrado");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarAlumno($_GET['id'], $_POST['nombre'], $_POST['edad'], $_POST['fechaNacimiento'], isset($_POST['presente']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Tarea actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la tarea.";
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
        <h1>Editar Tarea</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($alumno['nombre']); ?>" required></label>
            <label>Edad: <textarea name="edad" required><?php echo htmlspecialchars($alumno['edad']); ?></textarea></label>
            <label>Fecha de Nacimiento: <input type="date" name="fechaNacimiento" value="<?php echo formatDate($alumno['fechaNacimiento']); ?>" required></label>
            <label>Presente: <input type="checkbox" name="presente" <?php echo $alumno['presente'] ? 'checked' : ''; ?>></label><br>
            <input type="submit" value="Actualizar Alumno">
        </form>
        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>

</html>