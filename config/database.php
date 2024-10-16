<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://diegodsi4:7V4WdjSTsQKTmXAn@myatlasclusteredu.n5hyq.mongodb.net/?retryWrites=true&w=majority&appName=myAtlasClusterEDU");
    $database = $mongoClient->selectDataBase('alumnos');
    $tasksCollection = $database->tareas;
?>