<?php 

require_once '../model/Insumo.php';


if(isset($_POST['modificarIns'])){
	editarIns();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'cargarDatosInsumo':
			cargarDatosInsumo();
			break;
		case 'actMaterial':
			actualizarMaterial();
			break;

	}
}


function cargarDatosInsumo()
{
	$idInsumo= $_POST['idInsumo'];
	$objIns = new Insumo();
	$res = $objIns->getOneInsumo($idInsumo);
	echo json_encode($res);
}

function editarIns()
{
	$objIns = new Insumo();
	$objIns->setNombre($_POST['nomInsEdit']);
	$objIns->setCantidad($_POST['insCantEdit']);
	$objIns->setMinimo($_POST['insMinEdit']);
	$objIns->setId($_POST['idInsEdit']);
	$res = $objIns->updateInsumo();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/insumos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/insumos.php");
		</script>';
	}
}

function actualizarMaterial()
{
	$cant[1]= $_POST['va'];
	$cant[2]= $_POST['vb'];
	$cant[3]= $_POST['vc'];
	$cant[4]= $_POST['tinta'];
	$objIns = new Insumo();
	for ($i=1; $i <=4 ; $i++) { 
		$objIns->setCantidad($cant[$i]);
		$objIns->setId($i);
		$res=$objIns->updateCantidadInsumo();
	}
	echo json_encode($res);
}

 ?>