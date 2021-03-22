<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Documento.php'; ?>
<?php require_once '../model/Empresa.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de documentos</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/doc.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Documentos</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de documentos</p>
              </div> 

              <!--<div class="col-md-6" style="margin-top: 30px; margin-left: 220px;">
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">USA LAS FLECHAS DE TU TECLADO ()</p>
              </div>-->

          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaDoc">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoDocs" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Documento</th>
                <th>Empresa</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                 $objDoc= new Documento();
                 $data= $objDoc->getAllDoc();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      echo "<tr>
                          <td><a target='_blank' href='https://www.mundobeneficios.cl/ferias/".$value['ruta']."'>".$value['docnom']."</a></td>
                          <td>".$value['nombre']."</td>
                          <td>
                            <input type='button' class='btn-danger btn-sm eliminarDoc' id='".$value['id']."' value='Eliminar'>
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
<div class="modal fade modal" id="modalIngresoDoc" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Documentos</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/DocumentoController.php" enctype="multipart/form-data">
                      <div class="row" id="infoDoc">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="docEmp" class="control-label">Documento</label>            
                              <input type="file" name="docEmp[]" id="docEmp" required multiple>
                            </div>

                          </div>
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="empDDoc" class="control-label">Empresa dueña del documento</label>
                                     <br>
                          <select id="empDDoc" name="empDDoc"  required>
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
                          

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarDoc" name="agregarDoc">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de inserción de producto -->
<!--<div class="modal fade modal" id="modalModFeria" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar feria Feria</span>
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
                          <select id="empOrgEdit" name="empOrgEdit"  required>
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
</div>-->