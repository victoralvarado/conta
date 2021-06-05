<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once 'model/Cliente.php'; ?>
<?php require_once 'model/Producto.php'; ?>
<?php require_once 'model/DocumentoSerie.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Sistema contabilidad</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <?php include("referencias.php"); ?> 
  <script type="text/javascript" src="resources/venta.js"></script>
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
       $activeVenta = "active";
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

                        <div class="form-column col-md-8 col-sm-8 col-xs-8">
                          <br>
                          <center><h3><b>Venta</b></h3></center>
                            <div class="form-column col-md-8 col-sm-8 col-xs-8">
                                 <div class="form-group required">
                                     <label for="nombreCli" class="control-label">Cliente</label>
                                            <select class="form-control requerido" placeholder="Nombre del cliente" name="nombreCli" id="nombreCli" required>
                                              <?php 

                                               $objCli = new Cliente();
                                               $data= $objCli->getAllClientes();
                                                if ($data!=false) {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value['id']."' name='".$value['clasificacion']."' class='".$value['nit']."' min='".$value['nrc']."' max='".$value['direccion']."'>".$value['nombre']."</option>";
                                                  }

                                                }

                                                ?>
                                            </select>
                                 </div>
                          </div>

                          <!--<div class="form-column col-md-1 col-sm-1 col-xs-1">
                            <div class="form-group required">
                                      <label for="busqCli" class="control-label"></label><br>
                                      <button name="busqCli" id="busqCli" class="btn btn-info">Buscar</button>
                                 </div>
                          </div>-->

                           <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <div class="panel panel-info">
                              <div class="panel-heading">Información factura</div>
                              <div class="panel-body">
                                
                                <select id="tipoFac" name="tipoFac" class="form-control requerido">
                                <!--<option value="0">Seleccionar</option>-->
                                <option value="1" name="ccf">Comprobante de Crédito Fiscal</option>
                                <option value="2" name="fcf">Factura Consumidor Final</option>
                                <option value="3" name="fex">Factura de Exportación</option>
                              </select><br>  
                              <input type="hidden" name="maxnum" id="maxnum">
                              <input type="hidden" name="minnum" id="minnum">        
                              <input type="number" name="numfac" id="numfac" min="1" class="form-control requerido" style="color: red; text-align: right;" readonly><br>
                              <select id="numSerie" name="numSerie" class="form-control requerido">
                                <?php 

                                               $objCli = new DocumentoSerie();
                                               $data= $objCli->getAllDS();
                                                if ($data!=false) {
                                                  foreach ($data as $value) {
                                                    echo "<option value='".$value['id']."' class='".$value['tipo']."' name='".$value['serie']."'>".$value['serie']." (".$value['inicia_desde']." - ".$value['termina_en'].")</option>";
                                                  }

                                                }

                                                ?>
                              </select>

                              </div>
                            </div>    
                            </div>

                          </div>

                          <div class="form-column col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group required">
                              <label for="dirCli" class="control-label">Dirección</label>            
                              <textarea id="dirCli" name="dirCli" cols="40" rows="3" class="form-control requerido" readonly></textarea>
                            </div>

                          </div>
                          <div class="form-column col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group required">
                              <label for="regCli" class="control-label">Registro</label>            
                              <input type="text" name="regCli" id="regCli" class="form-control requerido" readonly>
                            </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="condPag" class="control-label">Condición de pago</label>            
                              <input type="number" name="condPag" id="condPag" min="1" value="0" class="form-control requerido">
                            </div>

                          </div>

                          <div class="form-column col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group required">
                              <label for="nitCli" class="control-label">NIT</label>            
                              <input type="text" name="nitCli" id="nitCli" class="form-control requerido" readonly>
                            </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group required">
                              <label for="fechaCompra" class="control-label">Fecha</label>            
                              <input type="date" name="fechaCompra" id="fechaCompra" class="form-control requerido">
                            </div>

                          </div> 

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required">
                              <table class="table table-bordered table-condensed" id="tableCompra">
                                    <!--<caption>Proveedores</caption>-->
                                    <thead>
                                        <tr>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Exentas</th>
                                            <th scope="col">Afectadas</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleCompra">
                                        
                                    </tbody>
                                </table>
                            </div>

                      </div>

                      <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required">
                              
                              <table class="table table-bordered table-condensed">
                              <tr>
                                <th colspan="2" rowspan="3" id="algomas" name="algomas">Algo más</th>
                                <th>Sumas</th>
                                <th><center><input type="text" name="sumas1" id="sumas1" readonly></center></th>
                                <th><center><input type="text" name="sumas2" id="sumas2" readonly></center></th>
                              </tr>
                              <tr>
                                <th>IVA</th>
                                <th> </th>
                                <th><center><input type="text" name="iva" id="iva" readonly></center></th>
                              </tr>
                              <tr>
                               <th>Sub-total</th>
                                <th> </th>
                                <th><center><input type="text" name="st" id="st" readonly></center></th>
                              </tr>
                              <tr>
                                <th>ENTREGADO POR:</th>
                                <th>RECIBIDO POR:</th>
                                <th>(-) Retención</th>
                                <th> </th>
                                <th><center><input type="text" name="rmenos" id="rmenos" readonly></center></th>
                              </tr>
                              <tr>
                                <th>Nombre:</th>
                                <th>Nombre:</th>
                                <th>(+) Retención</th>
                                <th> </th>
                                <th><center><input type="text" name="rmas" id="rmas" readonly></center></th>
                              </tr>
                              <tr>
                                <th>Firma:</th>
                                <th>Firma:</th>
                                <th>Ventas Exentas</th>
                                <th> </th>
                                <th><center><input type="text" name="vext" id="vext" readonly></center></th>
                              </tr>
                              <tr>
                               <th>DUI:</th>
                                <th>DUI:</th>
                                <th>Ventas Total</th>
                                <th> </th>
                                <th><center><input type="text" name="vt" id="vt" readonly></center></th>
                              </tr>
                            </table>

                            </div>
                      </div>

                      </div>

                      <div class="form-column col-md-4 col-sm-4 col-xs-4">
                        <br>
                          <center><h3><b>Cliente</b></h3></center>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <center><div class="form-group required">
                              <label class="control-label">¿Exento de IVA?</label><br>            
                                <input type="radio" id="exivay" name="exiva" value="1">
                                <label for="exivay">Sí</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="exivan" name="exiva" value="2">
                                <label for="exivan">No</label><br>
                            </div></center>

                          </div>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <center><div class="form-group required">
                              <label class="control-label">¿Agente de retención?</label><br>            
                                <input type="radio" id="ary" name="ar" value="1">
                                <label for="ary">Sí</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="arn" name="ar" value="2">
                                <label for="arn">No</label><br>
                            </div></center>
                            </div>

                            <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <center><div class="form-group required">
                              <label for="classCli" class="control-label">Clasificación</label>            
                              <input type="text" name="classCli" id="classCli" class="form-control requerido" readonly>
                            </div></center><br><br>

                          </div>

                          
                          <center><h3><b>Productos</b></h3></center>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                                 <div class="form-group required">
                                     <label for="codProd" class="control-label">Producto</label>
                                     <select class="form-control requerido" placeholder="Nombre del cliente" name="prods" id="prods" required>
                                              <?php 

                                               $objProd = new Producto();
                                               $data= $objProd->getAllProducto();
                                                if ($data!=false) {
                                                  foreach ($data as $value) {
                                                    if($value['existencias']>0)
                                                    {
                                                      echo "<option value='".$value['id']."' min='".$value['descripcion']."' max='".$value['precio']."' name='".$value['codigo']."' class='".$value['existencias']."'>".$value['nombre']."</option>";
                                                    }
                                                  }

                                                }

                                                ?>
                                            </select>
                                 </div>
                          </div>

                          <!--<div class="form-column col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group required">
                                      <label for="busqProd" class="control-label"></label><br>
                                      <button name="busqProd" id="busqProd" class="btn btn-info">Buscar</button>
                                 </div>
                          </div>-->

                          <div class="form-column col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group required">
                              <label for="cantProd" class="control-label">Cantidad</label>            
                              <input type="number" name="cantProd" id="cantProd" min="1" value="1" class="form-control requerido">
                            </div>

                          </div>

                          <div class="form-column col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group required">
                              <label for="preProd" class="control-label">Precio</label>            
                              <input type="text" name="preProd" id="preProd" class="form-control requerido" readonly>
                            </div>
                          </div>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required">
                              <label for="tipoProd" class="control-label">Tipo</label>            
                              <select id="tipoProd" name="tipoProd" class="form-control requerido" disabled>
                                <option value="0">Afectas</option>
                                <option value="1">Exentas</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required">
                              <label for="descProd" class="control-label">Descripción</label>            
                              <textarea id="descProd" name="descProd" cols="40" rows="3" class="form-control requerido" readonly></textarea>
                            </div>

                          </div>

                          <div class="form-column col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group required">
                                      <button name="btn1" id="btn1" class="btn btn-primary">✓</button>
                                 </div>
                          </div>

                          <!--<div class="form-column col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group required">
                                      <button name="btn2" id="btn2" class="btn btn-danger">X</button>
                                 </div>
                          </div>

                          <div class="form-column col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group required">
                                      <button name="btn3" id="btn3" class="btn btn-info">↑</button>
                                 </div>
                          </div>

                          <div class="form-column col-md-3 col-sm-3 col-xs-3">
                            <div class="form-group required">
                                      <button name="btn4" id="btn4" class="btn btn-info">↓</button>
                                 </div>
                          </div>-->

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required"><br>
                                      <center><button name="saveVen" id="saveVen" class="btn btn-success">Guardar</button></center>
                                 </div>
                          </div>

                          <div class="form-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group required">
                              <label for="totalPago" class="control-label">Total a pagar</label>            
                              <input type="text" name="totalPago" id="totalPago" class="form-control requerido" readonly>
                            </div>
                          </div>

                      </div>

                    

                      </div>


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