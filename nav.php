 <!-- .aside -->
 <aside class="bg-dark lter aside-md hidden-print" id="nav">
   <section class="vbox">

     <section class="w-f scrollable">
       <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
         <!-- nav -->
         <nav class="nav-primary hidden-xs">
           <ul class="nav">
             <!--<li  class="">
                      <a href="#">
                        <i class="fa fa-tachometer icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Cálculo de IVA</span>
                      </a>
                    </li> 
                    <li >
                      <a href="ayp.php"  >
                        <i class="fa fa-pencil icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span>Patrocinador y Ausp.</span>
                      </a>
                      
                    </li>-->
             <!--<li >
                      <a href="#"  >
                        <i class="fa fa-envelope-o icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Multimedia</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="documentos.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Documentos</span>
                          </a>
                        </li>
                        <li >
                          <a href="fotos.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Fotos</span>
                          </a>
                        </li>
                        <li >
                          <a href="videos.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Videos</span>
                          </a>
                        </li>
                        <li >
                          <a href="fondoInformacion.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Fondos para información</span>
                          </a>
                        </li>
                        <li >
                          <a href="fondoStand.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Fondos para stand</span>
                          </a>
                        </li>
                        <li >
                          <a href="monos.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Monos para stand</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li >
                      <a href="#"  >
                        <i class="fa fa-columns icon">
                          <b class="bg-success"></b>
                        </i>
                        <span>Cálculo del ISR</span>
                      </a>
                    </li>-->
             <!--<li >
                      <a href="emm.php"  >
                        <i class="fa fa-envelope-o icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span>Envío masivo mensa.</span>
                      </a>
                      
                    </li>-->
             <!--<li >
                      <a href="#"  >
                        <i class="fa fa-envelope-o icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Envío masivo mens.</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="cmm.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Crear mensajes</span>
                          </a>
                        </li>
                        <li >
                          <a href="emm.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Enviar mensajes</span>
                          </a>
                        </li>   
                      </ul>
                    </li>
                    <li >
                      <a href="#"  >
                        <i class="fa fa-pencil icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Patrocinador y Ausp.</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="ayp.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Gestionar</span>
                          </a>
                        </li>
                        <li >
                          <a href="asigayp.php" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Asignar</span>
                          </a>
                        </li>   
                      </ul>
                    </li>-->
             <li class="<?php echo $activeProducto; ?>">
               <a href="producto.php">
                 <i class="fas fa-barcode-alt icon">
                   <b class="bg-info"></b>
                 </i>
                 <span>Producto</span>
               </a>
             </li>
             <li class="<?php echo $activeProveedor; ?>">
               <a href="proveedor.php">
                 <i class="fas fa-store icon">
                   <b class="bg-info"></b>
                 </i>
                 <span>Proveedor</span>
               </a>
             </li>
             <li class="<?php echo $activeCompra; ?>">
               <a href="compra.php">
                 <i class="fas fa-dolly-flatbed-alt icon">
                   <b class="bg-info"></b>
                 </i>
                 <span>Compra</span>
               </a>
             </li>
             <li class="<?php echo $activeCliente; ?>">
               <a href="cliente.php">
                 <i class="fas fa-users icon">
                   <b class="bg-info"></b>
                 </i>
                 <span>Cliente</span>
               </a>
             </li>
             <?php

              if (!(isset($activeNS))) {
                $activeNS = "";
              }

              ?>
             <li class="<?php echo $activeNS; ?>">
               <a href="numeroserie.php">
                 <i class="fas fa-hashtag">
                   <b class="bg-info"></b>
                 </i>
                 <span>Número de series</span>
               </a>
             </li>
             <li class="<?php echo $activeVenta; ?>">
               <a href="venta.php">
                 <i class="fas fa-badge-dollar">
                   <b class="bg-info"></b>
                 </i>
                 <span>Venta</span>
               </a>
             </li>
             <li class="<?php echo $activeiva; ?>">
               <a href="#">
                 <i class="fas fa-books">
                   <b class="bg-info dker"></b>
                 </i>
                 <span class="pull-right">
                   <i class="fa fa-angle-down text"></i>
                   <i class="fa fa-angle-up text-active"></i>
                 </span>
                 <span>Reportes</span>
               </a>
               <ul class="nav lt">
                 <li id="hoverlc" style="cursor:pointer; cursor: hand" class="<?php echo $activelc; ?>">
                   <a data-toggle="modal" data-target="#compras">
                     <i id="changelc" class="fas fa-book icon"></i>
                     Libro de compras
                   </a>
                 </li>
                 <li id="hoverv" style="cursor:pointer; cursor: hand" class="<?php echo $activev; ?>">
                   <a data-toggle="modal" data-target="#ventasContribuyente">
                     <i id="changev" class="fas fa-book icon"></i>
                     <span>Ventas a contribuyentes</span>
                   </a>
                 </li>
                 <li id="hovervc" style="cursor:pointer; cursor: hand" class="<?php echo $activevc; ?>">
                   <a data-toggle="modal" data-target="#ventasConsumidor">
                     <i id="changevc" class="fas fa-book icon"></i>
                     <span>Ventas consumidor</span>
                   </a>
                 </li>
               </ul>
             </li>
             <li class="" style="cursor:pointer; cursor: hand">
               <a data-toggle="modal" data-target="#factura">
                 <i class="fas fa-file-invoice">
                   <b class="bg-info"></b>
                 </i>
                 <span>Buscar Factura</span>
               </a>
             </li>
           </ul>
           <br>
           <br>
           <br>
           <div class="footer" style="display: flex; align-items: flex-end;">
             <p>
               Copyright ©
               <script>
                 document.write(new Date().getFullYear());
               </script> All rights reserved
               <!-- | Created by <a href="https://github.com/victoralvarado" target="_blank">Victor Alvarado</a> & <a href="https://github.com/DiegoRosa98" target="_blank">Diego Rosa</a> -->
             </p>
           </div>
         </nav>
         <!-- / nav -->

         <!-- Modal -->
         <div class="modal fade" id="compras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Generar Reporte Libro de Compras</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form method="POST" action="libroCompras.php" target="_blank">
                   <div class="form-group">
                     <label>Ingrese el mes y el año: </label>
                     <?php $anio = date("Y");
                      $mes = date("m"); ?>
                     <input type="month" name="fecha" value="<?php echo $anio . "-" . $mes; ?>" max="<?php echo $anio . "-" . $mes; ?>" required>
                   </div>
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary" onclick="location.reload()">Generar</button>
                   </div>
                 </form>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
               </div>
             </div>
           </div>
         </div>

         <!-- Modal -->
         <div class="modal fade" id="ventasConsumidor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Generar Reporte Libro de Ventas a Consumidor</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form method="POST" action="libroVentasConsumidor.php" target="_blank">
                   <div class="form-group">
                     <label>Ingrese el mes y el año: </label>
                     <?php $anio = date("Y");
                      $mes = date("m"); ?>
                     <input type="month" name="fechaC" value="<?php echo $anio . "-" . $mes; ?>" max="<?php echo $anio . "-" . $mes; ?>" required>
                   </div>
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary" onclick="location.reload()">Generar</button>
                   </div>
                 </form>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <!-- Modal -->
         <div class="modal fade" id="ventasContribuyente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Generar Reporte Libro de Ventas a Contribuyentes</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form method="POST" action="libroVentasContribuyente.php" target="_blank">
                   <div class="form-group">
                     <label>Ingrese el mes y el año: </label>
                     <?php $anio = date("Y");
                      $mes = date("m"); ?>
                     <input type="month" name="fechaC" value="<?php echo $anio . "-" . $mes; ?>" max="<?php echo $anio . "-" . $mes; ?>" required>
                   </div>
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary" onclick="location.reload()">Generar</button>
                   </div>
                 </form>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <!-- Modal -->
         <div class="modal fade" id="factura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-sm" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Buscar factura</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form method="POST" action="facturaVenta.php" target="_blank">
                   <div class="form-group">
                     <?php require_once('model/Documento.php');
                      $objD = new Documento();
                      ?>
                      <label>Numero de Factura: </label>
                     <input type="number" name="numfac" value="1" max="<?php echo $objD->numFactura(); ?>" min="1" required>
                   </div>
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary" onclick="location.reload()">Buscar</button>
                   </div>
                 </form>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
     </section>

   </section>
 </aside>
 <!-- /.aside -->