<?php
    require './clases/Conexion.php';
    require './clases/Productos.php';

    $productos = new Productos();

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $productos->eliminarProducto($id);
    }

    if(isset($_POST['nombre']) && isset($_POST['categoria']) && isset($_POST['tipo']) && isset($_POST['cantidad']) && isset($_POST['precio']))
    {
        echo $_POST['nombre'].'<br>';
        echo $_POST['categoria'].'<br>';
        echo $_POST['tipo'].'<br>';
        echo $_POST['cantidad'].'<br>';
        echo $_POST['precio'].'<br>';
        $productos->InsertarProductos($_POST['nombre'], $_POST['categoria'], $_POST['tipo'], $_POST['cantidad'], $_POST['precio']);
    }
    //header('Location: frontend/pages/productos.php');