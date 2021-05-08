<?php /*require_once '../app/validacionAdmin.php';*/ ?>
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

                <?php
                $activeProducto = "";
                $activeIva = "";
                $activeProveedor = "";
                $activeCompra = "";
                $activeVenta = "";
                $activeCliente = "active";
                $activelc = "";
                $activev = "";
                $activevc = "";
                $activeiva = "";
                $activeControl = "";
                include("nav.php"); ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <section class="vbox">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="1">
                                            <form class="well form-horizontal" method="POST" action="controller/clienteController.php" enctype="multipart/form-data">
                                                <fieldset class="form-group">
                                                    <legend class="w-auto">Cliente</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Clasificación:</label>
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
                                                            <input id="nit" name="nit" placeholder="Número de Identificación Tributaria" class="form-control" required="true" value="" type="text">
                                                            <span id="existeNit" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">NRC:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nrc" name="nrc" placeholder="Número de Registro de Contribuyente" class="form-control" value="" type="text">
                                                            <span id="existe" style="color:red"></span>
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
                                                        <label class="col-md-3 control-label">Teléfono:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="telefono" name="telefono" placeholder="Teléfono" maxlength="12" class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <center>
                                                            <button type="submit" id="agregarProveedor" name="agregarProveedor" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar</button>
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
                                    <caption>Proveedores</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Clasificación</th>
                                            <th scope="col">NIT</th>
                                            <th scope="col">NRC</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Razon Social</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form id="eliEdi" class="well eliEdi" method="POST" action="controller/proveedorController.php">
                                                    <input type="hidden" name="idD" id="idD" value="">
                                                    <button type="button" id="eliminar" class="btn btn-danger eliminar"><em class="fas fa-trash"></em> Eliminar</button>
                                                    <script>
                                                        $(document).on("click", "#eliminar", function() {
                                                            swal({
                                                                    title: "Eliminar",
                                                                    text: "¿Estás seguro que deseas eliminar el proveedor?",
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
                                                                            $("#eliEdi").submit();
                                                                        }, 1100);
                                                                    }
                                                                });
                                                        });
                                                    </script>
                                                    <br>
                                                    <br>
                                                    <a class="btn btn-primary" data-toggle="modal" href="#edit_"><em class="fa fa-pencil"></em> Editar</a>
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