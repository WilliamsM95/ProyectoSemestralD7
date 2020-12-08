<?php
class Ventas {
    
    public function getDatos(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT * FROM inventario ORDER BY cod_producto ASC";
        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }

    public function getCategoria(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT * FROM `inventario_categoria`";        
        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }

    public function getTipo(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT * FROM `inventario_tipo`";        
        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }

}