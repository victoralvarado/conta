<?php
require_once('../model/Producto.php');

if (isset($_POST['agregarProducto'])) {
    insertProducto();
}

if (isset($_POST['idEdit'])) {
    editProducto();
}

if (isset($_POST['idD'])) {
    $id = $_POST['idD'];
    eraseProducto($id);
}

function insertProducto()
{
    $objP = new Producto();
    //El nombre de la imagen tendra el id del usurio y codigo del producto para evitar 
    //conflicto con imagenes que tengan el mismo nombre
    //$newName = $rutaDocServer.''.$idUser.'-'.$_POST['codigo'].'.'.$type;
    $idUser = $objP->idUser($_POST['user']);
    #Extencion de la imagen
    $type = str_replace('image/','',$_FILES['imagen']['type']);
    #Nombre original de la imagen
    $nombreDoc = $_FILES['imagen']['name'];
    #Nombre temporal de la imagen
    $archivoDoc = $_FILES['imagen']['tmp_name'];
    #Ruta donde se guardan las imagenes temporalmente
    $rutaDocServerTemp = '../temp/';
    #Ruta donde se guardan las imagenes
    $rutaDocServer = '../img/';
    #Ruta donde se guardan las images + el nombre original de la imagen
    $rutaDocServerImg = $rutaDocServerTemp.''.$nombreDoc;
    #Mover la imagen al servidor temporalmente
    move_uploaded_file($archivoDoc, $rutaDocServerImg);
    #Asignar un nuevo nombre a la imagen
    $newName = $rutaDocServer.''.$idUser.'-'.$_POST['codigo'].'.'.$type;
    #Reemplazar el nombre original de la imagen por el nuevo
    rename($rutaDocServerTemp.''.$_FILES['imagen']['name'],$newName);
    #Ruta de la imagen con el nuevo nombre
    $nameBD = 'img/'.$idUser.'-'.$_POST['codigo'].'.'.$type;
    $objP->setNombre($_POST['nombre']);
    $objP->setExistencias($_POST['existencias']);
    $objP->setPrecio($_POST['precio']);
    $objP->setCosto($_POST['costo']);
    $objP->setDescripcion($_POST['descripcion']);
    $objP->setImagen($nameBD);
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
        $objP->setId($_POST['idEdit']);
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
        //elimina la imagen anterior
        unlink("../".$_POST['img']);
        //El nombre de la imagen tendra el id del usurio y codigo del producto para evitar 
        //conflicto con imagenes que tengan el mismo nombre
        //$newName = $rutaDocServer.''.$idUser.'-'.$_POST['codigo'].'.'.$type;
        $idUser = $objP->idUser($_POST['user']);
        #Extencion de la imagen
        $type = str_replace('image/','',$_FILES['imagen']['type']);
        #Nombre original de la imagen
        $nombreDoc = $_FILES['imagen']['name'];
        #Nombre temporal de la imagen
        $archivoDoc = $_FILES['imagen']['tmp_name'];
        #Ruta donde se guardan las imagenes temporalmente
        $rutaDocServerTemp = '../temp/';
        #Ruta donde se guardan las imagenes
        $rutaDocServer = '../img/';
        #Ruta donde se guardan las images + el nombre original de la imagen
        $rutaDocServerImg = $rutaDocServerTemp.''.$nombreDoc;
        #Mover la imagen al servidor temporalmente
        move_uploaded_file($archivoDoc, $rutaDocServerImg);
        #Asignar un nuevo nombre a la imagen
        $newName = $rutaDocServer.''.$idUser.'-'.$_POST['codigo'].'.'.$type;
        #Reemplazar el nombre original de la imagen por el nuevo
        rename($rutaDocServerTemp.''.$_FILES['imagen']['name'],$newName);
        #Ruta de la imagen con el nuevo nombre
        $nameBD = 'img/'.$idUser.'-'.$_POST['codigo'].'.'.$type;
        $objP->setNombre($_POST['nombre']);
        $objP->setExistencias($_POST['existencias']);
        $objP->setPrecio($_POST['precio']);
        $objP->setCosto($_POST['costo']);
        $objP->setDescripcion($_POST['descripcion']);
        $objP->setImagen($nameBD);
        $objP->setCodigo($_POST['codigo']);
        $objP->setId($_POST['idEdit']);
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
