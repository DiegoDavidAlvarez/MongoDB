<?php
require_once __DIR__ .'/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['password'];
    $usuario = obtenerUsuario($nombre, $correo, $contraseña);

    if ($nombre == $usuario['usuario'] && $correo == $usuario['correo'] && $contraseña == $usuario['contraseña']){
        header("Location: principal.php?mensaje=Bienvenido " . $usuario['usuario']);
        exit;
    }else{
        header("Location: login.php?mensaje=Usuario o contraseña incorrectos");
    exit;
    }
}
if (isset($_GET["mensaje"])){
    $message = $_GET["mensaje"];
}
// $usuarios = obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styleLogin.css">
    <title>Document</title>
</head>
<body>
    <?php if (isset($message)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            
            <script>alert("<?php echo $message; ?>");
            window.location.href = "login.php";</script>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="register">
            <h1>
                Iniciar Sesión
            </h1><hr>
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
                    <button type="submit">Iniciar Sesión</button>
                </h2><hr class="separador">
                <span class="texto">¿No tienes una cuenta? <a href="index.php">Registrarse</a></span>
            </form>
        </div>
    </div>
</body>
</html>