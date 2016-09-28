
<?php

  $username="root";
  $password="usbw";
  $database="mfspotter";

	$latitude = $_GET['lati'];
	$longhitude = $_GET['longi'];
	$insurancesIDs = $_GET['insu'];
	$specializationIDs = $_GET['specia'];
	$radius = $_GET['radi'];
	$daysOfWeek = $_GET['days'];
	$openingTime = $_GET['open'];
	$closingTime = $_GET['close'];


  function parseToXML($htmlStr)
  {
  $xmlStr=str_replace('<','&lt;',$htmlStr);
  $xmlStr=str_replace('>','&gt;',$xmlStr);
  $xmlStr=str_replace('"','&quot;',$xmlStr);
  $xmlStr=str_replace("'",'&#39;',$xmlStr);
  $xmlStr=str_replace("&",'&amp;',$xmlStr);
  return $xmlStr;
  }

  // Opens a connection to a MySQL server
  $connection=mysql_connect ('localhost', $username, $password);
  if (!$connection) {
    die('Not connected : ' . mysql_error());
  }

  // Set the active MySQL database
  $db_selected = mysql_select_db($database, $connection);
  if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
  }

  // Search the rows in the markers table
 $query = "SELECT f.facilityName AS Facility_Name, f.facilityID, f.latitude, f.longhitude, f.address
	        FROM facility f, operatingperiod op 
	        WHERE f.facilityID = op.facilityID
	        AND op.dayofweek IN($daysOfWeek)
	        AND op.timeOpened >= '$openingTime'
	        AND op.timeClosed <= '$closingTime'
	        AND f.facilityID IN(   
                SELECT DISTINCT f.facilityID 
                FROM facility f, insurances i, insurancesCovered ic, specialization s, hasspecialization hs
                WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID AND s.specializationID = hs.specializationID 
                AND hs.facilityID = f.facilityID
                AND i.insurancesID IN ($insurancesIDs) AND s.specializationID IN ($specializationIDs) 
                AND f.facilityID IN 
                        (SELECT facilityID 
                        	FROM facility 
                        	WHERE (6371 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians($longhitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) ) < $radius))
        	GROUP BY f.facilityID";



  $result = mysql_query($query);

  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }

  header("Content-type: text/xml");

  // Start XML file, echo parent node
  echo '<markers>';

  // Iterate through the rows, printing XML nodes for each
  while ($row = @mysql_fetch_assoc($result)){
    // ADD TO XML DOCUMENT NODE
    echo '<marker ';
    echo 'name="' . parseToXML($row['Facility_Name']) . '" ';
    echo 'address="' . parseToXML($row['address']) . '" ';
    echo 'lat="' . $row['latitude'] . '" ';
    echo 'lng="' . $row['longhitude'] . '" ';
    echo '/>';


  }

  // End XML file
 echo '</markers>';



?>