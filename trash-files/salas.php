<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/VideoConferencia.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de sala de conferencias</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/vc.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Sala de conferencias</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de la sala de conferencias</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaVC">Nuevo video para conferencia</button>
                    <button class="btn btn-danger  btn-sm " style="margin-left: 5px;" id="chatVC">Borrar chat conferencia</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoVC" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Video</th>
                <th>Título</th>
                <th>Nombre expositor</th>
                <th>Cargo expositor</th>
                <th>Empresa</th>
                <th>Feria</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objVC= new VideoConferencia();
                 $data= $objVC->getAllVC();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      echo "<tr>
                          <td><iframe width='120' height='80' src='https://www.youtube.com/embed/".$value['url']."' frameborder='0' allowfullscreen></iframe></td>
                          <td>".$value['titulo']."</td>
                          <td>".$value['nomExposi']."</td>
                          <td>".$value['cargoExposi']."</td>
                          <td>".$value['empresa']."</td>
                          <td>".$value['nombre']."</td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarVC' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-danger btn-sm eliminarVC' id='".$value['id']."' value='Eliminar'>
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

<!-- Modal de inserción de producto -->
<div class="modal fade modal" id="modalIngresoVC" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Videos a la sala de conferencias</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/VideoConferenciaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoVC">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="vidVC" class="control-label">Video</label><br><br>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Enlace de YouTube" name="vidVC" id="vidVC" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="fechaVC" class="control-label">Título del video</label><br><br>
                                     <input type="text" class="form-control requerido"  name="fechaVC" id="fechaVC" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="horaVC" class="control-label">Nombre del expositor</label>
                                     <input type="text" class="form-control requerido"  name="horaVC" id="horaVC" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="minVC" class="control-label">Cargo del expositor</label>
                                     <input type="text" class="form-control requerido"  name="minVC" id="minVC" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="segVC" class="control-label">Empresa</label><br><br>
                                     <select id="segVC" name="segVC" class="form-control requerido" required>
                                              <?php 
                                                $objFer = new Empresa();
                                                $data= $objFer->getAllEmp();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["nombre"]."'>".$value['nombre']."</option>";
                                                  }
                                                }
                                               ?>
                                    </select>
                                 </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="ferVC" class="control-label">Feria a la que pertenece</label>
                                     <br>
                          <select id="ferVC" name="ferVC" class="form-control requerido" required>
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
                    <button class="btn btn-primary  btn-sm " id="agregarVC" name="agregarVC">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de inserción de producto -->
<div class="modal fade modal" id="modalModVC" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar Videos a la sala de conferencias</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/VideoConferenciaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoVCEdit">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="vidVCEdit" class="control-label">Video</label><br><br>
                                     <input type="hidden" id="idVCEdit" name="idVCEdit">
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Enlace de YouTube" name="vidVCEdit" id="vidVCEdit" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="fechaVCEdit" class="control-label">Título del video</label><br><br>
                                     <input type="text" class="form-control requerido"  name="fechaVCEdit" id="fechaVCEdit" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="horaVCEdit" class="control-label">Nombre del expositor</label>
                                     <input type="text" class="form-control requerido" name="horaVCEdit" id="horaVCEdit" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="minVCEdit" class="control-label">Cargo del expositor</label>
                                     <input type="text" class="form-control requerido"  name="minVCEdit" id="minVCEdit" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-2 col-sm-2 col-xs-2">
                          <div class="form-group required">
                                     <label for="segVCEdit" class="control-label">Empresa</label><br><br>
                                     <select id="segVCEdit" name="segVCEdit" class="form-control requerido" required>
                                              <?php 
                                                $objFer = new Empresa();
                                                $data= $objFer->getAllEmp();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["nombre"]."'>".$value['nombre']."</option>";
                                                  }
                                                }
                                               ?>
                                    </select>
                                 </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="ferVCEdit" class="control-label">Feria a la que pertenece</label>
                                     <br>
                          <select id="ferVCEdit" name="ferVCEdit" class="form-control requerido" required>
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
                    <button class="btn btn-primary  btn-sm " id="modificarVC" name="modificarVC">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de inserción de usuario -->
<div class="modal fade modal" id="modalDeleteChat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Eliminar chat conferencias</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/VideoConferenciaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoChatDel">
                          
                        <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="delChatFer" class="control-label">Feria a la que se borrará el chat</label>
                                     <br>
                          <select id="delChatFer" name="delChatFer" class="form-control requerido" required>
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
                    <button class="btn btn-danger  btn-sm " id="deleteChatVC" name="deleteChatVC">Eliminar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<script>
       function ceros(parte) {
           if(parte==1)
           {
               var minuteValue = document.getElementById("horaVC").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#horaVC").val(minuteValue);
           }
           else if(parte==2)
           {
               var minuteValue = document.getElementById("minVC").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#minVC").val(minuteValue);
           }
           else if(parte==3)
           {
               var minuteValue = document.getElementById("segVC").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#segVC").val(minuteValue);
           }
           else if(parte==4)
           {
               var minuteValue = document.getElementById("horaVCEdit").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#horaVCEdit").val(minuteValue);
           }
           else if(parte==5)
           {
               var minuteValue = document.getElementById("minVCEdit").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#minVCEdit").val(minuteValue);
           }
           else if(parte==6)
           {
               var minuteValue = document.getElementById("segVCEdit").value;
               if (minuteValue.length < 2) {
                   minuteValue = "0" + minuteValue;
               }
               $("#segVCEdit").val(minuteValue);
           }
       }
</script>
