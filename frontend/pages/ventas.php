<?php
    require '../../clases/Conexion.php';
    require '../../clases/Ventas.php';
    $check = false;
    $ventas = new Ventas();
    $resultados = $ventas->getDatos();
    if (!empty($resultados)) {
        $check = true;
    }

    $categorias = $ventas->getCategoria();
    $tipos = $ventas->getTipo();


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
    <link rel="stylesheet" href="../css/ventas.css">

</head>

<body>
    <!-- Vender Producto -->
    <div class="modal fade" id="venderProducto" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModal">
                        Vender Productos
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoriaProducto">Categoría Producto</label>
                            <select class="form-control" id="categoriaProducto" name="categoriaProducto">
                                <?php 
                                    foreach ($categorias as $categoria) {
                                        echo '<option>'.$categoria[descripcion].'</option>'; 
                                    }                    
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Tipo de Producto</label>
                            <select class="form-control" id="tipoProducto" name="tipoProducto">
                                <?php 
                                    foreach ($tipos as $tipo) {
                                        echo '<option>'.$tipo[descripcion].'</option>'; 
                                    }                    
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" />
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" />
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
                </form> -->
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigoUp">Código</label>
                            <input type="text" id="codigoUp" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nombreUp">Nombre</label>
                            <input type="text" class="form-control" id="nombreUp" />
                        </div>
                        <div class="form-group">
                            <label for="descripcionUp">Descripción</label>
                            <input type="text" class="form-control" id="descripcionUp" />
                        </div>
                        <div class="form-group">
                            <label for="cantidadUp">Cantidad</label>
                            <input type="text" class="form-control" id="cantidadUp" />
                        </div>
                        <div class="form-group">
                            <label for="precioUp">Precio</label>
                            <input type="text" class="form-control" id="precioUp" />
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

    <!-- Modal Agregar al Inventario -->
    <div class="modal fade" id="addProductInventarioModal" tabindex="-1" aria-labelledby="addProductInventarioModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductInventarioModal">
                        Agregar Productos al Inventario
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" />
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" name="addProductsInventario" class="btn btn-primary">
                            Agregar Productos
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
                <a href="#" class="d-block text-light p-3"><i class="icon ion-md-cog mr-2 lead"></i>Panel de Control</a>
                <a href="./productos.php" class="d-block text-light p-3"><i
                        class="icon ion-md-basket mr-2 lead"></i>Productos</a>
                <a href="#" class="d-block text-light p-3 active"><i class="icon ion-md-cash mr-2 lead"></i>Ventas</a>
                <a href="#" class="d-block text-light p-3"><i class="icon ion-md-contacts mr-2 lead"></i>Clientes</a>
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

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../assets/perfil.jpg" alt="imagen de perfil"
                                        class="img-fluid rounded-circle avatar mr-2">
                                    Perfil de Usuario
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Mi Perfil</a>
                                    <a class="dropdown-item" href="#">Configuración</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Cerrar Sesión</a>
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
                                <p class="lead text-muted">Mantenimiento de Ventas</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-mix">
                    <div class="container">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 d-flex stat my-3 ">
                                        <div class="mx-auto">
                                            <button type="button" class="btn btn-primary w-100 align-self-center"
                                                data-toggle="modal" data-target="#venderProducto">Agregar
                                                Venta</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex stat my-3 ">
                                        <div class="mx-auto">
                                            <button class="btn btn-primary w-100 align-self-center">Ver Todas las
                                                Ventas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                <div class="card rounded-0">
                                    <div class="card-header bg-light">
                                        <h6 class="font-weight-bold mb-0">Listado de Productos</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- <?php if ($check) { ?> -->
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Tamaño</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">Costo</th>
                                                    <th scope="col">Existencia</th>
                                                    <th scope="col">Punto ReOrden</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <?php foreach ($resultados as $res) { ?> -->
                                                <tr>
                                                    <!--<th scope="row"><?=$res['cod_producto'] ?></th>
                                                    <td><?=$res['descripcion_producto'] ?></td>
                                                    <td><?=$res['tamaño_producto'] ?></td>
                                                    <td><?=$res['precio_producto'] ?></td>
                                                    <td><?=$res['costo_produccion'] ?></td>
                                                    <td><?=$res['existencia'] ?></td>
                                                    <td><?=$res['punto_reorden'] ?></td>
                                                    <td><?=$res['estado_producto'] ?></td> -->
                                                </tr>
                                                <!-- <?php } ?> -->
                                            </tbody>
                                        </table>
                                        <!-- <?php } else { ?>
                                        <h6 class="font-weight-bold mb-0">La tabla no se puede mostrar, verifique que las sentencias de la BD estén correctos.</h6>
                                        <?php } ?> -->
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
</body>

</html>