<?php 

require_once '../model/Documento.php';

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'save2Tables':
			insercionTablas();
			break;
	}
}

function insercionTablas()
{
   //////////////////////////////////////////////
   $nombre = $_POST['nombre'];
   $direccion = $_POST['direccion'];
   $nit = $_POST['nit'];
   $nrc = $_POST['nrc'];
   $numFac = $_POST['numFac'];
   $tipoFac = $_POST['tipoFac'];
   $serie = $_POST['serie'];
   $cpago = $_POST['cpago'];
   $fecha = $_POST['fecha'];
   $prodDesc = $_POST['prodDesc'];
   $updateProd = $_POST['updateProd'];
   $classi = $_POST['classi'];
   $prod = $_POST['prod'];
   $canti = $_POST['canti'];
   $precioind = $_POST['precioind'];
   $tipoProd = $_POST['tipoProd'];
   $descProd = $_POST['descProd'];
   $sumas = $_POST['sumas'];
   $iva = $_POST['iva'];
   $subtot = $_POST['subtot'];
   $minren = $_POST['minren'];
   $plusren = $_POST['plusren'];
   $extven = $_POST['extven'];
   $ventot = $_POST['ventot'];
   $acumaf = $_POST['acumaf'];
   $acumex = $_POST['acumex'];
   $ret = $_POST['ret'];
   $caso = $_POST['caso'];
   //////////////////////////////////////////////
	$objDS = new Documento();
	$objDS->updateCantidadProd($updateProd);
	$objDS->saveMovimiento($prod,$canti,$precioind,$descProd);
	$objDS->saveDocumento($numFac,$serie,$nombre,$fecha,($numFac-1),$acumaf,$acumex,$iva,$ret,$cpago,$classi,$caso);
	$res = $objDS->saveDetalleDocumento($objDS->ultimoID(),$prod,$canti,$precioind,$numFac);
	echo json_encode($res);
	
}



?>