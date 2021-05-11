<?php
require_once('../model/Compra.php');
require_once('../model/DetalleCompra.php');
require_once('../model/Producto.php');
require_once('../model/Movimiento.php');

if (isset($_POST['idCompra'])) {
    editCompra();
}
$filas = json_decode($_POST['valores'], true);
foreach ($filas as $fila) {
    $objDC = new DetalleCompra();
    $objCo = new Compra();
    $objP = new Producto();
    $objM = new Movimiento();
    $compra = $objCo->ultmimoId();
    $id = $objP->getIdProducto($fila['codigo']);
    $objDC->setCompra($compra);
    $objDC->setProducto($id);
    $objDC->setCant($fila['cantidad']);
    $objDC->setPrice($fila['precio']);
    $objDC->setEstado(1);
    $objDC->saveDetalleCompra();
}

if (isset($_POST['user'])) {
    insertCompra();
}
function insertCompra()
{
    $objC = new Compra();
    $nombreUser = $objC->getNombreUser($_POST['user']);
    $objC->setAfectas($_POST['total']);
    $objC->setIva($_POST['ivaCF']);
    $objC->setretencion($_POST['ivaR']);
    $objC->setProveedor($_POST['contribuyente']);
    $objC->setFecha(str_replace("T", " ", $_POST['fecha'] . ':00'));
    $objC->setRegistrado_por($nombreUser);
    $objC->setCondiciones($_POST['condicion']);
    $objC->setEstado(1);
    $objC->setDocument_type($_POST['document_type']);
    $objC->setDocument_number($_POST['document_num']);
    $objC->saveCompra();
}

//falta modificar editCompra
function editCompra()
{
    $objC = new Compra();
    $nombreUser = $objC->getNombreUser($_POST['user']);
    $objC->setAfectas($_POST['cp']);
    $objC->setIva($_POST['ivaCF']);
    $objC->setretencion($_POST['ivaR']);
    $objC->setProveedor($_POST['contribuyente']);
    $objC->setFecha(str_replace("T", " ", $_POST['fecha'] . ':00'));
    $objC->setRegistrado_por($nombreUser);
    $objC->setCondiciones($_POST['condicion']);
    $objC->setEstado(1);
    $objC->setId($_POST['idCompra']);
    $res = $objC->updateCompra();
    $objDC = new DetalleCompra();
    $objDC->setCompra($_POST['idCompra']);
    $objDC->setProducto($_POST['producto']);
    $objDC->setCant($_POST['cantidad']);
    $objDC->setPrice($_POST['precio']);
    $objDC->setEstado(1);
    $objDC->updateDetalleCompra();
    if ($res['estado']) {
        echo '
		<script type="text/javascript">
				location.assign("../compra.php");
		</script>';
    } else {
        echo '
		<script type="text/javascript">
				location.assign("../compra.php");
		</script>';
    }
}
