<?php 

require_once '../model/Usuario.php';

if(isset($_POST['agregarUser'])){
	insertUser();
}

if(isset($_POST['enviar'])){
	inises();
}

function insertUser()
{
	$objUsua = new Usuario();
	$objUsua->setNombre($_POST['nombre']);
	$objUsua->setUsuario($_POST['user']);
	$objUsua->setContra(sha1($_POST['pass']));
	$res = $objUsua->saveUser();
	if($res['estado']==true)
	{
		echo '
		<script type="text/javascript">
				setTimeout( function(){ 
                    location.assign("../login.php");
                }, 1500 );
		</script>';
	}
	else
	{
		echo '
		<script type="text/javascript">
				alert("Error al registrarse en el sistema");
				location.assign("../login.php");
		</script>';
	}
}

function inises()
{
	$objUsuario = new Usuario();
	$objUsuario->setUsuario($_POST['user']);
	$objUsuario->setContra($_POST['pass']);
	$res = $objUsuario->login();
	//session_start();
	//$_SESSION['RES'] = $res['descripcion'];
	if(isset($_SESSION['USER'])){
		header('Location: ../index.php');
	}
	else
	{
		$ban = $objUsuario->errorLogin();
		if($ban['descripcion']=='baneado')
		{
			echo '<script type="text/javascript">
			alert("Usuario bloqueado");
			location.assign("../login.php");
			</script>';
		}
		else
		{
			echo '<script type="text/javascript">
			alert("Error al iniciar sesión");
			location.assign("../login.php");
			</script>';
		}
	}
}
