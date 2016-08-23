<?php

	$facility_id = $_GET["id"];

	$username="root";
	$password="usbw";
	$database="mfspotter";
	$operating_period = array();

	$connect = mysqli_connect("localhost", $username, $password, $database);  

	//INSURANNCES COVERED
 	$query2 = "SELECT * FROM operatingperiod WHERE facilityID = " . $facility_id . " ";

	$result2 = mysqli_query($connect, $query2); 

	if(mysqli_num_rows($result2) > 0)  
	{  
		while($row2 = mysqli_fetch_array($result2)) 
		{
		  $operating_period[] = array($row2['dayofweek'],$row2['timeOpened'], $row2['timeClosed']);

		}  

	} 

	for($row = 0; $row < count($operating_period); $row++)
	{
		for($col = 0; $col < 3; $col++)
		{
			if($operating_period[$row][$col] == 0)
			{
				$operating_period[$row][$col] = "Su";
				$days[] = $operating_period[$row][$col];

			}
			else if($operating_period[$row][$col] == 1)
			{
				$operating_period[$row][$col] = "Mo";
				$days[] = $operating_period[$row][$col];
			}
			else if($operating_period[$row][$col] == 2)
			{
				$operating_period[$row][$col] = "Tu";
				$days[] = $operating_period[$row][$col];
			}
			else if($operating_period[$row][$col] == 3)
			{
				$operating_period[$row][$col] = "We";
				$days[] = $operating_period[$row][$col];
			}
			else if($operating_period[$row][$col] == 4)
			{
				$operating_period[$row][$col] = "Th";
				$days[] = $operating_period[$row][$col];
			}
			else if($operating_period[$row][$col] == 5)
			{
				$operating_period[$row][$col] = "Fr";
				$days[] = $operating_period[$row][$col];
			}
			else if($operating_period[$row][$col] == 6)
			{
				$operating_period[$row][$col] = "Sa";
				$days[] = $operating_period[$row][$col];
			}


			echo ''. $operating_period[$row][$col] . "<br/>";
		}
		echo '<br/><br/>';
	}

	foreach($days as $i)
    {
      echo $i . ", ";

    }

?>


