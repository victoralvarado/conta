<?php
$mysqli = new mysqli("localhost", "root", "Itca123!", "bdtecnicascontables");

define('HOST', "localhost");
define('USER', "root");
define('PASS', "Itca123!");
define('BD', "bdtecnicascontables");

	    function conectar()
		{
			$con = new mysqli(HOST, USER, PASS, BD);
			$con->set_charset('utf8');
			if ($con->connect_errno){
				echo "<h1><b><center>ERROR EN LA CONEXIÓN</center></b></h1>";
				die();
			}

			return $con;
		}
?>