<?php
require_once('../model/Compra.php');
require_once('../model/DetalleCompra.php');
if (isset($_POST['agregarCompra'])) {
    insertCompra();
}
if (isset($_POST['idCompra'])) {
    editCompra();
}
function insertCompra()
{
    $objC = new Compra();
    $nombreUser = $objC->getNombreUser($_POST['user']);
    $objC->setAfectas($_POST['cp']);
    $objC->setIva($_POST['ivaCF']);
    $objC->setretencion($_POST['ivaR']);
    $objC->setProveedor($_POST['contribuyente']);
    $objC->setFecha(str_replace("T", " ",$_POST['fecha'].':00'));
    $objC->setRegistrado_por($nombreUser);
    $objC->setCondiciones($_POST['condicion']);
    $objC->setEstado(1);
    $objC->setTipo($_POST['tipo']);
    $objC->setNumero_comprobante($_POST['comprobante']);
    $objC->setNit(str_replace("-", "", $_POST['nitProveedor']));
    $objC->setNrc(str_replace("-", "", $_POST['nrcProveedor']));
    $objC->setExentas_importacion($_POST['exentasIm']);
    $objC->setExentas_internas($_POST['exentasIn']);
    $objC->setGravadas_importacion($_POST['gravadasIm']);
    $objC->setGravadas_internas($_POST['gravadasIn']);
    $objC->setSujeto_excluido($_POST['excluido']);
    $objC->setTotalCompras($_POST['totalCom']);
    $res = $objC->saveCompra();
    $compra = $objC->ultmimoId();
    $objDC = new DetalleCompra();
    $objDC->setCompra($compra);
    $objDC->setProducto($_POST['producto']);
    $objDC->setCant($_POST['cantidad']);
    $objDC->setPrice($_POST['precio']);
    $objDC->setEstado(1);
    $objDC->saveDetalleCompra();
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

function editCompra()
{
    $objC = new Compra();
    $nombreUser = $objC->getNombreUser($_POST['user']);
    $objC->setAfectas($_POST['cp']);
    $objC->setIva($_POST['ivaCF']);
    $objC->setretencion($_POST['ivaR']);
    $objC->setProveedor($_POST['contribuyente']);
    $objC->setFecha(str_replace("T", " ",$_POST['fecha'].':00'));
    $objC->setRegistrado_por($nombreUser);
    $objC->setCondiciones($_POST['condicion']);
    $objC->setEstado(1);
    $objC->setTipo($_POST['tipo']);
    $objC->setNumero_comprobante($_POST['comprobante']);
    $objC->setNit(str_replace("-", "", $_POST['nitProveedor']));
    $objC->setNrc(str_replace("-", "", $_POST['nrcProveedor']));
    $objC->setExentas_importacion($_POST['exentasIm']);
    $objC->setExentas_internas($_POST['exentasIn']);
    $objC->setGravadas_importacion($_POST['gravadasIm']);
    $objC->setGravadas_internas($_POST['gravadasIn']);
    $objC->setSujeto_excluido($_POST['excluido']);
    $objC->setTotalCompras($_POST['totalCom']);
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
