<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Pabellon.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de pabellones</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/pabellon.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Pabellones</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de pabellones</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaPabellon">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoPabellones" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Núm. de pabellón</th>
                <th>Nombre de pabellón</th>
                <th>Espacios normales</th>
                <th>Espacios premium</th>
                <th>Tel. informante</th>
                <th>Tipo pabellón</th>
                <th>Feria</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objPab= new Pabellon();
                 $data= $objPab->getAllPabellon();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      if($value['tipoPabellon']==1)
                      {
                        $tipoPab="Principal";
                      }
                      else
                      {
                        $tipoPab="Secundario";
                      }
                      echo "<tr>
                          <td>".$value['numeroPabellon']."</td>
                          <td>".$value['nombrePabellon']."</td>
                          <td>".$value['espaciosNormal']."</td>
                          <td>".$value['espaciosPremium']."</td>
                          <td>".$value['numeroInformante']."</td>
                          <td>".$tipoPab."</td>
                          <td>".$value['nombre']."</td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarPab' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-danger btn-sm eliminarPab' id='".$value['id']."' value='Eliminar'>
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

<!-- Modal de inserción de producto -->
<div class="modal fade modal" id="modalIngresoPabellon" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Pabellón</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/PabellonController.php" enctype="multipart/form-data">
                      <div class="row" id="infoPabellon">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="numPab" class="control-label">Número pabellón</label> 
                              <br>           
                              <input type="number" name="numPab" id="numPab" min="1" max="999999" value="1" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="nomPab" class="control-label">Nombre pabellón</label>            
                              <input type="text" name="nomPab" id="nomPab" placeholder="Nombre del pabellón"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="espNom" class="control-label">Espacios normales</label> 
                              <br>           
                              <input type="number" name="espNom" id="espNom" min="1" max="12" value="1" onKeyDown="return false" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="espPri" class="control-label">Espacios premium</label> 
                              <br>           
                              <input type="number" name="espPri" id="espPri" min="1" max="2" value="1" onKeyDown="return false" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="numInfor" class="control-label">Número de teléfono del informante</label> 
                              <br>           
                              <input type="text" name="numInfor" id="numInfor" placeholder="Ingrese número de 8 dígitos" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="prioPab" class="control-label">Tipo de pabellón</label>
                                     <br>
                          <select id="prioPab" name="prioPab" style="height: 30px;" required>
                              <option value='1'>Principal</option>
                              <option value='2'>Secundario</option>
                        </select>
                        </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="pabFer" class="control-label">Feria a la que pertenece el pabellón</label>
                                     <br>
                          <select id="pabFer" name="pabFer"  required>
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
                    <button class="btn btn-primary  btn-sm " id="agregarPabellon" name="agregarPabellon">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>

<!-- Modal de inserción de producto -->
<div class="modal fade modal" id="modalEditPabellon" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Editar Pabellón</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/PabellonController.php" enctype="multipart/form-data">
                      <div class="row" id="infoPabellon">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="numPabEdit" class="control-label">Número pabellón</label>
                              <input type="hidden" id="idPabellonEdit" name="idPabellonEdit"> 
                              <br>           
                              <input type="number" name="numPabEdit" id="numPabEdit" min="1" max="999999" value="1" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="nomPabEdit" class="control-label">Nombre pabellón</label>            
                              <input type="text" name="nomPabEdit" id="nomPabEdit"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="espNomEdit" class="control-label">Espacios normales</label> 
                              <br>           
                              <input type="number" name="espNomEdit" id="espNomEdit" min="1" max="12" value="1" onKeyDown="return false" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="espPriEdit" class="control-label">Espacios premium</label> 
                              <br>           
                              <input type="number" name="espPriEdit" id="espPriEdit" min="1" max="2" value="1" onKeyDown="return false" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="numInforEdit" class="control-label">Número de teléfono del informante</label> 
                              <br>           
                              <input type="text" name="numInforEdit" id="numInforEdit" placeholder="Ingrese número de 8 dígitos" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="prioPabEdit" class="control-label">Tipo de pabellón</label>
                                     <br>
                          <select id="prioPabEdit" name="prioPabEdit" style="height: 30px;" required>
                              <option value='1'>Principal</option>
                              <option value='2'>Secundario</option>
                        </select>
                        </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="pabFerEdit" class="control-label">Feria a la que pertenece el pabellón</label>
                                     <br>
                          <select id="pabFerEdit" name="pabFerEdit"  required>
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
                    <button class="btn btn-primary  btn-sm " id="editPabellon" name="editPabellon">Editar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>