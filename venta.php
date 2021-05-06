<?php /*require_once '../app/validacionAdmin.php';*/ ?>
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
       $activeIva = "";
       $activeProveedor = "";
       $activeCompra = "";
       $activeVenta = "active";
       include("nav.php"); ?>  
        <div class="ex1">
           <section id="content" class="container-fluid">
          	<section class="vbox">         
             
		<!--ACÁ PONER EL CÓDIGO A USAR-->
 
        	</section>
        	    <aside class="bg-light lter b-l aside-md hide" id="notes">
          	       <div class="wrapper">Notification</div>
                    </aside>
            </section>
	</div>
    </section>
  </section>
</body>
</html>