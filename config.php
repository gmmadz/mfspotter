<?php

$dbhost="localhost"; 
$dbuser="root"; 
$dbpass="usbw";
$dbname="mfspotter"; 

$connect = mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_select_db($connect,$dbname);

if(!$connect)
	die('Could not connect to MySQL: ' . mysqli_error());

?>