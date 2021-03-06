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

        $query = "SELECT `cod_producto`, nombre, t2.descripcion as Categoria, t3.descripcion as Tipo, `stock`, `precio_unitario`, `ventas_total` FROM `inventario` t1 INNER JOIN inventario_categoria t2 ON t1.categoria = t2.id_categoria INNER JOIN inventario_tipo t3 ON t1.tipo_producto = t3.id_tipo";

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

    public function editarProducto($id,$nom,$cat,$tipo,$cant,$precio){
        // Creando la conexion
        $conn = new Conexion();
        $con = $conn->Conectar();
        // Verificando la conexion
        if ($con->connect_error) {
            die("Conexión Fallida: " . $con->connect_error);
        }
        $query = "CALL EditarDatos('".$id."','".$nom."','".$cat."','".$tipo."','".$cant."',".$precio.")";
        return mysqli_query($conn->Conectar(),$query);
    
    }

    public function InsertarProductos($nombre, $categoria, $tipo, $cantidad, $precio)
    {
        $conn = new Conexion();
        $con = new Conexion();   
        $insertar = "INSERT INTO `inventario` (`nombre`, `categoria`, `tipo_producto`, `stock`, `precio_unitario`) VALUES ('$nombre', '$categoria', '$tipo', '$cantidad', '$precio')";
        
        $query = mysqli_query($conn->Conectar(),$insertar);
        if (!$query) 
        {
            echo "Error al insertar datos";
        }else
        {
            echo'<script type="text/javascript">
                        alert("Registro guardado");
                </script>';
        }
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