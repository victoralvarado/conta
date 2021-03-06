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
   $nomserie = $_POST['nomserie'];
   $cpago = $_POST['cpago'];
   $fecha = $_POST['fecha'];
   $prodDesc = $_POST['prodDesc'];
   $updateProd = json_decode($_POST['updateProd']);
   $classi = $_POST['classi'];
   $prod = json_decode($_POST['prod']);
   $canti = json_decode($_POST['canti']);
   $precioind = json_decode($_POST['precioind']);
   $tipoProd = $_POST['tipoProd'];
   $descProd = json_decode($_POST['descProd']);
   $cantorprod = json_decode($_POST['cantorprod']);
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
   foreach ($updateProd as $key => $value) {
      $objDS->updateCantidadProd($value);
   }
   foreach ($prod as $key => $value) {
      $objDS->saveMovimiento($value,$canti[$key],$cantorprod[$key],$precioind[$key],$descProd[$key],0,$fecha,$nombre,$nomserie." ".$numFac,);
   }
	$objDS->saveDocumento($numFac,$serie,$nombre,$fecha,($numFac-1),$acumaf,$acumex,$iva,$ret,$cpago,$classi,$caso);
   $idDoc=$objDS->ultimoID();
   foreach ($prod as $key => $value) {
	$res = $objDS->saveDetalleDocumento($idDoc,$value,$canti[$key],$precioind[$key],$numFac);
   }
   $res['numfac'] = $idDoc;
	echo json_encode($res);
	
}
