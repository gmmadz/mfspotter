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

    $insertquery = "INSERT INTO `comment`(`userID`, `facilityID`, `comment`, `dateRated`) VALUES ('$name','$facility', '$comment', CURRENT_TIMESTAMP)";

    $insert=mysqli_query($connect, $insertquery);


    
    $last_id = $connect->insert_id;

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

            <p><?php echo ''. $commentt . ''; ?></p>
            <ul class="list-inline">
              <li><a href="#" onclick="return insert_like('<?php echo $name ?>','<?php echo $last_id ?>');" id="like_button" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
              </li>
              <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-down margin-r-5"></i> Dislike</a>
              </li>
            </ul>
          </div>  <!-- /.post -->
      <?php
      }
    }
      
    exit;
    } 


?>