<?php
  $host="localhost";
  $username="root";
  $password="usbw";
  $database="mfspotter";

  $connect = mysqli_connect($host, $username, $password, $database);  


  if(isset($_POST['user_comm']) && isset($_POST['user_name']) && isset($_POST['facility_id']))
  {

    $comment=$_POST['user_comm'];
    $name=$_POST['user_name'];
    $facility=$_POST['facility_id'];


    //INSERT the comment into the database
    $insertquery = "INSERT INTO `comment`(`userID`, `facilityID`, `comment`, `dateRated`) VALUES ('$name','$facility', '$comment', CURRENT_TIMESTAMP)";

    $insert=mysqli_query($connect, $insertquery);


    
    $last_id = $connect->insert_id;

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
      ?>

          <div class="post">

            <div class="user-block">

              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/user1-128x128.jpg" alt="user image">
                  <span class="username">
                    <a href="#"><?php echo ''. $namae . ''; ?></a>
                  </span>
              <span class="description"><?php echo ''. $dateTime . ''; ?></span>
            </div>
            <!-- /.user-block -->

            <!-- Like and Dislike Button Part -->
            <p><?php echo ''. $commentt . ''; ?></p>
              <ul class="list-inline">
                <li>
                  <!-- Like Icon HTML -->
                  <span class="glyphicon glyphicon-thumbs-up" onClick="cwRating('. $comID .', 1, '. $like_count .', '. $uID .')"></span>&nbsp;

                  <!-- Like Counter -->
                  <span class="counter" id="like_count'. $comID.'">0</span>&nbsp;&nbsp;&nbsp;

                </li>

                <li>
                  <!-- Dislike Icon HTML -->
                  <span class="glyphicon glyphicon-thumbs-down" onClick="cwRating('. $comID .', 0, '. $dislike_count .', '. $uID .')"></span>&nbsp;
                  <!-- Dislike Counter -->
                  <span class="counter" id="dislike_count'. $comID.'">0</span>&nbsp;&nbsp;&nbsp;
                </li>
              </ul>
          </div>  <!-- /.post -->
      <?php
      }
    }
      
    exit;
    } 


?>