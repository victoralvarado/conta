  <?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<?php require_once '../model/AYP.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de auspiciadores y patrocinadores</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/ayp.js"></script>
</head>
<body>
  <section class="vbox">
    <?php include("header.php"); ?> 
    <section>
      <section class="hbox stretch">

       <?php include("nav.php"); ?>  

       <div class="ex1">
        <section id="content" class="container-fluid">
          <section class="vbox">  

          <div>
            <div class="row">
              <div class="col-md-6" style="margin-top: 30px; margin-left: 20px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Auspiciadores y Patrocinadores</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de auspiciadores y patrocinadores</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaAYP">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoAYP" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Auspiciador y/o Patrocinador</th>
                <th>Logo</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objAYP= new AYP();
                 $data= $objAYP->getAllAYP();
                  if ($data!=false) {
                  	$raizRuta="https://www.mundobeneficios.cl/ferias/";
                    foreach ($data as $value) {
                      echo "<tr>
                          <td>".$value['nombre']."</td>
                          <td><img src='".$raizRuta.$value['ruta']."' width='140' height='140'></td>
                          <td>
                            <input type='button' class='btn-danger btn-sm eliminarAYP' id='".$value['id']."' value='Eliminar'>
                          </td>
                      </tr>";
                    }
                  }
               ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section></div>
      <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  

</body>
</html>
</html>

<!-- Modal de inserción de stand -->
<div class="modal fade modal" id="modalIngresoAYP" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Auspiciador y Patrocinador</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/AYPController.php" enctype="multipart/form-data">
                      <div class="row" id="infoAYP">
                          
                      	<div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="nomAYP" class="control-label">Nombre</label><br>            
                              <input type="text" name="nomAYP" id="nomAYP" placeholder="Nombre del auspiciador y/o patrocinador"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgAYP" class="control-label">Imagen</label>            
                              <input type="file" name="imgAYP" id="imgAYP" required>
                            </div>

                          </div>  

                      </div>
                           
                          

              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarAYP" name="agregarAYP">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>