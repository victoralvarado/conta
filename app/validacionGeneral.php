<?php 

	session_start();
	if (isset($_SESSION['ROL'])) {
		
	
	}else{
		header("Location: http://www.skinner.cl/workflow/login.php");
	}

 ?>