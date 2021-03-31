<?php
require_once('../model/producto.php');

if (isset($_POST['agregarProducto'])) {
    insertProducto();
}

if (isset($_POST['key'])) {
    $key = $_POST['key'];
    if ($key == 'elimProducto') {
        eraseProducto();
    }
}


function insertProducto()
{
    $objP = new Producto();
    $objP->setNombre($_POST['nombre']);
    $objP->setExistencias($_POST['existencias']);
    $objP->setPrecio($_POST['precio']);
    $objP->setCosto($_POST['costo']);
    $objP->setDescripcion($_POST['descripcion']);
    $objP->setImagen(addslashes(file_get_contents($_FILES['imagen']['tmp_name'])));
    $objP->setCodigo($_POST['codigo']);
    $res = $objP->saveProducto();
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
