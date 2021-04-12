<?php
require_once('../model/Proveedor.php');

if (isset($_POST['agregarProveedor'])) {
    insertProveedor();
}

if (isset($_POST['idEdit'])) {
    editProveedor();
}

if (isset($_POST['idD'])) {
    $id = $_POST["idD"];
    eraseProveedor($id);
}

if (isset($_POST['text'])) {
    $objPr = new Proveedor();
    $clasi = $objPr->getCProveedor($_POST['text']);
    echo ucwords(strtolower($clasi));
}

function insertProveedor()
{
    $objP = new Proveedor();
    $objP->setTipo($_POST['tipo']);
    $objP->setClasificacion($_POST['clasificacion']);
    $objP->setNit(str_replace("-","",$_POST['nit']));
    $objP->setNrc(str_replace("-","",$_POST['nrc']));
    $objP->setNombre($_POST['nombre']);
    $objP->setRazon_social($_POST['razonsocial']);
    $objP->setDireccion($_POST['direccion']);
    $objP->setTelefono($_POST['telefono']);
    $res = $objP->saveProveedor();
    if ($res['estado']) {
        echo '
		<script type="text/javascript">
				location.assign("../proveedor.php");
		</script>';
    } else {
        echo '
		<script type="text/javascript">
				location.assign("../proveedor.php");
		</script>';
    }
}

function editProveedor()
{
    $objP = new Proveedor();
    $objP->setTipo($_POST['tipo']);
    $objP->setClasificacion($_POST['clasificacion']);
    #Asignar sin guion el nit
    $objP->setNit(str_replace("-","",$_POST['nit']));
    #Asignar sin guion el nrc
    $objP->setNrc(str_replace("-","",$_POST['nrc']));
    $objP->setNombre($_POST['nombre']);
    $objP->setRazon_social($_POST['razonsocial']);
    $objP->setDireccion($_POST['direccion']);
    $objP->setTelefono($_POST['telefono']);
    $objP->setId($_POST['idEdit']);
    $res = $objP->updateProveedor();
    if ($res['estado']) {
        echo '
		<script type="text/javascript">
				location.assign("../proveedor.php");
		</script>';
    } else {
        echo '
		<script type="text/javascript">
				location.assign("../proveedor.php");
		</script>';
    }
}

function eraseProveedor($id)
{
	$objP = new Proveedor();
	$objP->setId($id);
	$objP->deleteProveedor();
    echo '
		<script type="text/javascript">
				location.assign("../proveedor.php");
		</script>';
	//echo json_encode($res);
}