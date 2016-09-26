<?php

$insuranceNames = $_POST['insu'];


include('config2.php');
$mysqli->autocommit(false);

$mysqli->query("INSERT INTO insurances(insuranceName) VALUES ('".$insuranceNames."')" );
$mysqli->commit();
              

?>