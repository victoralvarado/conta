<?php 

require_once '../model/Cliente.php';

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'saveCliente':
			insertCliente();
	}
}

function insertCliente()
{
	if($_POST['clasi']==1)
	{
		$class="ninguno";
	}
	else if($_POST['clasi']==2)
	{
		$class="pequeño";
	}
	else if($_POST['clasi']==3)
	{
		$class="mediano";
	}
	else if($_POST['clasi']==4)
	{
		$class="gran contribuyente";
	}
	$objCli = new Cliente();
	$objCli->setNombre($_POST['nombre']);
	$objCli->setClasificacion($class);
	$objCli->setDireccion($_POST['direccion']);
	$objCli->setNit($_POST['nit']);
	$objCli->setNrc($_POST['nrc']);
	$objCli->setRazonSocial($_POST['rs']);
	$objCli->setGiro($_POST['giro']);
	$objCli->setTelefono($_POST['tel']);
	$res = $objCli->saveCliente();
	echo json_encode($res);
	
}

?>