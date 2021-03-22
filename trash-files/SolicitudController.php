<?php 

require_once '../model/Solicitud.php';
require_once '../model/Producto.php';

if(isset($_POST['modificarSol'])){
	uSOL();
}

if(isset($_POST['modificarSolPSD'])){
	uPSD();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'saveSolicitud':
			guardarSolicitud();
			break;
		case 'tablaSolicitud':
			loadSP();
			break;
		case 'checkSP':
			loadBSP();
			break;
		case 'cargarDatosSP':
			cargarDatos();
			break;
		case 'completeSolicitud':
			completarSolicitud();
			break;
		case 'cargarNotasSP':
			cargarNotas();
			break;
		case 'elimSol':
			eraseSolicitud();
			break;
		case 'banSP':
			banSol();
			break;
		case 'vbSolicitud':
			goodSol();
			break;
		case 'reloadProds':
			prodReload();
			break;
	}
}

function guardarSolicitud()
{
	session_start();
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$dia=date("Ymd");
	$hora=date("His");
	$nombre= $_POST['nombre'];
	$rut= $_POST['rut'];
	$notas= $_POST['notas'];
	$nombreDoc = $_FILES['file']['name'];
	$archivoDoc = $_FILES['file']['tmp_name'];
	$rutaDocServer = '../solicitud';
	$rutaDocDB = 'solicitud';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
	move_uploaded_file($archivoDoc, $rutaDocServer); 
	$objSol = new Solicitud();
	$objSol->setNombreCliente($nombre);
	$objSol->setRUT($rut);
	$objSol->setCodigo(str_replace(" ", "-", $_POST['codSP']));
	$objSol->setNombre("Producto-Temporal-".$hora);
	$objSol->setImgEntrada($rutaDocDB);
	$objSol->setNotas("[".$now."] ".$_SESSION['NOMBRE'].": ".$notas);
	$objSol->setIdPedido($_POST['idPedidoSol']);
	$res=$objSol->saveSolicitud();
	echo json_encode($res);
}

function loadSP()
{
	$idRol= $_POST['rol'];
	$datos="";
	$objSol= new Solicitud();
	if(strpos($idRol, '2') !== FALSE || strpos($idRol, '1') !== FALSE)
	{
		$data= $objSol->getAllSolicitudV();
	}
	if(strpos($idRol, '4') !== FALSE || strpos($idRol, '7') !== FALSE)
	{
		$data= $objSol->getAllSolicitudJP();
	}
    if ($data!=false) {
        foreach ($data as $value) {

        		if($value['imgSalida']=="dummy")
        		{
        			$imgSalida="<td>Vacío</td>";
        		}
        		else
        		{
        			$imgSalida="<td><a target='_blank' href='http://www.skinner.cl/workflow/".$value['imgSalida']."' ><img src='http://www.skinner.cl/workflow/".$value['imgSalida']."' width='60' height='60'></a></td>";
        		}
        		if($value['archivo']=="dummy")
        		{
        			$archivo="<td>Vacío</td>";
        		}
        		else
        		{
        			$archivo="<td><a target='_blank' href='http://www.skinner.cl/workflow/".$value['archivo']."'>".$value['nombre'].".psd"."</a></td>";
        		}
        		if($value['precio']=="dummy")
        		{
        			$precio="<td>Vacío</td>";
        		}
        		else
        		{
        			$precio="<td>".$value['precio']."</td>";
        		}
        		if(strpos($idRol, '4') !== FALSE || strpos($idRol, '7') !== FALSE)
				{
					$botones="<td><input type='button' class='btn-success btn-sm solComplete' id='".$value['id']."' value='Completar'>
					<input type='button' class='btn-primary btn-sm solVN' id='".$value['id']."' value='Ver notas'>
					<input type='button' class='btn-danger btn-sm solDelete' id='".$value['id']."' value='Eliminar'></td>";
				}
        		else if(strpos($idRol, '2') !== FALSE || strpos($idRol, '1') !== FALSE)
				{
					$botones="<td><input type='button' class='btn-success btn-sm solVB' id='".$value['id']."' value='Aprobado'>
					<input type='button' class='btn-danger btn-sm solNeg' id='".$value['id']."' value='Rechazado'>
					<input type='button' class='btn-primary btn-sm solVN' id='".$value['id']."' value='Ver notas'></td>";
				}
				if($value['estado']==1)
				{
					$estado="<td>Ingresado</td>";
				}
				else if($value['estado']==2)
				{
					$estado="<td>Respuesta</td>";
				}
				else if($value['estado']==3)
				{
					$estado="<td>Rechazado</td>";
				}
				else if($value['estado']==4)
				{
					$estado="<td>Aceptado</td>";
				}
        		$datos=$datos."<tr>
        		<td>".$value['idPedido']."</td>
        		<td>".$value['RUT']."</td>
	            <td>".$value['codigo']."</td>
	            <td>".$value['nombre']."</td>
	            <td><a target='_blank' href='http://www.skinner.cl/workflow/".$value['imgEntrada']."' ><img src='http://www.skinner.cl/workflow/".$value['imgEntrada']."' width='60' height='60'></a></td>
	            ".$imgSalida."
	            ".$precio."
	            ".$estado."
	            ".$botones."
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

function loadBSP()
{
	session_start();
	$objSol = new Solicitud();
	if(strpos($_SESSION['ROL'], '4') !== FALSE || strpos($_SESSION['ROL'], '7') !== FALSE)
	{
		$num = $objSol->countSolicitudJP();
	}
	else if(strpos($_SESSION['ROL'], '2') !== FALSE || strpos($_SESSION['ROL'], '1') !== FALSE)
	{
		$num = $objSol->countSolicitudV();
	}
	if($num['rol']==4)
    {
    	if($num['num']>0)
                {
                	$res['option'] = "<button class='btn btn-primary  btn-sm' style='margin-left: 5px;' id='agruparPedido'>Pedidos agrupados</button><button class='btn btn-success  btn-sm' style='margin-left: 5px;' id='solicitudProducto'>Tienes solicitudes de producto</button>";
				    $res['rol']=$num['rol'];
				    $res['estado']=$num['estado'];

                }
                else
                {
                  $res['option'] = "<button class='btn btn-primary  btn-sm' style='margin-left: 5px;' id='agruparPedido'>Pedidos agrupados</button><button class='btn btn-success  btn-sm' style='margin-left: 5px;' id='solicitudProducto'>No hay solicitudes de producto</button>";
				    $res['rol']=$num['rol'];
				    $res['estado']=$num['estado'];
                }
    	

    }
    else if($num['rol']==2)
    {
    	if($num['num']>0)
                {
                	$res['option'] = "<button class='btn btn-primary  btn-sm' style='margin-left: 5px;' id='nuevaPedido'>Nuevo</button><button class='btn btn-success  btn-sm' style='margin-left: 5px;' id='solicitudProducto'>Tienes solicitudes de producto</button>";
				    $res['rol']=$num['rol'];
				    $res['estado']=$num['estado'];

                }
                else
                {
                  $res['option'] = "<button class='btn btn-primary  btn-sm' style='margin-left: 5px;' id='nuevaPedido'>Nuevo</button><button class='btn btn-success  btn-sm' style='margin-left: 5px;' id='solicitudProducto'>No hay solicitudes de producto</button>";
				    $res['rol']=$num['rol'];
				    $res['estado']=$num['estado'];
                }
    	
    }

    echo json_encode($res);
}

function cargarDatos()
{
	$idSolicitud= $_POST['idSolicitud'];
	$objSol= new Solicitud();
	$res = $objSol->getOneSolicitud($idSolicitud);
	echo json_encode($res);
}

function completarSolicitud()
{
	session_start();
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$dia=date("Ymd");
	$hora=date("His");
	/////////////////////////////////////////////////
	$nombreDoc = $_FILES['file']['name'];
	$archivoDoc = $_FILES['file']['tmp_name'];
	$rutaDocServer = '../solicitud';
	$rutaDocDB = 'solicitud';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
	move_uploaded_file($archivoDoc, $rutaDocServer);
	///////////////////////////////////////////////// 
	/*$nombrePSD = $_FILES['doc']['name'];
	$archivoPSD = $_FILES['doc']['tmp_name'];
	$rutaPSDServer = '../PSD';
	$rutaPSDDB = 'PSD';
	$rutaPSDServer=$rutaPSDServer."/".$nombrePSD;
	$rutaPSDDB=$rutaPSDDB."/".$nombrePSD;
	move_uploaded_file($archivoPSD, $rutaPSDServer);*/
	/////////////////////////////////////////////////
	$objSol = new Solicitud();
	$objSol->setCodigo(str_replace(" ", "-", $_POST['codigo']));
	$objSol->setNombre($_POST['nombre']);
	$objSol->setImgSalida($rutaDocDB);
	//$objSol->setArchivo($rutaPSDDB);
	$doc = str_replace("\\", '/', $_POST['doc']);
	$objSol->setArchivo($doc);
	$objSol->setPrecio($_POST['precio']);
	$objSol->setDescripcion($_POST['descripcion']);
	$objSol->setNotas($_POST['notasOrg']."\n[".$now."] ".$_SESSION['NOMBRE'].": ".$_POST['notas']);
	$objSol->setIdSubCatProd($_POST['idSub']);
	$objSol->setEstado(2);
	$objSol->setId($_POST['idSolicitud']);
	$res=$objSol->updateSolicitud();
	echo json_encode($res);
}

function cargarNotas()
{
	$idSolicitud= $_POST['idSolicitud'];
	$objSol= new Solicitud();
	$res = $objSol->getOneSolicitud($idSolicitud);
	echo json_encode($res);
}

function eraseSolicitud()
{
	$idSolicitud= $_POST['idSolicitud'];
	$objSol= new Solicitud();
	$objSol->setId($idSolicitud);
	$res=$objSol->deleteSolicitud();
	echo json_encode($res);
}

function banSol()
{
	session_start();
	$now=date("d/m/Y h:i a", strtotime("now +3 GMT"));
	$idSolicitud= $_POST['idSolicitud'];
	$oldNotes= $_POST['oldNotes'];
	$newNotes= $_POST['newNotes'];
	$objSol= new Solicitud();
	$objSol->setNotas($oldNotes."\n[".$now."] ".$_SESSION['NOMBRE'].": ".$newNotes);
	$objSol->setId($idSolicitud);
	$res=$objSol->banSolicitud();
	echo json_encode($res);
}

function goodSol()
{
	$idSolicitud= $_POST['idSolicitud'];
	$objSol= new Solicitud();
	$objSol->setId($idSolicitud);
	$res=$objSol->goodSolicitud();
	echo json_encode($res);
}

function uSOL()
{
	$objSol= new Solicitud();
	$objSol->setCodigo(str_replace(" ", "-", $_POST['codSolEdit']));
	$objSol->setNombre($_POST['nomSolEdit']);
	$objSol->setPrecio($_POST['preSolEdit']);
	$objSol->setArchivo($_POST['archPSDEdit']);
	$objSol->setDescripcion($_POST['descripcioSolEdit']);
	$objSol->setId($_POST['idSolEdit']);
	$res = $objSol->updateSol();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/solicitudes.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/solicitudes.php");
		</script>';
	}
}

function uPSD()
{
	$nombreDoc = $_FILES['psdSolEdit']['name'];
	$archivoDoc = $_FILES['psdSolEdit']['tmp_name'];
	$rutaDocServer = '../PSD';
	$rutaDocDB = 'PSD';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
	move_uploaded_file($archivoDoc, $rutaDocServer);
	$objSol= new Solicitud();
	$objSol->setArchivo($rutaDocDB);
	$objSol->setId($_POST['idSolEditPSD']);
	$res = $objSol->updateSolPSD();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/solicitudes.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/solicitudes.php");
		</script>';
	}
}

function prodReload()
{
	$objSol= new Solicitud();
	$objProd = new Producto();
	$data = "";
	$prods = $objProd->getAllProducto();
	$sols = $objSol->getAllSolicitudPed();
	foreach ($prods as $value) {
		$data=$data+"<option value='".$value["id"]."' name='".$value["precio"]."' class='".$value["cantidad"]."'>".$value['nombre']."</option>";
	}
	foreach ($variable as $value) {
		$data=$data+"<option value='".$value["id"]."' name='".$value["precio"]."' class='-1'>".$value['nombre']."</option>";
	}
	echo json_encode($data);
}

?>