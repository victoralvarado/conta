<?php require_once('model/Proveedor.php'); ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script>
        jQuery(function($){
        $('#nit').mask('9999-999999-999-9');
        $('#nrc').mask('999999-9');
        $('#telefono').mask('999999999999');
        });
    </script>
</head>

<body>
    <section class="vbox">
        <?php include("header.php"); ?>
        <section>
            <section class="hbox stretch">

                <?php include("nav.php"); ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <section class="vbox">
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="1">
                                            <form class="well form-horizontal" method="POST" action="controller/proveedorController.php" enctype="multipart/form-data">
                                                <fieldset class="form-group">
                                                    <legend class="w-auto">Proveedor</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Tipo</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <select required id="tipo" name="tipo" class="form-control" aria-label="Default select">
                                                                <option value="">Seleccione un tipo</option>
                                                                <option value="1">Local</option>
                                                                <option value="2">Extranjero</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Existencias:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <select required="true" id="clasificacion" name="clasificacion" class="form-control" aria-label="Default select">
                                                                <option value="">Seleccione una clasificacion</option>
                                                                <option value="1">Ninguno</option>
                                                                <option value="2">Pequeño</option>
                                                                <option value="3">Mediano</option>
                                                                <option value="4">Gran Contribuyente</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">NIT:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nit" name="nit" placeholder="Número de Identificación Tributaria"  class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">NRC:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input id="nrc" name="nrc" placeholder="Número de Registro de Contribuyente" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Nombre:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input id="nombre" name="nombre" placeholder="Nombre" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Razon Social:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input id="razonsocial" name="razonsocial" placeholder="Razon Social" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Dirección:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <textarea name="direccion" id="direccion" placeholder="Dirección" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">teléfono:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input id="telefono" name="telefono" placeholder="Teléfono" class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <center>
                                                            <button type="submit" id="agregarProducto" name="agregarProducto" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar</button>
                                                            <button type="reset" class="btn btn-warning"><em class="fa fa-eraser"></em> Cancelar</button>
                                                        </center>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                        <aside class="bg-light lter b-l aside-md hide" id="notes">
                            <div class="wrapper">Notification</div>
                        </aside>
                    </section>
                </div>
            </section>
        </section>
</body>

</html>