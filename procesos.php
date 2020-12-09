<?php
    require './clases/Conexion.php';
    require './clases/Productos.php';

    $productos = new Productos();

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $productos->eliminarProducto($id);
    }
    header('Location: frontend/pages/productos.php');