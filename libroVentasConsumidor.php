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
    </head>

    <body>
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center;"><strong>LIBRO DE VENTAS A CONSUMIDOR</strong></h5>
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
                    <th rowspan="3" style="border: black 2px solid; vertical-align: middle;">#</th>
                    <th rowspan="3" style="border: black 2px solid; vertical-align: middle;">Fecha</th>
                    <th colspan="2" style="border: black 2px solid; vertical-align: middle; text-align: center;">Factura</th>
                    <th colspan="3" style="border: black 2px solid; vertical-align: middle; text-align: center;">Ventas</th>
                    <th rowspan="3" style="border: black 2px solid; vertical-align: middle;">Totales</th>
                </tr>
                <tr>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Desde</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Hasta</th>
                    <th colspan="2" style="border: black 2px solid; vertical-align: middle; text-align: center;">Gravadas</th>
                    <th rowspan="2" style="border: black 2px solid; vertical-align: middle;">Exentas</th>
                </tr>
                <tr>
                    <th style="border: black 2px solid; vertical-align: middle;">Locales</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Exportacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $objV = new Documento();
                $afectas = 0;
                $exentas = 0;
                $exentasE = 0;
                $sumas = 0;
                $data = $objV->libroVentasCF($f);
                if ($data) {
                    foreach ($data as $value) {
                        $n++;
                        $afectas += $value['afectas'];
                        if ($value['exentas'] > 0 && $value['tipo'] == 'fcf') {
                            $exentas += $value['exentas'];
                        }
                        if ($value['exentas'] > 0 && $value['tipo'] == 'fex') {
                            $exentasE += $value['exentas'];
                        }
                        $sumas += ($value['afectas'] + $value['exentas']);
                ?>
                        <tr>
                            <th style="border: black 2px solid;">
                                <?php echo $n; ?>
                            </th>
                            <td style="border: black 2px solid;">
                                <?php echo substr($value['fecha'], 0, 10); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['numero']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['numero']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($value['afectas'] > 0) {
                                    echo '$' . number_format($value['afectas'], 2);
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($value['exentas'] > 0 && $value['tipo'] == 'fex') {
                                    echo '$' . number_format($value['exentas'], 2);
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($value['exentas'] > 0 && $value['tipo'] == 'fcf') {
                                    echo '$' . number_format($value['exentas'], 2);
                                }
                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($value['afectas'] + $value['exentas'], 2); ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="border-left: 2px solid black; border-bottom: 2px solid black; text-align: center;">
                        <strong>Totales del Mes</strong>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($afectas, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($exentasE, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($exentas, 2); ?>
                    </th>
                    <th style="border: 2px solid black; border-left: 2px solid black;">
                        <?php echo '$' . number_format($sumas, 2); ?>
                    </th>
                </tr>
            </tfoot>
        </table>
        <br><br>
        <div class="row justify-content-center justify-content-md-center">
            <div class="col-md-6">
                <table class="" style="width: 60%; margin-left: auto;margin-right: auto; " cellspacing="5" cellpadding="5">
                    <thead>
                        <tr>
                            <th style="border: black 2px solid;">Resumen de operaciones</th>
                            <th style="border: black 2px solid;">Valor Neto</th>
                            <th style="border: black 2px solid;">Debito Fiscal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: black 2px solid;">
                                Ventas Internas Gravadas
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($afectas / 1.13), 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($afectas / 1.13) * 0.13, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: black 2px solid;">
                                Exportacion
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($exentasE / 1.13), 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($exentasE / 1.13) * 0.13, 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: black 2px solid;">
                                Ventas Internas Exentas
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($exentas / 1.13), 2); ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format(($exentas / 1.13) * 0.13, 2); ?>
                            </td>
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