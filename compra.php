<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/Compra.php'); ?>
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
                            <form id="compras" class="well form" method="post">
                                <fieldset class="form-group">
                                    <legend class="w-auto">Proveedor/Compra</legend>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Nombre del contribuyente</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="contribuyente" name="contribuyente" required="true">
                                                <option value="">Seleccionar</option>
                                                <?php
                                                $objP = new Proveedor();
                                                $data = $objP->getAllProveedor();
                                                if ($data) {
                                                    foreach ($data as $value) {
                                                ?>
                                                        <option id="<?php echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1); ?>" value="<?php echo ucwords(strtolower($value['id'])); ?>" title="<?php echo strtoupper($value['nombre']); ?>"><?php echo strtoupper($value['nombre']); ?></option>

                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Clasificacion</label>
                                            <input type="text" class="form-control" placeholder="Clasificacion" value="" name="clasificacion" id="clasificacion" required="true" readonly>
                                        </div>
                                    </div>
                                    <div class=" col-md-3"">
                                    <div class=" form-group">
                                        <label>Dias de credito</label>
                                        <input type="number" min="0" class="form-control" placeholder="Dias de credito" value="0" name="condicion" id="condicion" required="true">
                                    </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha de la Factura</label>
                                <?php $fechaActual = date('Y-m-d');

                                $horaActual = date('h:i');
                                $fh = $fechaActual . "T" . $horaActual;
                                $max = $fechaActual . "T23:59";
                                $min = strtotime('-60 day', strtotime($fechaActual));
                                $min = date('Y-m-d', $min); ?>
                                <input name="fecha" id="fecha" type="datetime-local" class="form-control" min="<?php echo $min . "T00:00"; ?>" max="<?php echo $max; ?>" value="<?php echo $fh; ?>" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Numero de Factura</label>
                                <input type="number" class="form-control" id="numfactura" placeholder="Numero de comprobante" name="numfactura" aria-describedby="inputGroupPrepend" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tipo de Documento</label>
                                <select name="tipo" id="tipo" class="form-control" required="true">
                                    <option value="">Seleccionar</option>
                                    <option value="ccf" title="Comprobante de credixto fiscal">CCF</option>
                                    <option value="fcf" title="">FACTURA</option>

                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['USER']; ?>">
                        </fieldset>
                        </form>
                </div>
                <div class="row">
                    <form class="well form" method="post">
                        <fieldset class="form-group">
                            <legend class="w-auto">Producto</legend>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="producto" name="producto" required="true">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        $objProd = new Producto();
                                        $data = $objProd->getAllProducto();
                                        if ($data) {
                                            foreach ($data as $value) {
                                        ?>
                                                <option id="<?php echo $value['codigo']; ?>" value="<?php echo strtoupper($value['nombre']); ?>"><?php echo strtoupper($value['nombre']) . ' ' . $value['descripcion']; ?></option>

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
                                    <input type="number" min="1.00" step="any" value="0" class="form-control mul" name="precio" id="precio" required="true">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cantidad × Precio</label>
                                    <input type="number" class="form-control" value="" placeholder="Total" name="cp" id="cp" required="true" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="text-align: center;">
                                    <button id="adicionar" class="btn btn-success" type="button">Agregar Producto</button>
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <span id="valp" style="color: red;"></span>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="col-md-9">
                        <input type="hidden" name="adicionados" id="adicionados">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>SubTotal</th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Subtotal:</label>
                        <input type="number" min="0.00" step="any" value="0.00" class="form-control" name="total" id="total" readonly>
                        <label>IVA:</label>
                        <input type="number" min="0.00" step="any" value="0.00" class="form-control" name="iva" id="iva" readonly>
                        <label>Retencion:</label>
                        <input type="number" min="0.00" step="any" value="0.00" class="form-control" name="retencion" id="retencion" readonly>
                        <label>TOTAL:</label>
                        <input type="number" min="0.00" step="any" value="0.00" class="form-control" name="totalf" id="totalf" readonly>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group" style="text-align: center;">
                            <span id="valtodo" style="color: red;"></span>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <button id="guardar" class="btn btn-success" type="button">Guardar</button>
                        </div>

                    </div>
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