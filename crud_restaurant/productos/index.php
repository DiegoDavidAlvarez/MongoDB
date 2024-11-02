<?php
require_once __DIR__ . '/../includes/functions.php';
$productos = obtenerProductos();
if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
}
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarProducto($_GET['id']);
    if ($count > 0){
        $mensaje = "Producto eliminado con éxito.";
        $resultado = "success";
    } else {
        $mensaje = "No se pudo eliminar el producto.";
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
    <title>Productos</title>
</head>

<body>
    <div class="contenedor">
        <?php if (isset($mensaje) && isset($_GET['resultado'])): ?>
            <div class="<?php echo $_GET['resultado']; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <h1>Registro de productos</h1>
        <hr><br>
        <a href="nuevo.php" class="boton">Agregar nuevo producto</a>
        <h2>Lista de productos registrados</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Disponible</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['nombre']) ?></td>
                        <td><?php echo htmlspecialchars($p['precio']) ?></td>
                        <td><?php echo htmlspecialchars($p['descripcion']) ?></td>
                        <td><?php echo htmlspecialchars($p['categoria']) ?></td>
                        <td><?php echo $p['disponible'] ? 'Sí' : 'No' ?></td>
                        <td class="actions">
                            <a href="editar.php?id=<?php echo $p['_id']; ?>" class="boton">Editar</a>
                        </td>
                        <td class="actions">
                            <a href="index.php?accion=eliminar&id=<?php echo $p['_id']; ?>" class="boton" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>