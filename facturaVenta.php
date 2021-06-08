<?php
if (isset($_GET['numfac'])) {
    require_once('model/Documento.php');
    $n =  $_GET['numfac'];
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
                $tipoF =""; 
                $objD = new Documento();
            $data =$objD->datosSerie($n);
            if ($data) {
                foreach ($data as $value) { 
                    if ($value['tipo']=='ccf') {
                        $tipoF = "Comprobante de Crédito Fiscal";
                    } elseif ($value['tipo']=='fcf') {
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
                <?php }} ?>
            </tr>
        </tbody>
    </table>
    <table style="border: none; width: 100%;">
        <tbody>
        <?php
        $condicion = ""; 
        $objD = new Documento();
            $data =$objD->datosCliente($n);
            if ($data) {
                foreach ($data as $value) {
                    if ($value['condiciones']==0) {
                        $condicion = "Contado";
                    } else {
                        $condicion = $value['condiciones'];
                    }
        ?>
            <tr>
                <td scope="col" colspan="2" rowspan="4">
                    <h6 style="text-align: left;"><strong>Nombre: </strong><?php echo '<font style="text-decoration:underline;">'.$value['nombre'].'</font>'; ?></h6>
                    <h6 style="text-align: left;"><strong>Dirección: </strong><?php echo '<font style="text-decoration:underline;">'.$value['direccion'].'</font>'; ?></h6>
                    <h6 style="text-align: left;"><strong>Condicion de pago: </strong><?php echo '<font style="text-decoration:underline;">'.$condicion.'</font>'; ?></h6>
                </td>
                <td scope="col" colspan="2" rowspan="4">
                    <h6 style="text-align: left;"><strong>Fecha: </strong><?php echo '<font style="text-decoration:underline;">'.substr($value['fecha'],0,10).'</font>'; ?></h6>
                    <h6 style="text-align: left;"><strong>Registro No: </strong><?php echo '<font style="text-decoration:underline;">'.$value['nrc'].'</font>'; ?></h6>
                    <h6 style="text-align: left;"><strong>NIT: </strong><?php echo '<font style="text-decoration:underline;">'.$value['nit'].'</font>'; ?></h6>
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
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="border-left: none; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Sumas</strong>
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>IVA 13%</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Subtotal</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Percepcion</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Retencion</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Ventas Exentas</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-left: 1px solid transparent; border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    <strong>Total a pagar</strong>
                </td>
                <td style="border-bottom: 1px solid transparent;">
                </td>
                <td style="border: 2px solid black; border-left: 2px solid black;">
                    0
                </td>

            </tr>
        </tfoot>
    </table>
</body>

</html>
<?php
$HTML = ob_get_contents();
$dompdf->loadHtml($HTML);
$dompdf->render();
ob_get_clean();
$dompdf->stream("", array("Attachment" => false));
} else {
    echo 'NO HAY DATOS';
}
?>