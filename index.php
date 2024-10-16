<?php
    require_once __DIR__ .'/includes/functions.php';
    $alumnos = obtenerAlumnos();

    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarAlumno($_GET['id']);
        $mensaje = $count > 0 ? "Tarea eliminada con éxito." : "No se pudo eliminar la tarea.";
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Registro de alumnos</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_alumno.php" class="button">Agregar Nuevo alumno</a>

        <h2>Lista de Alumnos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Fecha de Nacimiento</th>
                <th>Presente</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                <td><?php echo htmlspecialchars($alumno['edad']); ?></td>
                <td><?php echo formatDate($alumno['fechaNacimiento']); ?></td>
                <td><?php echo $alumno['presente'] ? 'Sí' : 'No'; ?></td>
                <td class="actions">
                    <a href="editar_alumno.php?id=<?php echo $alumno['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $alumno['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar a este alumno?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>