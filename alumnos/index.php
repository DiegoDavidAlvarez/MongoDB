<?php
require_once __DIR__ .'/includes/functions.php';
if (isset($_GET["mensaje"])){
    $message = $_GET["mensaje"];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearUsuario($_POST['usuario'], $_POST['correo'], $_POST['password']);
    if ($id) {
        header("Location: login.php?mensaje=Usuario creado con éxito");
        exit;
    } else {
        $message = "No se pudo crear el usuario.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styleLogin.css">
    <title>Registrate</title>
</head>
<body>
    <div class="container">
        <div class="register">
            <h1>
                Registrate
            </h1><hr>
            <?php if (isset($message)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                
                <script>alert("<?php echo $message; ?>");
                window.location.href = "index.php";</script>
            </div>
            <?php endif; ?>
            <form method="POST">
                <h2>
                    <label for="usuario">
                        Nombre de usuario:
                        <input placeholder="Nombre de usuario" type="text" name="usuario" id="usuario">
                    </label>
                </h2>
                <h2>
                    <label for="correo">
                        Correo electrónico:
                        <input placeholder="Dirección de correo electrónico" type="text" name="correo" id="correo">
                    </label>
                </h2>
                <h2>
                    <label for="password">
                        Contraseña:
                        <input placeholder="Contraseña" type="password" name="password" id="password">
                    </label>
                </h2>
                <h2>
                    <button type="submit">Crear cuenta</button>
                </h2><hr class="separador">
                <span class="texto">¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></span>
            </form>
        </div>
    </div>
</body>
</html>