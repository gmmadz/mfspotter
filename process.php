<?php
include('config.php');

$type = $_POST['type'];


if($type == 'new')
{
	$facility_id = $_POST['facility_id'];
	$user_id = $_POST['user_id'];
	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
	$title = $_POST['title'];

	$insert = mysqli_query($conn,"INSERT INTO `calendar`(`title`, `startDate`, `endDate`, `allDay`, `userID`, `facilityID`) VALUES('$title','$startdate','$startdate','false','$user_id','$facility_id')");
	$lastid = mysqli_insert_id($conn);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'changetitle')
{
	$eventid = $_POST['eventid'];
	$title = $_POST['title'];

	$update = mysqli_query($conn,"UPDATE calendar SET title='$title' where calendarID='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate')
{
	$title = $_POST['title'];
	$startdate = $_POST['start'];
	$enddate = $_POST['end'];
	$eventid = $_POST['eventid'];


	$update = mysqli_query($conn,"UPDATE calendar SET title='$title', startDate = '$startdate', endDate = '$enddate' where calendarID='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_POST['eventid'];

	echo $eventid;
	echo "<br>";
	$delete = mysqli_query($conn,"DELETE FROM calendar where calendarID='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{
	$facility_id = $_POST['facility_id'];
	$user_id = $_POST['user_id'];

	$events = array();
	$query = mysqli_query($conn, "SELECT * FROM calendar WHERE facilityID = '$facility_id' AND userID = '$user_id'");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['calendarID'];
    $e['title'] = $fetch['title'];
    $e['start'] = $fetch['startDate'];
    $e['end'] = $fetch['endDate'];

    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}


?>