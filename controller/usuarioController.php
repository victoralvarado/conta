<?php 

require_once 'model/Usuario.php';

if(isset($_POST['agregarUser'])){
	insertUser();
}

function insertUser()
{
	$objUsua = new Usuario();
}

?>