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
    <script type="text/javascript" src="resources/editarCompra.js"></script>
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
                include("nav.php");
                ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <div class="row">
                            <?php
                            if (isset($_POST['idCompra'])) {

                                $objC = new Compra();
                                $data = $objC->getOneCompra($_POST['idCompra']);
                                if ($data) {
                                    foreach ($data as $value) {
                            ?>
                                        <form class="well form" method="POST" id="modificar" action="controller/compraController.php">
                                            <fieldset class="form-group">
                                                <legend class="w-auto">Modificar compra</legend>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Fecha</label>
                                                        <input name="fecha" type="datetime-local" class="form-control" value="<?php echo substr(str_replace(" ", "T", $value['fecha']), 0, 16); ?>" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Numero de Comprobante</label>
                                                        <input type="number" class="form-control" placeholder="Numero de comprobante" value="<?php echo $value['numero_comprobante']; ?>" name="comprobante" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <?php echo $value['tipo']; ?>
                                                        <select name="tipo" class="form-control" required="true">
                                                            <?php
                                                            switch ($value['tipo']) {
                                                                case 'ccf':
                                                            ?>
                                                                    <option disabled value="">Seleccionar</option>
                                                                    <option selected value="1" title="Comprobante de credixto fiscal">CCF</option>
                                                                    <option value="0" disabled title="Nota de credito">NC</option>
                                                                <?php
                                                                    break;
                                                                case 'nc':
                                                                ?>
                                                                    <option value="" disabled>Seleccionar</option>
                                                                    <option value="1" disabled title="Comprobante de credixto fiscal">CCF</option>
                                                                    <option selected value="0" title="Nota de credito">NC</option>
                                                                <?php
                                                                    break;

                                                                default:
                                                                ?>

                                                                    <option selected value="">Seleccionar</option>
                                                                    <option value="1" disabled title="Comprobante de credixto fiscal">CCF</option>
                                                                    <option value="0" disabled title="Nota de credito">NC</option>
                                                            <?php
                                                                    break;
                                                            } ?>

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre del contribuyente</label>
                                                        <select class="form-control" id="contribuyente" name="contribuyente" required="true">
                                                            <option value="">Seleccionar</option>
                                                            <?php
                                                            $nombre = $value['nombre'];
                                                            $objPr = new Proveedor();
                                                            $dat = $objPr->getAllProveedor();
                                                            if ($dat) {
                                                                foreach ($dat as $val) {
                                                            ?>
                                                                    <?php if ($val['nombre'] == $nombre) {
                                                                        $selected = 'selected';
                                                                    } else {
                                                                        $selected = '';
                                                                    } ?>
                                                                    <option <?php echo $selected; ?> id="<?php echo substr($val['nrc'], 0, 6) . "-" . substr($val['nrc'], 6, 1); ?>" value="<?php echo $val['id']; ?>" title="<?php echo strtoupper($val['nombre']); ?>"><?php echo strtoupper($val['nombre']); ?></option>

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
                                                        <input type="text" id="nrcProveedor" value="<?php

                                                                                                    echo substr($value['nrc'], 0, 6) . "-" . substr($value['nrc'], 6, 1);


                                                                                                    ?>" placeholder="NRC" class="form-control" name="nrcProveedor" required="true" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>NIT</label>
                                                        <input type="text" class="form-control" placeholder="NIT" value="<?php if ($value['nit'] == '') {
                                                                                                                                $value['nit'];
                                                                                                                            } else {
                                                                                                                                echo substr($value['nit'], 0, 4) . "-" . substr($value['nit'], 4, 6) . "-"
                                                                                                                                    . substr($value['nit'], 10, 3) . "-" . substr($value['nit'], 13, 1);
                                                                                                                            } ?>" name="nitProveedor" id="nitProveedor" required="true" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Clasificacion</label>
                                                        <input type="text" class="form-control" placeholder="Clasificacion" value="<?php echo ucwords(strtolower($value['clasificacion'])); ?>" name="clasificacion" id="clasificacion" required="true" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Producto</label>
                                                        <select class="form-control" id="producto" name="producto" required="true">
                                                            <option value="">Seleccionar</option>
                                                            <?php
                                                            $producto = $value['nombrep'];
                                                            $objProd = new Producto();
                                                            $datp = $objProd->getAllProducto();
                                                            if ($datp) {
                                                                foreach ($datp as $valp) {
                                                            ?>
                                                                    <?php if ($valp['nombre'] == $producto) {
                                                                        $selected = 'selected';
                                                                    } else {
                                                                        $selected = '';
                                                                    } ?>
                                                                    <option <?php echo $selected; ?> id="<?php echo $valp['codigo']; ?>" value="<?php echo $valp['id']; ?>"><?php echo ucwords(strtolower($valp['nombre'])); ?></option>

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
                                                        <input type="number" min="0" value="<?php echo $value['cant']; ?>" id="cantidad" class="form-control mul" name="cantidad" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Precio</label>
                                                        <input type="number" min="1.00" step="any" value="<?php echo $value['price']; ?>" class="form-control mul" name="precio" id="precio" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Cantidad × Precio</label>
                                                        <input type="number" class="form-control" step="any" value="<?php echo ($value['price'] * $value['cant']); ?>" placeholder="Total" name="cp" id="cp" required="true" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="col-md-2"">
                                        </div>
                                        <div class=" col-md-3"">
                                                        <label>Condicion de pago</label>
                                                        <select name="condicion" id="condicion" class="form-control" required="true">
                                                            <?php switch ($value['condiciones']) {
                                                                case '1':
                                                            ?>
                                                                    <option id="condi0" value="">Seleccionar</option>
                                                                    <option selected id="condi1" value="1">Contado</option>
                                                                    <option id="condi2" value="2">Credito</option>
                                                                <?php
                                                                    break;
                                                                case '2':
                                                                ?>
                                                                    <option id="condi0" value="">Seleccionar</option>
                                                                    <option id="condi1" value="1">Contado</option>
                                                                    <option selecteds id="condi2" value="2">Credito</option>
                                                                <?php
                                                                    break;

                                                                default:
                                                                ?>
                                                                    <option selecteds id="condi0" value="">Seleccionar</option>
                                                                    <option id="condi1" value="1">Contado</option>
                                                                    <option id="condi2" value="2">Credito</option>
                                                            <?php
                                                                    break;
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class=" col-md-5" style="text-align: center;">
                                                        <label>Tipo de compra</label>
                                                        <?php if ($value['exentas_importacion'] > $value['exentas_internas'] && $value['exentas_importacion'] > $value['gravadas_importacion'] && $value['exentas_importacion'] > $value['gravadas_internas'] && $value['exentas_importacion'] > $value['sujeto_excluido']) {
                                                        ?>
                                                            <input type="hidden" id="tipocompraval" value="c1<?php echo $value['exentas_importacion']; ?>">
                                                        <?php
                                                        } else if ($value['exentas_internas'] > $value['gravadas_importacion'] && $value['exentas_internas'] > $value['gravadas_internas'] && $value['exentas_internas'] > $value['sujeto_excluido']) {
                                                        ?>
                                                            <input type="hidden" id="tipocompraval" value="c2<?php echo $value['exentas_internas']; ?>">
                                                        <?php
                                                        } else if ($value['gravadas_importacion'] > $value['gravadas_internas'] && $value['gravadas_importacion'] > $value['sujeto_excluido']) {
                                                        ?>
                                                            <input type="hidden" id="tipocompraval" value="c3<?php echo $value['gravadas_importacion']; ?>">
                                                        <?php
                                                        } else if ($value['gravadas_internas'] > $value['sujeto_excluido']) {
                                                        ?>
                                                            <input type="hidden" id="tipocompraval" value="c4<?php echo $value['gravadas_internas']; ?>">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="hidden" id="tipocompraval" value="c5<?php echo $value['sujeto_excluido']; ?>">
                                                        <?php
                                                        } ?>
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
                                                                <input type="number" min="0.00" step="any" class="form-control com" value="0.00" name="exentasIm" id="importacionE" readonly required="true">
                                                                <span class="alert" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Internas</label>
                                                                <input type="number" min="0.00" step="any" class="form-control com" value="0.00" name="exentasIn" id="internasE" readonly required="true">
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
                                                                <input type="number" min="0.00" step="any" class="form-control com gravadas" value="0.00" name="gravadasIm" id="importacionG" readonly required="true">
                                                                <span class="alert" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Internas</label>
                                                                <input type="number" min="0.00" step="any" class="form-control com gravadas" value="0.00" name="gravadasIn" id="internasG" readonly required="true">
                                                                <span class="alert" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>IVA(Credito Fiscal)</label>
                                                            <input type="hidden" id="ivaCFTemp" step="any" min="0.00" value="<?php echo $value['iva']; ?>">
                                                            <input type="number" class="form-control" step="any" min="0.00" value="0.00" placeholder="IVA Credito Fiscal" name="ivaCF" id="ivaCF" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>IVA-Retenido</label>
                                                            <input type="hidden" id="ivaRTemp" step="any" min="0.00" value="<?php echo $value['retencion']; ?>">
                                                            <input type="number" class="form-control" step="any" min="0.00" value="0.00" placeholder="IVA Retenido" name="ivaR" id="ivaR" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Total Compras</label>
                                                            <input type="hidden" id="totalComTemp" step="any" min="0.00" value="<?php echo $value['totalCompras']; ?>">
                                                            <input type="number" class="form-control" step="any" min="0.00" value="0.00" placeholder="Total Compras" name="totalCom" id="totalCom" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Compra a sujeto excluido</label>
                                                            <input type="number" id="excluido" step="any" min="0.00" value="0.00" class="form-control" name="excluido" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="text-align: center;">
                                                            <input type="hidden" name="user" value="<?php echo $_SESSION['USER']; ?>">
                                                            <input type="hidden" name="idCompra" value="<?php echo $value['idcompra']; ?>">
                                                            <button type="button" id="modificarCompra" name="modificarCompra" class="btn btn-primary"><i class="fas fa-file-edit"></i> Modificar Compra</button>
                                                            <a href="compra.php" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Volver al libro de compras"><i class="fas fa-reply-all"></i> Cancelar</a>
                                                        </div>
                                                    </div>
                                            </fieldset>
                                        </form>
                            <?php }
                                }
                            }
                            ?>
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