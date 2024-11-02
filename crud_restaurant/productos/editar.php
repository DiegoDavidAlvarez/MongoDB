<?php
require_once __DIR__ . '/../includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$producto = obtenerProductoPorId($_GET['id']);

if (!$producto) {
    header("Location: index.php?mensaje=Producto no encontrado&resultado=error");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarProducto($_GET['id'], $_POST['nombre'], doubleval($_POST['precio']), $_POST['descripcion'], $_POST['categoria'], isset($_POST['disponible']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Producto actualizado con éxito&resultado=success");
        exit;
    } else {
        header("Location: index.php?mensaje=No se pudo actualizar el Producto&resultado=error");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <div class="contenedor">
        <h1>Editar producto</h1>
        <hr>
        <?php if (isset($_GET['resultado']) && $_GET['resultado'] == 'error'): ?>
            <div class="error"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required></label>
            <label>Precio: <input type="number" name="precio" id="precio" step="any" value="<?php echo htmlspecialchars($producto['precio']); ?>"></label>
            <label>Descripción: <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($producto['descripcion']) ?></textarea></label>
            <label>
                Categoria: 
                <select name="categoria" id="categoria" required>
                    <option value="Sopa">Sopa</option>
                    <option value="Segundo">Segundo</option>
                    <option value="Bebida">Bebida</option>
                    <option value="Postre">Postre</option>
                    <option value="<?php echo htmlspecialchars($producto['categoria']) ?>" hidden selected><?php echo htmlspecialchars($producto['categoria']) ?></option>
                </select>
            </label>
            <label>Disponible: <input type="checkbox" name="disponible" <?php echo htmlspecialchars($producto['disponible'] ? "checked" : "") ?>></label><br><hr>
            <input type="submit" value="Actualizar Producto">
        </form>
        <a href="index.php" class="boton">Volver a la lista de productos</a>
    </div>
</body>

</html>