<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Pabellon.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<?php require_once '../model/Stand.php'; ?>
<?php require_once '../model/MonoStand.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de stand</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/stand.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Stand</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de stand</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaStand">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoStand" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Empresa</th>
                <th>Pabellón</th>
                <th>Tipo de stand</th>
                <th>Color del stand</th>
                <th>Mono del stand</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objSta= new Stand();
                 $data= $objSta->getAllStand();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      /*if ($value['estado']==1) {
                        $estado="activado";
                      }
                      else
                      {
                        $estado="desactivado";
                      }*/
                      if($value['tipoStand']==1)
                      {
                        $ts="Normal";
                      }
                      else
                      {
                        $ts="Premium";
                      }
                      echo "<tr>
                          <td>".$value['empresa']."</td>
                          <td>".$value['pabellon']." (".$value['nombre'].")</td>
                          <td>".$ts."</td>
                          <td>".$value['color']."</td>
                          <td>".$value['mono']."</td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarSta' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-danger btn-sm eliminarSta' id='".$value['id']."' value='Eliminar'>
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
<div class="modal fade modal" id="modalIngresoStand" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Stand</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/StandController.php" enctype="multipart/form-data">
                      <div class="row" id="infoStand">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="staEmp" class="control-label">Empresa dueña del stand</label>
                                     <br>
                          <select id="staEmp" name="staEmp"  required>
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

                          <div class="form-column col-md-8 col-sm-8 col-xs-8">
                          <div class="form-group required">
                                     <label for="staPab" class="control-label">Pabellón donde estará el stand</label>
                                     <br>
                          <select id="staPab" name="staPab"  required>
                                              <?php 
                                                $objSta = new Stand();
                                                $data= $objSta->getAllPINS();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['nombrePabellon']." (".$value['nombre'].")</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="colSta" class="control-label">Color del Stand</label>
                                     <br>
                          <select id="colSta" name="colSta"  required>
                                              <?php 
                                                $objSta = new Stand();
                                                $data= $objSta->getAllFS();
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
                                     <label for="monoSta" class="control-label">Mono del Stand</label>
                                     <br>
                          <select id="monoSta" name="monoSta"  required>
                                              <?php 
                                                $objMono = new MonoStand();
                                                $data= $objMono->getAllMono();
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
                                     <label for="staTipo" class="control-label">Tipo de stand</label>
                                     <br>
                          <select id="staTipo" name="staTipo"  required>
                              <option value='1'>Normal</option>
                              <option value='2'>Premium</option>;
                        </select>
                        </div>
                          </div>

                          </div>
                           
                          

              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarStand" name="agregarStand">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>

<!-- Modal de modificación de stand -->
<div class="modal fade modal" id="modalEditStand" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Editar Stand</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/StandController.php" enctype="multipart/form-data">
                      <div class="row" id="infoStandEdit">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                      <input type="hidden" id="idStandEdit" name="idStandEdit"> 
                                     <label for="staEmpEdit" class="control-label">Empresa dueña del stand</label>
                                     <br>
                          <select id="staEmpEdit" name="staEmpEdit"  required>
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

                          <div class="form-column col-md-8 col-sm-8 col-xs-8">
                          <div class="form-group required">
                                     <label for="staPabEdit" class="control-label">Pabellón donde estará el stand</label>
                                     <br>
                          <select id="staPabEdit" name="staPabEdit"  required>
                                              <?php 
                                                $objSta = new Stand();
                                                $data= $objSta->getAllPINS();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['nombrePabellon']." (".$value['nombre'].")</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="colStaEdit" class="control-label">Color del Stand</label>
                                     <br>
                          <select id="colStaEdit" name="colStaEdit"  required>
                                              <?php 
                                                $objSta = new Stand();
                                                $data= $objSta->getAllFS();
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
                                     <label for="monoStaEdit" class="control-label">Mono del Stand</label>
                                     <br>
                          <select id="monoStaEdit" name="monoStaEdit"  required>
                                              <?php 
                                                $objMono = new MonoStand();
                                                $data= $objMono->getAllMono();
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
                                     <label for="staTipoEdit" class="control-label">Tipo de stand</label>
                                     <br>
                          <select id="staTipoEdit" name="staTipoEdit"  required>
                              <option value='1'>Normal</option>
                              <option value='2'>Premium</option>
                        </select>
                        </div>
                          </div>

                          </div>
                           
                          

              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="editStand" name="editStand">Editar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>