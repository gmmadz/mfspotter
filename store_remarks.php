<?php
  	$host="localhost";
	$username="root";
	$password="usbw";
	$database="mfspotter";

	$connect = mysqli_connect("localhost", $username, $password, $database);
  
	if(isset($_POST['post_like']) && isset($_POST['user_id']) && isset($_POST['comment_id']))
	{
		$comment=$_POST['comment_id'];
   		$user=$_POST['user_id'];
   		$remarks="Like";
	    
		//echo $user;
		//echo $comment;
		//echo $remarks;	

	  	$insertquery = "INSERT INTO `remark`(`userID`, `commentID`, `remarks`) VALUES ('$user','$comment', '$remarks')";
	 	$insert=mysqli_query($connect, $insertquery);

	 	$last_id = $connect->insert_id;

	 	//Select Likes
	 	$selectquery="SELECT COUNT(remarkID) AS likes FROM `remark` WHERE commentID = '$comment' AND remarks = '$remarks'";

	  	$selectLikes=mysqli_query($connect, $selectquery);

	  	//SELECT Dislikes
	  	$selectquery2="SELECT COUNT(remarkID) AS dislikes FROM `remark` WHERE commentID = '$comment' AND remarks = 'Dislike'";

	  	$selectDislikes=mysqli_query($connect, $selectquery);


	  	if(mysqli_num_rows($selectLikes) > 0){

	  		while($row=mysqli_fetch_array($selectLikes))
			{
				$likes = $row['likes'];

			}

	  	}

	  	echo $likes;
	  	return $likes;
	  	
	}


	

  
?>