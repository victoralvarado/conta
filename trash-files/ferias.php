<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<?php require_once '../model/FondoInformacion.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de ferias</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/feria.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Ferias</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de ferias</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaFeria">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoFerias" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Nombre de la feria</th>
                <th>Empresa organizadora</th>
                <th>Programa feria</th>
                <th>Imagen portada</th>
                <th>Imagen esquina</th>
                <th>Imagen costado 1</th>
                <th>Imagen costado 2</th>
                <th>Imagen costado 3</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objFer= new Feria();
                 $data= $objFer->getAllFeria();
                 $raizRuta="https://www.mundobeneficios.cl/ferias/";
                  if ($data!=false) {
                    foreach ($data as $value) {
                      if($value['id']!=13)
                      {
                        echo "<tr>
                          <td>".$value['nombre']."</td>
                          <td>".$value['Empresa_organizadora']."</td>
                          <td><a target='_blank' href='https://www.mundobeneficios.cl/ferias/".$value['programaFeria']."'>Programa ".$value['Empresa_organizadora']."</a></td>
                          <td><img src='".$raizRuta.$value['imgPortada']."' width='120' height='30'></td>
                          <td><img src='".$raizRuta.$value['imgEsquina']."' width='60' height='60'></td>
                          <td><img src='".$raizRuta.$value['imgCostado1']."' width='60' height='60'></td>
                          <td><img src='".$raizRuta.$value['imgCostado2']."' width='60' height='60'></td>
                          <td><img src='".$raizRuta.$value['imgCostado3']."' width='60' height='60'></td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarFer' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-primary btn-sm actFer' id='".$value['id']."' value='Actualizar imágenes'>
                            <input type='button' class='btn-primary btn-sm actProg' id='".$value['id']."' value='Cambiar programa'>
                            <input type='button' class='btn-danger btn-sm eliminarFer' id='".$value['id']."' value='Eliminar'>
                          </td>
                      </tr>";
                      }                      
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
<div class="modal fade modal" id="modalIngresoFeria" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Feria</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/FeriaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoFeria">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreFeria" class="control-label">Nombre de la feria</label>
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre de la feria" name="nombreFeria" id="nombreFeria" required>
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgPort" class="control-label">Imagen portada</label>            
                              <input type="file" name="imgPort" id="imgPort" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgEsq" class="control-label">Imagen esquina</label>            
                              <input type="file" name="imgEsq" id="imgEsq">
                            </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgCost1" class="control-label">Imagen costado 1</label>            
                              <input type="file" name="imgCost1" id="imgCost1" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgCost2" class="control-label">Imagen costado 2</label>            
                              <input type="file" name="imgCost2" id="imgCost2">
                            </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgCost3" class="control-label">Imagen costado 3</label>            
                              <input type="file" name="imgCost3" id="imgCost3">
                            </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="empOrg" class="control-label">Empresa organizadora</label>
                                     <br>
                          <select id="empOrg" name="empOrg"  required>
                                              <?php 
                                                $objFer = new Feria();
                                                $data= $objFer->getEmpOrg();
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
                                     <label for="colInf" class="control-label">Color de información</label>
                                     <br>
                          <select id="colInf" name="colInf"  required>
                                              <?php 
                                                $objFI = new FondoInformacion();
                                                $data= $objFI->getAllFondoI();
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

                          <div class="form-column col-md-4 col-sm-4 col-xs-4" >
                            <div class="form-group required">
                              <label for="progFeria" class="control-label">Programa feria</label>            
                              <input type="file" name="progFeria" id="progFeria" required>
                            </div>

                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="fi" class="control-label">Fecha inicio</label><br>            
                              <input type="date" name="fi" id="fi" required>
                            </div>

                          </div>

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarFeria" name="agregarFeria">Guardar</button>
                    <a target="_blank" href="img-help.png" class="btn btn-success  btn-sm ">Ayuda</a>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de modificación feria-->
<div class="modal fade modal" id="modalModFeria" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar Feria</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/FeriaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoFeriaEdit">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreFeriaEdit" class="control-label">Nombre de la feria</label>
                                     <input type="hidden" id="idFeriaEdit" name="idFeriaEdit"> 
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre de la feria" name="nombreFeriaEdit" id="nombreFeriaEdit" required>
                                 </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="empOrgEdit" class="control-label">Empresa organizadora</label>
                                     <br>
                          <select id="empOrgEdit" name="empOrgEdit" style="height: 34px;"  required>
                                              <?php 
                                                $objFer = new Feria();
                                                $data= $objFer->getEmpOrg();
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
                                     <label for="colInfEdit" class="control-label">Color de información</label>
                                     <br>
                          <select id="colInfEdit" name="colInfEdit" style="height: 34px;"  required>
                                              <?php 
                                                $objFI = new FondoInformacion();
                                                $data= $objFI->getAllFondoI();
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
                              <label for="fiEdit" class="control-label">Fecha inicio</label><br>            
                              <input type="date" name="fiEdit" id="fiEdit" required>
                            </div>

                          </div>

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modFeria" name="modFeria">Modificar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>

<!-- Modal de modificar de feria -->
<div class="modal fade modal" id="modalModImg" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Actualizar Imágenes</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/FeriaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoImgEdit">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <input type="hidden" id="idImgEdit" name="idImgEdit"> 
                                     <label for="imgEdit" class="control-label">Imagen que se actualizará</label>
                                     <br>
                                    <select id="imgEdit" name="imgEdit"  required>
                                        <option value="1">Imagen portada</option>
                                        <option value="2">Imagen esquina</option> 
                                        <option value="3">Imagen costado 1</option> 
                                        <option value="4">Imagen costado 2</option> 
                                        <option value="5">Imagen costado 3</option>                 
                                    </select>
                                 </div>
                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                             <label for="imgAct" class="control-label">Imagen</label>            
                              <input type="file" name="imgAct" id="imgAct" required>        
                        </div>
                          </div>
                          

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modImg" name="modImg">Actualizar</button>
                    <a target="_blank" href="img-help.png" class="btn btn-success  btn-sm ">Ayuda</a>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de inserción de producto -->
<div class="modal fade modal" id="modalModProg" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Cambiar Programa Feria</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/FeriaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoProgEdit">

                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                            <input type="hidden" id="idProgEdit" name="idProgEdit"> 
                             <label for="progFeriaEdit" class="control-label">Nuevo programa de la feria</label>            
                              <input type="file" name="progFeriaEdit" id="progFeriaEdit" required>        
                        </div>
                          </div>
                          

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modProg" name="modProg">Actualizar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>