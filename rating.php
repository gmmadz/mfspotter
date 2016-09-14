<?php
	$host="localhost";
	$username="root";
	$password="usbw";
	$database="mfspotter";

	$connect = mysqli_connect($host, $username, $password, $database); 


	if(isset($_POST['id']) && isset($_POST['type']) && isset($_POST['like']) && isset($_POST['dislike'])){

		$id=$_POST['id'];
    	$type=$_POST['type'];
    	$prev_like=$_POST['like'];
    	$prev_dislike=$_POST['dislike'];

    	//echo $id;
    	//echo $type;
    	//echo $prev_likes;
    	//echo $prev_dislikes;

		/*previous comment data
		$prev_record = $tutorial->get_rows($_POST['id']);

		$selectQ = "SELECT * FROM comment WHERE commentID = $id";

    	$select=mysqli_query($connect, $selectQ);

    	if(mysqli_num_rows($select) > 0){
    		if($row=mysqli_fetch_array($select)){

    		}
    	}*/
		
		//calculates the numbers of like or dislike
		if($_POST['type'] == 1){
			$like = ($prev_like + 1);
			$dislike = $prev_dislike;
			$return_count = $like;
		}else{
			$like = $prev_like;
			$dislike = ($prev_dislike + 1);
			$return_count = $dislike;
		}
		
		//store update data
		$data = array('like_num'=>$like,'dislike_num'=>$dislike);
		//update condition
		$condition = array('id'=>$id);

		//update like dislike on comment table
		//$update = $tutorial->update($data,$condition);

		$data_array_num = count($data);
		$cols_vals = "";
		$condition_str = "";
		$i=0;

		foreach($data as $key=>$val){
			$i++;
			$sep = ($i == $data_array_num)?'':', ';
			$cols_vals .= $key."='".$val."'".$sep;
		}
		foreach($conditions as $key=>$val){
			$i++;
			$sep = ($i == $data_array_num)?"":" AND ";
			$condition_str .= $key."='".$val."'";
		}

		$updateSQL = "UPDATE tutorials SET $cols_vals WHERE $condition_str";

    	$insert=mysqli_query($connect, $updateSQL);


		//return $update?TRUE:FALSE;
		
		//return like or dislike number if update is successful, otherwise return error
		//echo $update?$return_count:'err';
		echo $return_count;
	}
?>