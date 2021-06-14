<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/producto.php'); ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script type="text/javascript" src="resources/producto.js"></script>
</head>

<body>
    <section class="vbox">
        <?php include("header.php"); ?>
        <section>
            <section class="hbox stretch">

                <?php
                $activeProducto = "active";
                $activeIva = "";
                $activeCompra = "";
                $activeProveedor = "";
                $activeVenta = "";
                $activeCliente = "";
                $activelc = "";
                $activev = "";
                $activevc = "";
                $activeiva = "";
                $activeControl = "";
                include("nav.php");
                ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <section class="vbox">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="1">

                                            <form class="well form-horizontal" method="POST" action="controller/productoController.php" enctype="multipart/form-data">

                                                <fieldset class="form-group">
                                                    <legend class="w-auto">Producto</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Nombre:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nombre" name="nombre" placeholder="Nombre del producto" class="form-control" required="true" value="" type="text" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Existencias:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="existencias" name="existencias" placeholder="Existencias" min="0" readonly value="0" class="form-control" required="true" value="" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Precio:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="precio" name="precio" placeholder="Precio" min="0.00" value="0.00" step="any" class="form-control" required="true" value="" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Costo:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="costo" name="costo" placeholder="Costo" min="0.00" value="0.00" step="any" class="form-control" readonly required="true" value="" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Descripción:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" value="" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Imagen:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="imagen" name="imagen" class="form-control" accept="image/*" required="true" value="" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Codigo:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="codigo" autocomplete="off" name="codigo" max="15" placeholder="Codigo del producto" class="form-control" required="true" value="" type="text" autocomplete="off">
                                                            <span id="existecodigo" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <center>
                                                            <input type="hidden" name="user" value="<?php echo $_SESSION['USER']; ?>">
                                                            <button type="submit" id="agregarProducto" name="agregarProducto" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar</button>
                                                            <button type="reset" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Limpiar cajas de texto"><em class="fa fa-eraser"></em> Limpiar</button>
                                                        </center>
                                                    </div>
                                                </fieldset>

                                            </form>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <caption>Productos</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Existencias</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Imagen</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $objP = new Producto();
                                        $data = $objP->getAllProducto();
                                        if ($data) {
                                            foreach ($data as $value) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $value['nombre']; ?></td>
                                                    <td><?php echo $value['existencias']; ?></td>
                                                    <td><?php echo $value['precio']; ?></td>
                                                    <td><?php echo $value['costo']; ?></td>
                                                    <td><?php echo $value['descripcion']; ?></td>
                                                    <td><?php echo $value['codigo']; ?></td>
                                                    <td><img src="<?php echo $value['imagen']; ?>" width="150" alt="<?php echo $value['nombre']; ?>" /></td>
                                                    <td>
                                                        <form id="eliEdi<?php echo $value['id']; ?>" class="well eliEdi" method="POST" action="controller/productoController.php">
                                                            <input type="hidden" name="idD" id="idD" value="<?php echo $value['id']; ?>">
                                                            <button type="button" id="eliminar<?php echo $value['id']; ?>" class="btn btn-danger eliminar"><em class="fas fa-trash"></em> Eliminar</button>
                                                            <br>
                                                            <br>
                                                            <a class="btn btn-primary" data-toggle="modal" href="#edit_<?php echo $value['id']; ?>"><em class="fa fa-pencil"></em> Editar</a>
                                                            <br>
                                                            <br>
                                                            <a class="btn btn-primary" data-toggle="modal" href="#kardex<?php echo $value['id']; ?>"><em class="fas fa-clipboard-list-check"></em> Kardex</a>
                                                        </form>
                                                    </td>
                                                </tr>
                                    </tbody>
                                    <!-- Modal -->
                                    <div class="modal fade" id="kardex<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Generar Reporte Libro de Compras</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="kardex.php" target="_blank">
                                                        <span class="val" style="color: red;"></span>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <?php $fechaActual = date('Y-m-d'); ?>
                                                                <label class="col-md-3 control-label">Desde:</label>
                                                                <div class="col-md-7 inputGroupContainer">
                                                                    <input type="date" class="date" id="desde" name="desde" value="<?php echo $fechaActual; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Hasta:</label>
                                                                <div class="col-md-7 inputGroupContainer">
                                                                    <input type="date" class="date" id="hasta" name="hasta" value="<?php echo $fechaActual; ?>" required>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $(document).on("change", ".date", function() {
                                                                        if ($('#desde').val() <= $('#hasta').val()) {
                                                                            $("#generar").attr("disabled", false);
                                                                            $(".val").text("");
                                                                        } else if ($('#desde').val() > $('#hasta').val()) {
                                                                            $("#generar").attr("disabled", true);
                                                                            $(".val").text("'Hasta' no puede ser menor que 'Desde'");
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                            <div class="form-group">
                                                                <input type="hidden" name="numProd" value="<?php echo $value['id']; ?>">
                                                                <input type="hidden" name="des" value="<?php echo $value['descripcion']; ?>">
                                                                <button type="submit" id="generar" class="btn btn-primary" onclick="location.reload()">Generar</button>

                                                            </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal fade" id="edit_<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title"><strong>Editar Producto</strong></h6>
                                            <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="editar<?php echo $value['id']; ?>" class="well editar" action="controller/productoController.php" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Nombre:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="nombreEdit" name="nombre" placeholder="Nombre del producto" class="form-control edit" required="true" value="<?php echo $value['nombre']; ?>" type="text" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Existencias:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="existenciasEdit" name="existencias" placeholder="Existencias" min="0" class="form-control edit" value="<?php echo $value['existencias']; ?>" type="number">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Precio:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="precioEdit" name="precio" placeholder="Precio" min="0.00" step="any" class="form-control edit" value="<?php echo $value['precio']; ?>" type="number">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Costo:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="costoEdit" name="costo" placeholder="Costo" min="0.00" step="any" class="form-control edit" value="<?php echo $value['costo']; ?>" type="number">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Descripción:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <textarea id="descripcionEdit" name="descripcion" placeholder="Descripción" class="form-control edit" rows="2"><?php echo $value['descripcion']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Imagen:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="imagenEdit" name="imagen" class="form-control" accept="image/*" type="file">
                                                        <div class="alert alert-warning" role="alert">
                                                            Si no agrega una imagen nueva, se mantendra la imagen actual
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 control-label">Codigo:</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <input id="codigoEdit" name="codigo" placeholder="Codigo del producto" class="form-control edit" required="true" value="<?php echo $value['codigo']; ?>" type="text" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input id="img" name="img" class="form-control" required="true" value="<?php echo $value['imagen']; ?>" type="hidden">
                                                    <input id="idEdit" name="idEdit" min="1" class="form-control" required="true" value="<?php echo $value['id']; ?>" type="hidden">
                                                    <input type="hidden" name="user" value="<?php echo $_SESSION['USER']; ?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()"><em class="fa fa-times"></em> Cancelar</button>
                                                    <button type="button" id="editarPro<?php echo $value['id']; ?>" name="editarProducto" class="btn btn-primary editarProducto editarPro"><em class=" fa fa-pencil-square-o"></em> Editar</button>
                                                </div>
                                                <script>
                                                    $(document).on("click", "#eliminar<?php echo $value['id']; ?>", function() {
                                                        swal({
                                                                title: "Eliminar",
                                                                text: "¿Estás seguro que deseas eliminar el producto?",
                                                                type: "warning",
                                                                showCancelButton: true,
                                                                cancelButtonText: "Cancelar",
                                                                confirmButtonColor: "#DD6B55",
                                                                confirmButtonText: "Continuar",
                                                                closeOnConfirm: false
                                                            },
                                                            function(isConfirm) {
                                                                if (isConfirm) {
                                                                    swal({
                                                                        title: "Eliminado",
                                                                        text: "Eliminaste el registro!",
                                                                        type: "success",
                                                                        showCancelButton: false,
                                                                        showConfirmButton: false
                                                                    });
                                                                    setTimeout(function() {
                                                                        $("#eliEdi<?php echo $value['id']; ?>").submit();
                                                                    }, 1100);
                                                                }
                                                            });
                                                    });
                                                    $(document).on("click", "#editarPro<?php echo $value['id']; ?>", function() {
                                                        swal({
                                                                title: "Editar",
                                                                text: "¿Estás seguro que deseas editar el producto?",
                                                                type: "warning",
                                                                showCancelButton: true,
                                                                cancelButtonText: "Cancelar",
                                                                confirmButtonColor: "#DD6B55",
                                                                confirmButtonText: "Continuar",
                                                                closeOnConfirm: false
                                                            },
                                                            function(isConfirm) {
                                                                if (isConfirm) {
                                                                    swal({
                                                                        title: "Modificado",
                                                                        text: "Modificaste el registro!",
                                                                        type: "success",
                                                                        showCancelButton: false,
                                                                        showConfirmButton: false
                                                                    });
                                                                    setTimeout(function() {
                                                                        $("#editar<?php echo $value['id']; ?>").submit();
                                                                    }, 1100);
                                                                }
                                                            });
                                                    });
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php

                                            }
                                        }
                    ?>
                    </table>
                </div>
            </section>
            <aside class=" bg-light lter b-l aside-md hide" id="notes"></aside>
        </section>
        </div>
    </section>
    </section>
</body>

</html>