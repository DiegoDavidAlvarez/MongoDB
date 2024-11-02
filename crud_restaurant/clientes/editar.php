<?php
require_once __DIR__ . '/../includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$cliente = obtenerClientePorId($_GET['id']);

if (!$cliente) {
    header("Location: index.php?mensaje=Cliente no encontrado&resultado=error");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarCliente($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);
    if ($count > 0) {
        header("Location: index.php?mensaje=Cliente actualizado con éxito&resultado=success");
        exit;
    } else {
        header("Location: index.php?mensaje=No se pudo actualizar el Cliente&resultado=error");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="contenedor">
        <h1>Editar cliente</h1>
        <hr>
        <?php if (isset($_GET['resultado']) && $_GET['resultado'] == 'error'): ?>
            <div class="error"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required></label>
            <label>Correo: <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>"></label>
            <label>Telefono: <input type="number" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required></label>
            <label>Dirección: <input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required></label><hr>
            <input type="submit" value="Actualizar Cliente">
        </form>
        <a href="index.php" class="boton">Volver a la lista de clientes</a>
    </div>
</body>

</html>