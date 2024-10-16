<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerAlumnos() {
        global $tasksCollection;
        return $tasksCollection->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }
    function crearAlumno($nombre, $edad, $fechaNacimiento) {
        global $tasksCollection;
        $resultado = $tasksCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'edad' => sanitizeInput($edad),
            'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
            'presente' => false
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerAlumnoPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarAlumno($id, $nombre, $edad, $fechaNacimiento, $presente) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'edad' => sanitizeInput($edad),
                'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
                'presente' => $presente
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarAlumno($id) {
        global $tasksCollection;
        $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>