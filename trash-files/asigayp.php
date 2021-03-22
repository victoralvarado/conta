  <?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<?php require_once '../model/AYP.php'; ?>
<?php require_once '../model/AsigAYP.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de asignación auspiciadores y patrocinadores</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/asigayp.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Asignación de auspiciadores y patrocinadores</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Elige quienes auspiciarán y patrocinarán las ferias</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaAsigAYP">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoAsigAYP" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Auspiciador/Patrocinador</th>
                <th>Feria que patrocinará/auspiciará</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objAAYP= new AsigAYP();
                 $data= $objAAYP->getAllAsigAYP();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      echo "<tr>
                          <td>".$value['aop']."</td>
                          <td>".$value['feria']."</td>
                          <td>
                            <input type='button' class='btn-danger btn-sm eliminarAsigAYP' id='".$value['id']."' value='Eliminar'>
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
<div class="modal fade modal" id="modalIngresoAsigAYP" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Asignar Auspiciador y Patrocinador</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/AsigAYPController.php" enctype="multipart/form-data">
                      <div class="row" id="infoAsigAYP">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="aypEmp" class="control-label">Patrocinador/Auspiciador</label>
                                     <br>
                          <select id="aypEmp" name="aypEmp"  required>
                                              <?php 
                                                $objAYP = new AYP();
                                                $data= $objAYP->getAllAYP();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['nombre']."</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="aypFer" class="control-label">Feria a la que patrocinará/auspiciará</label>
                                     <br>
                          <select id="aypFer" name="aypFer"  required>
                                              <?php 
                                                $objFer = new Feria();
                                                $data= $objFer->getAllFeria();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['nombre']."</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>


                          </div>
                           
                          

              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarAsigAYP" name="agregarAsigAYP">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>