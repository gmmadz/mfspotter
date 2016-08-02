
<?php

  $username="root";
  $password="usbw";
  $database="mfspotter";


  $schedArray= $_GET['schedule'];
  $opening = $_GET['op'];
  $closing = $_GET['cl'];

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
$query = sprintf("SELECT f.facilityName, f.address, f.latitude, f.longhitude
        FROM facility f, operatingperiod op 
        WHERE f.facilityID = op.facilityID
        AND op.dayofweek IN('%s')
        AND op.timeOpened >= '%s'
        AND op.timeClosed <= '%s'
        GROUP BY f.facilityID",
  mysql_real_escape_string($schedArray),
  mysql_real_escape_string($opening),
  mysql_real_escape_string($closing));

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
    echo 'name="' . parseToXML($row['facilityName']) . '" ';
    echo 'address="' . parseToXML($row['address']) . '" ';
    echo 'lat="' . $row['latitude'] . '" ';
    echo 'lng="' . $row['longhitude'] . '" ';
    echo '/>';


  }

  // End XML file
 echo '</markers>';



?>