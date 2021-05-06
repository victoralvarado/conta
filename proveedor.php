<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/Proveedor.php'); ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script type="text/javascript" src="resources/proveedor.js"></script>
</head>

<body>
    <section class="vbox">
        <?php include("header.php"); ?>
        <section>
            <section class="hbox stretch">

                <?php
                $activeProducto = "";
                $activeIva = "";
                $activeCompra = "";
                $activeProveedor = "active";
                $activeVenta = "";
                include("nav.php");
                ?>
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
                                            <th scope="col">Tipo</th>
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
                                        <?php
                                        $objP = new Proveedor();
                                        $data = $objP->getAllProveedor();
                                        if ($data) {
                                            foreach ($data as $value) {
                                        ?>
                                                <tr>
                                                    <td><?php echo ucwords(strtolower($value['tipo'])); ?></td>
                                                    <td><?php echo ucwords(strtolower($value['clasificacion'])); ?></td>
                                                    <td>
                                                        <?php echo substr($value['nit'], 0, 4) . "-" . substr($value['nit'], 4, 6) . "-"
                                                            . substr($value['nit'], 10, 3) . "-" . substr($value['nit'], 13, 1);
                                                        #Mostrando nit con guiones
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($value['nrc'] == '') {
                                                            $value['nrc'];
                                                        } else {
                                                            echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1);
                                                            #Mostrando nrc con guion
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo strtoupper($value['nombre']); ?></td>
                                                    <td><?php echo ucwords(strtolower($value['razon_social'])); ?></td>
                                                    <td><?php echo ucwords(strtolower($value['direccion'])); ?></td>
                                                    <td><?php echo $value['telefono']; ?></td>
                                                    <td>
                                                        <form id="eliEdi" class="well" method="POST" action="controller/proveedorController.php">
                                                            <input type="hidden" name="idD" id="idD" value="<?php echo $value['id']; ?>">
                                                            <button type="button" id="eliminar" class="btn btn-danger"><em class="fa fa-trash-o"></em> Eliminar</button>
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
                                                    <h6 class="modal-title"><strong>Editar Proveedor</strong></h6>
                                                    <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="editar" action="controller/proveedorController.php" enctype="multipart/form-data">

                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Tipo</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <select required id="tipoEdit" name="tipo" class="form-control edit" aria-label="Default select">

                                                                    <?php
                                                                    switch ($value['tipo']) {
                                                                        case 'local':
                                                                    ?>
                                                                            <option value="">Seleccione un tipo</option>
                                                                            <option selected value="1">Local</option>
                                                                            <option value="2">Extranjero</option>
                                                                        <?php
                                                                            break;
                                                                        case 'extranjero':
                                                                        ?>
                                                                            <option value="">Seleccione un tipo</option>
                                                                            <option value="1">Local</option>
                                                                            <option selected value="2">Extranjero</option>
                                                                        <?php
                                                                            break;

                                                                        default:
                                                                        ?>
                                                                            <option selected value="">Seleccione un tipo</option>
                                                                            <option value="1">Local</option>
                                                                            <option value="2">Extranjero</option>
                                                                    <?php
                                                                            break;
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Clasificacion:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <select required="true" id="clasificacionEdit" name="clasificacion" class="form-control edit" aria-label="Default select">
                                                                    <?php
                                                                    switch ($value['clasificacion']) {
                                                                        case 'ninguno':
                                                                    ?>
                                                                            <option value="">Seleccione una clasificacion</option>
                                                                            <option selected value="1">Ninguno</option>
                                                                            <option value="2">Pequeño</option>
                                                                            <option value="3">Mediano</option>
                                                                            <option value="4">Gran Contribuyente</option>
                                                                        <?php
                                                                            break;
                                                                        case 'pequeño':
                                                                        ?>
                                                                            <option value="">Seleccione una clasificacion</option>
                                                                            <option value="1">Ninguno</option>
                                                                            <option selected value="2">Pequeño</option>
                                                                            <option value="3">Mediano</option>
                                                                            <option value="4">Gran Contribuyente</option>
                                                                        <?php
                                                                            break;
                                                                        case 'mediano':
                                                                        ?>
                                                                            <option value="">Seleccione una clasificacion</option>
                                                                            <option value="1">Ninguno</option>
                                                                            <option value="2">Pequeño</option>
                                                                            <option selected value="3">Mediano</option>
                                                                            <option value="4">Gran Contribuyente</option>
                                                                        <?php
                                                                            break;
                                                                        case 'gran contribuyente':
                                                                        ?>
                                                                            <option value="">Seleccione una clasificacion</option>
                                                                            <option value="1">Ninguno</option>
                                                                            <option value="2">Pequeño</option>
                                                                            <option value="3">Mediano</option>
                                                                            <option selected value="4">Gran Contribuyente</option>
                                                                        <?php
                                                                            break;
                                                                        default:
                                                                        ?>
                                                                            <option selected value="">Seleccione una clasificacion</option>
                                                                            <option value="1">Ninguno</option>
                                                                            <option value="2">Pequeño</option>
                                                                            <option value="3">Mediano</option>
                                                                            <option value="4">Gran Contribuyente</option>
                                                                    <?php
                                                                            break;
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">NIT:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="nitEdit" name="nit" placeholder="Número de Identificación Tributaria" class="form-control edit" required="true" value="<?php echo $value['nit']; ?>" type="text">
                                                                <input id="nitActual" name="nitActual" value="<?php echo substr($value['nit'], 0, 4) . "-" . substr($value['nit'], 4, 6) . "-" . substr($value['nit'], 10, 3) . "-" . substr($value['nit'], 13, 1); ?>" type="hidden">
                                                                <span id="existeEditNit" style="color:red"></span>
                                                                <span id="existeActualNit" style="color:green"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">NRC:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="nrcEdit" name="nrc" placeholder="Número de Registro de Contribuyente" class="form-control" value="<?php echo $value['nrc']; ?>" type="text">
                                                                <input id="nrcActual" name="nrcActual" value="<?php echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1); ?>" type="hidden">
                                                                <span id="existeEdit" style="color:red"></span>
                                                                <span id="existeActual" style="color:green"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Nombre:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="nombreEdit" name="nombre" placeholder="Nombre" class="form-control edit" value="<?php echo $value['nombre']; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Razon Social:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="razonsocialEdit" name="razonsocial" placeholder="Razon Social" class="form-control" value="<?php echo $value['razon_social']; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Dirección:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <textarea id="direccionEdit" name="direccion" placeholder="Dirección" class="form-control edit" rows="2"><?php echo $value['direccion']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 control-label">Teléfono:</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <input id="telefonoEdit" name="telefono" placeholder="Teléfono" class="form-control edit" maxlength="12" required="true" value="<?php echo $value['telefono']; ?>" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="idEdit" name="idEdit" min="1" class="form-control" required="true" value="<?php echo $value['id']; ?>" type="hidden">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()"><em class="fa fa-times"></em> Cancelar</button>
                                                            <button type="button" name="editarProveedor" class="btn btn-primary editarProveedor"><em class="fa fa-pencil-square-o"></em> Editar</button>
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
                            </div>
                        </section>
                        <aside class=" bg-light lter b-l aside-md hide" id="notes"></aside>
                    </section>
                </div>
            </section>
        </section>
</body>

</html>