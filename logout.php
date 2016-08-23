<?php

	include("Landing.php");
	session_start();
	
	if((isset($_SESSION['username'])) && (isset($_SESSION['password'])))
	{
		// remove all session variables
		session_unset(); 
		
		redirect("login.php");
		
	}
		
?>