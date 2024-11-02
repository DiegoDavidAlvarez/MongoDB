<?php
require_once __DIR__ . '/../includes/functions.php';
$clientes = obtenerClientes();
if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
}
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarCliente($_GET['id']);
    if ($count > 0){
        $mensaje = "Cliente eliminado con éxito.";
        $resultado = "success";
    } else {
        $mensaje = "No se pudo eliminar el cliente.";
        $resultado = "error";
    }
    header("Location: index.php?mensaje=$mensaje&resultado=$resultado");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Clientes</title>
</head>

<body>
    <div class="contenedor">
        <?php if (isset($mensaje) && isset($_GET['resultado'])): ?>
            <div class="<?php echo $_GET['resultado']; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <h1>Registro de clientes</h1>
        <hr><br>
        <a href="nuevo.php" class="boton">Agregar nuevo cliente</a>
        <h2>Lista de clientes registrados</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($c['nombre']) ?></td>
                        <td><?php echo htmlspecialchars($c['correo']) ?></td>
                        <td><?php echo htmlspecialchars($c['telefono']) ?></td>
                        <td><?php echo htmlspecialchars($c['direccion']) ?></td>
                        <td class="actions">
                            <a href="editar.php?id=<?php echo $c['_id']; ?>" class="boton">Editar</a>
                        </td>
                        <td class="actions">
                            <a href="index.php?accion=eliminar&id=<?php echo $c['_id']; ?>" class="boton" onclick="return confirm('¿Estás seguro de que quieres eliminar a este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>