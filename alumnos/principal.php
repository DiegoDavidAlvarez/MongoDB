<?php
    require_once __DIR__ .'/includes/functions.php';
    $alumnos = obtenerAlumnos();
    if (isset($_GET["mensaje"])){
        $message = $_GET["mensaje"];
    }else{
        header("Location: index.php?mensaje=Tienes que iniciar sesión para ingresar a esta pagina");
    }

    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarAlumno($_GET['id']);
        $mensaje = $count > 0 ? "Alumno eliminado con éxito." : "No se pudo eliminar el alumno.";
        header("Location: principal.php?mensaje=$mensaje");
        exit;
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
        <h1>Registro de alumnos</h1><hr><br>

        <?php if (isset($message)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                
                <script>
                alert("<?php echo $message; ?>");
                </script>
                
            </div>
        <?php endif; ?>

        <a href="agregar_alumno.php" class="button">Agregar Nuevo alumno</a>

        <h2>Lista de Alumnos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Curso</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Promedio</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                <td><?php echo htmlspecialchars($alumno['curso']); ?></td>
                <td><?php echo htmlspecialchars($alumno['nota1']); ?></td>
                <td><?php echo htmlspecialchars($alumno['nota2']); ?></td>
                <td><?php echo htmlspecialchars($alumno['nota3']); ?></td>
                <td><?php
                $promedio = ($alumno['nota1'] + $alumno['nota2'] + $alumno['nota2']) / 3;
                $promedio = round($promedio, 2);
                echo $promedio; 
                ?></td>
                <td class="actions">
                    <a href="editar_alumno.php?id=<?php echo $alumno['_id']; ?>" class="button">Editar</a>
                    <a href="principal.php?accion=eliminar&id=<?php echo $alumno['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar a este alumno?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>