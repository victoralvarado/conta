<?php 

	session_start();
	if (isset($_SESSION['USER'])) {
		
	
	}else{
		header("Location: login.php");
	}

 ?>