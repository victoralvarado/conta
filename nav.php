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
                 <span>Libros IVA</span>
               </a>
               <ul class="nav lt">
                 <li id="hoverlc" class="<?php echo $activelc; ?>">
                   <a href="librocompras.php">
                     <i id="changelc" class="fas fa-book icon"></i>
                     <span>Libro de compras</span>
                   </a>
                 </li>
                 <li id="hoverv" class="<?php echo $activev; ?>">
                   <a href="ventascontribuyente.php">
                     <i id="changev" class="fas fa-book icon"></i>
                     <span>Ventas a contribuyentes</span>
                   </a>
                 </li>
                 <li id="hovervc" class="<?php echo $activevc; ?>">
                   <a href="ventasconsumidor.php">
                     <i id="changevc" class="fas fa-book icon"></i>
                     <span>Ventas consumidor</span>
                   </a>
                 </li>
               </ul>
             </li>
             <li class="<?php echo $activeControl; ?>">
               <a href="controlinventario.php">
                 <i class="fas fa-clipboard-list">
                   <b class="bg-info"></b>
                 </i>
                 <span>Control de inventario</span>
               </a>
             </li>
           </ul>
           <br>
           <br>
           <br>
           <div class="footer" style="display: flex;
    align-items: flex-end;">
             <p>
               Copyright © 
               <script>
                 document.write(new Date().getFullYear());
               </script> All rights reserved <!-- | Created by <a href="https://github.com/victoralvarado" target="_blank">Victor Alvarado</a> & <a href="https://github.com/DiegoRosa98" target="_blank">Diego Rosa</a> -->
             </p>
           </div>
         </nav>
         <!-- / nav -->
       </div>
     </section>

   </section>
 </aside>
 <!-- /.aside -->