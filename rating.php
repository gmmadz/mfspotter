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
        $remark = "";
        //$remarkId = 0;

    	//echo $id;
    	//echo $type;
    	//echo $userId;

        //Check if remark exists in database
        $validateRemark = "SELECT * FROM `remark` WHERE userID = $userId AND commentID = $id";

        $validation = mysqli_query($connect, $validateRemark);

        if(mysqli_num_rows($validation) > 0){
            while($row = mysqli_fetch_array($validation)){
                if($row['remarks'] == null){
                    $remark = "";
                }
                else{
                    //$remarkId = $row['remarkID']
                    $remark = $row['remarks'];
                }
               
            }
        }


        //Update only the remarks
        if($remark == "Like" || $remark == "Dislike"){

            if($_POST['type'] == 1){

                //Update the like remarks
                $updateLikeQ = "UPDATE remark SET remarks = 'Like' WHERE userID = $userId AND commentID = $id";

                $updateLike=mysqli_query($connect, $updateLikeQ);

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
                $updateDislikeQ = "UPDATE remark SET remarks = 'Dislike' WHERE userID = $userId AND commentID = $id";

                $updateDislike=mysqli_query($connect, $updateDislikeQ);

                //COUNT THE UPDATED TOTAL DISLIKES
                $countDislikeQ = "SELECT COUNT(remarkID) AS total FROM remark WHERE commentID = $id AND remarks = 'Dislike'";

                $countDislike=mysqli_query($connect, $countDislikeQ);

                if(mysqli_num_rows($countDislike) > 0){
                    if($row=mysqli_fetch_array($countDislike)){
                        $total = $row['total'];
                    }
                }
            }
        }
        else{
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
        }

	   echo '<meta http-equiv="refresh" content="0">';
	   echo $total;


	}
?>