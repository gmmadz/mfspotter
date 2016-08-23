<?php

	$facility_id = $_GET["id"];

	$username="root";
	$password="usbw";
	$database="mfspotter";


	$connect = mysqli_connect("localhost", $username, $password, $database);  

	//INSURANNCES COVERED
  $query4 = "SELECT comment, firstName, middleName, lastName, dateRated, timeRated FROM comment c, user u WHERE c.userID = u.userID AND facilityID = " . $facility_id . " ORDER BY dateRated DESC, timeRated DESC";

  $result4 = mysqli_query($connect, $query4); 

  if(mysqli_num_rows($result4) > 0)  
  {  
    while($row4 = mysqli_fetch_array($result4)) 
    {
      //$comments[] = array($row4['comment'], $row4['firstName'], $row4['middleName'], $row4['lastName']);
    	$name = implode(" ", array($row4['firstName'], $row4['middleName'], $row4['lastName']));
    	$comments[] = array('thecomment' => $row4['comment']);
    	$namae[] = array('thename' => $name);


    }  

  }

  /*
   for($row = 0; $row < count($comments); $row++){
   	 for($col = 0; $col < 4; $col++){



   	 	 echo ''. $comments[$row][$col] . ' ';
   	 }

   	 echo '<br/>';

   }*/

   foreach ($comments as $com => $c) 
   {
   		foreach ($c as $na => $n) {
   			echo $n . "<br/>";
   		}
   	}
?>


