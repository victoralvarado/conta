<?php
require_once('../model/DetallePartida.php');
require_once('../model/Partida.php');
require_once('../model/Cuentas.php');

if (isset($_POST['valores'])) {

    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $debe = 0;
    $haber = 0;
    $filas = json_decode($_POST['valores'], true);
    foreach ($filas as $fila) {
        $objC = new Cuentas();
        $debeAnterior = $objC->debeAnterior($fila['codigo']);
        $haberAnterior = $objC->haberAnterior($fila['codigo']);
        $objC->setDebe(number_format((floatval($fila['debe'])+$debeAnterior),2));
        $objC->setHaber(number_format((floatval($fila['haber'])+$haberAnterior),2));
        $objC->setCodigo($fila['codigo']);
        $objC->updateCuenta();
        $debe += number_format(floatval($fila['debe']),2);
        $haber += number_format(floatval($fila['haber']),2);
    }
    $objP = new Partida();

    $objP->setFecha($fecha);
    $objP->setDebe($debe);
    $objP->setHaber($haber);
    $objP->setDescripcion($descripcion);
    $objP->setCompra_relacionada(0);
    $objP->savePartida();

    $partidaId = $objP->ultmimoId();
    $filasv = json_decode($_POST['valores'], true);
    foreach ($filasv as $fila) {
        $objC = new Cuentas();
        $objDP = new DetallePartida();
        $cuentaId = $objC->CuentaId($fila['codigo']);
        $objDP->setPartidaId($partidaId);
        $objDP->setCuentaId($cuentaId);
        $objDP->setDebe($fila['debe']);
        $objDP->setHaber($fila['haber']);
        $objDP->saveDPartida();
    }
    
}
