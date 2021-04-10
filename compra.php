<?php /*require_once '../app/validacionAdmin.php';*/ ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script type="text/javascript" src="resources/compras.js"></script>
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
                $activeCompra = "active";
                include("nav.php");
                ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <form class="well form" method="POST" action="controller/productoController.php" enctype="multipart/form-data">
                            <fieldset class="form-group">
                                <legend class="w-auto">Libro de compras</legend>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <?php $fechaActual = date('Y-m-d');?>
                                        <input type="date" class="form-control" value="<?php echo $fechaActual;?>"  required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Numero de Comprobante</label>
                                        <input type="number" class="form-control" name="" id="" required="true">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" required="true">
                                            <option>Seleccionar</option>
                                            <option>CCF</option>
                                            <option>NC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero de Registro</label>
                                        <input type="number" class="form-control" name="" id="" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre del contribuyente</label>
                                        <select class="form-control" required="true">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend class="w-auto">
                                    <h6 style="text-align: center;">
                                        <hr style="height:1px;border-width:0;background-color:#AAA8A8;">
                                        Compras Exentas
                                    </h6>
                                </legend>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Importacion</label>
                                        <input type="number" class="form-control exentas" name="exentas" id="importacionE" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Internas</label>
                                        <input type="number" class="form-control exentas" name="exentas" id="internasE" required="true">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend class="w-auto">
                                    <h6 style="text-align: center;">
                                        <hr style="height:1px;border-width:0;background-color:#AAA8A8;">
                                        Compras Gravadas
                                    </h6>
                                </legend>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Importacion</label>
                                        <input type="number" class="form-control gravadas" name="gravadas" id="importacionG" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Internas</label>
                                        <input type="number" class="form-control gravadas" name="gravadas" id="internasG" required="true">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend class="w-auto">
                                    <hr style="height:1px;border-width:0;background-color:#AAA8A8 ;">
                                </legend>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IVA(Credito Fiscal)</label>
                                        <input type="number" class="form-control" name="" id="ivaCF" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IVA-Percibido</label>
                                        <input type="number" class="form-control" name="" id="ivaP" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Compras</label>
                                        <input type="number" class="form-control" name="" id="totalCom" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Compra a sujeto excluido</label>
                                        <input type="number" class="form-control" name="" id="">
                                    </div>
                                </div>
                            </fieldset>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Agregar Compra</button>
                                    </div>
                                </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Fecha</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">No. Comprobante</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">No. Registro</th>
                                        <th style="vertical-align: middle;"scope="col" rowspan="2">Nombre Contribuyente</th>
                                        <th style="vertical-align: middle;"scope="col" colspan="2">Compras Exentas</th>
                                        <th style="vertical-align: middle;"scope="col" colspan="2">Compras Exentas</th>
                                        <th style="vertical-align: middle;"scope="col" rowspan="2">IVA(Credito Fiscal)</th>
                                        <th style="vertical-align: middle;"scope="col" rowspan="2">IVA-Percibido</th>
                                        <th style="vertical-align: middle;"scope="col" rowspan="2">Total Compras</th>
                                        <th style="vertical-align: middle;"scope="col" rowspan="2">Compra a sujeto excluido</th>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;"scope="col">Importacion</th>
                                        <th style="vertical-align: middle;"scope="col">Internas</th>
                                        <th style="vertical-align: middle;"scope="col">Importacion</th>
                                        <th style="vertical-align: middle;"scope="col">Internas</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
                                        <td>lorem</td>
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