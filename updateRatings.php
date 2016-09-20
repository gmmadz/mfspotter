<?php

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

include('config2.php');
$mysqli->autocommit(false);

$mysqli->query("UPDATE rating SET rating = $newProcessRating, dateRated = NOW() WHERE ratingID = $processID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newOutcomeRating, dateRated = NOW() WHERE ratingID = $outcomeID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newStructureRating, dateRated = NOW() WHERE ratingID = $structureID AND facilityID = $facilityID AND userID = $userID");
$mysqli->query("UPDATE rating SET rating = $newExperienceRating, dateRated = NOW()WHERE ratingID = $experienceID AND facilityID = $facilityID AND userID = $userID");        
$mysqli->commit();
              

?>