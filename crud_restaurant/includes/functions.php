<?php
    require_once __DIR__ .'/../config/database.php';

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
    #####################
    # Funciones Cliente #
    #####################
    function obtenerClientes() {
        global $colleccionClientes;
        return $colleccionClientes->find();
    }
    function crearCliente($nombre, $correo, $telefono, $direccion) {
        global $colleccionClientes;
        $resultado = $colleccionClientes->insertOne([
            'nombre' => sanitizeInput($nombre),
            'correo' => sanitizeInput($correo),
            'telefono' => sanitizeInput($telefono),
            'direccion' => sanitizeInput($direccion),
            // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerClientePorId($id) {
        global $colleccionClientes;
        return $colleccionClientes->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarCliente($id, $nombre, $correo, $telefono, $direccion) {
        global $colleccionClientes;
        $resultado = $colleccionClientes->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'correo' => sanitizeInput($correo),
                'telefono' => sanitizeInput($telefono),
                'direccion' => sanitizeInput($direccion),
                // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarCliente($id) {
        global $colleccionClientes;
        $resultado = $colleccionClientes->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    ######################
    # Funciones Producto #
    ######################
    function obtenerProductos(){
        global $colleccionProductos;
        return $colleccionProductos->find();
    }
    function crearProducto($nombre, $precio, $descripcion, $categoria){
        global $colleccionProductos;
        $resultado = $colleccionProductos->insertOne([
            'nombre' => sanitizeInput($nombre),
            'precio' => sanitizeInput($precio),
            'descripcion' => sanitizeInput($descripcion),
            'categoria' => sanitizeInput($categoria),
            'disponible' => true,
            // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerProductoPorId($id) {
        global $colleccionProductos;
        return $colleccionProductos->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarProducto($id, $nombre, $precio, $descripcion, $categoria, $disponible) {
        global $colleccionProductos;
        $resultado = $colleccionProductos->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'precio' => sanitizeInput($precio),
                'descripcion' => sanitizeInput($descripcion),
                'categoria' => sanitizeInput($categoria),
                'disponible' => $disponible,
                // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarProducto($id) {
        global $colleccionProductos;
        $resultado = $colleccionProductos->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
?>