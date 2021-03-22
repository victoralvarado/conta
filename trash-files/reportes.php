<?php require_once '../app/validacionAdmin.php'; ?>
<?php require_once '../model/Log.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Módulo de reportes</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="../include/networking.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</head>
<body>
  <section class="vbox">
    <?php include("header.php"); ?> 
    <section>
      <section class="hbox stretch">

       <?php include("nav.php"); ?>  


        <section id="content" style="overflow: scroll;">
          <section class="vbox">         

              <header style="margin-top: 10px;">
                <div class="row">
                      <div class="form-column col-md-2 col-sm-2 col-xs-2">
                      <img src="https://www.mundobeneficios.cl/ferias/img/logo_mb.png" style="float:left;width:70px;  height: 30px; margin-right:20px;">
                      </div>
                      <div class="form-column col-md-2 col-sm-2 col-xs-2"><?php $fecha=date("d/m/Y h:i a", strtotime("now +3 GMT")); echo $fecha; ?></div>
                      <div class="form-column col-md-2 col-sm-2 col-xs-2">
                      <select id="tipoLog"><option value="0">Todo</option><option value="1">Tiempo en sistema</option><option value="2">Visita stand</option><option value="3">Conversación</option></select></div>
                      <div class="form-column col-md-2 col-sm-2 col-xs-2">
                      <input type="date" id="fechaLog" style="height: 20px;">
                      </div>
                      <div class="form-column col-md-2 col-sm-2 col-xs-2">
                      <input type="submit" name="buscLog" id="buscLog" value="Buscar" >
                      </div>
                      <div class="form-column col-md-2 col-sm-2 col-xs-2">
                      <input type="submit" name="exportLog" id="exportLog" value="Generar PDF">
                      </div>
                </div>
                    </header>
                    <section >
                      <section>
                          <section>
                                
                                <label id="logs" style="margin-top: 0px;margin-right: 25px;margin-left: 135px;margin-bottom: 15px; line-height : 30px;">
                                    <?php  
                                      $objLog = new Log();
                                      $data=$objLog->getAllLog();
                                      $cont=1;
                                      if($data!=null)
                                      {
                                        echo '<div id="divLog">';
                                        foreach ($data as $value) 
                                        {
                                            echo "<div id='".$cont."' class='row'><b>[".$value['hora']."] ".$value['descripcion']."</b></div><br>";
                                            $cont++;
                                        }
                                        echo '</div>';
                                      }

                                    ?>
                                </label>
                                


                          </section>
                      </section>
                    </section>
          </section>
          <!--<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>-->
        </section>


          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>

<script type="text/javascript">
  $(function() { 
   $('#exportLog').click(function() {
      var now = Date.now();
      
      var options = {
        pagesplit: true
      };

      var node = document.getElementById('divLog');
      var texto  = node.innerText;
      var myrows = node.getElementsByClassName('row');
      var filas = ($("#divLog").find(".row")).length;
      var i=1;
      var k=i;
      var iter=1;
      var aux=1;
      var ii=0;
      var info="";
      //source = $('#divLog')[0];

      var doc = new jsPDF('p', 'pt', 'letter');
      doc.setPage(1);
      doc.setFontSize(11);

          while((28*i)<filas)
          {
            for (k = 1*aux; k <= 28*iter; k++) {
                    node = document.getElementById(k);
                    texto= node.innerText+'\n\n';
                    info=info+texto;             
            }
            doc.text(info, 20,20, {
                      'width': 170,
                      'pagesplit':false
                    });
            doc.addPage();
            info="";
            iter++;
            ii++;
            aux=28*ii;
            i++;
          }
          if(filas-aux>0)
          {
            ulci=filas-aux;
            for (k = 1+aux; k <= aux+ulci; k++) {
                    node = document.getElementById(k);
                    texto= node.innerText+'\n\n';
                    info=info+texto;             
            }
            doc.text(info, 20,20, {
                      'width': 170,
                      'pagesplit':false
                    });

            }
            
          doc.save('Reporte_'+now+'.pdf');

      

   });
  });
</script>
  