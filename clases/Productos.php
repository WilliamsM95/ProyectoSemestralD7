<?php
class Productos {
    private $id, $descripcion, $tamano, $precio, $costo, $existencia, $puntoReorden, $estado;
    public function __construct($id, $descripcion, $tamano, $precio, $costo, $existencia, $puntoReorden, $estado){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->tamano = $tamano; 
        $this->precio = $precio; 
        $this->costo = $costo;
        $this->existencia = $existencia;
        $this->puntoReorden = $puntoReorden;
        $this->estado = $estado;
    }
    public function getDatos(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT * FROM producto ORDER BY cod_producto ASC";
        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }

}