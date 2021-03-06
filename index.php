<?php require_once 'app/validacionGeneral.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
  <meta charset="utf-8" />
  <title>Sistema contabilidad</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <?php include("referencias.php"); ?>
</head>

<body>
  <section class="vbox">
    <?php include("header.php"); ?>
    <section>
      <section class="hbox stretch">

        <?php
        $activeProducto = "";
        $activeIva = "active";
        $activeProveedor = "";
        $activeCompra = "";
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
            <section class="vbox">
              <h1><b>
                  <center>¬°BIENVENIDO <?php echo $_SESSION['NOMBRE'] ?>!</center>
                </b></h1>
              <h4>
                <center>
                  La fecha y hora de hoy es: <?php $fecha = date("d/m/Y h:i a", strtotime("now"));
                                              echo $fecha; ?>
                </center>
              </h4>
              <br>
              <center><img src="images/clasificacion-contabilidad.jpg" width="640" height="480"></center>
              <h5>
                <center>Mensaje de bienvenida.</center>
              </h5>
            </section>
            <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
          </section>
          <aside class="bg-light lter b-l aside-md hide" id="notes">
            <div class="wrapper">Notification</div>
          </aside>
        </div>
      </section>
    </section>
  </section>
</body>

</html>