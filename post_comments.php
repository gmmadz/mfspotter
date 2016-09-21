<?php
  $host="localhost";
  $username="root";
  $password="usbw";
  $database="mfspotter";

  $connect = mysqli_connect($host, $username, $password, $database);  


  if(isset($_POST['user_comm']) && isset($_POST['user_name']) && isset($_POST['facility_id']))
  {
    session_start();

    $comment=$_POST['user_comm'];
    $name=$_POST['user_name'];
    $facility=$_POST['facility_id'];


    //INSERT the comment into the database
    $insertquery = "INSERT INTO `comment`(`userID`, `facilityID`, `comment`, `dateRated`) VALUES ('$name','$facility', '$comment', CURRENT_TIMESTAMP)";

    $insert=mysqli_query($connect, $insertquery);


    
    $last_id = $connect->insert_id;
    $like_count = "'like_count". $last_id . "'";
    $dislike_count = "'dislike_count". $last_id . "'";


    //SELECT THE COMMENT ON THE DATABASE
    $selectquery = "SELECT firstName, middleName, lastName, comment,  DATE_FORMAT( dateRated,  '%Y-%m-%d %H:%i' ) AS dateRated FROM comment c, user u WHERE c.userID = u.userID AND c.userID='$name' AND facilityID='$facility' AND comment='$comment' AND commentID='$last_id'";

    $select=mysqli_query($connect, $selectquery);
    
    if(mysqli_num_rows($select) > 0)
    {
      if($row=mysqli_fetch_array($select))
      {
        $namae=$row['firstName']. " ". $row['middleName']. " ". $row['lastName'];
        $commentt=$row['comment'];
        $dateTime=$row['dateRated'];

        //Select Likes and Dislikes
        $selectquery2="SELECT COUNT(case when remarks = 'Like' then 1 end) as likes, COUNT(case when remarks = 'Dislike' then 1 end) as dislikes FROM remark WHERE commentID = '$last_id'";

        $selectRemarks=mysqli_query($connect, $selectquery2);


        if(mysqli_num_rows($selectRemarks) > 0){
          while($row2=mysqli_fetch_array($selectRemarks)){
            $likes = $row2['likes'];
            $dislikes = $row2['dislikes'];

          }
        

      ?>

          <div class="post">

            <div class="user-block">

              <img class="img-circle img-bordered-sm" src="/mfspotter/dist/img/profpic/<?php echo $_SESSION["profilePicture"] ?>.jpg" alt="user image">
                  <span class="username">
                    <a href="#"><?php echo ''. $namae . ''; ?></a>
                  </span>
              <span class="description"><?php echo ''. $dateTime . ''; ?></span>
            </div>
            <!-- /.user-block -->

            <!-- Like and Dislike Button Part -->
            <p><?php echo ''. $commentt . ''; ?></p>

              <div class="ratings">
                        
                <ul class="list-inline">
                  <li>
                    <!-- Like Icon HTML -->
                    <span class="glyphicon glyphicon-thumbs-up" onClick="cwRating('<?php echo $last_id ?>', 1, <?php echo $like_count ?>, '<?php echo $name ?>')"></span>&nbsp;

                    <!-- Like Counter -->
                    <span class="counter" id="<?php echo 'like_count'. $last_id ; ?>"><?php echo $likes ?></span>&nbsp;&nbsp;&nbsp;

                  </li>

                  <li>
                    <!-- Dislike Icon HTML -->
                    <span class="glyphicon glyphicon-thumbs-down" onClick="cwRating('<?php echo $last_id ?>', 0, <?php echo $dislike_count ?>, '<?php echo $name ?>')"></span>&nbsp;
                    <!-- Dislike Counter -->
                    <span class="counter" id="<?php echo 'dislike_count'. $last_id ; ?>"><?php echo $dislikes ?></span>&nbsp;&nbsp;&nbsp;
                  </li>
                </ul>
                </div> <!-- /. ratings -->
          </div>  <!-- /.post -->
      <?php
      }
      }
    }
      
    exit;
    } 


?>