<?php 

require_once '../model/Familia.php';

if(isset($_POST['agregarFam'])){
	insertFam();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimFam':
			eraseFam();
			break;

	}
}

function insertFam()
{
	$objFam = new Familia();
	$objFam->setNombre($_POST['nomFam']);
	$res = $objFam->saveFamilia();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/familias.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/familias.php");
		</script>';
	}
}

function eraseFam()
{
	$idFam= $_POST['idFam'];
	$objFam = new Familia();
	$objFam->setId($idFam);
	$res=$objFam->deleteFamilia();
	echo json_encode($res);
}

 ?>