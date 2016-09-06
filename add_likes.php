<?php
	$host="localhost";
	  $username="root";
	  $password="usbw";
	  $database="mfspotter";

	  $connect = mysqli_connect($host, $username, $password, $database);  

	if(!empty($_POST["id"])) {
		
		switch($_POST["action"]){
			case "like":
				$query = "INSERT INTO ipaddress_likes_map (ip_address,tutorial_id) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','" . $_POST["id"] . "')";
				$result = $db_handle->insertQuery($query);
				if(!empty($result)) {
					$query ="UPDATE tutorial SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
					$result = $db_handle->updateQuery($query);				
				}			
			break;		
			case "unlike":
				$query = "DELETE FROM ipaddress_likes_map WHERE ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' and tutorial_id = '" . $_POST["id"] . "'";
				$result = $db_handle->deleteQuery($query);
				if(!empty($result)) {
					$query ="UPDATE tutorial SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
					$result = $db_handle->updateQuery($query);
				}
			break;		
		}
	}
?>