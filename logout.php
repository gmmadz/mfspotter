<?php
	include("Landing.php");

		if(isset($_COOKIE['usname']) && isset($_COOKIE['pword']))
		{
			//UNSET COOKIES
			setcookie('usname', "$user", time()-129600, '/');
			setcookie('pword', "$password", time()-129600, '/');
			
			redirect("login.php");
			
		}
		
?>