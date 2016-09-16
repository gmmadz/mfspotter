<?php


$username="root";
$password="usbw";
$database="mfspotter";

$newProcessRating = $_POST['pval'];
$newOutcomeRating = $_POST['oval'];
$newStructureRating = $_POST['sval'];
$newExperienceRating = $_POST['eval'];

$processID = $_POST['pid'];
$outcomeID = $_POST['oid'];
$structureID = $_POST['sid'];
$experienceID = $_POST['eid'];


$userID = $_POST['usid'];
$facilityID = $_POST['faid'];

$mysqli = new mysqli("localhost", $username, $password, $database); 
$mysqli->autocommit(false);

$mysqli->query("UPDATE rating SET rating = $newProcessRating WHERE ratingID = $processID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newOutcomeRating WHERE ratingID = $outcomeID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newStructureRating WHERE ratingID = $structureID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newExperienceRating WHERE ratingID = $experienceID AND facilityID = $facilityID AND userID = $userID");        
$mysqli->commit();
              

?>