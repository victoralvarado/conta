<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/Proveedor.php'); ?>
<?php require_once('model/Producto.php'); ?>
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
                                        <?php $fechaActual = date('Y-m-d'); ?>
                                        <input type="date" class="form-control" value="<?php echo $fechaActual; ?>" required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Numero de Comprobante</label>
                                        <input type="number" class="form-control" name="" required="true">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" required="true">
                                            <option value="">Seleccionar</option>
                                            <option value="ccf" title="Comprobante de credixto fiscal">CCF</option>
                                            <option value="nc" title="Nota de credito">NC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre del contribuyente</label>
                                        <select class="form-control" id="contribuyente" name="contribuyente" required="true">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $objP = new Proveedor();
                                            $data = $objP->getAllProveedor();
                                            if ($data) {
                                                foreach ($data as $value) {
                                            ?>
                                                    <option id="<?php echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1); ?>" value="<?php echo ucwords(strtolower($value['nombre'])); ?>" title="<?php echo ucwords(strtolower($value['nombre'])); ?>"><?php echo ucwords(strtolower($value['nombre'])); ?></option>

                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>NRC</label>
                                        <input type="text" id="nrcProveedor" class="form-control" name="nrcProveedor" required="true" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>NIT</label>
                                        <input type="text" class="form-control" value="" name="" id="nitProveedor" required="true" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Clasificacion</label>
                                        <input type="text" class="form-control" value="" name="" id="clasificacion" required="true" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <select class="form-control" id="producto" name="producto" required="true">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            $objProd = new Producto();
                                            $data = $objProd->getAllProducto();
                                            if ($data) {
                                                foreach ($data as $value) {
                                            ?>
                                                    <option id="<?php echo $value['codigo'];?>" value="<?php echo ucwords(strtolower($value['nombre'])); ?>" ><?php echo ucwords(strtolower($value['nombre'])); ?></option>

                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="number" min="0" value="0" id="cantidad" class="form-control mul" name="cantidad" required="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number" min="0" value="0" class="form-control mul" name="precio" id="precio" required="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cantidad × Precio</label>
                                        <input type="number" class="form-control"  name="cp" id="cp" required="true" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="text-align: center;">
                                        Compras Exentas
                                    </h6>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Importacion</label>
                                            <input type="number" min="0" class="form-control com" value="0" name="exentas" id="importacionE" required="true">
                                            <span class="alert" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Internas</label>
                                            <input type="number" min="0" class="form-control com" value="0" name="exentas" id="internasE" required="true">
                                            <span class="alert" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="text-align: center;">
                                        Compras Gravadas
                                    </h6>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Importacion</label>
                                            <input type="number" min="0" class="form-control com gravadas" value="0" name="gravadas" id="importacionG" required="true">
                                            <span class="alert" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Internas</label>
                                            <input type="number" min="0" class="form-control com gravadas" value="0" name="gravadas" id="internasG" required="true">
                                            <span class="alert" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
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
                                        <input type="number" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar Compra</button>
                                        <button type="reset" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Limpiar cajas de texto"><em class="fa fa-eraser"></em> Limpiar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="col-md-12">
                            <table id="tblCompras" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <caption>Libro de compras</caption>
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Fecha</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">No. Comprobante</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">No. Registro</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Nombre Contribuyente</th>
                                        <th style="vertical-align: middle;" scope="col" colspan="2">Compras Exentas</th>
                                        <th style="vertical-align: middle;" scope="col" colspan="2">Compras Exentas</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">IVA(Credito Fiscal)</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">IVA-Percibido</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Total Compras</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Compra a sujeto excluido</th>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;" scope="col">Importacion</th>
                                        <th style="vertical-align: middle;" scope="col">Internas</th>
                                        <th style="vertical-align: middle;" scope="col">Importacion</th>
                                        <th style="vertical-align: middle;" scope="col">Internas</th>
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
                        </div>
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