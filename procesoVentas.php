<?php 

// carrito de compras y tipo Ventas
   
    $ventas = new Ventas();
    $cantidad = $_POST['cantidadUp'];
    $ventas->id = $_POST['codigoUp'];
    $ventas->nombre = $_POST['nombreUp'];
    $ventas->categoria = $_POST['categoriaUp'];
    $ventas->tipo = $_POST['tipoUp'];
    $ventas->existencia = $_POST['stockUp'];

    echo $ventas->id;
    echo '<br>';
    echo $ventas->nombre;
    echo '<br>';
    echo $ventas->categoria;
    echo '<br>';
    echo $ventas->tipo;
    echo '<br>';
    echo $ventas->existencia;
    echo '<br>';
    echo $cantidad;

    // sesion para compras
    session_start();
    if(isset($_SESSION['carrito'])){
        $carrito = $_SESSION['carrito'];
    } else {
        $carrito = array();
    }
    array_push($carrito, $ventas);
    $_SESSION['carrito'] = $ventas;

    header('location: ./frontend/pages/ventas.php');

?>
