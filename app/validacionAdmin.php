<?php 

	session_start();
	if (strpos($_SESSION['ROL'], '1') !== FALSE) {
		
	
	}else{
		if(isset($_SESSION['ROL']))
		{
			header("Location: ../index.php");
		}
		else
		{
			header("Location: ../login.php");
		}
	}

 ?>