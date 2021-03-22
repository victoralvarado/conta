<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Feria.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de envio masivo de mensajes</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
</head>
<style>
      .wall
      {
        background: url(images/thumb-1920-668083.jpg) top left no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
</style>
<body>
  <section class="vbox">
    <?php include("header.php"); ?> 
    <section>
      <section class="hbox stretch">

       <?php include("nav.php"); ?>  

       <link rel="stylesheet" type="text/css" href="css/css.css">

        <section id="content" class="wall">
          <section class="vbox">         
              
            <div class="jumbotron boxlogin">
                  <center><h3><b>ENVÍO MASIVO DE MENSAJES</b></h3></center> <br>
                  <form method="GET" action="../api_feria/registro/auxBot.php">
                    <div class="form-column col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="ferEMM" class="control-label">Selecciona la feria a la que enviarás masivamente los mensajes a los usuarios: </label>
                        <select id="ferEMM" name="ferEMM" style="width: 220px; height: 28px;" required>
                        <?php 
                          $objFer = new Feria();
                          $data= $objFer->getAllFeria();
                          if($data!=null)
                          {
                            foreach ($data as $value) {
                              if($value["id"]!=13)
                              {
                                echo "<option value='".$value["id"]."'>".$value['nombre']."</option>";
                              }
                              else
                              {

                              }
                            }
                          }
                         ?>
                        </select>
                        <!--<label for="pass" class="control-label">Contraseña: </label>
                        <input class="form-control" type="password" name="pass" id="pass">-->
                        <label for="menEMM" class="control-label">Selecciona el mensaje a enviar (los mensajes cambiarán dependiendo de la feria seleccionada): </label>
                        <select id="menEMM" name="menEMM" style="width: 220px; height: 28px;" required>
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="clearfix"></div>
                    <center>
                      <div class="form-column col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <input class="btn btn-info" type="submit" id="enviarMensaje" name="enviarMensaje" value="Enviar">
                        </div>
                        <span id="resultado"></span>
                      </div>
                    </center>
                  </form>
            </div>

          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    var idFeria = $("#ferEMM option:selected").val();
    cargarMensajes(idFeria);
  });

  $(document).on("click","#enviarMensaje",function(){
    swal({
          title: "¡Exito!",
          text: "Mensajes enviados a todos los números registrados en esta feria.",
          timer: 3000,
          type: 'success',
          closeOnConfirm: true,
          closeOnCancel: true,
          allowOutsideClick: false
      });
  });

  $("#ferEMM").on("change",function(){
    var idFeria = $("#ferEMM option:selected").val();
    cargarMensajes(idFeria);
  });

  function cargarMensajes(idFeria)
  {
    $.ajax({
      type: 'POST',
      async: false,
      dataType: 'json',
      data: {key: 'cargarMensajes', idFeria:idFeria},
      url: '../controller/MensajeController.php',
      success: function(res)
      {
        if(res.estado!=false)
        {
          $("#menEMM").empty();
          $("#menEMM").append(res.option);
        }
        else
        {
          $("#menEMM").empty();
          $("#menEMM").append(res.option);
        }
      },
      error: function(xhr, status)
      {
          console.log('error :c');
      }
    });
  }
</script>