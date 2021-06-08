<?php
require_once('../model/Compra.php');
require_once('../model/DetalleCompra.php');
require_once('../model/Producto.php');
require_once('../model/Movimiento.php');

if (isset($_POST['datos'])) {
    $fila = json_decode($_POST['datos'], true);
    foreach ($fila as $fil) {
        try {
            $objC = new Compra();
            $nombreUser = $objC->getNombreUser($fil['user']);
            $objC->setAfectas($fil['total']);
            $objC->setIva($fil['ivaCF']);
            $objC->setRetencion($fil['ivaR']);
            $objC->setProveedor($fil['contribuyente']);
            $objC->setFecha(str_replace('T', ' ', $fil['fecha'] . ':00'));
            $objC->setRegistrado_por($nombreUser);
            $objC->setCondiciones($fil['condicion']);
            $objC->setEstadoC(1);
            $objC->setDocument_type($fil['document_type']);
            $objC->setDocument_number($fil['document_num']);
            $objC->saveCompra();
        } catch (Throwable $th) {
            echo $th;
        }
    }
}

if (isset($_POST['valores'])) {

    $filas = json_decode($_POST['valores'], true);
    foreach ($filas as $fila) {
        try {
            
            $tipo = 1;
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
            $objDC->setEstadoDC(1);
            $objDC->saveDetalleCompra();

            $objM->setId(0);
            $objM->setProductoM($id);
            $objM->setCantidad($fila['cantidad']);
            $ue = $objP->getUltimaExistenciaP($fila['codigo']);
            $objM->setUltima_existencia($ue);
            $objM->setPrecio(null);
            $uc = $objP->getUltimoCostoP($fila['codigo']);
            $objM->setUltimo_costo($uc);
            $objM->setCosto($fila['precio']);
            $descripcionmov = $objM->desMovimiento($compra);
            $objM->setDescripcion($descripcionmov);
            $objM->setTipo($tipo);
            $objM->setFecha(substr($_POST['fecha'],0,10));
            $objM->setCliente($_POST['contribuyente']);
            $objM->setDoc($_POST['tipo'].''.$_POST['numfactura']);
            $objM->setEstadoM(1);
            $objM->saveMovimiento();

            $objP->setExistencias($ue + $fila['cantidad']);
            $ncosto = (($ue * $uc) + ($fila['cantidad'] * $fila['precio'])) / ($ue + $fila['cantidad']);
            $objP->setCostoP($ncosto);
            $objP->setCodigo($fila['codigo']);
            $objP->updateProductoCE();
        } catch (Throwable $th) {
            echo $th;
        }
    }
}

?>