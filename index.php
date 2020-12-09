<?php
    define('TITULO','Proyecto Semestral');
        include('clases/datos.php');
        session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/estilo1.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Sistema de Inventario</title>
</head>
<body>


<form name="form1" method='POST'>
<h2>Iniciar Sesión</h2>
<div class="inputWithIcon">
<input class="input" type="text" name="usuario" placeholder="Usuario" required>
<i class="fas fa-user" aria-hidden="true"></i>
</div>

<div class="passIcon">
<input class="input" type="password" name="contra" placeholder="Contraseña" required>
<i class="fas fa-unlock-alt" aria-hidden="true"></i>
</div>

<input type="submit" class="btn" name="enviar" value="Enviar">

</form>

<?php
if(isset($_POST['enviar'])){
        $usuario = $_POST['usuario'];
        $contra= $_POST['contra'];
        $dato = new datos($usuario,$contra);

            if($dato->Verificar()==true){
            ?>
            <script>
            var frm=document.form1;
            frm.style.display="none"    
            </script>
            <form action="frontend/pages/productos.php" name="form2" method='POST'>
                <h2>Bienvenido haga click Aquí</h2>
                <h2><?= $_SESSION["usuario"]?></h2>  
        <input type="submit" class="btn-comenzar" name="comenzar" value="Comenzar">
            </form>

    <?php
            }
            
            else{
            ?>
            <p class="error">Usuario o Contraseña incorrecta</p>
            <?php

            }  
}

?>

</body>
</html>