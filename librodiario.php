<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once('model/Partida.php'); ?>

<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
</head>
<script>
$(document).ready(function() {
    var nFilas = $(".tabp tr").length;
    if (nFilas<=1) {
        $("#versionI").attr('disabled','disabled');
    } else{
        $("#versionI").removeAttr('disabled');
    }
});
</script>
<body>
    <section class="vbox">
        <?php include("header.php"); ?>
        <section>
            <section class="hbox stretch">

                <?php
                $activeProducto = "";
                $activeIva = "";
                $activeProveedor = "";
                $activeCompra = "";
                $activeLibro = "active";
                $activeVenta = "";
                $activeCliente = "";
                $activelc = "";
                $activev = "";
                $activevc = "";
                $activeiva = "";
                $activeControl = "";
                include("nav.php");
                ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                            <fieldset class="form-group">
                                    <legend class="w-auto">Libro Diario</legend>
                                <div class="form-group">
                                <form method="POST" action="">
                                    <label>Filtrar por Fecha</label>
                                    <?php $fechaActual = date('Y-m-d'); ?>
                                    <input name="fecha" id="fecha" type="date" class="form-control" max="<?php echo $fechaActual; ?>" value="<?php echo $fechaActual; ?>" required="true">
                                    <input type="submit" class="btn btn-info" value="Filtrar">
                                    </form>
                                </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                            <form method="POST" action="reportelibdiario.php" target="_blank">
                            <?php $fe=$fechaActual;
                                        if (isset($_POST['fecha'])) {
                                            $fe = $_POST['fecha'];
                                            echo '<P>Mostrando partidas de fecha: '.$fe.'</P>';
                                        } else {
                                            $fe = $fechaActual;
                                            echo '<P>Mostrando partidas de fecha: '.$fe.'</P>';
                                        } ?>
                                        <input name="fechap" id="fechap" type="hidden" class="form-control"  value="<?php echo $fe; ?>">
                                    <input type="submit" id="versionI" class="btn btn-success" value="Generar version Imprimible">
                            </form>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <span id="valcuenta" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered tabp">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Partida</th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Debe</th>
                                            <th scope="col">Haber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $objP = new Partida();
                                        $data = $objP->libroDiario($fe);
                                        if ($data) {
                                            foreach ($data as $value) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $value['fecha']; ?></td>
                                                    <td><?php echo $value['numero']; ?></td>
                                                    <td><?php echo $value['codigo']; ?></td>
                                                    <td><?php echo $value['nombre']; ?></td>
                                                    <td><?php if ($value['debe'] != 0.00) {
                                                            echo '$' . number_format($value['debe'], 2);
                                                        } ?></td>
                                                    <td><?php if ($value['haber'] != 0.00) {
                                                            echo '$' . number_format($value['haber'], 2);
                                                        } ?></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
                <aside class="bg-light lter b-l aside-md hide" id="notes">
                    <div class="wrapper">Notification</div>
                </aside>
            </section>
        </section>
    </section>
</body>

</html>