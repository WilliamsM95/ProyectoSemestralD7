<?php
require "clases/Conexion.php";

class datos{
public $usuario="";
public $contra="";

function __construct($user,$pass){
    $this->usuario = $user;
    $this->contra = $pass;
}

public function Verificar(){
    $con = new Conexion();
    $verificar=true;
    $consulta = "SELECT * FROM usuarios WHERE usuario= '".$this->usuario."' AND contra= '".$this->contra."'";
    $resul = mysqli_query($con->Conectar(), $consulta);
    $existLogin = mysqli_num_rows($resul);
    if(!$existLogin > 0){
        $verificar = false;
        }
    else{
        $resul = mysqli_fetch_object($resul);
        $_SESSION["usuario"] = $resul->usuario;
        $_SESSION["contra"] = $resul->contra;
        $_SESSION["tipo"] = $resul->tipo;
        }

    mysqli_close($con->Conectar());
    return $verificar;
    }


}

?>