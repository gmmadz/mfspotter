<?php

$dbhost="localhost"; 
$dbuser="root"; 
$dbpass="usbw";
$dbname="mfspotter"; 

$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_select_db($conn,$dbname);

if(!$conn)
	die('Could not connect to MySQL: ' . mysqli_error());

?>