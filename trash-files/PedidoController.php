<?php 

require_once '../model/Pedido.php';
require_once '../model/DistribucionChile.php';
require_once '../model/Cliente.php';

if(isset($_POST['agregarPedido'])){
	insertPedido();
}

if(isset($_POST['modificarPedido'])){
	editPedido();
}

if(isset($_POST['modificarEstadoPedido'])){
	editEstadoPedido();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'tabla':
			cargarTabla();
			break;
		case 'tablaGroup':
			cargarTablaGroup();
			break;
		case 'elimPedido':
			erasePedido();
			break;
		case 'cargarDatosPed':
			cargarDatosPedido();
			break;
		case 'reenviar':
			reenviarPedido();
			break;
		case 'anular':
			anularPedido();
			break;
		case 'cargarCE':
			cargarComuna();
			break;
		case 'changeGroup':
			cambiarGroup();
			break;
		case 'pedActual':
			numeroActual();
			break;
		case 'cargarDC':
			datosCliente();
			break;


	}
}

function insertPedido()
{
	session_start();
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$serv="";
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$objCli = new Cliente();
	$objCli->setNombreCliente($_POST['nomClient']);
	$objCli->setRut($_POST['rut']);
	$objCli->setEmail($_POST['mailClient']);
	$objCli->setWhatsapp($_POST['wpClient']);
	$objCli->saveCliente();
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$objPed = new Pedido();
	$objPed->setNombreCliente($_POST['nomClient']);
	$objPed->setRut($_POST['rut']);
	$objPed->setEmail($_POST['mailClient']);
	$objPed->setWhatsapp($_POST['wpClient']);
	$direcEnvio=$_POST['dirEnvio']."_".$_POST['numEnvio']."_".$_POST['comunChile']."_".$_POST['provinChile'];
	$direcFactu=$_POST['dirFactu']."_".$_POST['numFactu']."_".$_POST['comunFChile']."_".$_POST['provinFChile'];
	$objPed->setDireccionEnvio($direcEnvio);
	$objPed->setDireccionFacturacion($direcFactu);
	$objPed->setRecibo($_POST['tipoRecivo']);
	$prods=$_POST['detProd'];
	$objPed->setDetallesProductos($prods);
	$objPed->setTotalPago($_POST['tpProd']);
	$objPed->setDescuento($_POST['descProd']);
	$objPed->setComision($_POST['comProd']);
	$objPed->setCostoEntrega($_POST['costoEnt']);
	$objPed->setServiciosAdicionales($_POST['costoServiAdi']);
	$objPed->setNotas("[".$now."] ".$_SESSION['NOMBRE'].": ".$_POST['notasPedido']);
	$objPed->setGananciaTotal($_POST['gt']);
	$objPed->setIdCanalVen($_POST['canalVenta']);
	$objPed->setFormaEnt($_POST['formaEntrega']);
	for ($i=1; $i <=100 ; $i++) { 
		if (isset($_POST['SA'.$i])) {
			$serv=$serv.$i;
		}
	}
	$objPed->setIdServicio($serv);
	$objPed->setFechaEnt($_POST['fechaEnt']);
	if($_POST['canalVenta']==12 || $_POST['canalVenta']==13)
	{
		$objPed->setIdEstado(2);
	}
	else
	{
		if(strpos($_SESSION['ROL'], '3') !== FALSE)
		{
			$objPed->setIdEstado(2);
		}
		else
		{
			$objPed->setIdEstado(1);
		}
	}
	$objPed->updateCant($_POST['updateCantidad']);
	$res = $objPed->savePedido();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
}

function editPedido()
{
	$serv="";
	$objPed = new Pedido();
	$objPed->setNombreCliente($_POST['nomClientEdit']);
	$objPed->setRut($_POST['rutEdit']);
	$objPed->setEmail($_POST['mailClientEdit']);
	$objPed->setWhatsapp($_POST['wpClientEdit']);
	$direcEnvio=$_POST['dirEnvioEdit']."_".$_POST['numEnvioEdit']."_".$_POST['comunChileEdit']."_".$_POST['provinChileEdit'];
	$direcFactu=$_POST['dirFactuEdit']."_".$_POST['numFactuEdit']."_".$_POST['comunFChileEdit']."_".$_POST['provinFChileEdit'];
	$objPed->setDireccionEnvio($direcEnvio);
	$objPed->setDireccionFacturacion($direcFactu);
	$objPed->setRecibo($_POST['tipoRecivoEdit']);
	$prods=$_POST['detProdEdit'];
	$objPed->setDetallesProductos($prods);
	$objPed->setTotalPago($_POST['tpProdEdit']);
	$objPed->setDescuento($_POST['descProdEdit']);
	$objPed->setComision($_POST['comProdEdit']);
	$objPed->setCostoEntrega($_POST['costoEntEdit']);
	$objPed->setServiciosAdicionales($_POST['costoServiAdiEdit']);
	$objPed->setGananciaTotal($_POST['gtEdit']);
	$objPed->setIdEstado($_POST['idEstadoEdit']);
	$objPed->setIdCanalVen($_POST['canalVentaEdit']);
	$objPed->setFormaEnt($_POST['formaEntregaEdit']);
	for ($i=1; $i <=100 ; $i++) { 
		if (isset($_POST['SA'.$i.'Edit'])) {
			$serv=$serv.$i;
		}
	}
	$objPed->setIdServicio($serv);
	$objPed->setFechaEnt($_POST['fechaEntEdit']);
	$objPed->setId($_POST['idPedidoEdit']);
	$objPed->updateCant($_POST['updateCantidadEdit']);
	$res = $objPed->updatePedido();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
}

function cargarTabla()
{
	$idRol= $_POST['rol'];
	$ven = array();
	$jefven = array();
	$prod = array();
	$jefprod = array();
	$qa = array();
	$desp = array();
	$datos="";
	$objPed= new Pedido();
	$data=$objPed->getAllPedido();
	if(strpos($idRol, '2') !== FALSE)
	{
		$ven[1]="Ingresado";
		$ven[2]="Rechazado";
		$ven[3]="Despachado - producto devuelto";
	}
	if(strpos($idRol, '3') !== FALSE)
	{
		$jefven[1]="Ingresado";
		$jefven[2]="Pedido anulado";
		$jefven[3]="Entregado a cliente";
	}
	if(strpos($idRol, '4') !== FALSE)
	{
		$jefprod[1]="Autorizado";
		$jefprod[2]="En Diseño";
		$jefprod[3]="En impresión";
		$jefprod[4]="En corte";
		$jefprod[5]="Rechazado QA";

	}
	if(strpos($idRol, '5') !== FALSE)
	{
		$desp[1]="Aprobado QA";
		$desp[2]="Despachado - esperando a ser recogido";
		$desp[3]="Despachado - en ruta";
		$desp[4]="Despachado - reenviar";
	}
	if(strpos($idRol, '6') !== FALSE)
	{
		$qa[1]="Control de calidad";
	}
	if(strpos($idRol, '7') !== FALSE)
	{
		$prod[1]="Autorizado";
		$prod[2]="En Diseño";
		$prod[3]="En impresión";
		$prod[4]="En corte";
		$prod[5]="Rechazado QA";
	}
    if (!(empty($data))) {
        	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        	foreach ($data as $value) {
        	if(strpos($idRol, '2') === FALSE)
        	{
        		if(strpos($idRol, '4') !== FALSE || strpos($idRol, '7') !== FALSE)
        		{ 
        				
        				if($value['estadoPedido']==$jefprod[1] || $value['estadoPedido']==$jefprod[2] || $value['estadoPedido']==$jefprod[3] || $value['estadoPedido']==$jefprod[4] || $value['estadoPedido']==$jefprod[5] || $value['estadoPedido']==$prod[1] || $value['estadoPedido']==$prod[2] || $value['estadoPedido']==$prod[3] || $value['estadoPedido']==$prod[4] || $value['estadoPedido']==$prod[5])
	        			{
	        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
				            <td>
				            	<input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'>
				                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
				                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
				                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
				            </td>
				            </tr>";
	        			}
	        			else
	        			{
	        				if($value['estadoPedido']==$jefven[1] || $value['estadoPedido']==$jefven[2] || $value['estadoPedido']==$jefven[3])
		        			{
		        				$datos=$datos."<tr>
			        			<td>".$value['id']."</td>
					            <td>".$value['detalleProductos']."</td>
					            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
					            <td>".$value['totalPago']."</td>
					            <td>".$value['direccionEnvio']."</td>
					            <td>".$value['whatsapp']."</td>
					            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else if($value['estadoPedido']==$desp[1] || $value['estadoPedido']==$desp[2] || $value['estadoPedido']==$desp[3] || $value['estadoPedido']==$desp[4])
		        			{
		        				$datos=$datos."<tr>
			        			<td>".$value['id']."</td>
					            <td>".$value['detalleProductos']."</td>
					            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
					            <td>".$value['totalPago']."</td>
					            <td>".$value['direccionEnvio']."</td>
					            <td>".$value['whatsapp']."</td>
					            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else if($value['estadoPedido']==$qa[1])
		        			{
		        				$datos=$datos."<tr>
			        			<td>".$value['id']."</td>
					            <td>".$value['detalleProductos']."</td>
					            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
					            <td>".$value['totalPago']."</td>
					            <td>".$value['direccionEnvio']."</td>
					            <td>".$value['whatsapp']."</td>
					            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else if($value['estadoPedido']==$ven[1] || $value['estadoPedido']==$ven[2] || $value['estadoPedido']==$ven[3])
		        			{
		        				if($value['idEstado']!=12)
				        		{
				        			$datos=$datos."<tr>
				        			<td>".$value['id']."</td>
						            <td>".$value['detalleProductos']."</td>
						            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
						            <td>".$value['totalPago']."</td>
						            <td>".$value['direccionEnvio']."</td>
						            <td>".$value['whatsapp']."</td>
						            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
				        		}
				        		else
				        		{
				        			$datos=$datos."<tr>
				        			<td>".$value['id']."</td>
						            <td>".$value['detalleProductos']."</td>
						            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
						            <td>".$value['totalPago']."</td>
						            <td>".$value['direccionEnvio']."</td>
						            <td>".$value['whatsapp']."</td>
						            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
						                <input type='button' class='btn-danger btn-sm anularPedido' id='".$value['id']."' value='Anular pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
				        		}
		        			}
	        				else
	        				{
	        					$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
				            <td>
				            	
				            </td>
				            </tr>";
				        	}
	        			}

        		}
        		else
        		{
        			if(strpos($idRol, '1') !== FALSE)
        			{
        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
			            <td>
			                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
			                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
			                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
			            </td>
			            </tr>";
        			}
        			if(strpos($idRol, '3') !== FALSE)
        			{
        				
	        				if($value['estadoPedido']==$jefven[1] || $value['estadoPedido']==$jefven[2] || $value['estadoPedido']==$jefven[3])
		        			{
		        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else
		        			{
		        				if($value['estadoPedido']==$jefprod[1] || $value['estadoPedido']==$jefprod[2] || $value['estadoPedido']==$jefprod[3] || $value['estadoPedido']==$jefprod[4] || $value['estadoPedido']==$jefprod[5] || $value['estadoPedido']==$prod[1] || $value['estadoPedido']==$prod[2] || $value['estadoPedido']==$prod[3] || $value['estadoPedido']==$prod[4] || $value['estadoPedido']==$prod[5])
			        			{
			        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						            	<input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'>
						                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
			        			}
			        			else if($value['estadoPedido']==$desp[1] || $value['estadoPedido']==$desp[2] || $value['estadoPedido']==$desp[3] || $value['estadoPedido']==$desp[4])
			        			{
			        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
			        			}
			        			else if($value['estadoPedido']==$qa[1])
			        			{
			        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
			        			}
			        			else if($value['estadoPedido']==$ven[1] || $value['estadoPedido']==$ven[2] || $value['estadoPedido']==$ven[3])
			        			{
			        				if($value['idEstado']!=12)
					        		{
					        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
					        		}
					        		else
					        		{
					        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
							                <input type='button' class='btn-danger btn-sm anularPedido' id='".$value['id']."' value='Anular pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
					        		}
			        			}
		        				else
		        				{
		        					$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
					            <td>
					            	
					            </td>
					            </tr>";
					        	}
			        		}
        			}

        			if(strpos($idRol, '5') !== FALSE)
        			{
        				
	        				if($value['estadoPedido']==$desp[1] || $value['estadoPedido']==$desp[2] || $value['estadoPedido']==$desp[3] || $value['estadoPedido']==$desp[4])
		        			{
		        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else
		        			{
		        				if($value['estadoPedido']==$jefprod[1] || $value['estadoPedido']==$jefprod[2] || $value['estadoPedido']==$jefprod[3] || $value['estadoPedido']==$jefprod[4] || $value['estadoPedido']==$jefprod[5] || $value['estadoPedido']==$prod[1] || $value['estadoPedido']==$prod[2] || $value['estadoPedido']==$prod[3] || $value['estadoPedido']==$prod[4] || $value['estadoPedido']==$prod[5])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							            	<input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$jefven[1] || $value['estadoPedido']==$jefven[2] || $value['estadoPedido']==$jefven[3])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$qa[1])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$ven[1] || $value['estadoPedido']==$ven[2] || $value['estadoPedido']==$ven[3])
				        			{
				        				if($value['idEstado']!=12)
						        		{
						        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
								            <td>
								                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
								                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
								                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
								            </td>
								            </tr>";
						        		}
						        		else
						        		{
						        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
								            <td>
								                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
								                <input type='button' class='btn-danger btn-sm anularPedido' id='".$value['id']."' value='Anular pedido'>
								                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
								                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
								            </td>
								            </tr>";
						        		}
				        			}
			        				else
			        				{
			        					$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						            	
						            </td>
						            </tr>";
						        	}
		        			}

        			}

        			if(strpos($idRol, '6') !== FALSE)
        			{
        				
	        				if($value['estadoPedido']==$qa[1])
		        			{
		        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
					            <td>
					                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
					                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
					                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
					            </td>
					            </tr>";
		        			}
		        			else
		        			{
		        				if($value['estadoPedido']==$jefprod[1] || $value['estadoPedido']==$jefprod[2] || $value['estadoPedido']==$jefprod[3] || $value['estadoPedido']==$jefprod[4] || $value['estadoPedido']==$jefprod[5] || $value['estadoPedido']==$prod[1] || $value['estadoPedido']==$prod[2] || $value['estadoPedido']==$prod[3] || $value['estadoPedido']==$prod[4] || $value['estadoPedido']==$prod[5])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							            	<input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$jefven[1] || $value['estadoPedido']==$jefven[2] || $value['estadoPedido']==$jefven[3])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$desp[1] || $value['estadoPedido']==$desp[2] || $value['estadoPedido']==$desp[3] || $value['estadoPedido']==$desp[4])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$ven[1] || $value['estadoPedido']==$ven[2] || $value['estadoPedido']==$ven[3])
				        			{
				        				if($value['idEstado']!=12)
						        		{
						        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>>
								            <td>
								                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
								                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
								                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
								            </td>
								            </tr>";
						        		}
						        		else
						        		{
						        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
								            <td>
								                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
								                <input type='button' class='btn-danger btn-sm anularPedido' id='".$value['id']."' value='Anular pedido'>
								                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
								                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
								            </td>
								            </tr>";
						        		}
				        			}
			        				else
			        				{
			        					$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						            	
						            </td>
						            </tr>";
						        	}
		        			}
	        			
        			}
        			
	        	}
        	}
        	else
        	{
        				
	        				if($value['estadoPedido']==$ven[1] || $value['estadoPedido']==$ven[2] || $value['estadoPedido']==$ven[3])
		        			{
		        				if($value['idEstado']!=12)
				        		{
				        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
				        		}
				        		else
				        		{
				        			$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						                <input type='button' class='btn-primary btn-sm reenviarPedido' id='".$value['id']."' value='Reenviar pedido'>
						                <input type='button' class='btn-danger btn-sm anularPedido' id='".$value['id']."' value='Anular pedido'>
						                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
						                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
						            </td>
						            </tr>";
				        		}
		        			}
		        			else
		        			{
				        				if($value['estadoPedido']==$jefprod[1] || $value['estadoPedido']==$jefprod[2] || $value['estadoPedido']==$jefprod[3] || $value['estadoPedido']==$jefprod[4] || $value['estadoPedido']==$jefprod[5] || $value['estadoPedido']==$prod[1] || $value['estadoPedido']==$prod[2] || $value['estadoPedido']==$prod[3] || $value['estadoPedido']==$prod[4] || $value['estadoPedido']==$prod[5])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							            	<input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$jefven[1] || $value['estadoPedido']==$jefven[2] || $value['estadoPedido']==$jefven[3])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$desp[1] || $value['estadoPedido']==$desp[2] || $value['estadoPedido']==$desp[3] || $value['estadoPedido']==$desp[4])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
				        			else if($value['estadoPedido']==$qa[1])
				        			{
				        				$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
							            <td>
							                <input type='button' class='btn-primary btn-sm estadoPedido' id='".$value['id']."' value='Estado del pedido'>
							                <input type='button' class='btn-success btn-sm editarPedido' id='".$value['id']."' value='Editar'>
							                <input type='button' class='btn-danger btn-sm eliminarPedido' id='".$value['id']."' value='Eliminar'>
							            </td>
							            </tr>";
				        			}
			        				else
			        				{
			        					$datos=$datos."<tr>
		        			<td>".$value['id']."</td>
				            <td>".$value['detalleProductos']."</td>
				            <td>".date('d/m/Y', strtotime($value['fechaEnt']))."</td>
				            <td>".$value['totalPago']."</td>
				            <td>".$value['direccionEnvio']."</td>
				            <td>".$value['whatsapp']."</td>
				            <td>".$value['estadoPedido']."</td>
						            <td>
						            	
						            </td>
						            </tr>";
						        	}		        		
		        			}
        		
        	}
        	
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $datos = str_replace("_", ", ", $datos);
        $datos = str_replace("+", "<br>", $datos);
        $res['estado']=true;
        $res['option']=$datos;
        $res['rol']=$idRol;
        echo json_encode($res);
    }
    else
    {
    	$res['estado']=false;
        $res['option']="";
        $res['rol']=$idRol;
        echo json_encode($res);
    }
}

function cargarTablaGroup()
{
	$idRol= $_POST['rol'];
	$datos="";
	$objPed= new Pedido();
	$data= $objPed->getAllPedido4JP();
    if ($data!=false) {
        foreach ($data as $value) {

        		$datos=$datos."<tr>
        		<td><input type='checkbox' id='".$value['id']."' class='groupCheck' value='UPDATE tbl_pedido SET idEstado=[EST] WHERE id=".$value['id'].";'></td>
	            <td>".$value['detalleProductos']."</td>
	            <td>".$value['estadoPedido']."</td>
	            <td><input type='button' class='btn-success btn-sm materialPedido' id='".$value['id']."' value='Material utilizado'></td>
	            </tr>";
        
        	}
        $res['estado']=true;
        $res['option']=$datos;
        $res['rol']=$idRol;
        echo json_encode($res);
    }
    else
    {
    	$res['estado']=false;
        $res['option']="";
        $res['rol']=$idRol;
        echo json_encode($res);
    }
}

function erasePedido()
{
	$idPedido= $_POST['idPedido'];
	$objPed = new Pedido();
	$objPed->setId($idPedido);
	$res=$objPed->deletePedido();
	echo json_encode($res);
}

function cargarDatosPedido()
{
	$idPedido= $_POST['idPedido'];
	$objPed = new Pedido();
	$res = $objPed->getOnePedido($idPedido);
	echo json_encode($res);
}

function editEstadoPedido()
{
	session_start();
	$estado = array();
	$estado[1]="Ingresado";
	$estado[2]="Autorizado";
	$estado[3]="Rechazado";
	$estado[4]="En Diseño";
	$estado[5]="En impresión";
	$estado[6]="En corte";
	$estado[7]="Control de calidad";
	$estado[8]="Aprobado QA";
	$estado[9]="Rechazado QA";
	$estado[10]="Despachado - esperando a ser recogido";
	$estado[11]="Despachado - en ruta";
	$estado[12]="Despachado - producto devuelto";
	$estado[13]="Pedido anulado";
	$estado[14]="Despachado - reenviar";
	$estado[15]="Entregado a cliente";
	$estado[16]="Finalizado - venta";
	$estado[17]="Finalizado - anulado";
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$notasViejas= $_POST['notasOrgPedidoEdit'];
	$idPedido= $_POST['idPedidoEstadoEdit'];
	$objPed = new Pedido();
	$objPed->setId($idPedido);
	$notas = $_POST['notasPedidoEdit'];
	$nuevasNotas=$_POST['notasPedidoEdit'];
	if(!(empty($_POST['notasPedidoEdit'])))
	{
		$objPed->setNotas($notasViejas."\n[".$now."] ".$_SESSION['NOMBRE'].": ".$_POST['notasPedidoEdit']."\n[".$now."] ".$_SESSION['NOMBRE']." ha cambiado el estado del pedido a: ".$estado[$_POST['estadoEdit']].".");
	}
	else
	{
		$objPed->setNotas($notasViejas."\n[".$now."] ".$_SESSION['NOMBRE']." ha cambiado el estado del pedido a: ".$estado[$_POST['estadoEdit']].".");
	}
	$objPed->setIdEstado($_POST['estadoEdit']);
	$res=$objPed->updateEstadoPedido();
	if($_POST['estadoEdit']==16)
	{
		$venta=$objPed->getOnePedido($idPedido);
		$idPedido= $venta['id'];
        $nc = $venta['nombreCliente'];
        $rut = $venta['RUT'];
        $email = $venta['email'];
        $wp = $venta['whatsapp'];
        $recibo = $venta['recibo'];
        $prod = $venta['detalleProductos'];
        $valorVenta = $venta['totalPago'];
        $descuento = $venta['descuento'];
        $com = $venta['comision'];
        $costoEnt = $venta['costoEntrega'];
        $sa = $venta['serviciosAdicionales'];
        $notas = $venta['notas'];
        $gananciaTotal = (((($valorVenta-$descuento)-$com)+$costoEnt)+$sa);
        $idCanalVen = $venta['idCanalVen'];
        $idFormaEnt = $venta['idFormaEnt'];
        $idServicio = $venta['idServicio'];
        $objPed->saveVenta($idPedido, $nc, $rut, $email, $wp, $recibo, $prod, $valorVenta, $descuento, $com, $costoEnt, $sa, $notas, $gananciaTotal, $idCanalVen, $idFormaEnt, $idServicio);
		$res=$objPed->deletePedido();
	}
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/pedidos.php");
		</script>';
	}
}

function reenviarPedido()
{
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$idPedido= $_POST['idPedido'];
	$idEstado= $_POST['idEstado'];
	$notasViejas=$_POST['oldNotas'];
	$objPed = new Pedido();
	$objPed->setId($idPedido);
	if(!(empty($_POST['notas'])))
	{
		$objPed->setNotas($notasViejas."\n[".$now."] ".$_POST['notas']);
	}
	else
	{
		$objPed->setNotas($notasViejas);
	}
	if($idEstado==3)
	{
		$objPed->setIdEstado(1);
	}
	else if($idEstado==12)
	{
		$objPed->setIdEstado(14);
	}
	else
	{
		$objPed->setIdEstado(1);
	}
	$res=$objPed->updateEstadoPedido();
	echo json_encode($res);
}

function anularPedido()
{
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$idPedido= $_POST['idPedido'];
	$notasViejas=$_POST['oldNotas'];
	$objPed = new Pedido();
	$objPed->setId($idPedido);
	if(!(empty($_POST['notas'])))
	{
		$objPed->setNotas($notasViejas."\n[".$now."] ".$_POST['notas']);
	}
	else
	{
		$objPed->setNotas($notasViejas);
	}
	$objPed->setIdEstado(13);
	$res=$objPed->updateEstadoPedido();
	echo json_encode($res);
}

function cargarComuna()
{
	$datos="";
	$idProvincia= $_POST['idProvincia'];
	$objChile = new DistribucionChile();
	$data = $objChile->getAllComunas($idProvincia);
	if ($data!=false) {
        foreach ($data as $value) {
        	$datos=$datos."<option value='".$value["name"]."' name='".$value["id"]."'>".$value['name']."</option>";
        }
        $res['estado']=true;
        $res['option']=$datos;
    }
    else
    {
    	$res['estado']=false;
        $res['option']="";
    }
    echo json_encode($res);
}

function cambiarGroup()
{
	$secuencias="";
	$objPed = new Pedido();
	$i=0;
	$checkbox= $_POST['checkbox'];
	$tempbox = implode(",", $checkbox);
	$group= str_replace("[EST]",$_POST['estado'],$tempbox);
	$sql = explode(',',$group);
	foreach ($sql as $value)
	{
		$res = $objPed->execute($value);
	}
	echo json_encode($res);
}

function numeroActual()
{
	$objPed = new Pedido();
	$num = $objPed->ultimaID();
	if(!(empty($num)))
	{
		$res['estado']=true;
        $res['num']=$num;
	}
	else
	{
		$res['estado']=false;
	}
	echo json_encode($res);
}

function datosCliente()
{
	$rut= $_POST['rut'];
	$objCli = new Cliente();
	$res = $objCli->getOneCliente($rut);
	echo json_encode($res);
}

 ?>