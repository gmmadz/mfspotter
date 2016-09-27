<?php

  if(!(isset($_SESSION['username'])) && !(isset($_SESSION['password'])))
  {
    echo "<script>alert('Not Logged in!')</script>";
    redirect('login.php');
      
  }
    
  else
  {
    $type = $_SESSION['usertype'];
    $user = $_SESSION["user_id"];

    //Selecting the facility of the staff
    $selectQuery = "SELECT f.facilityID FROM facility f, facilityhasstaff fs, user u WHERE f.facilityID = fs.facilityID AND u.userID = fs.userID AND u.userID = '$user'";
    $SelectSql = @mysqli_query($connect, $selectQuery);
    $roww = mysqli_fetch_array($SelectSql);


    if($type == "staff"){
      echo ' <li><a href="staff_facilityProfile.php?id='. $roww['facilityID'] .'">Manage Medical Facility</a></li>';
    }
    

    echo '<li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="dist/img/profpic/'.$_SESSION["profilePicture"].'.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">'.$_SESSION["firstname"].' '.$_SESSION["lastname"] .'</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/profpic/'.$_SESSION["profilePicture"].'.jpg" class="img-circle" alt="User Image">

              <p>
                '.$_SESSION["firstname"].' '.$_SESSION["lastname"] .'
                <small>'. $_SESSION["usertype"] .'</small>
              </p>
            </li>';            
  }
    
  
  function redirect($url)
  {
    echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
    die();
  }

  
?>

   