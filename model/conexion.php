<?php
//error_reporting(0);
define('HOST', "localhost");
define('USER', "root");
define('PASS', "Itca123!");
define('BD', "bdtecnicascontables");
define('PASS2', "PHP4LIFE");


function conectar()
{
    $con = new mysqli(HOST, USER, PASS, BD);
    $con->set_charset('utf8');
    if ($con->connect_errno) {
    			$con=null;
    			$con = new mysqli(HOST, USER, PASS2, BD);
			    $con->set_charset('utf8');
			    if ($con->connect_errno) 
			    {
			    	echo "<h1><b><center>ERROR EN LA CONEXIÓN 2</center></b></h1>";
	        		die(); 
			    }     	
    } else {
        //echo "<h1><b><center>CONEXIÓN EXITOSA</center></b></h1>";
    }

    return $con;
}

conectar();
?>