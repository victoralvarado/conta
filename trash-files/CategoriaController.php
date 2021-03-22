<?php 

require_once '../model/Categoria.php';

if(isset($_POST['agregarCatProd'])){
	insertCatProd();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimCatProd':
			eraseCatProd();
			break;

	}
}

function insertCatProd()
{
	$objCat = new Categoria();
	$objCat->setNombre($_POST['nomCatProd']);
	$objCat->setIdFamilia($_POST['famCatProd']);
	$res = $objCat->saveCatProd();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/categorias.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/categorias.php");
		</script>';
	}
}

function eraseCatProd()
{
	$idCatProd= $_POST['idCatProd'];
	$objCat = new Categoria();
	$objCat->setId($idCatProd);
	$res=$objCat->deleteCatProd();
	echo json_encode($res);
}

 ?>