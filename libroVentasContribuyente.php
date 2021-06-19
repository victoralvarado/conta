<?php
if (isset($_POST['fechaC'])) {
    $f = $_POST['fechaC'];
    require_once('model/Documento.php');
    ob_start();
    require_once 'dompdf/autoload.inc.php';
    $dompdf = new Dompdf\Dompdf(['isRemoteEnabled' => true]);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh5U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Ventas Contribuyentes</title>
    </head>

    <body>
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center;"><strong>LIBRO DE VENTAS A CONTRIBUYENTES</strong></h5>
            </div>
        </div>
        <table style="border: none;width: 100%;">
            <tbody>
                <tr>
                    <td rowspan="4" style="vertical-align: middle;">
                        <div>
                            <h6 style="text-align: center;"><strong>Mes: <?php echo $f; ?></strong></h6>
                        </div>
                    </td>
                    <td rowspan="4" style="vertical-align: middle;">
                        <div>
                            <h5 style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        </div>
                    </td>
                    <td scope="col" colspan="2" rowspan="4" style="text-align: end;">
                        <h5 style="text-align: center;"><strong>Empresa de Ejemplo S.A de C.V</strong></h5>
                        <h6 style="text-align: center;"><strong>Desarrolo de Software, Seguridad Informatica y Tecnologias de la Información</strong></h6>
                        <h6 style="text-align: center;"><strong>Departamento de San Salvador, El Salvador, Centroamerica</strong></h6>

                        <h6 style="text-align: center;"><strong>Registro No:100001-1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:0101-010150-101-1</strong></h6>


                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table" style="width: 100%;">
            <thead class="thead-light" style="background-color: #E6ECEC;">
                <tr>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">#</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Fecha</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">No. Comprobante</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Nombre del Contibuyente</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">No. Registro</th>
                    <th colspan="2" style="border: black 2px solid; vertical-align: middle; text-align: center;">Ventas</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">IVA (Debito Fiscal)</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Totales</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">IVA Percibido</th>
                </tr>
                <tr>
                    <th style="border: black 2px solid; vertical-align: middle; text-align: center;">Exentas</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Gravadas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $objVC = new Documento();
                $afectasCF = 0;
                $exentasCF = 0;
                $exentasE = 0;
                $data = $objVC->libroVentasCF($f);
                if ($data) {
                    foreach ($data as $value) {
                        $afectasCF += $value['afectas'];
                        if ($value['exentas'] > 0 && $value['tipo'] == 'fcf') {
                            $exentasCF += $value['exentas'];
                        }
                        if ($value['exentas'] > 0 && $value['tipo'] == 'fex') {
                            $exentasE += $value['exentas'];
                        }
                    }
                } ?>
                <?php
                $n = 0;
                $objV = new Documento();
                $afectas = 0;
                $exentas = 0;
                $exentasI = 0;
                $sumas = 0;
                $totalDF = 0;
                $percepcionCF = 0;
                $data = $objV->libroVentasC($f);
                if ($data) {
                    foreach ($data as $value) {
                        $n++;
                        $afectas += ($value['afectas'] / 1.13);
                        $exentas += $value['exentas'];
                        $totalDF += ((($value['afectas'] / 1.13) * 0.13));
                        $sumas += (($value['exentas']) + ($value['afectas'] / 1.13) + ($value['afectas'] / 1.13) * 0.13);
                        if (($value['afectas'] / 1.13) >= 100 && $value['datos_cliente'] != 'gran contribuyente') {
                            $percepcionCF += (($value['afectas'] / 1.13) * 0.01);
                        }
                ?>
                        <tr>
                            <th style="border: black 2px solid;">
                                <?php echo $n; ?>
                            </th>
                            <td style="border: black 2px solid;">
                                <?php echo substr($value['fecha'], 0, 10); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo strtoupper($value['tipo']) . ' ' . $value['numero']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['nombre']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['nrc']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($value['exentas'] > 0) {
                                    echo '$' . number_format($value['exentas'], 2);
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($value['afectas'] > 0) {
                                    echo '$' . number_format($value['afectas'] / 1.13, 2);
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if ($value['afectas'] > 0) {
                                    echo '$' . number_format(($value['afectas'] / 1.13) * 0.13, 2);
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format((($value['exentas']) + ($value['afectas'] / 1.13) + ($value['afectas'] / 1.13) * 0.13), 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                if (($value['afectas'] / 1.13) >= 100 && $value['datos_cliente'] != 'gran contribuyente') {
                                    echo '$' . number_format(($value['afectas'] / 1.13) * 0.01, 2);
                                } ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="border-left: 2px solid black; border-bottom: 2px solid black; text-align: center;">
                        <strong>Totales del Mes</strong>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($exentas, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($afectas, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($totalDF, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($sumas, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($percepcionCF, 2); ?>
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="row justify-content-center justify-content-md-center">
            <div class="col-md-6">
                <table class="" style="width: 60%; margin-left: auto;margin-right: auto; " cellspacing="5" cellpadding="5">
                    <thead>
                        <tr>
                            <th style="border: black 2px solid;">Resumen</th>
                            <th style="border: black 2px solid;">Exentas</th>
                            <th style="border: black 2px solid;">Gravadas</th>
                            <th style="border: black 2px solid;">Debito Fiscal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr">
                            <td style="border: black 2px solid;">
                                Ventas a Contribuyentes
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($exentas, 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($afectas, 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($totalDF, 2); ?>
                            </td>
                            </tr>
                            <tr>
                                <td style="border: black 2px solid;">
                                    Ventas a Consumidor Final
                                </td>
                                <td style="border: black 2px solid;">
                                    <?php echo '$' . number_format(($exentasCF / 1.13), 2); ?>
                                </td>
                                <td style="border: black 2px solid;">
                                    <?php echo '$' . number_format(($afectasCF / 1.13) + ($exentasE / 1.13), 2); ?>
                                </td>
                                <td style="border: black 2px solid;">
                                    <?php echo '$' . number_format((($exentasCF / 1.13) * 0.13) + (($afectasCF / 1.13) * 0.13) + (($exentasE / 1.13) * 0.13), 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="border: black 2px solid;">
                                    TOTALES
                                </th>
                                <th style="border: black 2px solid;">
                                    <?php echo '$' . number_format($exentas + ($exentasCF / 1.13), 2); ?>
                                </th>
                                <th style="border: black 2px solid;">
                                    <?php echo '$' . number_format($afectas + (($afectasCF / 1.13) + ($exentasE / 1.13)), 2); ?>
                                </th>
                                <th style="border: black 2px solid;">
                                    <?php echo '$' . number_format($totalDF + ((($exentasCF / 1.13) * 0.13) + (($afectasCF / 1.13) * 0.13) + (($exentasE / 1.13) * 0.13)), 2); ?>
                                </th>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
    echo 'NADA QUE MOSTRAR';
}
?>