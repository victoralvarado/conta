<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Mensaje.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de creación masivo de mensajes</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/mensaje.js"></script>
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
                        <p class="robo" style="font-weight: 300; margin-bottom: 0px; font-size: 30px;">Mensajes</p>
                        <p class="robo" style="font-weight: 300; font-size: 14px; height: 40px;">Gesti&oacute;n  de mensajes</p>
              </div> 


          <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 1px;">
            <div class="btn-group pull-right">
                <a href="#" class="admin-menu-navi">
                    <button class="btn btn-primary  btn-sm " style="margin-left: 5px;" id="nuevaMensa">Nuevo Texto</button>
                    <button class="btn btn-success  btn-sm " style="margin-left: 5px;" id="nuevaMensaImg">Nueva Imagen</button>
                 </a>
            </div>
        </div>

        <div class="clearfix"></div>   

              <div class="form-column col-md-11 col-sm-11 col-xs-11" style="margin-top: 10px;">
              <table id="listadoMensa" class="mdl-data-table" cellspacing="1" width="100%">
              <thead>
                <th>Título del mensaje</th>
                <th>Feria</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </thead>
              <tbody>
             <?php 
                $objMensa= new Mensaje();
                 $data= $objMensa->getAllMensaje();
                  if ($data!=false) {
                    foreach ($data as $value) {
                      $tipoMensa=substr($value['cuerpo'], 0, 3);
                      $size=strlen($value['cuerpo']);
                      $img=substr($value['cuerpo'], 4, $size);
                      if($tipoMensa=='img')
                      {
                          echo "<tr>
                            <td>".$value['titulo']."</td>
                            <td>".$value['nombre']."</td>
                            <td><a target='_blank' href='".$img."'><img src='".$img."' width='60' height='60'></a></td>
                            <td>
                              <input type='button' class='btn-danger btn-sm eliminarMensa' id='".$value['id']."' value='Eliminar'>
                            </td>
                        </tr>";
                      }
                      else
                      {
                          echo "<tr>
                            <td>".$value['titulo']."</td>
                            <td>".$value['nombre']."</td>
                            <td>Es mensaje de texto</td>
                            <td>
                              <input type='button' class='btn-success btn-sm editarMensa' id='".$value['id']."' value='Editar'>
                              <input type='button' class='btn-danger btn-sm eliminarMensa' id='".$value['id']."' value='Eliminar'>
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

<!-- Modal de inserción de mensaje -->
<div class="modal fade modal" id="modalIngresoMensa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Mensaje de texto</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/MensajeController.php" enctype="multipart/form-data">
                      <div class="row" id="infoMensaje">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="titMensa" class="control-label">Título del mensaje</label>            
                              <input type="text" name="titMensa" id="titMensa" placeholder="Título del mensaje"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="cuerpoMensa" class="control-label">Cuerpo del mensaje <b>(No usar enter/intro/salto de línea, esto rompe el búcle de envío masivo)</b></label>            
                              <textarea id="cuerpoMensa" name="cuerpoMensa" rows="8" cols="32" placeholder="No incluir saludo, este se agrega automáticamente al inicio del mensaje, Límite de 255 caracteres" required></textarea>
                            </div>

                          </div> 
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                              <div class="form-group required">
                                <label for="feriaMensa" class="control-label">Feria a la que pertenece el mensaje</label>
                                <br>
                                <select id="feriaMensa" name="feriaMensa" style="width: 220px; height: 28px;" required>
                                                    <?php 
                                                        $objFeria = new Feria();
                                                        $data= $objFeria->getAllFeria();
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
                    <button class="btn btn-primary  btn-sm " id="agregarMensaje" name="agregarMensaje">Guardar</button>
                    <input type='button' class='btn-success btn-sm' id='PSI' value='Palabras especiales'>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>

<!-- Modal de inserción de mensaje -->
<div class="modal fade modal" id="modalIngresoMensaImg" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Agregar Mensaje de imagen</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/MensajeController.php" enctype="multipart/form-data">
                      <div class="row" id="infoMensajeImg">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="titMensaImg" class="control-label">Título del mensaje</label>            
                              <input type="text" name="titMensaImg" id="titMensaImg" placeholder="Título del mensaje"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="fileImg" class="control-label">Imagen del mensaje</label>            
                              <input type="file" name="fileImg" id="fileImg" required>
                            </div>

                          </div> 
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                              <div class="form-group required">
                                <label for="feriaMensaImg" class="control-label">Feria a la que pertenece el mensaje</label>
                                <br>
                                <select id="feriaMensaImg" name="feriaMensaImg" style="width: 220px; height: 28px;" required>
                                                    <?php 
                                                        $objFeria = new Feria();
                                                        $data= $objFeria->getAllFeria();
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
                    <button class="btn btn-primary  btn-sm " id="agregarMensajeImg" name="agregarMensajeImg">Guardar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>


<!-- Modal de modificación de mensaje -->
<div class="modal fade modal" id="modalModMensa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar Mensaje de texto</span>
                </div>
                <div class="modal-body" >
                  <form method="POST" action="../controller/MensajeController.php" enctype="multipart/form-data">
                      <div class="row" id="infoMensaje">
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="titMensaEdit" class="control-label">Título del mensaje</label> 
                              <input type="hidden" id="idMensajeEdit" name="idMensajeEdit">            
                              <input type="text" name="titMensaEdit" id="titMensaEdit" placeholder="Título del mensaje"  required>
                            </div>

                          </div>
                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="cuerpoMensaEdit" class="control-label">Cuerpo del mensaje <b>(No usar enter/intro/salto de línea, esto rompe el búcle de envío masivo)</b></label>            
                              <textarea id="cuerpoMensaEdit" name="cuerpoMensaEdit" rows="8" cols="32" placeholder="No incluir saludo, este se agrega automáticamente al inicio del mensaje, Límite de 255 caracteres" required></textarea>
                            </div>

                          </div> 
                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                              <div class="form-group required">
                                <label for="feriaMensaEdit" class="control-label">Feria a la que pertenece el mensaje</label>
                                <br>
                                <select id="feriaMensaEdit" name="feriaMensaEdit" style="width: 220px; height: 28px;" required>
                                                    <?php 
                                                        $objFeria = new Feria();
                                                        $data= $objFeria->getAllFeria();
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
                    <button class="btn btn-primary  btn-sm " id="modificarMensaje" name="modificarMensaje">Guardar</button>
                    <input type='button' class='btn-success btn-sm' id='PSM' value='Palabras especiales'>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
               </form>
            </div>
        </div> 
    </div>   
</div>

<script type="text/javascript">
  $(document).on("click","#PSI",function(){
    alert("Palabras especiales (Solo se usan en el cuerpo del mensaje)\n\n [NOMUSER]=Se reemplaza por el nombre del usuario cuando se envía el mensaje.\n\n[NOMFER]=Se reemplaza por el nombre de la feria cuando se envía el mensaje.\n\n[URL]=Se reemplaza por el link de acceso único al sistema del usuario cuando se envía el mensaje.\n\n**(palabra entre asteriscos)=La palabras que estén en medio de los asteriscos se enviaran en negrita. ej: *Hola como estas* (para que funcione el primer asterisco tiene que estar pegado a la primera palabra ej: *Hola, y el segundo asterisco tiene que estar pegado a la última palabra, ej: estas*).");
  });

  $(document).on("click","#PSM",function(){
    alert("Palabras especiales (Solo se usan en el cuerpo del mensaje)\n\n [NOMUSER]=Se reemplaza por el nombre del usuario cuando se envía el mensaje.\n\n[NOMFER]=Se reemplaza por el nombre de la feria cuando se envía el mensaje.\n\n[URL]=Se reemplaza por el link de acceso único al sistema del usuario cuando se envía el mensaje.\n\n**(palabra entre asteriscos)=La palabras que estén en medio de los asteriscos se enviaran en negrita. ej: *Hola como estas* (para que funcione el primer asterisco tiene que estar pegado a la primera palabra ej: *Hola, y el segundo asterisco tiene que estar pegado a la última palabra, ej: estas*).");
  });
</script>