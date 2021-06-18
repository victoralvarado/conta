<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/Cuentas.php'); ?>

<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script type="text/javascript" src="resources/partidas.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    
    
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
                $activePartida = "active";
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
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <legend class="w-auto">Cuenta</legend>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input type="text" class="form-control" placeholder="codigo" value="" name="codigo" id="codigo" required="true" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cuenta</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="cuentas" name="cuentas" required="true">
                                                <option value="">Seleccionar</option>
                                                <?php
                                                $objC = new Cuentas();
                                                $data = $objC->getAllCuentas();
                                                if ($data) {
                                                    foreach ($data as $value) {
                                                ?>
                                                        <option id="<?php echo $value['codigo']; ?>" value="<?php echo $value['nombre']; ?>"><?php echo $value['nombre']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div class=" form-group">
                                            <label>Debe</label>
                                            <input type="number" min="0" class="form-control" placeholder="Debe" name="debe" id="debe" required="true">
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div class=" form-group">
                                            <label>Haber</label>
                                            <input type="number" min="0" class="form-control" placeholder="Haber" name="haber" id="haber" required="true">
                                        </div>
                                    </div>
                                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['USER']; ?>">
                                </fieldset>
                            </div>
                            <div class="col-md-12" style="text-align: center;">
                                <button id="add" class="btn btn-success" type="button">Agregar</button>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <span id="valcuenta" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <legend class="w-auto">Partidas</legend>
                                    <form action="">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha</label>
                                                <?php $fechaActual = date('Y-m-d'); ?>
                                                <input name="fecha" id="fecha" type="date" class="form-control" max="<?php echo $fechaActual; ?>" value="<?php echo $fechaActual; ?>" required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Descripcion</label>
                                                <textarea name="textarea" id="descripcion" class="form-control" rows="3" required="true"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="adicionados" id="adicionados">
                                        <div class="table-responsive">
                                            <table id="mytable" class="table table-bordered sortable">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Cuenta</th>
                                                        <th>Debe</th>
                                                        <th>Haber</th>
                                                        <th>Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2">Totales</th>
                                                        <th id="totaldebe"></th>
                                                        <th id="totalhaber"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-12" style="text-align: center;">
                                            <input class="form-check-input" type="checkbox" id="check" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Generar reporte al guardar
                                            </label>
                                        </div>
                                        <div class="col-md-12" style="text-align: center;">
                                            <input id="guardarp" class="btn btn-success" value="Guardar Partida">
                                        </div>
                                        <div class="form-group" style="text-align: center;">
                                            <span id="valpartidas" style="color: red;"></span>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </section>
                    <!-- Modal -->
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                    <label>Debe: </label>
                                        <input type="number" min="0" name="debeedit" id="editcand">
                                    </div>
                                    <div class="form-group">
                                    <label>Haber: </label>
                                        <input type="number" min="0" name="haberedit" id="editcanh">
                                    </div>
                                        <div class="form-group" style="text-align: center;">
                                            <button type="button" id="editarCantidad" class="btn btn-primary">Editar</button>
                                        </div>
                                        <div class="form-group" style="text-align: center;">
                                            <span id="valedit" style="color: red;"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <aside class="bg-light lter b-l aside-md hide" id="notes">
                            <div class="wrapper">Notification</div>
                        </aside>
            </section>
        </section>
    </section>
</body>

</html>