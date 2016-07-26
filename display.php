
<?php

$username="root";
$password="usbw";
$database="mfspotter";

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

// Select all the rows in the markers table
$query = sprintf("SELECT address, facilityName, latitude, longhitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
 

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
  echo 'type="ba" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>