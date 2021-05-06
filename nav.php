 <!-- .aside -->
 <aside class="bg-dark lter aside-md hidden-print" id="nav">
   <section class="vbox">

     <section class="w-f scrollable">
       <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
         <script>
           $(document).ready(function() {

             $("#hoverlc").click(function() {
               $("#changelc").attr("class", "fas fa-book-open icon");
               $("#changev").attr("class", "fas fa-book icon");
               $("#changevc").attr("class", "fas fa-book icon");
             });
             $("#hoverv").click(function() {
               $("#changelc").attr("class", "fas fa-book icon");
               $("#changev").attr("class", "fas fa-book-open icon");
               $("#changevc").attr("class", "fas fa-book icon");
             });
             $("#hovervc").click(function() {
               $("#changelc").attr("class", "fas fa-book icon");
               $("#changev").attr("class", "fas fa-book icon");
               $("#changevc").attr("class", "fas fa-book-open icon");
             });
           });
         </script>
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
             <li class="<?php echo $activeVenta; ?>">
               <a href="venta.php">
                 <i class="fas fa-badge-dollar">
                   <b class="bg-info"></b>
                 </i>
                 <span>Venta</span>
               </a>
             </li>
             <li>
               <a href="#">
                 <i class="fas fa-books">
                   <b class="bg-primary dker"></b>
                 </i>
                 <span class="pull-right">
                   <i class="fa fa-angle-down text"></i>
                   <i class="fa fa-angle-up text-active"></i>
                 </span>
                 <span>Libros IVA</span>
               </a>
               <ul class="nav lt">
                 <li id="hoverlc">
                   <a href="#">
                     <i id="changelc" class="fas fa-book icon"></i>
                     <span>Libro de compras</span>
                   </a>
                 </li>
                 <li id="hoverv">
                   <a href="#">
                     <i id="changev" class="fas fa-book icon"></i>
                     <span>Ventas a contribuyentes</span>
                   </a>
                 </li>
                 <li id="hovervc">
                   <a href="#">
                     <i id="changevc" class="fas fa-book icon"></i>
                     <span>Ventas consumidor</span>
                   </a>
                 </li>
               </ul>
             </li>
             <li>
               <a href="#">
                 <i class="fas fa-clipboard-list">
                   <b class="bg-info"></b>
                 </i>
                 <span>Control de inventario</span>
               </a>
             </li>
           </ul>
         </nav>
         <!-- / nav -->
       </div>
     </section>

   </section>
 </aside>
 <!-- /.aside -->