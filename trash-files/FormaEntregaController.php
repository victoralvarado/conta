<?php 

require_once '../model/FormaEntrega.php';

if(isset($_POST['agregarFE'])){
	insertFE();
}

if(isset($_POST['modificarFE'])){
	editFE();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimFE':
			eraseFE();
			break;
		case 'cargarDatosFE':
			cargarDatosFE();
			break;

	}
}

function insertFE()
{
	$objFE = new FormaEntrega();
	$objFE->setNombre($_POST['nomFE']);
	if($_POST['tipoCosto']=='cvariable')
	{
		$objFE->setCosto($_POST['tipoCosto']);
	}
	else
	{
		$objFE->setCosto($_POST['valorCosto']);
	}
	$res = $objFE->saveFE();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/formas.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/formas.php");
		</script>';
	}
}

function editFE()
{
	$objFE = new FormaEntrega();
	$objFE->setNombre($_POST['nomFEEdit']);
	if($_POST['tipoCostoEdit']=='cvariable')
	{
		$objFE->setCosto($_POST['tipoCostoEdit']);
	}
	else
	{
		$objFE->setCosto($_POST['valorCostoEdit']);
	}
	$objFE->setId($_POST['idFEEdit']);
	$res = $objFE->updateFE();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/formas.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/formas.php");
		</script>';
	}
}

function eraseFE()
{
	$idFE= $_POST['idFE'];
	$objFE = new FormaEntrega();
	$objFE->setId($idFE);
	$res=$objFE->deleteFE();
	echo json_encode($res);
}

function cargarDatosFE()
{
	$idForma= $_POST['idForma'];
	$objFE = new FormaEntrega();
	$res = $objFE->getOneFormaEntrega($idForma);
	echo json_encode($res);
}

 ?>