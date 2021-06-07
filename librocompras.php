<?php
if (isset($_POST['fecha'])) {
    $f = $_POST['fecha'];
    require_once('model/Compra.php');
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
                <h5 style="text-align: center;"><strong>LIBRO DE COMPRAS</strong></h5>
                <hr>
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
            <thead class="thead-light">
                <tr>
                    <th style="border: black 2px solid; vertical-align: middle;">#</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Fecha</th>
                    <th style="border: black 2px solid; vertical-align: middle;">No. Comprobante</th>
                    <th style="border: black 2px solid; vertical-align: middle;">No. Registro</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Nombre Contribuyente</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Afectas</th>
                    <th style="border: black 2px solid; vertical-align: middle;">IVA Credito Fiscal</th>
                    <th style="border: black 2px solid; vertical-align: middle;">IVA Percibido</th>
                    <th style="border: black 2px solid; vertical-align: middle;">Sumas</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $n = 0;
                $objC = new Compra();
                $afectas = 0;
                $ivaCF = 0;
                $ivaP = 0;
                $sumas = 0;
                $data = $objC->libroCompras($f);
                if ($data) {
                    foreach ($data as $value) {
                        $n++;
                        $afectas += $value['afectas'];
                        $ivaCF += $value['iva'];
                        $ivaP += $value['retencion'];
                        $sumas += ($value['afectas'] + $value['iva'] + $value['retencion']);
                ?>
                        <tr>
                            <th style="border: black 2px solid;">
                                <?php echo $n; ?>
                            </th>
                            <td style="border: black 2px solid;">
                                <?php echo $value['fecha']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo strtoupper($value['document_type']) . "" . $value['document_number']; ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php
                                $long = strlen($value['nrc']);
                                echo substr($value['nrc'], 0, ($long - 1)) . "-" . substr($value['nrc'], -1, 1)

                                ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo $value['nombre'];  ?>
                            </td>
                            <td class="afectas" style="border: black 2px solid;">
                                <?php echo '$' . number_format($value['afectas'], 2, '.', '');  ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($value['iva'], 2, '.', '');  ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($value['retencion'], 2, '.', '');  ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php echo '$' . number_format($value['afectas'] + $value['iva'] + $value['retencion'], 2, '.', '');  ?>
                            </td>
                        </tr>
                <?php
                    }
                } ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="border-left: 2px solid black; border-bottom: 2px solid black; text-align: center;">
                        <strong>Totales del Mes</strong>
                    </td>
                    <td id="resultado_afectas" style="border: 2px solid black; border-left: 2px solid black;">
                        <strong><?php echo '$' . number_format($afectas, 2, '.', ''); ?></strong>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong><?php echo '$' . number_format($ivaCF, 2, '.', ''); ?></strong>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong><?php echo '$' . number_format($ivaP, 2, '.', ''); ?></strong>
                    </td>
                    <td style="border: 2px solid black; border-left: 2px solid black;">
                        <strong><?php echo '$' . number_format($sumas, 2, '.', ''); ?></strong>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
    </body>

    </html>
<?php

    $HTML = ob_get_contents();
    $dompdf->loadHtml($HTML);
    $dompdf->set_paper('a4', 'landscape');
    $dompdf->render();
    ob_get_clean();
    $dompdf->stream("", array("Attachment" => false));
} else {
    echo 'NADA QUE MOSTRAR';
}
?>