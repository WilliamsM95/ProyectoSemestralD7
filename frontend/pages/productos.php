<?php
    require '../../clases/Conexion.php';
    require '../../clases/Productos.php';
    session_start();

    if ($_SESSION["usuario"]==""){
        header('Location: ../../index.php');
    }

    $check = false;
    $codigoProducto = 0;
    $productos = new Productos();
    $resultados = $productos->getDatos();
    if (!empty($resultados)) {
        $check = true;
    }

    // if(isset($_POST['submit'])){
    //     $arregloSeleccionado = $_POST['arreglo'];
    //     $remitente = $_POST['remitente'];
    //     $destinatario = $_POST['destinatario'];
    //     $telefono = $_POST['telefono'];
    //     $direccion = $_POST['direccion'];
    //     $mensaje = $_POST['mensaje'];
    //     $color = $_POST['color'];

    //     $datos = new Datos($remitente, $destinatario, $telefono, $direccion, $mensaje, $color, $arregloSeleccionado);

    //     echo $datos->InsertarDatos();
    //     $resultados = $login->getDatos();
    //     $check = true;
    // }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Productos</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/productos.css">

</head>

<body>
    <!-- Modal Agregar Producto -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModal">
                        Agregar Productos
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" />
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" />
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" />
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precio" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" name="addProducts" class="btn btn-primary">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Producto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModal">
                        Editar Productos
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../Editar.php" method='POST'>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigoUp">Código</label>
                            <input type="number" name="id" class="form-control" id="codigoUp" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nombreUp">Nombre</label>
                            <input type="text" name="nom" class="form-control" id="nombreUp" required/>
                        </div>
                       
                        <div class="arreglo">
                        <label>Seleccionador de Categoria
                        <select name = "cat" >
                        <?php

                        $conn = new Conexion();
                        $con = $conn->Conectar();
                        $query = "SELECT * FROM inventario_categoria";
                        $result = mysqli_query($conn->Conectar(), $query);
                        while($row =mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?= $row['id_categoria'] ?>"><?= $row['descripcion'] ?></option>
                        <?php }?>
                        </select>
                        </label>
                        </div>

                        <div class="arreglo">
                        <label>Seleccionador de Tipo
                        <select name = "tipo" >
                        <?php

                        $conn = new Conexion();
                        $con = $conn->Conectar();
                        $query = "SELECT * FROM inventario_tipo;";
                        $result = mysqli_query($conn->Conectar(), $query);
                        while($row =mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?= $row['id_tipo'] ?>"><?= $row['descripcion'] ?></option>
                        <?php }?>
                        </select>
                        </label>
                        </div>  
  
                        <div class="form-group">
                            <label for="cantidadUp">Cantidad</label>
                            <input type="text" name="cant" class="form-control" id="cantidadUp" required/>
                        </div>
                        <div class="form-group">
                            <label for="precioUp">Precio</label>
                            <input type="text" name="precio" class="form-control" id="precioUp" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" name="editProduct" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pagina Visible -->
    <div class="d-flex">
        <!-- Inicio del Sidebar -->
        <div id="sidebar-container" class=" bg-primary">
            <div class="logo">
                <h4 class="text-light font-weight-bold">Productos</h4>
            </div>
            <div class="menu">
                <a href="#" class="d-block text-light p-3"><i class="icon ion-md-basket mr-2 lead"></i>Productos</a>
                <a href="./ventas.php" class="d-block text-light p-3"><i
                        class="icon ion-md-cash mr-2 lead"></i>Ventas</a>
            </div>
        </div>
        <!-- Fin del Sidebar -->
        <!-- Inicio del Contenido -->
        <div class="w-100">
            <!-- Inicio del NavBar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <form class="form-inline position-relative my-2 d-inline-block">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar Producto"
                            aria-label="Buscar">
                        <button class="btn btn-search position-absolute" type="submit"><i
                                class="icon ion-md-search"></i></button>
                    </form>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../assets/perfil.jpg" alt="imagen de perfil"
                                        class="img-fluid rounded-circle avatar mr-2">
                                        <?= $_SESSION["usuario"]?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Mi Perfil</a>
                                    <a class="dropdown-item" href="#">Configuración</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../logout.php">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Fin del NavBar -->
            <div id="content">
                <section class="py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <h1 class="font-weight-bold mb-0">Bienvenido Usuario</h1>
                                <p class="lead text-muted">Mantenimiento de Productos</p>
                            </div>
                            <div class="col-lg-3 d-flex ">
                                <button type="button" class="btn btn-primary w-100 align-self-center"
                                    data-toggle="modal" data-target="#addProductModal">Agregar
                                    Producto</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-mix">
                    <div class="container">
                    </div>
                </section>
                <section class="bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                <div class="card rounded-0">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">Listado de Productos en Inventario</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($check) { ?>
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Categoría</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cajas Totales</th>
                                                    <th scope="col">Salidas Totales</th>
                                                    <th scope="col">Existencia</th>
                                                    <th scope="col">Precio Unitario</th>
                                                    <th scope="col">Importe Inventariado</th>
                                                    <th scope="col">Ventas Totales</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultados as $res) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?=$res['cod_producto'] ?></td>
                                                    <td><?=$res['nombre'] ?></td>
                                                    <td><?=$res['Categoria'] ?></td>
                                                    <td><?=$res['Tipo'] ?></td>
                                                    <td><?=$res['cajas_totales'] ?></td>
                                                    <td><?=$res['salidas_totales'] ?></td>
                                                    <td><?=$res['stock'] ?></td>
                                                    <td><?=$res['precio_unitario'] ?></td>
                                                    <td><?=$res['importe_inventariado'] ?></td>
                                                    <td><?=$res['ventas_total'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary editbtn"
                                                            value="<?php echo $res['cod_producto']; ?>">
                                                            Editar
                                                        </button>
                                                        <a href="../../procesos.php?delete=<?php echo $res['cod_producto']; ?>"
                                                            class="btn btn-danger my-1">Eliminar</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php } else { ?>
                                        <h6 class="font-weight-bold mb-0">La tabla no se puede mostrar, verifique que
                                            las sentencias de la BD estén correctos.</h6>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Final del Contenido -->
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('.editbtn').on('click', function() {

            $('#editProductModal').modal('show');

            $tr = $(this).closest('tr');
            var datos = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(datos);
            $('#codigoUp').val(datos[0].replace(/\n/g, ' '));
            $('#nombreUp').val(datos[1]);
            $('#descripcionUp').val(datos[2]);
            $('#TipoUp').val(datos[3]);
            $('#cantidadUp').val(datos[6]);
            $('#precioUp').val(datos[7]);
        });
    });
    </script>
</body>

</html>