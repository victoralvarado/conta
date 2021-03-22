<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/FondoStand.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de fondos del stand</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/fs.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Fondo de stand</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de fondos para el stand</p>
              </div> 


          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaFS">Nuevo</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoFS" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Color</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                $objFS= new FondoStand();
                 $data= $objFS->getAllFondoS();
                  if ($data!=false) {
                    $raizRuta="https://www.mundobeneficios.cl/ferias/";
                    foreach ($data as $value) {
                      echo "<tr>
                          <td>".$value['nombre']."</td>
                          <td><img src='".$raizRuta.$value['ruta']."' width='180' height='90'></td>
                          <td>
                            <input type='button' class='btn-danger btn-sm eliminarFS' id='".$value['id']."' value='Eliminar'>
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
<div class="modal fade modal" id="modalIngresoFS" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Fondo Stand</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/FondoSController.php" enctype="multipart/form-data">
                      <div class="row" id="infoFS">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="nomColorFS" class="control-label">Nombre del color</label>            
                              <input type="text" name="nomColorFS" id="nomColorFS" placeholder="Nombre del color, ej: Naranja, azul, etc."  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="imgFS" class="control-label">Imagen</label>            
                              <input type="file" name="imgFS" id="imgFS" required>
                            </div>

                          </div>                               

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="agregarFS" name="agregarFS">Guardar</button>
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