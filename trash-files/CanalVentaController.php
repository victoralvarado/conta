<?php 

require_once '../model/CanalVenta.php';

if(isset($_POST['agregarCV'])){
	insertCV();
}

if(isset($_POST['modificarCV'])){
	editarCV();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimCV':
			eraseCV();
			break;
		case 'cargarDatosCV':
			cargarDatosCV();
			break;

	}
}

function insertCV()
{
	$objCV = new CanalVenta();
	$objCV->setNombre($_POST['nomCV']);
	$objCV->setPorCom($_POST['porcomCV']);
	$objCV->setValCom($_POST['valcomCV']);
	$res = $objCV->saveCV();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/canales.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/canales.php");
		</script>';
	}
}

function eraseCV()
{
	$idCV= $_POST['idCV'];
	$objCV = new CanalVenta();
	$objCV->setId($idCV);
	$res=$objCV->deleteCV();
	echo json_encode($res);
}

function cargarDatosCV()
{
	$idCanal= $_POST['idCanal'];
	$objCV = new CanalVenta();
	$res = $objCV->getOneCanalVenta($idCanal);
	echo json_encode($res);
}

function editarCV()
{
	$objCV = new CanalVenta();
	$objCV->setNombre($_POST['nomCVEdit']);
	$objCV->setPorCom($_POST['porcomCVEdit']);
	$objCV->setValCom($_POST['valcomCVEdit']);
	$objCV->setId($_POST['idCVEdit']);
	$res = $objCV->updateCV();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/canales.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/canales.php");
		</script>';
	}
}

 ?>