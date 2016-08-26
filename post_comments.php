<?php
  $host="localhost";
  $username="root";
  $password="usbw";
  $database="mfspotter";

  $connect=mysql_connect($host,$username,$password);
  $db=mysql_select_db($database);

  if(isset($_POST['user_comm']) && isset($_POST['user_name']))
  {
    $comment=$_POST['user_comm'];
    $name=$_POST['user_name'];
    $facility=$_POST['facility_id'];


    $insert=mysql_query("INSERT INTO `comment`(`userID`, `facilityID`, `comment`, `dateRated`) VALUES ('$name','$facilty', '$comment', CURRENT_TIMESTAMP)");
    
    $id=mysql_insert_id($insert);

    $select=mysql_query("SELECT firstName, middleName, lastName, comment,  DATE_FORMAT( dateRated,  '%Y-%m-%d %H:%i' ) AS dateRated FROM comment c, user u WHERE c.userID = u.userID AND userID='$name' AND facilityID='$facility' AND comment='$comment' AND id='$id'");
    
    if($row=mysql_fetch_array($select))
    {
  	  $firstname=$row['firstName'];
      $middlename=$row['middleName'];
      $lastname=$row['lastName'];

  	  $comment=$row['comment'];
      $dateTime=$row['dateRated'];
    ?>

        <div class="post">

          <div class="user-block">

            <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/user1-128x128.jpg" alt="user image">
                <span class="username">
                  <a href="#"><?php echo ''. $firtname. ' ' . $middlename . ' ' . $lastname . ''; ?></a>
                </span>
            <span class="description"><?php echo ''. $dateTime . ''; ?></span>
          </div>
          <!-- /.user-block -->

          <p><?php echo ''. $comment . ''; ?></p>
          <ul class="list-inline">
            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
            </li>
            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-down margin-r-5"></i> Dislike</a>
            </li>
          </ul>
        </div>  <!-- /.post -->
    <?php
    }
  exit;
  } 

?>