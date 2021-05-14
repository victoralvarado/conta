<?php require_once 'app/validacionGeneral.php'; ?>
<?php require_once 'model/Cliente.php'; ?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="utf-8" />
    <title>Sistema contabilidad</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php include("referencias.php"); ?>
    <script type="text/javascript" src="resources/cliente.js"></script>
    <script type="text/javascript" src="resources/jmask.js"></script>
      <script>
        $(document).ready(function($){
            $("#nit").mask("9999-999999-999-9");
            $("#nrc").mask("9999-999999-999-9");
            $("#nitEdit").mask("9999-999999-999-9");
            $("#nrcEdit").mask("9999-999999-999-9");
          });
    </script>
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
                $activeVenta = "";
                $activeCliente = "active";
                $activelc = "";
                $activev = "";
                $activevc = "";
                $activeiva = "";
                $activeControl = "";
                include("nav.php"); ?>
                <div class="ex1">
                    <section id="content" class="container-fluid">
                        <section class="vbox">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="1">
                                        <div class="well form-horizontal">
                                                <fieldset class="form-group">
                                                    <legend class="w-auto">Cliente</legend>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Clasificación:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <select required="true" id="clasificacion" name="clasificacion" class="form-control" aria-label="Default select">
                                                                <option value="0">Seleccione una clasificacion</option>
                                                                <option value="1">Ninguno</option>
                                                                <option value="2">Pequeño</option>
                                                                <option value="3">Mediano</option>
                                                                <option value="4">Gran Contribuyente</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">NIT:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nit" name="nit" placeholder="Número de Identificación Tributaria" class="form-control" required="true" value="" type="text">
                                                            <span id="existeNit" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">NRC:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nrc" name="nrc" placeholder="Número de Registro de Contribuyente" class="form-control" value="" type="text">
                                                            <span id="existe" style="color:red"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Nombre:</label>
                                                        <div class="col-md-7 inputGroupContainer">
                                                            <input id="nombre" name="nombre" placeholder="Nombre" class="form-control" value="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
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
                                                    </div>
                                                    <div class="form-group">
                                                        <center>
                                                            <button type="submit" id="agregarCliente" name="agregarCliente" class="btn btn-primary"><em class="fa fa-plus"></em> Agregar</button>
                                                            <button type="reset" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Limpiar cajas de texto"><em class="fa fa-eraser"></em> Limpiar</button>
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
                                    <caption>Proveedores</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Clasificación</th>
                                            <th scope="col">NIT</th>
                                            <th scope="col">NRC</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Razon Social</th>
                                            <th scope="col">Giro</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                            $objCli = new Cliente();
                                            $data= $objCli->getAllClientes();
                                            if($data!=false)
                                            {
                                                foreach ($data as $value) {
                                                    echo '<tr>
                                                    <td>'.$value['clasificacion'].'</td>
                                                    <td>'.$value['nit'].'</td>
                                                    <td>'.$value['nrc'].'</td>
                                                    <td>'.$value['nombre'].'</td>
                                                    <td>'.$value['razon_social'].'</td>
                                                    <td>'.$value['giro'].'</td>
                                                    <td>'.$value['direccion'].'</td>
                                                    <td>'.$value['telefono'].'</td>
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

<!-- Modal de modificación de cliente -->
<div class="modal fade modal" id="modalModCliente" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " Style="height:45px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <span class="robo" style="font-size: 20px;">Modificar cliente</span>
                </div>
                <div class="modal-body" >
                      <div class="row" id="infoClienteEdit">

                        <div class="form-column col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group required">
                                     <label for="clasificacionEdit" class="control-label">Clasificación</label>
                                     <br>
                                     <input type="hidden" id="idClienteEdit" name="idClienteEdit"> 
                                <select required="true" id="clasificacionEdit" name="clasificacionEdit" class="form-control" aria-label="Default select">
                                                                <option value="0">Seleccione una clasificacion</option>
                                                                <option value="1">Ninguno</option>
                                                                <option value="2">Pequeño</option>
                                                                <option value="3">Mediano</option>
                                                                <option value="4">Gran Contribuyente</option>
                                </select>
                        </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nitEdit" class="control-label">NIT</label>
                                     <input id="nitEdit" name="nitEdit" placeholder="Número de Identificación Tributaria" class="form-control" required="true" value="" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nrcEdit" class="control-label">NRC</label>
                                     <input id="nrcEdit" name="nrcEdit" placeholder="Número de Registro de Contribuyente" class="form-control" value="" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="nombreEdit" class="control-label">Nombre</label>
                                     <input id="nombreEdit" name="nombreEdit" placeholder="Nombre" class="form-control" value="" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="razonsocialEdit" class="control-label">Razón social</label>
                                     <input id="razonsocialEdit" name="razonsocialEdit" placeholder="Razon Social" class="form-control" value="" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="giroEdit" class="control-label">Giro</label>
                                     <input id="giroEdit" name="giroEdit" placeholder="Giro" class="form-control" value="" type="text">
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="direccionEdit" class="control-label">Dirección</label>
                                     <textarea name="direccionEdit" id="direccionEdit" placeholder="Dirección" class="form-control" rows="2"></textarea>
                                 </div>
                          </div>

                          <div class="form-column col-md-4 col-sm-4 col-xs-4">
                                 <div class="form-group required">
                                     <label for="telefonoEdit" class="control-label">Teléfono</label>
                                     <input id="telefonoEdit" name="telefonoEdit" placeholder="Teléfono" maxlength="12" class="form-control" required="true" value="" type="text">
                                 </div>
                          </div>
                           
                          

              </div>   
              <div class="clearfix"></div>
                    <div>
                    <button class="btn btn-primary  btn-sm " id="modCliente" name="modCliente">Modificar</button>
                  </div>     
               <div class="modal-footer" id="modalFooter" >
                  
               </div>
            </div>
        </div> 
    </div>   
</div>