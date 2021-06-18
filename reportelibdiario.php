<?php
if (isset($_POST['fechap'])) {
    $fechap = $_POST['fechap'];

    require_once('model/Partida.php');
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
        <title>Partida</title>
    </head>

    <body>
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center;"><strong>Libro Diario</strong></h5>
                <hr>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <h5 style="text-align: center;"><strong>Empresa de Ejemplo S.A de C.V</strong></h5>
                        <h6 style="text-align: center;"><strong>Registro No:100001-1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIT:0101-010150-101-1</strong></h6>
                        <hr>
        </div>
        </div>
        <?php
        $objPs = new Partida();
                $datas = $objPs->partidas($fechap);
                if ($datas) {
                    foreach ($datas as $values) { 
                        ?>
                    <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center;"><strong>Partida # <?php echo $values['numpartida']; ?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $values['fepartida']; ?></strong></h5>
            </div>
        </div>
        <table class="table" style="width: 100%;" cellspacing="10">
            <thead class="thead-dark" style="display: table-header-group;
    vertical-align: middle;
    border-color: inherit;">
                <tr>
                    <th style="border: black 2px solid;">Codigo</th>
                    <th style="border: black 2px solid;">Cuenta</th>
                    <th style="border: black 2px solid;">Debe</th>
                    <th style="border: black 2px solid;">Haber</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $debe =0;
            $haber=0;  
            $objP = new Partida();
                $data = $objP->libroDiarioR($values['numpartida'],$values['fepartida']);
                if ($data) {
                    foreach ($data as $value) { 
                        $debe += floatval($value['debe']);
                        $haber += floatval($value['haber']);
                        ?>
                <tr>
                <td style="border: 2px solid black; border-left: 2px solid black;"><?php echo $value['codigo'];?></td>
                <td style="border: 2px solid black; border-left: 2px solid black;"><?php echo $value['nombre'];?></td>
                <td style="border: 2px solid black; border-left: 2px solid black;"><?php if ($value['debe'] != 0.00) {echo '$' . number_format(floatval($value['debe']),2);}?></td>
                <td style="border: 2px solid black; border-left: 2px solid black;"><?php if ($value['haber'] != 0.00) {echo '$' . number_format(floatval($value['haber']),2);}?></td>
                </tr>
                <?php }} ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" style="border: 2px solid black; border-left: 2px solid black; text-align: center;">SUMAS</th>
                    <th style="border: 2px solid black; border-left: 2px solid black;"><?php echo '$' . number_format($debe, 2); ?></th>
                    <th style="border: 2px solid black; border-left: 2px solid black;"><?php echo '$' . number_format($haber, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        <br><br>
        <?php }} ?>
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
                        echo '<h1>NO HAY DATOS</h1>';
                    }
?>