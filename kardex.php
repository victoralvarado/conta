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
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh5U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Kardex</title>
    </head>

    <body>
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
        <table style="width: 100%;" cellspacing="10">
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
                                        echo '$' . number_format($value['costo'], 2);
                                    }
                                } ?>
                            </td>
                            <td style="border: black 2px solid;">
                                <?php if ($n > 1) {
                                    if ($tipo == 'Venta') {
                                        echo '$' . number_format($value['cantidad'] * $value['costo'], 2);
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
                                        echo '$' . number_format((($value['ultimo_costo']) + ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] + $value['cantidad']), 2);
                                    } else {
                                        echo '$' . number_format((($value['ultimo_costo']) - ($value['cantidad'] * $value['costo'])) / ($value['ultima_existencia'] - $value['cantidad']), 2);
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

                                        echo '$' . number_format(($value['ultimo_costo']) + ($value['cantidad'] * $value['costo']), 2);
                                    } else {
                                        echo '$' . number_format(($value['ultimo_costo']) - ($value['cantidad'] * $value['costo']), 2);
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