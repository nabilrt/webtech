<?php 
	session_start();
    require_once "../controller/dltprofile.php";
    
   if( delete_account($_SESSION['NID']))
   {
   

	if (isset($_SESSION['NID'])) {
		session_destroy();
		header("location: renterlogin.php");
	}
	else{
		header("location: renterlogin.php");
	}
}

 ?>