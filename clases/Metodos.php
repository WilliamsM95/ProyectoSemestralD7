<?php
include "Conexion.php";

class Metodos
{
    public function MostrarTodo()
    {
        $con = new Conexion();
        $mostrar = "SELECT * from arreglos";
        $resultado = mysqli_query($con->Conexion(), $mostrar);
        return $resultado;
    }

    public function MostrarEspecifico($tipo, $idi)
    {
        $con = new Conexion();
        if($tipo == 1)
        {
            $mostrar = "SELECT * from registros_pedidos";
        }
        elseif($tipo == 2)
        {
            $mostrar = "SELECT * from registros_pedidos WHERE id_cliente ='". $idi."'";
        }
        $resultado=mysqli_query($con->Conexion(), $mostrar);
        return $resultado;
    }

    public function Insertar($idCliente, $nombreCliente, $pa, $d, $contact,$dire,$msj,$color,$tipo)
    {
        $con = new Conexion();   
        $insertar = "INSERT INTO registros_pedidos(id_cliente, nombre_cliente, para, de, contacto, direccion, mensaje_personalizado, color_etiqueta, combo) VALUES ('$idCliente', '$nombreCliente', '$pa', '$d', '$contact','$dire','$msj','$color','$tipo')";
        
        $query = mysqli_query($con->Conexion(),$insertar);
    }
}
?>