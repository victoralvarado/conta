<?php
require_once('model/Producto.php');
if (isset($_POST['numProd'])) {
    $idProducto =  $_POST['numProd'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $descripcion = $_POST['des'];
    ob_start();
    require_once 'dompdf/autoload.inc.php';
    $dompdf = new Dompdf\Dompdf(['isRemoteEnabled' => true]);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <title>Kardex</title>
    </head>

    <body style="font-size: 14px !important;
			height: 355px;
			margin: -45px;
			padding: 10px;
			page-break-inside: avoid; 
			width: 100%;">
        <table style="border: none; width: 100%;" cellspacing="10">
            <tbody>
                <tr>
                    <td scope="col">
                        <h5 style="text-align: left;"><strong>Targeta de Control de Inventario</strong></h5>
                        <h6 style="text-align: left;"><strong>Metodo Costo Promedio</strong></h6>
                        <h6 style="text-align: left;"><strong>DESDE: <?php echo $desde; ?></strong></h6>
                        <h6 style="text-align: left;"><strong>HASTA: <?php echo $hasta; ?></strong></h6>
                    </td>
                    <td scope="col">
                        <h5 style="text-align: center;"><strong>Empresa de Ejemplo S.A de C.V</strong></h5>
                        <h6 style="text-align: center;"><strong>Desarrolo de Software, Seguridad Informatica y Tecnologias de la Información</strong></h6>
                        <h6 style="text-align: center;"><strong>Departamento de San Salvador, El Salvador, Centroamerica</h6>
                        <h6 style="text-align: center;"><strong>Registro No:100001-1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:0101-010150-101-1</strong></h6>
                    </td>

                    <td scope="col" style="vertical-align: middle;">
                        <h6 style="text-align: center;"><strong><?php echo $descripcion; ?></strong></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%;" cellspacing="10" cellpadding="10">
            <thead class="thead-light" style="display: table-header-group; background-color: #F1F7F7;">
                <tr>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">#</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Fecha</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Documento</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Proveedor\Cliente</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Tipo</th>
                    <th colspan="3" style="border: black 2px solid; text-align: center; vertical-align: middle;">Entradas</th>
                    <th colspan="3" style="border: black 2px solid; text-align: center; vertical-align: middle;">Salidas</th>
                    <th colspan="3" style="border: black 2px solid; text-align: center; vertical-align: middle;">Saldos</th>

                </tr>
                <tr>
                    <th style="border: black 2px solid;">Unidades</th>
                    <th style="border: black 2px solid;">C. Unitario</th>
                    <th style="border: black 2px solid;">Valor Total</th>
                    <th style="border: black 2px solid;">Unidades</th>
                    <th style="border: black 2px solid;">C. Unitario</th>
                    <th style="border: black 2px solid;">Valor Total</th>
                    <th style="border: black 2px solid;">Unidades</th>
                    <th style="border: black 2px solid;">C. Unitario</th>
                    <th style="border: black 2px solid;">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $tipo = '';
                $vt_anterior = 0;
                $costouniP = 0;
                $nvt = 0;
                $ncosto = 0;
                $nmul = 0;
                $valorcompra1 = 0;
                $valorcompra2 = 0;
                $objP = new Producto();
                $data = $objP->movimiento($idProducto, $desde, $hasta);
                if ($data) {
                    foreach ($data as $value) {
                        $n++;
                        if ($value['tipo'] == 0) {
                            $tipo = 'Venta';
                        } else {
                            $tipo = 'Compra';
                        }
                ?>
                        <tr>
                            <th style="border: black 2px solid;">
                                <?php echo $n; ?>
                            </th>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n == 1) {
                                    echo $desde;
                                } else {
                                    echo $value['fecha'];
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n == 1) {
                                    echo $value['doc'];
                                } else {
                                    echo mb_strtoupper($value['doc']);
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    echo $objP->mostrarClPr($value['tipo'], $value['cliente']);
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n > 1) {
                                    echo $tipo;
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Compra') {
                                        echo $value['cantidad'];
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Compra') {
                                        echo '$' . number_format($value['costo'], 2);
                                        $costouniP = $value['costo']; //costo unitario de las compras
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Compra') {
                                        echo '$' . number_format($value['cantidad'] * $value['costo'], 2);
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Venta') {
                                        echo $value['cantidad'];
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Venta') {
                                        if ($ncosto > 0) {
                                            echo '$' . number_format($ncosto, 2);
                                        } else {
                                            echo '$' . number_format($costouniP, 2);
                                        }
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Venta') {
                                        if ($ncosto > 0) {
                                            echo '$' . number_format($value['cantidad'] * $ncosto, 2);
                                            $nmul = $value['cantidad'] * $ncosto;
                                        } else {
                                            echo '$' . number_format($value['cantidad'] * $costouniP, 2);
                                        }
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n == 1) {
                                    echo $value['ultima_existencia'];
                                } else {
                                    if ($tipo == 'Compra') {
                                        echo $value['ultima_existencia'] + $value['cantidad'];
                                    } else {
                                        echo $value['ultima_existencia'] - $value['cantidad'];
                                    }
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n == 1) {
                                    echo '$' . number_format($value['ultimo_costo'], 2);
                                } else {
                                    if ($tipo == 'Compra') {

                                        if ($nvt > 0) {
                                            echo '$' . number_format(($nvt + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']), 2);
                                            $valorcompra2 = ($nvt + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']);
                                            $vt_anterior = ($nvt + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']);
                                            $ncosto = ($nvt + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']);
                                        } else {
                                            echo '$' . number_format((($value['ultimo_costo']) + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']), 2);
                                            $valorcompra1 = (($value['ultimo_costo']) + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']);
                                            $vt_anterior = (($value['ultimo_costo']) + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']);
                                        }
                                    } else {
                                        if ($nvt > 0) {
                                            if ($valorcompra2 <= 0) {
                                                echo '$' . number_format($valorcompra1, 2);
                                            } else {
                                                echo '$' . number_format($valorcompra2, 2);
                                            }
                                        } else {
                                            echo '$' . number_format($valorcompra1, 2);
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($n == 1) {
                                    echo '$' . number_format($value['ultima_existencia'] * $value['ultimo_costo'], 2);
                                } else {
                                    if ($tipo == 'Compra') {
                                        if ($nvt > 0) {
                                            echo '$' . number_format(($value['cantidad'] * $value['costo']) + $nvt, 2);
                                            $vt_anterior = ($value['cantidad'] * $value['costo']) + $nvt;
                                        } else {
                                            echo '$' . number_format(($value['cantidad'] * $value['costo']) + $value['ultimo_costo'], 2);
                                            $vt_anterior = ($value['cantidad'] * $value['costo']) + $value['ultimo_costo'];
                                        }
                                    } else {
                                        if ($nvt > 0) {
                                            if ($nmul > 0) {

                                                echo '$' . number_format($vt_anterior - ($nmul), 2);
                                                $nvt = $vt_anterior - ($nmul);
                                                $vt_anterior = $vt_anterior - ($nmul);
                                            } else {
                                                echo '$' . number_format($nvt - ($value['cantidad'] * $costouniP), 2);
                                                $nvt = $nvt - ($value['cantidad'] * $costouniP);
                                            }
                                        } else {
                                            echo '$' . number_format($vt_anterior - ($value['cantidad'] * $costouniP), 2);
                                            $nvt = $vt_anterior - ($value['cantidad'] * $costouniP);
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </body>

    </html>
<?php
    $HTML = ob_get_contents();
    $dompdf->loadHtml($HTML);
    $dompdf->set_paper('letter', 'landscape');
    $dompdf->render();
    ob_get_clean();
    $dompdf->stream("", array("Attachment" => false));
} else {
    echo 'NO HAY DATOS';
}
?>