<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerAlumnos() {
        global $tasksCollection;
        return $tasksCollection->find();
    }
    function obtenerUsuarios(){
        global $tasksCollection2;
        return $tasksCollection2->find();
    }
    function obtenerUsuario($nombre, $correo, $contraseña) {
        global $tasksCollection2;
        return $tasksCollection2->findOne([
            '$and' => [
                ['usuario' => $nombre],
                ['correo' => $correo],
                ['contraseña' => $contraseña]
            ]
        ]);
    }
    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        $input = htmlspecialchars(strip_tags(trim($input)));
        if (is_numeric($input)) {
            $input = max(0, $input);
        }
        return $input;
    }
    function crearAlumno($nombre, $curso, $nota1, $nota2, $nota3) {
        global $tasksCollection;
        $promedio = ($nota1 + $nota2 + $nota3) / 3;
        $promedio = round($promedio, 2);
        $resultado = $tasksCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'curso' => sanitizeInput($curso),
            'nota1' => sanitizeInput($nota1),
            'nota2' => sanitizeInput($nota2),
            'nota3' => sanitizeInput($nota3),
            // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function crearUsuario($nombre_usuario, $correo, $contraseña) {
        global $tasksCollection2;
        $usuarioExistente = $tasksCollection2->findOne(['usuario' => sanitizeInput($nombre_usuario)]);
    
        if (!$usuarioExistente) { 
            $resultado = $tasksCollection2->insertOne([
                'usuario' => sanitizeInput($nombre_usuario),
                'correo' => sanitizeInput($correo),
                'contraseña' => sanitizeInput($contraseña)
            ]);
    
            return $resultado->getInsertedId();
        } else {
            return false;
        }
    }
    function obtenerAlumnoPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarAlumno($id, $nombre, $curso, $nota1, $nota2, $nota3) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'curso' => sanitizeInput($curso),
                'nota1' => sanitizeInput($nota1),
                'nota2' => sanitizeInput($nota2),
                'nota3' => sanitizeInput($nota3),
                // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
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