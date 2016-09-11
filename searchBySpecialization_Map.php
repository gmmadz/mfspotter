
<?php

  $username="root";
  $password="usbw";
  $database="mfspotter";


  $insurances = $_GET["insurances"];


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
  $query = "SELECT f.facilityName AS Facility_Name, f.address, f.facilityID, f.longhitude, f.latitude
  FROM facility f, specialization s, hasspecialization hs
              WHERE f.facilityID = hs.facilityID AND s.specializationID = hs.specializationID
              AND s.specializationID IN ($insurances)
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