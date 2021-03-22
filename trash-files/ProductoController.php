<?php 

require_once '../model/Producto.php';

if(isset($_POST['agregarProducto'])){
	insertProducto();
}

if(isset($_POST['modificarProducto'])){
	editProducto();
}

if(isset($_POST['modificarProductoPSD'])){
	editPSD();
}

if (isset($_POST['key'])) {
	$key = $_POST['key'];
	switch ($key) {
		case 'elimProducto':
			eraseProducto();
			break;
		case 'cargarDatosProd':
			cargarDatosProducto();
			break;

	}
}

function insertProducto()
{
	$nombreDoc = $_FILES['psdProd']['name'];
	$archivoDoc = $_FILES['psdProd']['tmp_name'];
	$rutaDocServer = '../PSD';
	$rutaDocDB = 'PSD';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
	move_uploaded_file($archivoDoc, $rutaDocServer);
	$img = str_replace("\\", '/', $_POST['rutaProd']);
	$objProd = new Producto();
	$objProd->setCodigo(str_replace(" ", "-", $_POST['codProd']));
	$objProd->setNombre($_POST['nomProd']);
	$objProd->setArchivo($rutaDocDB);
	$objProd->setRuta($img);
	$objProd->setPrecio($_POST['preProd']);
	$objProd->setDescripcion($_POST['descripcionProd']);
	$objProd->setCantidad($_POST['cantProd']);
	$objProd->setMinimo($_POST['cantMin']);
	$objProd->setIdSubCatProd($_POST['subProducto']);
	$res = $objProd->saveProducto();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}
}

function eraseProducto()
{
	$idProducto= $_POST['idProducto'];
	$objProd = new Producto();
	$objProd->setId($idProducto);
	$res=$objProd->deleteProducto();
	echo json_encode($res);
}

function cargarDatosProducto()
{
	$idProducto= $_POST['idProducto'];
	$objProd = new Producto();
	$res = $objProd->getOneProducto($idProducto);
	echo json_encode($res);
}

function editProducto()
{
	$objProd = new Producto();
	$objProd->setCodigo(str_replace(" ", "-", $_POST['codProdEdit']));
	$objProd->setNombre($_POST['nomProdEdit']);
	$img = str_replace("\\", '/', $_POST['rutaProdEdit']);
	$objProd->setRuta($img);
	$objProd->setPrecio($_POST['preProdEdit']);
	$objProd->setDescripcion($_POST['descripcionProdEdit']);
	$objProd->setCantidad($_POST['cantProdEdit']);
	$objProd->setMinimo($_POST['cantMinEdit']);
	$objProd->setIdSubCatProd($_POST['subProductoEdit']);
	$objProd->setId($_POST['idProductoEdit']);
	$res = $objProd->updateProducto();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}
}

function editPSD()
{
	$nombreDoc = $_FILES['psdProdEdit']['name'];
	$archivoDoc = $_FILES['psdProdEdit']['tmp_name'];
	$rutaDocServer = '../PSD';
	$rutaDocDB = 'PSD';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
	move_uploaded_file($archivoDoc, $rutaDocServer);
	$objProd = new Producto();
	$objProd->setArchivo($rutaDocDB);
	$objProd->setId($_POST['idProductoEditPSD']);
	$res = $objProd->updatePSD();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				location.assign("http://www.skinner.cl/workflow/productos.php");
		</script>';
	}

}

 ?>