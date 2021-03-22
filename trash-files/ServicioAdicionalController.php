<?php 

require_once '../model/ServiciosAdicionales.php';

if(isset($_POST['agregarSA'])){
	insertSA();
}

if(isset($_POST['modificarSA'])){
	editarSA();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimSA':
			eraseSA();
			break;
		case 'cargarDatosSA':
			cargarDatosSA();
			break;

	}
}

function insertSA()
{
	$objSA = new ServiciosAdicionales();
	$objSA->setNombre($_POST['nomSA']);
	$objSA->setCosto($_POST['costoSA']);
	$res = $objSA->saveSA();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/servicios.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/servicios.php");
		</script>';
	}
}

function eraseSA()
{
	$idServicio= $_POST['idServicio'];
	$objSA = new ServiciosAdicionales();
	$objSA->setId($idServicio);
	$res=$objSA->deleteSA();
	echo json_encode($res);
}

function cargarDatosSA()
{
	$idServicio= $_POST['idServicio'];
	$objSA = new ServiciosAdicionales();
	$res = $objSA->getOneSA($idServicio);
	echo json_encode($res);
}

function editarSA()
{
	$objSA = new ServiciosAdicionales();
	$objSA->setNombre($_POST['nomSAEdit']);
	$objSA->setCosto($_POST['costoSAEdit']);
	$objSA->setId($_POST['idSAEdit']);
	$res = $objSA->updateSA();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/servicios.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/servicios.php");
		</script>';
	}
}

 ?>