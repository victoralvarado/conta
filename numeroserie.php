<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once 'model/DocumentoSerie.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Sistema contabilidad</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/ds.js"></script>
</head>
<body>
  <section class="vbox">
    <?php include("header.php"); ?> 
    <section>
      <section class="hbox stretch">

       <?php 
       $activeProducto = "";
       $activeIva = "";
       $activeProveedor = "";
       $activeCompra = "";
       $activeNS = "active";
       $activeVenta = "";
       $activeCliente = "";
       $activelc = "";
       $activev = "";
       $activevc = "";
       $activeiva = "";
       $activeControl = "";
       include("nav.php"); ?>  
        <div class="ex1">
           <section id="content" class="container-fluid">
          	<section class="vbox">         
             
		<!--ACÁ PONER EL CÓDIGO A USAR-->

        
        <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="1">
                                        <div class="well form-horizontal">
                                                <fieldset class="form-group">
                                                    <legend class="w-auto">Número de serie</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Tipo:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <select required="true" id="tipo" name="tipo" class="form-control" aria-label="Default select">
                                                                <option value="0">Seleccionar</option>
                                                                <option value="ccf">Crédito Fiscal</option>
                                                                <option value="fcf">Factura de Consumidor Final</option>
                                                                <option value="fex">Factura de Exportación</option>
                                                                <option value="nr">Nota de Remisión</option>
                                                                <option value="nc">Nota de Crédito</option>
                                                                <option value="nd">Nota de Debito</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Serie:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="serie" name="serie" placeholder="Serie" class="form-control" type="text">
                                                            <span id="existe" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Inicia desde:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input type="number" name="nsid" id="nsid" min="1" value="1" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Termina en:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                        <input type="number" name="nste" id="nste" min="1" value="1000" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group">
                                                        <label class="col-md-3 control-label">Razon Social:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="razonsocial" name="razonsocial" placeholder="Razon Social" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Giro:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="giro" name="giro" placeholder="Giro" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Dirección:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <textarea name="direccion" id="direccion" placeholder="Dirección" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Teléfono:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="telefono" name="telefono" placeholder="Teléfono" maxlength="12" class="form-control" required="true" value="" type="text">
                                                        </div>
                                                    </div>-->
                                                    <div class="form-group">
                                                        <center>
                                                            <button type="submit" id="agregarDS" name="agregarDS" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar</button>
                                                            <button type="reset" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Limpiar cajas de texto" id="cleanDS" name="cleanDS"><em class="fa fa-eraser"></em> Limpiar</button>
                                                        </center>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <caption>Números de serie</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Serie</th>
                                            <th scope="col">Inicia desde</th>
                                            <th scope="col">Termina en</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                            $objDS = new DocumentoSerie();
                                            $data= $objDS->getAllDS();
                                            if($data!=false)
                                            {
                                                foreach ($data as $value) {
                                                    echo '<tr>
                                                    <td>'.$value['tipo'].'</td>
                                                    <td>'.$value['serie'].'</td>
                                                    <td>'.$value['inicia_desde'].'</td>
                                                    <td>'.$value['termina_en'].'</td>
                                                    <td>
                                                            <button type="button" id="'.$value['id'].'" class="btn btn-danger eliminar"><em class="fas fa-trash"></em> Eliminar</button><br><br> 
                                                            <a class="btn btn-primary editar" id="'.$value['id'].'"><em class="fa fa-pencil"></em> Editar</a>
                                                    </td>
                                                </tr>';
                                                }
                                            }

                                        ?>
                                    </tbody>
                                </table>                


    <!------------------------------>
 
        	</section>
        	    <aside class="bg-light lter b-l aside-md hide" id="notes">
          	       <div class="wrapper">Notification</div>
                    </aside>
            </section>
	</div>
    </section>
  </section>
</body>
</html>


<!-- Modal de modificación de DS -->
<div class="modal fade modal" id="modalModDS" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar Número de Serie</span>
                </div>
                <div class="modal-body" >
                      <div class="row" id="infoDSEdit">

                        <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="tipoEdit" class="control-label">Tipo</label>
                                     <br>
                                     <input type="hidden" id="idDSEdit" name="idDSEdit"> 
                                <select required="true" id="tipoEdit" name="tipoEdit" class="form-control" aria-label="Default select">
                                                                <option value="0">Seleccionar</option>
                                                                <option value="ccf">Crédito Fiscal</option>
                                                                <option value="fcf">Factura de Consumidor Final</option>
                                                                <option value="fex">Factura de Exportación</option>
                                                                <option value="nr">Nota de Remisión</option>
                                                                <option value="nc">Nota de Crédito</option>
                                                                <option value="nd">Nota de Debito</option>
                                </select>
                        </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="serieEdit" class="control-label">Serie</label>
                                     <input id="serieEdit" name="serieEdit" placeholder="Serie" class="form-control" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nsidEdit" class="control-label">Inicia desde</label>
                                     <input type="number" name="nsidEdit" id="nsidEdit" min="1" value="1" class="form-control">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nsteEdit" class="control-label">Termina en</label>
                                     <input type="number" name="nsteEdit" id="nsteEdit" min="1" value="1000" class="form-control">
                                 </div>
                          </div>                                        

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modDS" name="modDS">Modificar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
            </div>
        </div> 
    </div>   
</div>