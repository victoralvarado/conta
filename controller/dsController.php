<?php 

require_once '../model/DocumentoSerie.php';

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'saveDS':
			insertDocumentoSerie();
			break;
		case 'cargarDatosDS':
			cargarDatos();
			break;
		case 'modiDS':
			modDocumentoSerie();
			break;
		case 'elimiDS':
			eraseDocumentoSerie();
			break;
	}
}

function insertDocumentoSerie()
{
	$objDS = new DocumentoSerie();
	$objDS->setTipo($_POST['tipo']);
	$objDS->setSerie($_POST['serie']);
	$objDS->setInicia_desde($_POST['nsid']);
	$objDS->setTermina_en($_POST['nste']);
	$res = $objDS->saveDS();
	echo json_encode($res);
	
}

function cargarDatos()
{
	$objDS = new DocumentoSerie();
	$res = $objDS->getOneDS($_POST['idDS']);
	echo json_encode($res);
}

function modDocumentoSerie()
{
	
	$objDS = new DocumentoSerie();
	$objDS->setTipo($_POST['tipo']);
	$objDS->setSerie($_POST['serie']);
	$objDS->setInicia_desde($_POST['nsid']);
	$objDS->setTermina_en($_POST['nste']);
	$objDS->setId($_POST['id']);
	$res = $objDS->updateDS();
	echo json_encode($res);
	
}

function eraseDocumentoSerie()
{
	$objDS = new DocumentoSerie();
	$objDS->setId($_POST['idDS']);
	$res = $objDS->deleteDS();
	echo json_encode($res);
}

?>