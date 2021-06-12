<?php
if (isset($_POST['numfac'])) {
    require_once('model/Documento.php');
    $n =  $_POST['numfac'];
    ob_start();
    require_once 'dompdf/autoload.inc.php';
    $dompdf = new Dompdf\Dompdf(['isRemoteEnabled' => true]);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <script src="resources/numl.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh5U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Factura</title>
    </head>

    <body>
        <table style="border: none; width: 100%;" cellspacing="10">
            <tbody>
                <tr>
                    <td scope="col" colspan="2" rowspan="4">
                        <h5 style="text-align: center;"><strong>Empresa de Ejemplo S.A de C.V</strong></h5>
                        <h6 style="text-align: center;"><strong>Desarrolo de Software, Seguridad Informatica y Tecnologias de la Información</strong></h6>
                        <h6 style="text-align: center;"><strong>Departamento de San Salvador, El Salvador, Centroamerica</h6>
                        <h6 style="text-align: center;"><strong>Registro No:100001-1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:0101-010150-101-1</strong></h6>
                    </td>
                    <?php
                    $tipoF = "";
                    $objD = new Documento();
                    $data = $objD->datosSerie($n);
                    if ($data) {
                        foreach ($data as $value) {
                            if ($value['tipo'] == 'ccf') {
                                $tipoF = "Comprobante de Crédito Fiscal";
                            } elseif ($value['tipo'] == 'fcf') {
                                $tipoF = "Factura Consumidor Final";
                            } else {
                                $tipoF = "Factura de Exportación";
                            }
                    ?>
                            <td rowspan="4" style="vertical-align: middle;">
                                <div style="border-style: solid; border-radius: 6px;">
                                    <h6 style="text-align: center;"><strong><?php echo $tipoF; ?></strong></h6>
                                    <h4 style="text-align: center; color: red;"><strong>No. <?php echo $n; ?></strong></h4>
                                    <h6 style="text-align: center;"><strong>Serie: <?php echo $value['serie']; ?></strong></h6>
                                </div>
                            </td>
                    <?php }
                    } ?>
                </tr>
            </tbody>
        </table>
        <table style="border: none; width: 100%;">
            <tbody>
                <?php
                $condicion = "";
                $objD = new Documento();
                $data = $objD->datosCliente($n);
                if ($data) {
                    foreach ($data as $value) {
                        if ($value['condiciones'] == 0) {
                            $condicion = "Contado";
                        } else {
                            if ($value['condiciones'] <= 1) {
                                $condicion = $value['condiciones'] . ' Mes';
                            } else {
                                $condicion = $value['condiciones'] . ' Meses';
                            }
                        }
                ?>
                        <tr>
                            <td scope="col" colspan="2" rowspan="4">
                                <h6 style="text-align: left;"><strong>Nombre: </strong><?php echo '<font style="text-decoration:underline;">' . $value['nombre'] . '</font>'; ?></h6>
                                <h6 style="text-align: left;"><strong>Dirección: </strong><?php echo '<font style="text-decoration:underline;">' . $value['direccion'] . '</font>'; ?></h6>
                                <h6 style="text-align: left;"><strong>Condicion de pago: </strong><?php echo '<font style="text-decoration:underline;">' . $condicion . '</font>'; ?></h6>
                            </td>
                            <td scope="col" colspan="2" rowspan="4">
                                <h6 style="text-align: left;"><strong>Fecha: </strong><?php echo '<font style="text-decoration:underline;">' . substr($value['fecha'], 0, 10) . '</font>'; ?></h6>
                                <h6 style="text-align: left;"><strong>Registro No: </strong><?php echo '<font style="text-decoration:underline;">' . $value['nrc'] . '</font>'; ?></h6>
                                <h6 style="text-align: left;"><strong>NIT: </strong><?php echo '<font style="text-decoration:underline;">' . $value['nit'] . '</font>'; ?></h6>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <table class="table" style="width: 100%;" cellspacing="10">
            <thead class="thead-dark" style="display: table-header-group;
    vertical-align: middle;
    border-color: inherit;">
                <tr>
                    <th style="border: black 2px solid;">Cantidad</th>
                    <th style="border: black 2px solid;">Descripcion</th>
                    <th style="border: black 2px solid;">Precio</th>
                    <th style="border: black 2px solid;">Exentas</th>
                    <th style="border: black 2px solid;">Afectas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $exentas = 0.00;
                $afectas = 0.00;
                $iva = 0.00;
                $per = 0.00;
                $sumasaf = 0.00;
                $objD = new Documento();
                $data = $objD->datosfactura($n);
                if ($data) {
                    foreach ($data as $value) {
                        if ($tipoF == 'Comprobante de Crédito Fiscal') {
                            if (number_format($value['price'], 2) == number_format($value['precio'], 2)) {
                                $exentas = $value['price'] * $value['cant'];
                                $afectas = 0.00;
                            } else if (number_format($value['price'], 2) != number_format($value['precio'], 2)) {
                                $exentas = 0.00;
                                $afectas = ($objD->PrecioProd($value['producto'])) * $value['cant'];
                                $sumasaf += $afectas;
                            }
                        } else if ($tipoF == "Factura de Exportación") {
                            $exentas = $value['price'] * $value['cant'];
                            $afectas = 0.00;
                        } else {
                            if (number_format($value['price'], 2) == number_format($value['precio'], 2)) {
                                $exentas = $value['price'] * $value['cant'];
                                $afectas = 0.00;
                            } else if (number_format($value['price'], 2) != number_format($value['precio'], 2)) {
                                $exentas = 0.00;
                                $afectas = (($objD->PrecioProd($value['producto'])) * $value['cant']) * 0.13 + ((($objD->PrecioProd($value['producto'])) * $value['cant']));
                                $sumasaf += $afectas;
                            }
                        }

                ?>
                        <tr>
                            <td style="border: black 2px solid;">
                                <?php echo $value['cant']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['descripcion']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($tipoF == 'Comprobante de Crédito Fiscal' || $tipoF == "Factura de Exportación") {
                                    echo '$' . number_format($objD->PrecioProd($value['producto']), 2);
                                } else {
                                    echo '$' . number_format(($objD->PrecioProd($value['producto']) * 0.13) + ($objD->PrecioProd($value['producto'])), 2);
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($exentas, 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                echo '$' . number_format($afectas, 2); ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 2px solid transparent;">

                    </td>

                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Sumas</strong>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($value['exentas'], 2); ?>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format(($sumasaf), 2); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>IVA 13%</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php
                        if ($value['iva'] > 0) {
                            echo '$' . number_format(($sumasaf) * 0.13, 2);
                            $iva = round($sumasaf) * 0.13;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Subtotal</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php
                        if ($value['iva'] > 0) {
                            echo '$' . number_format(($sumasaf) + $iva, 2);
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Percepcion</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php if ($value['retencion'] >= 1) {
                            echo '$' . number_format(($sumasaf) * 0.01, 2);
                            $per = round($sumasaf) * 0.01;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Retencion</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">

                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 2px solid black;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Ventas Exentas</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($value['exentas'], 2); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-left: 2px solid black; border-bottom: 2px solid black;">
                        <?php
                        $c = '';
                        $d = '';
                        $datos = number_format($value['exentas'] + ($sumasaf) + $iva + $per, 2, '.', '');
                        list($n1, $n2) = explode(".", $datos);
                        $f = new NumberFormatter('es', NumberFormatter::SPELLOUT);

                        if ($n1 > 1 || $n1 == 0) {
                            $d = 'DOLARES';
                        } else {
                            $d = 'UN DOLAR';
                            $n1 = '';
                        }
                        if ($n2 > 1 || $n2 == 0) {
                            $c = 'CENTAVOS';
                        } else {
                            $c = 'UN CENTAVO';
                            $n2 = '';
                        }
                        echo '<strong>SON: </strong>' . mb_strtoupper(str_replace('y uno', 'y un', str_replace('iuno', 'IÚN', $f->format($n1))));
                        echo mb_strtoupper(' ' . $d . ' CON ' . str_replace('y uno', 'y un', str_replace('iuno', 'IÚN', $f->format($n2)))) . ' ' . $c . ' ';
                        ?>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong>Total a pagar</strong>
                    </td>
                    <td style="border-bottom: 1px solid transparent;">
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($value['exentas'] + ($sumasaf) + $iva + $per, 2); ?>
                    </td>

                </tr>
            </tfoot>
        </table>
    </body>

    </html>
<?php
    $HTML = ob_get_contents();
    $dompdf->loadHtml($HTML);
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();
    ob_get_clean();
    $dompdf->stream("", array("Attachment" => false));
} else {
    echo 'NO HAY DATOS';
}
?>