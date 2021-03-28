
    <!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Iniciar sesión</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo.png" class="m-r-sm">&nbsp;Iniciar sesión</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
                 
    </header>
    <style>
      .wall
      {
        background: url(images/wallpapertip_accounting-wallpaper_2451419.jpg) top left no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
    </style>
    <section>
      <section class="hbox stretch">

       <link rel="stylesheet" type="text/css" href="css/css.css">


        <section id="content" class="wall">
          <section class="vbox">        
              <div class="jumbotron boxlogin">
                  <center><h3><b>INGRESO SISTEMA CONTABILIDAD</b></h3></center> <br>
                  <form method="POST" action="#">
                    <div class="form-column col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="usuario" class="control-label">Nombre de usuario: </label>
                        <input class="form-control" type="text" name="user" id="user">
                        <label for="pass" class="control-label">Contraseña: </label>
                        <input class="form-control" type="password" name="pass" id="pass">
                      </div>
                    </div>
                    <br>
                    <div class="clearfix"></div>
                    <center>
                      <div class="form-column col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <input class="btn btn-info" type="submit" id="enviar" name="enviar" value="Iniciar">
                        </div>
                        <span id="resultado"></span>
                      </div>
                    </center>
                    <div class="clearfix"></div>
                    <center>
                      <div class="form-column col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <b><a href="registro.php">O si no tienes una cuenta registrate aquí</a></b>
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