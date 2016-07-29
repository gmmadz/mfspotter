
<?php

$username="root";
$password="usbw";
$database="mfspotter";

$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];
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

/*$query = sprintf("SELECT address, facilityName, latitude, longhitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20";
*/
// Search the rows in the markers table
$query = sprintf("SELECT address, facilityName, latitude, longhitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);
/*
 
$query = " SELECT z.facilityname,
        z.latitude, z.longhitude,
        p.distance_unit
                 * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                 * COS(RADIANS(z.latitude))
                 * COS(RADIANS(p.longpoint) - RADIANS(z.longhitude))
                 + SIN(RADIANS(p.latpoint))
                 * SIN(RADIANS(z.latitude)))) AS distance_in_km
  FROM facility AS z
  JOIN (   
        SELECT  7.1907  AS latpoint,  125.4553 AS longpoint,
                25.0 AS radius,      111.045 AS distance_unit
    ) AS p ON 1=1
  WHERE z.latitude
     BETWEEN p.latpoint  - (p.radius / p.distance_unit)
         AND p.latpoint  + (p.radius / p.distance_unit)
    AND z.longhitude
     BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
         AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
  ORDER BY distance_in_km
  LIMIT 10";
*/

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
  echo 'type="'. $row['distance'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>