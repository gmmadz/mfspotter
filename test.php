<?php
    
  $facility_name = $_GET["id"];

  $username="root";
  $password="usbw";
  $database="mfspotter";

  echo $facility_name;

  $facilityddays = array("Mon", "Tues");
  echo "I like " . $facilityddays[0] . ", " . $facilityddays[1] . ".";

?>


