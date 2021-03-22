<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de ferias</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/moderador.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Moderadores</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de moderadores</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaModera">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoModera" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Username</th>
                <th>Whatsapp</th>
                <th>Feria</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 /*$objFer= new Feria();
                 $data= $objFer->getAllFeria();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      echo "<tr>
                          <td>".$value['nombre']."</td>
                          <td>".$value['Empresa_organizadora']."</td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarFer' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-danger btn-sm eliminarFer' id='".$value['id']."' value='Eliminar'>
                          </td>
                      </tr>";
                    }
                  }*/
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
<div class="modal fade modal" id="modalIngresoModera" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Moderador</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/UsuarioController.php" enctype="multipart/form-data">
                      <div class="row" id="infoFeria">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreUserM" class="control-label">Nombre de usuario</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre de usuario" name="nombreUserM" id="nombreUserM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="correoM" class="control-label">Correo</label>
                                     <input type="email" class="form-control requerido"  
                                            placeholder="Correo" name="correoM" id="correoM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="whaM" class="control-label">Whatsapp</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Whatsapp (número de teléfono)" name="whaM" id="whaM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="passM" class="control-label">Contraseña</label>
                                     <input type="password" class="form-control requerido"  
                                            placeholder="Contraseña" name="passM" id="passM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="repassM" class="control-label">Repetir contraseña</label>
                                     <input type="password" class="form-control requerido"  
                                            placeholder="Contraseña" name="repassM" id="repassM" required>
                                 </div>
                          </div>
                          
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nomM" class="control-label">Nombre</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre del moderador" name="nomM" id="nomM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="apeM" class="control-label">Apellido</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Apellido del moderador" name="apeM" id="apeM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="carM" class="control-label">Cargo</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Cargo del moderador" name="carM" id="carM" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="modEmp" class="control-label">Empresa a la que pertencece el moderador</label>
                                     <br>
                          <select id="modEmp" name="modEmp"  required>
                                              <?php 
                                                $objEmp = new Empresa();
                                                $data= $objEmp->getAllEmp();
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
                                     <label for="modFer" class="control-label">Feria en la que aparecerá el moderador</label>
                                     <br>
                          <select id="modFer" name="modFer"  required>
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
                           <!--<div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="empOrg" class="control-label">Empresa organizadora</label>
                                     <br>
                          <select id="empOrg" name="empOrg"  required>
                                              <?php 
                                                /*$objFer = new Feria();
                                                $data= $objFer->getEmpOrg();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['nombre']."</option>";
                                                  }
                                                }*/
                                               ?>
                        </select>
                        </div>
                          </div>-->
                          

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarFeria" name="agregarFeria">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>
