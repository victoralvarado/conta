<?php
require_once('../model/Producto.php');

if (isset($_POST['agregarProducto'])) {
    insertProducto();
}

if (isset($_POST['editarProducto'])) {
    editProducto();
}

if (isset($_POST['idD'])) {
    $id = $_POST["idD"];
    eraseProducto($id);
}

function insertProducto()
{
    $objP = new Producto();
    $nombreDoc = $_FILES['imagen']['name'];
	$archivoDoc = $_FILES['imagen']['tmp_name'];
    $rutaDocServer = "../img";
    $rutaDocDB = 'img';
	$rutaDocServer=$rutaDocServer."/".$nombreDoc;
	$rutaDocDB=$rutaDocDB."/".$nombreDoc;
    move_uploaded_file($archivoDoc, $rutaDocServer);
    $objP->setNombre($_POST['nombre']);
    $objP->setExistencias($_POST['existencias']);
    $objP->setPrecio($_POST['precio']);
    $objP->setCosto($_POST['costo']);
    $objP->setDescripcion($_POST['descripcion']);
    $objP->setImagen($rutaDocDB);
    $objP->setCodigo($_POST['codigo']);
    $res = $objP->saveProducto();
    if ($res['estado']) {
        echo '
		<script type="text/javascript">
				location.assign("../producto.php");
		</script>';
    } else {
        echo '
		<script type="text/javascript">
				location.assign("../producto.php");
		</script>';
    }
}

function editProducto()
{
    $objP = new Producto();
    if ($_FILES['imagen']['name']==null) {
        $objP->setNombre($_POST['nombre']);
        $objP->setExistencias($_POST['existencias']);
        $objP->setPrecio($_POST['precio']);
        $objP->setCosto($_POST['costo']);
        $objP->setDescripcion($_POST['descripcion']);
        $objP->setImagen('');
        $objP->setCodigo($_POST['codigo']);
        $objP->setId($_POST['id']);
        $res = $objP->updateProducto();
        if ($res['estado']) {
            echo '
            <script type="text/javascript">
                    location.assign("../producto.php");
            </script>';
        } else {
            echo '
            <script type="text/javascript">
                    location.assign("../producto.php");
            </script>';
        }
    } else{
        unlink("../".$_POST['img']);
        $nombreDoc = $_FILES['imagen']['name'];
        $archivoDoc = $_FILES['imagen']['tmp_name'];
        $rutaDocServer = "../img";
        $rutaDocDB = 'img';
        $rutaDocServer = $rutaDocServer . "/" . $nombreDoc;
        $rutaDocDB = $rutaDocDB . "/" . $nombreDoc;
        move_uploaded_file($archivoDoc, $rutaDocServer);
        $objP->setNombre($_POST['nombre']);
        $objP->setExistencias($_POST['existencias']);
        $objP->setPrecio($_POST['precio']);
        $objP->setCosto($_POST['costo']);
        $objP->setDescripcion($_POST['descripcion']);
        $objP->setImagen($rutaDocDB);
        $objP->setCodigo($_POST['codigo']);
        $objP->setId($_POST['id']);
        $res = $objP->updateProducto();
        if ($res['estado']) {
            echo '
            <script type="text/javascript">
                    location.assign("http://localhost/conta/producto.php");
            </script>';
        } else {
            echo '
            <script type="text/javascript">
                    location.assign("http://localhost/conta/producto.php");
            </script>';
        }
    }
    
}

function eraseProducto($id)
{
	$objP = new Producto();
	$objP->setId($id);
	$objP->deleteProducto();
    echo '
		<script type="text/javascript">
				location.assign("../producto.php");
		</script>';
	//echo json_encode($res);
}
