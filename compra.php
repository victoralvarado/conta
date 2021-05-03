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
                include("nav.php");
                ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <div class="row">
                            <form class="well form" method="POST" action="controller/compraController.php">
                                <fieldset class="form-group">
                                    <legend class="w-auto">Libro de compras</legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('Y-m-d');
                                            $horaActual = date('h:i');
                                            $fh = $fechaActual . "T" . $horaActual; ?>
                                            <input name="fecha" type="datetime-local" class="form-control" value="<?php echo $fh; ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Numero de Comprobante</label>
                                            <input type="number" class="form-control" placeholder="Numero de comprobante" name="comprobante" aria-describedby="inputGroupPrepend" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control" required="true">
                                                <option value="">Seleccionar</option>
                                                <option value="1" title="Comprobante de credixto fiscal">CCF</option>
                                                <option value="0" title="Nota de credito">NC</option>
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
                                                        <option id="<?php echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1); ?>" value="<?php echo ucwords(strtolower($value['id'])); ?>" title="<?php echo ucwords(strtolower($value['nombre'])); ?>"><?php echo ucwords(strtolower($value['nombre'])); ?></option>

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
                                            <input type="text" id="nrcProveedor" placeholder="NRC" class="form-control" name="nrcProveedor" required="true" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>NIT</label>
                                            <input type="text" class="form-control" placeholder="NIT" value="" name="nitProveedor" id="nitProveedor" required="true" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Clasificacion</label>
                                            <input type="text" class="form-control" placeholder="Clasificacion" value="" name="clasificacion" id="clasificacion" required="true" readonly>
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
                                                        <option id="<?php echo $value['codigo']; ?>" value="<?php echo $value['id']; ?>"><?php echo ucwords(strtolower($value['nombre'])); ?></option>

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
                                        <div class="col-md-2"">
                                        </div>
                                        <div class=" col-md-3"">
                                            <label>Condicion de pago</label>
                                            <select name="condicion" id="condicion" class="form-control" required="true">
                                                <option id="condi0" value="">Seleccionar</option>
                                                <option id="condi1" value="1">Contado</option>
                                                <option id="condi2" value="2">Credito</option>
                                            </select>
                                        </div>
                                        <div class=" col-md-5" style="text-align: center;">
                                            <label>Tipo de compra</label>
                                            <select name="tCompra" id="tCompra" class="form-control" required="true" disabled="true">
                                                <option id="c0" value="">Seleccionar</option>
                                                <option id="c1" value="c1">Compra Exenta Importacion</option>
                                                <option id="c2" value="c2">Compra Exenta Interna</option>
                                                <option id="c3" value="c3">Compra Gravada Importacion</option>
                                                <option id="c4" value="c4">Compra Gravada Interna</option>
                                            </select>
                                            <span id="spTipo" style="color:red">Seleccione un contribuyente</span>
                                        </div>
                                        <div class="col-md-2"">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                            <h6 style="text-align: center;">
                                                Compras Exentas
                                            </h6>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Importacion</label>
                                                    <input type="number" min="0" class="form-control com" value="0.00" name="exentasIm" id="importacionE" readonly required="true">
                                                    <span class="alert" style="color:red"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Internas</label>
                                                    <input type="number" min="0" class="form-control com" value="0.00" name="exentasIn" id="internasE" readonly required="true">
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
                                                    <input type="number" min="0" class="form-control com gravadas" value="0.00" name="gravadasIm" id="importacionG" readonly required="true">
                                                    <span class="alert" style="color:red"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Internas</label>
                                                    <input type="number" min="0" class="form-control com gravadas" value="0.00" name="gravadasIn" id="internasG" readonly required="true">
                                                    <span class="alert" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>IVA(Credito Fiscal)</label>
                                                <input type="number" value="0.00" class="form-control" placeholder="(+)IVA Credito Fiscal" name="ivaCF" id="ivaCF" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>IVA-Retención</label>
                                                <input type="number" value="0.00" class="form-control" placeholder="(-)IVA Retención" name="ivaR" id="ivaR" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Compras</label>
                                                <input type="number" value="0.00" class="form-control" placeholder="Total Compras" name="totalCom" id="totalCom" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Compra a sujeto excluido</label>
                                                <input type="number" value="0.00" id="excluido" class="form-control" name="excluido" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" style="text-align: center;">
                                                <input type="hidden" name="user" value="<?php echo $_SESSION['USER']; ?>">
                                                <button type="submit" id="agregarCompra" name="agregarCompra" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar Compra</button>
                                                <button type="reset" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Limpiar cajas de texto"><em class="fa fa-eraser"></em> Limpiar</button>
                                            </div>
                                        </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <table id="tblCompras" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <caption>Libro de compras</caption>
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Fecha</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">No. Comprobante</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">NRC</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">NIT</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Nombre Contribuyente</th>
                                        <th style="vertical-align: middle;" scope="col" colspan="2">Compras Exentas</th>
                                        <th style="vertical-align: middle;" scope="col" colspan="2">Compras Gravadas</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">IVA(Credito Fiscal)</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">IVA-Retención</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Total Compras</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Compra a sujeto excluido</th>
                                        <th style="vertical-align: middle;" scope="col" rowspan="2">Accion</th>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;" scope="col">Importacion</th>
                                        <th style="vertical-align: middle;" scope="col">Internas</th>
                                        <th style="vertical-align: middle;" scope="col">Importacion</th>
                                        <th style="vertical-align: middle;" scope="col">Internas</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $objC = new Compra();
                                    $data = $objC->getAllCompras();
                                    if ($data) {

                                        foreach ($data as $value) {
                                    ?>
                                            <tr>

                                                <td><?php echo $value['fecha']; ?></td>
                                                <td><?php echo strtoupper($value['tipo']) . "" . $value['numero_comprobante']; ?></td>
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
                                                <td><?php if ($value['nit'] == '') {
                                                        $value['nit'];
                                                    } else {
                                                        echo substr($value['nit'], 0, 4) . "-" . substr($value['nit'], 4, 6) . "-"
                                                            . substr($value['nit'], 10, 3) . "-" . substr($value['nit'], 13, 1);
                                                    } ?></td>
                                                <td><?php echo strtoupper($value['nombre']); ?></td>
                                                <td>$<?php echo $value['exentas_importacion']; ?></td>
                                                <td>$<?php echo $value['exentas_internas']; ?></td>
                                                <td>$<?php echo $value['gravadas_importacion']; ?></td>
                                                <td>$<?php echo $value['gravadas_internas']; ?></td>
                                                <td>$<?php echo $value['iva']; ?></td>
                                                <td>$<?php echo $value['retencion']; ?></td>
                                                <td>$<?php echo $value['totalCompras']; ?></td>
                                                <td>$<?php echo $value['sujeto_excluido']; ?></td>
                                                <td>
                                                    <form action="editarCompra.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="idCompra" value="<?php echo $value['id']; ?>">
                                                        <button type="submit" name="editarCompra" class="btn btn-primary"><em class="fa fa-pencil"></em> Editar</button>
                                                    </form>
                                                    <br>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "NADA";
                                    }
                                    ?>
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