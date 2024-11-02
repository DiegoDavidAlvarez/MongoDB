<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://diegodsi4:QK3r95mHB12PU0QB@notas.sw37i.mongodb.net/?retryWrites=true&w=majority&appName=Notas");
    // $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->selectDataBase('restaurant');
    $colleccionClientes = $database->clientes;
    $colleccionProductos = $database->productos;
?>

