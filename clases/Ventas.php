<?php
class Ventas {
    public $id, $codigo, $nombre, $categoria, $tipo, $existencia, $precio;
    
    public function getDatos(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT `cod_producto`, nombre, t2.descripcion as Categoria, t3.descripcion as Tipo, `stock`, `precio_unitario` FROM `inventario` t1 INNER JOIN inventario_categoria t2 ON t1.categoria = t2.id_categoria INNER JOIN inventario_tipo t3 ON t1.tipo_producto = t3.id_tipo";

        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }

}
