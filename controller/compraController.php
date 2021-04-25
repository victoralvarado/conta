<?php 
    if (isset($_POST['agregarCompra'])) {
        insertCompra();
    }
    function insertCompra()
    {
        $objC = new Compra();
        $nombreUser = $objC->getNombreUser($_POST['user']);
        $objC->setFecha($_POST['fecha']);
        $objC->set
    }

?>