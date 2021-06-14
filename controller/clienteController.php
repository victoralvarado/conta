<?php 

require_once '../model/Cliente.php';

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'saveCliente':
			insertCliente();
			break;
		case 'cargarDatosCliente':
			cargarDatos();
			break;
		case 'modiCliente':
			modCliente();
			break;
		case 'elimiCliente':
			eraseCliente();
			break;
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

function cargarDatos()
{
	$objCli = new Cliente();
	$res = $objCli->getOneCliente($_POST['idCliente']);
	echo json_encode($res);
}

function modCliente()
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
	$objCli->setId($_POST['id']);
	$res = $objCli->updateCliente();
	echo json_encode($res);
	
}

function eraseCliente()
{
	$objCli = new Cliente();
	$objCli->setId($_POST['idCliente']);
	$res = $objCli->deleteCliente();
	echo json_encode($res);
}
