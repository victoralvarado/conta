<?php 
define('HOST', "45.79.14.202");
define('USER', "Diego");
define('PASS', "Peoloco#12");
define('BD', "workflow_skinner");

	    function conectar()
		{
			$con = new mysqli(HOST, USER, PASS, BD);
			$con->set_charset('utf8');
			if ($con->connect_errno){
				echo "<h1><b><center>ERROR EN LA CONEXIÓN</center></b></h1>";
				die();
			}
			else
			{
			}

			
			return $con;
		}

	

 ?>