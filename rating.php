<?php
	$host="localhost";
	$username="root";
	$password="usbw";
	$database="mfspotter";

	$connect = mysqli_connect($host, $username, $password, $database); 


	if(isset($_POST['id']) && isset($_POST['type']) && isset($_POST['userId'])){

		$id=$_POST['id'];
    	$type=$_POST['type'];
    	$userId=$_POST['userId'];
    	$total = 0;

    	//echo $id;
    	//echo $type;
    	//echo $userId;

		//calculates the numbers of like or dislike
		if($_POST['type'] == 1){

			//Insert the like remarks
			$insertLikeQ = "INSERT INTO `remark`(`userID`, `commentID`, `remarks`) VALUES ($userId, $id,'Like')";

    		$insertLike=mysqli_query($connect, $insertLikeQ);

    		//COUNT THE UPDATED TOTAL LIKES
    		$countLikeQ = "SELECT COUNT(remarkID) AS total FROM remark WHERE commentID = $id AND remarks = 'Like'";

    		$countLike=mysqli_query($connect, $countLikeQ);

    		if(mysqli_num_rows($countLike) > 0){
    			if($row=mysqli_fetch_array($countLike)){
    				$total = $row['total'];
    			}
    		}

		}else{
			//Insert the dislike remarks
			$insertDislikeQ = "INSERT INTO `remark`(`userID`, `commentID`, `remarks`) VALUES ($userId, $id,'Dislike')";

    		$insertDislike=mysqli_query($connect, $insertDislikeQ);

    		//COUNT THE UPDATED TOTAL DISLIKES
    		$countDislikeQ = "SELECT COUNT(remarkID) AS total FROM remark WHERE commentID = $id AND remarks = 'Dislike'";

    		$countDislike=mysqli_query($connect, $countDislikeQ);

    		if(mysqli_num_rows($countDislike) > 0){
    			if($row=mysqli_fetch_array($countDislike)){
    				$total = $row['total'];
    			}
    		}
		}
		
		echo $total;
	}
?>