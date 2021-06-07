<?php 
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
                        <h5 style="text-align: center;">Mes: 05/21</h5>
                    </div>
                </td>
                <td rowspan="4" style="vertical-align: middle;">
                    <div>
                        <h5 style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                    </div>
                </td>
                <td scope="col" colspan="2" rowspan="4" style="text-align: end;">
                    <h5 style="text-align: center;"><strong>Empresa de Ejemplo S.A de C.V</strong></h5>
                    <h5 style="text-align: center;">Desarrolo de Software, Seguridad Informatica y Tecnologias de la Información</h5>
                    <h5 style="text-align: center;">Departamento de San Salvador, El Salvador, Centroamerica</h5>

                    <h5 style="text-align: center;">Registro No:100001-1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:0101-010150-101-1</h5>


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
            <tr>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
                <td style="border: black 2px solid;">
                    -
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="border-left: 2px solid black; border-bottom: 2px solid black; text-align: center;">
                    <strong>Totales del Mes</strong>
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="row justify-content-center justify-content-md-center">
        <div class="col-md-6">
            <table class="" style="width: 60%; margin-left: auto;margin-right: auto; " cellspacing="5" cellpadding="5">
                <tbody>
                    <tr">
                        <th style="border: black 2px solid;">
                            Ventas Internas Exentas
                        </th>
                        <td style="border: black 2px solid;">
                            $0
                        </td>
                    </tr>
                    <tr>
                        <th style="border: black 2px solid;">
                            Ventas Internas Gravadas
                        </th>
                        <td style="border: black 2px solid;">
                            $0
                        </td>
                    </tr>
                    <tr>
                        <th style="border: black 2px solid;">
                            Debito Fiscal
                        </th>
                        <td style="border: black 2px solid;">
                            $0
                        </td>
                    </tr>
                    <tr>
                        <th style="border: black 2px solid;">
                            Exportacion
                        </th>
                        <td style="border: black 2px solid;">
                            $0
                        </td>
                    </tr>
                    <tr>
                        <th style="border: black 2px solid;">
                            TOTAL
                        </th>
                        <td style="border: black 2px solid;">
                            $0
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
$dompdf->set_paper ('a4','landscape');
$dompdf->render();
ob_get_clean();
$dompdf->stream("", array("Attachment" => false));
?>