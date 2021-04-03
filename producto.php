<?php require_once('model/producto.php'); ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
</head>

<body>
    <section class="vbox">
        <?php 
            $activeProducto = "active";
            $activeIva = "";
            $activeProveedor = ""; 
            include("header.php"); 
        ?>
        <section>
            <section class="hbox stretch">

                <?php $active ="active"; include("nav.php"); ?>
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
                                                            <input id="nombre" name="nombre" placeholder="Nombre del producto" class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Existencias:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="existencias" name="existencias" placeholder="Existencias" min="1" class="form-control" required="true" value="" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Precio:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="precio" name="precio" placeholder="Precio" min="1.00" step="any" class="form-control" required="true" value="" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Costo:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="costo" name="costo" placeholder="Costo" min="1.00" step="any" class="form-control" required="true" value="" type="number">
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
                                                            <input id="codigo" name="codigo" placeholder="Codigo del producto" class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <center>
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
                                                    <td><?php echo ucwords(strtolower($value['nombre'])); ?></td>
                                                    <td><?php echo $value['existencias']; ?></td>
                                                    <td><?php echo $value['precio']; ?></td>
                                                    <td><?php echo $value['costo']; ?></td>
                                                    <td><?php echo ucwords(strtolower($value['descripcion'])); ?></td>
                                                    <td><?php echo $value['codigo']; ?></td>
                                                    <td><img src="<?php echo $value['imagen']; ?>" width="150" alt="<?php echo $value['nombre']; ?>" /></td>
                                                    <td>
                                                        <form class="well" method="POST" action="controller/productoController.php">
                                                            <input type="hidden" name="idD" id="idD" value="<?php echo $value['id']; ?>">
                                                            <button type="submit" class="btn btn-danger"><em class="fa fa-trash-o"></em> Eliminar</button>
                                                            <br>
                                                            <br>
                                                            <a class="btn btn-primary" data-toggle="modal" href="#edit_<?php echo $value['id']; ?>"><em class="fa fa-pencil"></em> Editar</a>
                                                        </form>
                                                    </td>
                                                </tr>
                                    </tbody>
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
                                                    <form method="POST" action="controller/productoController.php" enctype="multipart/form-data">
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Nombre:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="nombreEdit" name="nombre" placeholder="Nombre del producto" class="form-control" required="true" value="<?php echo $value['nombre']; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Existencias:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="existenciasEdit" name="existencias" placeholder="Existencias" min="1" class="form-control" required="true" value="<?php echo $value['existencias']; ?>" type="number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Precio:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="precioEdit" name="precio" placeholder="Precio" min="1.00" step="any" class="form-control" required="true" value="<?php echo $value['precio']; ?>" type="number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Costo:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="costoEdit" name="costo" placeholder="Costo" min="1.00" step="any" class="form-control" required="true" value="<?php echo $value['costo']; ?>" type="number">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Descripción:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <textarea id="descripcionEdit" name="descripcion" placeholder="Descripción" class="form-control" rows="2"><?php echo $value['descripcion']; ?></textarea>
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
                                                                <input id="codigoEdit" name="codigo" placeholder="Codigo del producto" class="form-control" required="true" value="<?php echo $value['codigo']; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="img" name="img" class="form-control" required="true" value="<?php echo $value['imagen']; ?>" type="hidden">
                                                            <input id="id" name="id" min="1" class="form-control" required="true" value="<?php echo $value['id']; ?>" type="hidden">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()"><i class="fa fa-times"></i> Cancelar</button>
                                                            <button type="submit" id="editarProducto" name="editarProducto" class="btn btn-primary""><i class="fa fa-pencil-square-o"></i> Editar</button>
                                                                    </div>
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