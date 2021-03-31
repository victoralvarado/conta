<?php require_once("./model/producto.php"); ?>
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
        <?php include("header.php"); ?>
        <section>
            <section class="hbox stretch">

                <?php include("nav.php"); ?>
                <section id="content">
                    <section class="vbox">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td colspan="1">

                                        <form class="well form-horizontal" method="POST" action="./controller/productocontroller.php" enctype="multipart/form-data">

                                            <fieldset class="form-group p-3">
                                                <center>
                                                    <legend class="w-auto px-2">Producto</legend>
                                                </center>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nombre</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="nombre" name="nombre" placeholder="Nombre del producto" class="form-control" required="true" value="" type="text"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Existencias</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="existencias" name="existencias" placeholder="Existencias" min="1" class="form-control" required="true" value="" type="number"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Precio</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="precio" name="precio" placeholder="Precio" min="1.00" step="any" class="form-control" required="true" value="" type="number"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Costo</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="costo" name="costo" placeholder="Costo" min="1.00" step="any" class="form-control" required="true" value="" type="number"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Descripción</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" value="" rows="2"></textarea></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Imagen</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="imagen" name="imagen" class="form-control" accept="image/*" required="true" value="" type="file"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Codigo</label>
                                                    <div class="col-md-8 inputGroupContainer">
                                                        <div class="input-group"><input id="codigo" name="codigo" placeholder="Codigo del producto" class="form-control" required="true" value="" type="text"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <center>
                                                        <button type="submit" id="agregarProducto" name="agregarProducto" class="btn btn-primary">Agregar</button>
                                                        <button type="reset" class="btn btn-warning">Cancelar</button>
                                                    </center>
                                                </div>
                                            </fieldset>

                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Existencias</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $objP = new Producto();
                                $data = $objP->getAllProducto();
                                if ($data) {
                                    foreach ($data as $value) {
                                        echo "<tr>
                          <td>" . $value['nombre'] . "</td>
                          <td>" . $value['existencias'] . "</td>
                          <td>" . $value['precio'] . "</td>
                          <td>" . $value['costo'] . "</td>
                          <td>" . $value['descripcion'] . "</td>
                          <td>" . $value['codigo'] . "</td>
                          <td><img src='data:image/jpeg;base64," . base64_encode($value['imagen']) . "' width='150' /></td>
                          <td>
                            <input type='button' class='btn-danger btn-sm' id='" . $value['id'] . "' value='Eliminar'>
                          </td>
                      </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                    <aside class="bg-light lter b-l aside-md hide" id="notes">
                        <div class="wrapper">Notification</div>
                    </aside>
                </section>
            </section>
        </section>
</body>

</html>