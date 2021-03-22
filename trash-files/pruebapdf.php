<?php 
                require_once 'pluggins/vendor/autoload.php';
                require_once '../model/Conexion.php';

                    echo "<h1>ENTRÓ</h1>";
                    $sql = "SELECT * FROM tbl_empresa;";
                    $con = conectar();
                    $info = $con->query($sql);
                    echo "<h1>ENTRÓ 2</h1>";
                    $html="<h5>Empresas dentro del sistema</h5>";
                    $html.="<table border='1'>";
                    $html.="<tr bgcolor='lightblue'>
                          <th>NOMBRE EMPRESA</th>
                          <th>LOGO</th>
                         </tr>";
                    echo "<h1>ENTRÓ 3</h1>";
                    foreach ($info as  $value) {
                      
                        $html.="<tr>
                              <td>".$value['nombre']."</td>
                              <td><img src='https://www.mundobeneficios.cl/ferias/".$value['logo']."' width='60' height='60'></td>
                            </tr>"; 
                    }
                    echo "<h1>ENTRÓ 4</h1>";
                    $html.= "</table>";
                    echo $html;
                    $mpdf = new \Mpdf\Mpdf();
                    echo "<h1>ENTRÓ 6</h1>";
                    $mpdf->WriteHTML($html);
                    $mpdf->Output();


                 ?>