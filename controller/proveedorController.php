<?php
require_once('../model/Proveedor.php');

if (isset($_POST['agregarProveedor'])) {
    insertProducto();
}

if (isset($_POST['editarProveedor'])) {
    editProducto();
}

if (isset($_POST['idD'])) {
    $id = $_POST["idD"];
    eraseProducto($id);
}