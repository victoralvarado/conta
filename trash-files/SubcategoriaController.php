<?php 

require_once '../model/Subcategoria.php';

if(isset($_POST['agregarSubCatProd'])){
	insertSubCatProd();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimSubCatProd':
			eraseSubCatProd();
			break;

	}
}

function insertSubCatProd()
{
	$objSub = new Subcategoria();
	$objSub->setNombre($_POST['nomSubCatProd']);
	$objSub->setIdCatProd($_POST['catSubProd']);
	$res = $objSub->saveSubCatProd();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/subcategorias.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/subcategorias.php");
		</script>';
	}
}

function eraseSubCatProd()
{
	$idSubCatProd= $_POST['idSubCatProd'];
	$objSub = new Subcategoria();
	$objSub->setId($idSubCatProd);
	$res=$objSub->deleteSubCatProd();
	echo json_encode($res);
}

 ?>