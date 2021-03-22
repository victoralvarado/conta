<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Rubro.php'; ?>
<?php require_once '../model/Tipoe.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de empresas</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/empresa.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Empresas</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de empresas</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaEmpresa">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoEmpresas" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Nombre</th>
                <th>Logo</th>
                <th>Banner</th>
                <th>Estado</th>
                <th>Rubro</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objEmp= new Empresa();
                 $data= $objEmp->getAllEmp();
                 $raizRuta="https://www.mundobeneficios.cl/ferias/";
                  if ($data!=false) {
                    foreach ($data as $value) {
                      if ($value['estado']==1) {
                        $estado="activado";
                      }
                      else
                      {
                        $estado="desactivado";
                      }
					  if($value['id']!=11)
					  {
						  echo "<tr>
                          <td>".$value['nombre']."</td>
                          <td><img src='".$raizRuta.$value['logo']."' width='40' height='20'></td>
                          <td><img src='".$raizRuta.$value['banner']."' width='20' height='40'></td>
                          <td>".$estado."</td>
                          <td>".$value['trubro']."-".$value['rubro']."</td>
                          <td>".$value['tipoe']."</td>
                          <td>
                            <input type='button' class='btn-success btn-sm editarEmp' id='".$value['id']."' value='Editar'>
                            <input type='button' class='btn-primary btn-sm clEmp' id='".$value['id']."' value='Cambiar logo'>
                            <input type='button' class='btn-primary btn-sm cbEmp' id='".$value['id']."' value='Cambiar banner'>
                            <input type='button' class='btn-danger btn-sm eliminarEmp' id='".$value['id']."' value='Desactivar'>
                            <input type='button' class='btn-success btn-sm reacEmp' id='".$value['id']."' value='Activar'>
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
        </section></div>
      <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  

</body>
</html>

<!-- Modal de inserción de empresas -->
<div class="modal fade modal" id="modalNuevaEmpresa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar empresa</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/EmpresaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoProducto">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreEmp" class="control-label">Nombre</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre de la empresa" name="nombreEmp" id="nombreEmp" required>
                                 </div>
                          </div>
                           <!--<div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="descripcionEmp" class="control-label">Descripción</label>            
                              <textarea id="descripcionEmp" name="descripcionEmp" rows="5" cols="34" placeholder="Límite de 180 caracteres" required></textarea>
                            </div>

                          </div>-->
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="logoEmp" class="control-label">Logo</label>            
                              <input type="file" name="logoEmp" id="logoEmp" style="height: 37px;" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="bannerEmp" class="control-label">Banner</label>            
                              <input type="file" name="bannerEmp" id="bannerEmp" style="height: 37px;">
                            </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="vidpinEmp" class="control-label">Video principal</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Enlace de YouTube" name="vidpinEmp" id="vidpinEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="webEmp" class="control-label">Página web</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Página web de la empresa" name="webEmp" id="webEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="emailEmp" class="control-label">Email</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="email" class="form-control requerido"  
                                            placeholder="Email de la empresa" name="emailEmp" id="emailEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="linkEmp" class="control-label">LinkedIn</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Perfil de LinkedIn de la empresa" name="linkEmp" id="linkEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="fbEmp" class="control-label">Facebook</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Facebook de la empresa" name="fbEmp" id="fbEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="igEmp" class="control-label">Instagram</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Instagram de la empresa" name="igEmp" id="igEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="waEmp" class="control-label">Whatsapp</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Whatsapp (Número de teléfono)" name="waEmp" id="waEmp">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="rubroEmp" class="control-label">Rubro</label>
                                     <br>
                          <select id="rubroEmp" name="rubroEmp" style="height: 34px;" required>
                                              <?php 
                                                $objRubro = new Rubro();
                                                $data= $objRubro->getAllRubro();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['tipo']."-".$value['rubro']."</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="tipoEmp" class="control-label">Tipo</label>
                                     <br>
                          <select id="tipoEmp" name="tipoEmp" style="height: 34px;" required>
                                              <?php 
                                                  $objTipoe = new Tipoe();
                                                  $data= $objTipoe->getAllTipoe();
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
                              <label for="descripcionEmp" class="control-label">Descripción</label>            
                              <textarea id="descripcionEmp" name="descripcionEmp" rows="6" cols="34" placeholder="Límite de 204 caracteres" required></textarea>
                            </div>

                          </div>

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarEmpresa" name="agregarEmpresa">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>



<!-- Modal de modificación de empresas -->
<div class="modal fade modal" id="modalEditEmpresa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar empresa</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/EmpresaController.php" enctype="multipart/form-data">
                      <div class="row" id="infoProducto">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreEmpEdit" class="control-label">Nombre</label>
                                     <input type="hidden" id="idEmpresa" name="idEmpresa">
                                     <input type="hidden" id="tipoeG" name="tipoeG">
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Nombre de la empresa" name="nombreEmpEdit" id="nombreEmpEdit" required>
                                 </div>
                          </div>
                           <!--<div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="descripcionEmpEdit" class="control-label">Descripción</label>            
                              <textarea id="descripcionEmpEdit" name="descripcionEmpEdit" rows="5" cols="34" placeholder="Límite de 180 caracteres" required></textarea>
                            </div>

                          </div>-->
                          <!--<div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="logoEmpEdit" class="control-label">Logo</label>            
                              <input type="file" name="logoEmpEdit" id="logoEmpEdit" required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="bannerEmpEdit" class="control-label">Banner</label>            
                              <input type="file" name="bannerEmpEdit" id="bannerEmpEdit">
                            </div>
                          </div>-->
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="vidpinEmpEdit" class="control-label">Video principal</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Enlace de YouTube" name="vidpinEmpEdit" id="vidpinEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="webEmpEdit" class="control-label">Página web</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Página web de la empresa" name="webEmpEdit" id="webEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="emailEmpEdit" class="control-label">Email</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="email" class="form-control requerido"  
                                            placeholder="Email de la empresa" name="emailEmpEdit" id="emailEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="linkEmpEdit" class="control-label">LinkedIn</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Perfil de LinkedIn de la empresa" name="linkEmpEdit" id="linkEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="fbEmpEdit" class="control-label">Facebook</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Facebook de la empresa" name="fbEmpEdit" id="fbEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="igEmpEdit" class="control-label">Instagram</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Instagram de la empresa" name="igEmpEdit" id="igEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="waEmpEdit" class="control-label">Whatsapp</label>
                                     <!--<input type="hidden" id="idEmpresa" name="idEmpresa">-->
                                     <input type="text" class="form-control requerido"  
                                            placeholder="Whatsapp (Número de teléfono)" name="waEmpEdit" id="waEmpEdit">
                                 </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="rubroEmpEdit" class="control-label">Rubro</label>
                                     <br>
                          <select id="rubroEmpEdit" name="rubroEmpEdit" style="height: 34px;"  required>
                                              <?php 
                                                $objRubro = new Rubro();
                                                $data= $objRubro->getAllRubro();
                                                if($data!=null)
                                                {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value["id"]."'>".$value['tipo']."-".$value['rubro']."</option>";
                                                  }
                                                }
                                               ?>
                        </select>
                        </div>
                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="tipoEmpEdit" class="control-label">Tipo</label>
                                     <br>
                          <select id="tipoEmpEdit" name="tipoEmpEdit" style="height: 34px;" required>
                                              <?php 
                                                  $objTipoe = new Tipoe();
                                                  $data= $objTipoe->getAllTipoe();
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
                              <label for="descripcionEmpEdit" class="control-label">Descripción</label>            
                              <textarea id="descripcionEmpEdit" name="descripcionEmpEdit" rows="6" cols="34" placeholder="Límite de 204 caracteres" required></textarea>
                            </div>

                          </div>

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="editEmpresa" name="editEmpresa">Editar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de actualizar logo -->
<div class="modal fade modal" id="modalActLogo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Actualizar logo</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/EmpresaController.php" enctype="multipart/form-data">
                      <div class="row" id="actLogo">
                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                                 <div class="form-group required">
                                     <center><label for="logoEmpEdit" class="control-label">Nuevo logo</label>
                                     <input type="hidden" id="idEmpresaCL" name="idEmpresaCL">            
                                     <input type="file" name="logoEmpEdit" id="logoEmpEdit" required></center>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modificarLogo" name="modificarLogo" >Actualizar logo</button>
                  </div>

              </div>  
              </form>    
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
            </div>
        </div> 
    </div>   
</div>

<!-- Modal de actualizar banner -->
<div class="modal fade modal" id="modalActBanner" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Actualizar banner</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/EmpresaController.php" enctype="multipart/form-data">
                      <div class="row" id="actBanner">
                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                                 <div class="form-group required">
                                     <center><label for="bannerEmpEdit" class="control-label">Nuevo banner</label>
                                     <input type="hidden" id="idEmpresaCB" name="idEmpresaCB">            
                                     <input type="file" name="bannerEmpEdit" id="bannerEmpEdit"></center>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modificarBanner" name="modificarBanner">Actualizar banner</button>
                  </div>

              </div>  
              </form>    
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
            </div>
        </div> 
    </div>   
</div>
