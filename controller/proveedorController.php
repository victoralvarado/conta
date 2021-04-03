<?php
require_once('../model/Proveedor.php');

if (isset($_POST['agregarProveedor'])) {
    insertProveedor();
}

if (isset($_POST['editarProveedor'])) {
    editProducto();
}

if (isset($_POST['idD'])) {
    $id = $_POST["idD"];
    eraseProducto($id);
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