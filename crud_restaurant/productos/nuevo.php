<?php
require_once __DIR__ . '/../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = crearProducto($_POST['nombre'], doubleval($_POST['precio']), $_POST['descripcion'], $_POST['categoria']);
    if ($id) {
        header("Location: index.php?mensaje=Producto agregado con exito&resultado=success");
        exit;
    } else {
        header("Location: nuevo.php?mensaje=Error no se pudo agregar el producto&resultado=error");
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
    <title>Agregar nuevo producto</title>
</head>
<body>
    <div class="contenedor">
        <h1>Agregar nuevo producto</h1><hr><br>
        <form method="post">
            <label>Nombre: <input type="text" name="nombre" id="nombre" required></label>
            <label>Precio: <input type="number" name="precio" id="precio" step="any" required></label>
            <label>Descripcion: <textarea name="descripcion" id="descripcion" required></textarea></label>
            <label>
                Categoria: 
                <select name="categoria" id="categoria" required>
                    <option value="Sopa" selected>Sopa</option>
                    <option value="Segundo">Segundo</option>
                    <option value="Bebida">Bebida</option>
                    <option value="Postre">Postre</option>
                </select>
            </label>
            <input type="submit" value="Agregar producto">
        </form>
        <a href="index.php" class="boton">Volver a la lista de productos</a>
    </div>
</body>
</html>