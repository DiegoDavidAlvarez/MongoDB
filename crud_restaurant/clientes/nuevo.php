<?php
require_once __DIR__ . '/../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = crearCliente($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);
    if ($id) {
        header("Location: index.php?mensaje=Cliente agregado con exito&resultado=success");
        exit;
    } else {
        header("Location: nuevo.php?mensaje=Error no se pudo actualizar el cliente&resultado=error");
        exit;
    }
}
?>
<?php if (isset($_GET['resultado']) && isset($_GET['mensaje'])): ?>
    <div class="<?php echo $_GET['resultado'] ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Agregar nuevo cliente</title>
</head>
<body>
    <div class="contenedor">
        <h1>Agregar nuevo cliente</h1><hr><br>
        <form method="post">
            <label>Nombre: <input type="text" name="nombre" id="nombre" required></label>
            <label>Correo: <input type="email" name="correo" id="correo" required></label>
            <label>Telefono: <input type="number" name="telefono" id="telefono" required></label>
            <label>Direccion: <input type="text" name="direccion" id="direccion" required></label>
            <input type="submit" value="Agregar cliente">
        </form>
        <a href="index.php" class="boton">Volver a la lista de clientes</a>
    </div>
</body>
</html>