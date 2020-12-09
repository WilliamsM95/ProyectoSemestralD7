<?php
    require 'clases/Conexion.php';
    require 'clases/Productos.php';
    
    session_start();

    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $cat = $_POST["cat"];
    $tipo = $_POST["tipo"];
    $cant = $_POST["cant"];
    $precio = $_POST["precio"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$productos = new Productos();

$wasSaved = $productos->editarProducto($id,$nom,$cat,$tipo,$cant,$precio);
if($wasSaved){
    echo "Se editoooooooooooooooooooo!";

}else{
    echo "ya valio!";
}


?>

<form class="fr" action="frontend/pages/productos.php">
        <button type="submit" class="botton">Atras</button>
    </form>

</body>
</html>