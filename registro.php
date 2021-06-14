<!DOCTYPE html>
<html lang="en" class="app">

<head>
  <meta charset="utf-8" />
  <title>Registro</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <?php include("referencias.php"); ?>
  <script type="text/javascript" src="resources/usuario.js"></script>
</head>

<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo.png" class="m-r-sm">&nbsp;Registro</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>

    </header>
    <style>
      .wall {
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

            <!-------------------------------------------------FORMULARIO------------------------------------------------------------------->

            <br><br>
            <center>
              <section class="panel panel-default" style="width: 800px;">
                <header class="panel-heading font-bold">
                  Formulario de registro
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="controller/usuarioController.php">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre completo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control rounded" id="nombre" name="nombre" required>
                      </div>
                    </div>

                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre de usuario (Username)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control rounded" id="user" name="user" required>
                      </div>
                    </div>

                    <!--<div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">With help</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control">
                        <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-id-1">Label focus</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-id-1">
                      </div>
                    </div>-->
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="pass" name="pass" required>
                      </div>
                    </div>

                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Repetir contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="repass" name="repass" required>
                      </div>
                    </div>
                    <!--<div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Placeholder</label>
                      <div class="col-sm-10">
                        <input type="text"  class="form-control" placeholder="placeholder">
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Disabled</label>
                      <div class="col-lg-10">
                        <input class="form-control" type="text" placeholder="Disabled input here..." disabled>
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Static control</label>
                      <div class="col-lg-10">
                        <p class="form-control-static">email@example.com</p>
                      </div>
                    </div>                    
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Checkboxes and radios</label>
                      <div class="col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            Option one is this and that&mdash;be sure to include why it's great
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Option one is this and that&mdash;be sure to include why it's great
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Option two can be something else and selecting it will deselect option one
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Inline checkboxes</label>
                      <div class="col-sm-10">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" value="option1"> a
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox2" value="option2"> b
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox3" value="option3"> c
                        </label>
                      </div>
                    </div>                    
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Select</label>
                      <div class="col-sm-10">
                        <select name="account" class="form-control m-b">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                        </select>

                      </div>
                    </div>-->

                    <!--<div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Drag and Drop</label>
                      <div class="col-sm-10">
                        <div class="dropfile visible-lg">
                          <small>Drag and Drop file here</small>
                        </div>
                      </div>
                    </div>-->

                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-4">
                        <button type="submit" class="btn btn-default" id="limpiarUser" name="limpiarUser">Limpiar</button>
                        <button type="submit" class="btn btn-primary" id="agregarUser" name="agregarUser">Registrarse</button>
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <center><b><a href="login.php">Regresar</a></b></center>
                    <div class="line line-dashed line-lg pull-in"></div>
                  </form>
                </div>
              </section>
            </center>


            <!----------------------------------------------FIN FORMULARIO----------------------------------------------------------------->

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