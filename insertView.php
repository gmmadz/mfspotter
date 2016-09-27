<?php 

	$facility_id = $_GET["id"];
	
	session_start();
	$user_id = $_SESSION['user_id'];
	include('config2.php');
	$mysqli->autocommit(false);


  	//INSERT INTO RATING PROCESS
    $mysqli->query("INSERT INTO `views`(`facilityID`, `userID`) VALUES ('". $facility_id ."', '". $user_id ."')");

    $mysqli->commit();

   	$url = "facilityProfile.php?id=".$facility_id;

    redirect($url);

    function redirect($url)
	{
	   echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
	   die();
	}


?>