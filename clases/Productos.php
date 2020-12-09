<?php
class Productos {
    private $id, $descripcion, $tamano, $precio, $costo, $existencia, $puntoReorden, $estado;
    // public function __construct ($id, $descripcion, $tamano, $precio, $costo, $existencia, $puntoReorden, $estado){
    //     $this->id = $id;
    //     $this->descripcion = $descripcion;
    //     $this->tamano = $tamano; 
    //     $this->precio = $precio; 
    //     $this->costo = $costo;
    //     $this->existencia = $existencia;
    //     $this->puntoReorden = $puntoReorden;
    //     $this->estado = $estado;
    // }
    // public function getDatoUnico(){
    //     $conn = new Conexion();
    //     $con = $conn->Conectar();
    //     // Verificando la conexion
    //     if ($con->connect_error) {
    //         die("Conexión Fallida: " . $con->connect_error);
    //     }

    //     $query = "SELECT nombre, `cod_producto`, t2.descripcion as Categoria, t3.descripcion as Tipo, `cajas_totales`, `salidas_totales`, `stock`, `precio_unitario`, `importe_inventariado`, `ventas_total` FROM `inventario` t1 INNER JOIN inventario_categoria t2 ON t1.categoria = t2.id_categoria INNER JOIN inventario_tipo t3 ON t1.tipo_producto = t3.id_tipo WHERE ";
    //     mysqli_query($conn->Conectar(),$query);

    //     $con->close();
    // }

    public function getDatos(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("ConexiÃ³n Fallida: " . $con->connect_error);
        }

        $query = "SELECT `cod_producto`, nombre, t2.descripcion as Categoria, t3.descripcion as Tipo, `cajas_totales`, `salidas_totales`, `stock`, `precio_unitario`, `importe_inventariado`, `ventas_total` FROM `inventario` t1 INNER JOIN inventario_categoria t2 ON t1.categoria = t2.id_categoria INNER JOIN inventario_tipo t3 ON t1.tipo_producto = t3.id_tipo";

        $res = mysqli_query($conn->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        $con->close();
        return $datos;
    }
    
    public function eliminarProducto($id){
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "DELETE FROM `inventario` WHERE `inventario`.`cod_producto` = $id";
        mysqli_query($conn->Conectar(),$query);

        $con->close();
    }

    public function editarProducto(){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }

        $query = "SELECT nombre, `cod_producto`, t2.descripcion as Categoria, t3.descripcion as Tipo, `cajas_totales`, `salidas_totales`, `stock`, `precio_unitario`, `importe_inventariado`, `ventas_total` FROM `inventario` t1 INNER JOIN inventario_categoria t2 ON t1.categoria = t2.id_categoria INNER JOIN inventario_tipo t3 ON t1.tipo_producto = t3.id_tipo WHERE `inventario`.`cod_producto` = $this->id";
        $res = mysqli_query($conn->Conectar(),$query);
        if(count($res) == 1){
            $dato = $res->fetch_array();
            while($row = mysqli_fetch_assoc($res)){
                $codigoProducto = $row['cod_producto'];
            }
            $con->close();
        }        
        return $dato;
    }

}