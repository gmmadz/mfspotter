
<?php 
    
  $facility_id = $_GET["id"];
  session_start();
 
  include('config.php');
  $operating_period = array();
  $special = array();
  $insurance_name = array();

  //Facility
  $query = "SELECT * FROM `facility` WHERE facilityID = " . $facility_id . " ";

  $result = mysqli_query($connect, $query); 

  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      $facility_name = $row['facilityName'];
      $facility_tel = $row['telephoneNumber'];
      $facility_address = $row['address'];
      $facility_lat = $row['latitude'];
      $facility_lng = $row['longhitude'];
      $facility_picture = $row['facilityPicture'];
    }  
    
  }

  //Specialization
  $query4 = "SELECT specialization FROM specialization sp, hasspecialization hs, facility f WHERE f.facilityID = hs.facilityID AND sp.specializationID = hs.specializationID AND f.facilityID = " . $facility_id . " ";

  $result4 = mysqli_query($connect, $query4); 

  if(mysqli_num_rows($result4) > 0)  
  {  
    while($row4 = mysqli_fetch_array($result4)) 
    {
      $special[] = $row4['specialization'];
    }  
    
  }


  //OPERATING HOURS
  $query2 = "SELECT dayofweek, DATE_FORMAT(timeOpened, '%h:%i %p') AS Opening_Time, DATE_FORMAT(timeClosed, '%h:%i %p') AS Closing_Time FROM `operatingperiod` WHERE facilityID = " . $facility_id . " ";

  $result2 = mysqli_query($connect, $query2); 

  if(mysqli_num_rows($result2) > 0)  
  {  
    while($row2 = mysqli_fetch_array($result2)) 
    {
      $operating_period[] = array($row2['dayofweek'],$row2['Opening_Time'], $row2['Closing_Time']);

    }  

  } 

  //INSURANCES COVERED
  //$query3 = "SELECT * FROM insurances WHERE insurancesID IN ( SELECT insurancesID FROM insurancescovered WHERE facilityID = " . $facility_id . " )";
  $query3 = "SELECT insuranceName FROM insurances i, insurancescovered ic WHERE i.insurancesID = ic.insuranceID AND ic.facilityID = " . $facility_id . "";
  $result3 = mysqli_query($connect, $query3); 

  if(mysqli_num_rows($result3) > 0)  
  {  
    while($row3 = mysqli_fetch_array($result3)) 
    {
      $insurance_name[] = $row3['insuranceName'];

    }  

  } 

  
  
  //COMMENTS
   /*$query4 = "SELECT comment, firstName, middleName, lastName, dateRated, timeRated FROM comment c, user u WHERE c.userID = u.userID AND facilityID = " . $facility_id . " ORDER BY dateRated DESC, timeRated DESC";

  $result4 = mysqli_query($connect, $query4); 

  if(mysqli_num_rows($result4) > 0)  
  {  
    while($row4 = mysqli_fetch_array($result4)) 
    {
      $name = implode(" ", array($row4['firstName'], $row4['middleName'], $row4['lastName']));
      $comments[] = array($row4['comment'], $name, $row4['dateRated']);

    }  

  }*/



  //RATINGS
  //$mysqli = new mysqli('localhost', 'root', 'usbw', 'mfspotter');
  include('config2.php');
  $mysqli->autocommit(false);
  
    if(isset($_POST['submitted']))
    {
       
        $facilityID = $facility_id;

        $userID = $_SESSION["user_id"];
        $process = $_POST['rating-process'];
        $outcomes = $_POST['rating-outcome'];
        $structure = $_POST['rating-structure'];
        $experience = $_POST['rating-experience'];
        echo $experience;

        //INSERT INTO RATING PROCESS
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '1', '$process', now() )");

        //INSERT INTO RATING OUTCOMES
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '2', '$outcomes', now() )");

        //INSERT INTO RATING STRUCTURE
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '3', '$structure', now() )");

        //INSERT INTO RATING EXPERIENCE
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '4', '$experience', now() )");



        $mysqli->commit();
           
    }

function getOverallVotePerID($id){

  include('config.php');
 // $query = "SELECT AVG(rating) as overall FROM rating, facility WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id." AND dateRated >= DATE_SUB(NOW(),INTERVAL 1 YEAR) GROUP BY facility.facilityID";
  $query = "SELECT AVG(rating) as overall, (SELECT AVG(rating) as last FROM rating WHERE dateRated <= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND rating.facilityID = ".$id.")/2 as oneYearBefore
  FROM rating, facility 
  WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id."
            AND dateRated >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
            GROUP BY facility.facilityID";

  $result = mysqli_query($connect, $query);

  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {

      if($row['oneYearBefore'] == null)
      {
        return number_format($row['overall'],2);
      }
      else
      {
        
        return number_format(($row['overall'] + $row['oneYearBefore'])/2 ,2);
        
      }
    }
  }
  else
  {
    return 0;
  }
}

function getTotalVotesPerCategory($category, $fid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT count(categoryID) as total FROM `rating` WHERE categoryID = ".$category." AND ".$fid." GROUP BY categoryID";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      return $row['total'];
    }  
    
  }
  else
  {
    return 0;
  }
 
}

function getAverageVotePerCategory($category, $id){ //lagyan ng ID
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT AVG(rating) as overall FROM `rating` WHERE categoryID = ".$category." AND facilityID = ".$id." GROUP BY categoryID";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      return number_format($row['overall'],2);
    }  
    
  }
  else
  {
    return 0;
  }
 
}

function getCountVotePerCategoryTotal($id, $category){ //lagyan ng ID
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT count(categoryID) as overall FROM `rating` WHERE categoryID = ".$category." AND facilityID = ".$id." GROUP BY categoryID";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      return number_format($row['overall'],2);
    }  
    
  }
  else
  {
    return 0;
  }
 
}

function getTotalVotes($rating, $category, $id){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT count(categoryID) as totalVotes FROM `rating` WHERE categoryID = ".$category."  AND rating = ".$rating." AND facilityID = ".$id." GROUP BY categoryID";

  $result = mysqli_query($connect, $query);

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result))
    {
      return $row['totalVotes']; 
    }
  }
  else
  {
    return 0;
  }
}



function userHasVoted($id, $facid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 

  $query = "SELECT * FROM rating WHERE userID = ".$id." AND facilityID = ".$facid." LIMIT 1";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result)) return true;
  else return false;

}


function getRatingID($id, $facid, $catid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 

  $query = "SELECT categoryID, ratingID, rating FROM rating WHERE userID = ".$id." AND facilityID = ".$facid." AND categoryID = ".$catid." ";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_array($result))
    {
      return $row['ratingID']; 
    }
  }
  else 
    return false;

}

function getRatingValue($id, $facid, $catid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 

  $query = "SELECT categoryID, ratingID, rating FROM rating WHERE userID = ".$id." AND facilityID = ".$facid." AND categoryID = ".$catid." ";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_array($result))
    {
      return $row['rating']; 
    }
  }
  else 
    return false;

}






if(getCountVotePerCategoryTotal($facility_id,1) == 0 && getCountVotePerCategoryTotal($facility_id,2) == 0 && getCountVotePerCategoryTotal($facility_id,3) == 0 && getCountVotePerCategoryTotal($facility_id,4) == 0){
 
  $processFive = 0;
  $processFour = 0;
  $processThree = 0;
  $processTwo = 0;
  $processOne = 0;

  $outcomeFive = 0;
  $outcomeFour = 0;
  $outcomeThree = 0;
  $outcomeTwo = 0;
  $outcomeOne = 0;

  $structureFive = 0;
  $structureFour = 0;
  $structureThree = 0;
  $structureTwo = 0;
  $structureOne = 0;

  $experienceFive = 0;
  $experienceFour = 0;
  $experienceThree = 0;
  $experienceTwo = 0;
  $experienceOne = 0;

}

else{
  $processFive = (getTotalVotes(5,1, $facility_id)/getCountVotePerCategoryTotal($facility_id, 1))*100;
  $processFour = (getTotalVotes(4,1, $facility_id)/getCountVotePerCategoryTotal($facility_id, 1))*100;
  $processThree = (getTotalVotes(3,1, $facility_id)/getCountVotePerCategoryTotal($facility_id, 1))*100;
  $processTwo = (getTotalVotes(2,1, $facility_id)/getCountVotePerCategoryTotal($facility_id, 1))*100;
  $processOne = (getTotalVotes(1,1, $facility_id)/getCountVotePerCategoryTotal($facility_id, 1))*100;

  $outcomeFive = (getTotalVotes(5,2, $facility_id)/getCountVotePerCategoryTotal($facility_id, 2))*100;
  $outcomeFour = (getTotalVotes(4,2, $facility_id)/getCountVotePerCategoryTotal($facility_id, 2))*100;
  $outcomeThree = (getTotalVotes(3,2, $facility_id)/getCountVotePerCategoryTotal($facility_id, 2))*100;
  $outcomeTwo = (getTotalVotes(2,2, $facility_id)/getCountVotePerCategoryTotal($facility_id, 2))*100;
  $outcomeOne = (getTotalVotes(1,2, $facility_id)/getCountVotePerCategoryTotal($facility_id, 2))*100;

  $structureFive = (getTotalVotes(5,3, $facility_id)/getCountVotePerCategoryTotal($facility_id, 3))*100;
  $structureFour = (getTotalVotes(4,3, $facility_id)/getCountVotePerCategoryTotal($facility_id, 3))*100;
  $structureThree = (getTotalVotes(3,3, $facility_id)/getCountVotePerCategoryTotal($facility_id, 3))*100;
  $structureTwo = (getTotalVotes(2,3, $facility_id)/getCountVotePerCategoryTotal($facility_id, 3))*100;
  $structureOne = (getTotalVotes(1,3, $facility_id)/getCountVotePerCategoryTotal($facility_id, 3))*100;

  $experienceFive = (getTotalVotes(5,4, $facility_id)/getCountVotePerCategoryTotal($facility_id, 4))*100;
  $experienceFour = (getTotalVotes(4,4, $facility_id)/getCountVotePerCategoryTotal($facility_id, 4))*100;
  $experienceThree = (getTotalVotes(3,4, $facility_id)/getCountVotePerCategoryTotal($facility_id, 4))*100;
  $experienceTwo = (getTotalVotes(2,4, $facility_id)/getCountVotePerCategoryTotal($facility_id, 4))*100;
  $experienceOne = (getTotalVotes(1,4, $facility_id)/getCountVotePerCategoryTotal($facility_id, 4))*100;
}








$overallRating =(getAverageVotePerCategory(1, $facility_id) + getAverageVotePerCategory(2, $facility_id) + getAverageVotePerCategory(3, $facility_id) + getAverageVotePerCategory(4, $facility_id))/4;













?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
   <!--LINKS included on the page -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $facility_name ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!--RATEIT-->
  <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/themes/fontawesome-stars.css">
  <link rel="stylesheet" href="dist/themes/fontawesome-stars-o.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">

  .glyphicon-thumbs-up:hover{ color:#008000; cursor:pointer;}
  .glyphicon-thumbs-down:hover{ color: #E10000; cursor:pointer;}
  .counter{ color:#333333;}


  .icon-success {
    color: #008000;
  }

  .icon-fail {
    color: #E10000;
  }


  </style>
<script type="text/javascript">



  </script>

  
</head>

<body class="hold-transition skin-green layout-top-nav" onload="load()">

<div class="wrapper">

  <!-Main Header->
   <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <div class="navbar-header">
        <a href="../mfspotter/Landing.php" class="navbar-brand"><b>MFS</b>potter</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
          
      <!-Menu on the left side->
       
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
         <!-- User Account: style can be found in dropdown.less -->

          <?php
            include("config.php");
            
            include("header.php");
          ?>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
        <!-- /.navbar -->

    </nav>

  </header>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Facility Profile
        </h1>
      </section>


    <!- Main content -->
      <!-- Your Page Content Here -->
      <section class="content">
        <div class="row">

          <!- RIGHT SIDE MORE ON FACILITY DETAILS ->
          <div class="col-md-3">

            <!-- Profile-->
            <div class="box box-primary box-success">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive" src="/mfspotter/dist/img/facilitypic/<?php echo $facility_picture ?>.jpg" alt="User profile picture">
                <?php
                  echo '
                  <label id="facility_lati" for="'. $facility_lat . '"></label>
                  <label id="facility_long" for="'. $facility_lng. '"></label>
                  <label id="facility_name" for="'. $facility_name. '"></label>
                  ';
                ?>
                <h3 class="profile-username text-center"><?php echo $facility_name ?></h3>

                <ul class="list-group list-group-unbordered">

                  <li class="list-group-item">
                    <b>Overall Rating</b> 
                        <a class="pull-right">
                          <div class="rateit" data-rateit-value="<?php echo getOverallVotePerID($facility_id)?>"  data-rateit-ispreset="true" data-rateit-readonly="true">
                          </div>

                        </a>
                  </li>

                  <!-add php script to hide this if user has already voted->
                  <li class="list-group-item">
                    <b>View Rating Details</b> 
                        <a class="pull-right">
                         <b><a data-toggle="modal" href="#ratingDetailsModal" class="pull-right"><?php echo number_format(getOverallVotePerID($facility_id),2)?></a></b>

                        </a>
                  </li>


                  <li class="list-group-item">
                    <b>Operating Hours</b> <a class="pull-right">
                    <?php
                      for($row = 0; $row < count($operating_period); $row++)
                      {

                        //FOR THE DAYS
                        if($operating_period[$row][0] == 0)
                        {
                          $operating_period[$row][0] = "Su";
                          //$days[] = $operating_period[$row][$col];

                        }
                        else if($operating_period[$row][0] == 1)
                        {
                          $operating_period[$row][0] = "Mo";
                          //$days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][0] == 2)
                        {
                          $operating_period[$row][0] = "Tu";
                          //$days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][0] == 3)
                        {
                          $operating_period[$row][0] = "We";
                          //$days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][0] == 4)
                        {
                          $operating_period[$row][0] = "Th";
                          //$days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][0] == 5)
                        {
                          $operating_period[$row][0] = "Fr";
                          //$days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][0] == 6)
                        {
                          $operating_period[$row][0] = "Sa";
                          //$days[] = $operating_period[$row][$col];
                        }


                        echo ''. $operating_period[$row][0] . ' '. $operating_period[$row][1] .' - '. $operating_period[$row][2] ;

                      
                        echo '<br/>';

                      }

                    ?>


                    </a>
                    <?php

                      for($i = 0; $i < count($operating_period); $i++)
                      {
                        echo "</br>";
                      }

                     ?>

                  </li>
                  <li class="list-group-item">
                    <b>Telephone Number</b> <a class="pull-right"><?php echo $facility_tel ?></a>
                  </li>
                </ul>

                 <a href="appointment.php?id=<?php echo $facility_id ?>" class="btn btn-success btn-block"><b>Set an Appointment</b></a>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About the Facility-->
            <div class="box box-primary box-success">
              <div class="box-header with-border">
                <h3 class="box-title">About the Facility</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Specialization</strong>

                <p class="text-muted">
                  <?php
                    foreach($special as $sp)
                    {
                      echo '<span class="label label-success">'. $sp .'</span> ';

                    }
                
                  ?>
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted"><?php echo $facility_address ?></p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> Insurances Included</strong>

                <p>
                  <?php
                    foreach($insurance_name as $i)
                    {
                      echo '<span class="label label-success">'. $i .'</span> ';

                    }
                
                  ?>
                </p>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box on About the Facility -->

            <!-- Ratings -->
        


          </div>
          <!-- /.col -->
     


   

        <!-RATING DETAILS MODAL->
        <div class="modal fade modal-default" id="ratingDetailsModal">
           <div class="modal-dialog">
                   
              <div class="modal-content">
                      
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Rating Details</h4>
                </div>
                      
                <div class="modal-body">
                  <div class="col-md-12">
                    <div class="nav-tabs-custom">
                          
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Process</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Outcomes</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Structure</a></li>
                            <li><a href="#tab_4" data-toggle="tab">Experience</a></li>
                          </ul>
                          

                          <div class="tab-content">
                            
                            <div class="tab-pane active" id="tab_1">
                                


                                <div class="progress-group">
                                  <span class="progress-text"> 
                                            <select class="rating-display-five">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                  </span>
                                  <span class="progress-number"><b><?php echo getTotalVotes(5,1, $facility_id); ?></b> votes</span>

                                  <div class="progress md">
                                     <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processFive."%"?>"> <?php echo number_format($processFive,2) ." %"?> </div> 
                                  </div>
                                </div>

                                <div class="progress-group">
                                  <span class="progress-text"> 
                                            <select class="rating-display-four">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                  </span>
                                  <span class="progress-number"><b><?php echo getTotalVotes(4,1, $facility_id); ?></b> votes</span>

                                  <div class="progress md">
                                    <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processFour."%"?>"><?php echo number_format($processFour,2)." %"?></div>
                                  </div>
                                </div>


                                <div class="progress-group">
                                  <span class="progress-text"> 
                                            <select class="rating-display-three">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                  </span>
                                  <span class="progress-number"><b><?php echo getTotalVotes(3,1, $facility_id); ?></b> votes</span>

                                  <div class="progress md">
                                    <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processThree."%"?>"><?php echo number_format($processThree,2) ." %"?></div>
                                  </div>
                                </div>


                                <div class="progress-group">
                                  <span class="progress-text"> 
                                            <select class="rating-display-two">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                  </span>
                                  <span class="progress-number"><b><?php echo getTotalVotes(2,1, $facility_id); ?></b> votes</span>

                                  <div class="progress md">
                                    <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processTwo."%"?>"><?php echo number_format($processTwo,2) ." %"?></div>
                                  </div>
                                </div>

                                <div class="progress-group">
                                  <span class="progress-text"> 
                                            <select class="rating-display-one">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                  </span>
                                  <span class="progress-number"><b><?php echo getTotalVotes(1,1, $facility_id); ?></b> votes</span>

                                  <div class="progress md">
                                    <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processOne."%"?>"><?php echo number_format($processOne,2) ." %"?></div>
                                  </div>
                                </div>




                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
              
                                <div class="progress-group">
                                <span class="progress-text"> 
                                          <select class="rating-display-five">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                </span>
                                <span class="progress-number"><b><?php echo getTotalVotes(5,2, $facility_id); ?></b> votes</span>

                                <div class="progress md">
                                   <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeFive."%"?>"> <?php echo number_format($outcomeFive) ." %"?> </div> 
                                </div>
                              </div>

                              <div class="progress-group">
                                <span class="progress-text"> 
                                          <select class="rating-display-four">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                </span>
                                <span class="progress-number"><b><?php echo getTotalVotes(4,2, $facility_id); ?></b> votes</span>

                                <div class="progress md">
                                  <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeFour."%"?>"><?php echo number_format($outcomeFour)." %"?></div>
                                </div>
                              </div>


                              <div class="progress-group">
                                <span class="progress-text"> 
                                          <select class="rating-display-three">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                </span>
                                <span class="progress-number"><b><?php echo getTotalVotes(3,2, $facility_id); ?></b> votes</span>

                                <div class="progress md">
                                  <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeThree."%"?>"><?php echo number_format($outcomeThree)." %"?></div>
                                </div>
                              </div>


                              <div class="progress-group">
                                <span class="progress-text"> 
                                          <select class="rating-display-two">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                </span>
                                <span class="progress-number"><b><?php echo getTotalVotes(2,2, $facility_id); ?></b> votes</span>

                                <div class="progress md">
                                  <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeTwo."%"?>"><?php echo number_format($outcomeTwo)." %"?></div>
                                </div>
                              </div>

                              <div class="progress-group">
                                <span class="progress-text"> 
                                          <select class="rating-display-one">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                </span>
                                <span class="progress-number"><b><?php echo getTotalVotes(1,2, $facility_id); ?></b> votes</span>

                                <div class="progress md">
                                  <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeOne."%"?>"><?php echo number_format($outcomeOne)." %"?></div>
                                </div>
                              </div>

                            </div>
                            <!-- /.tab-pane -->



                            <div class="tab-pane" id="tab_3">
                  
                              <!-- /.post -->


                              <!-STRUCTURE CATEGORY DETAILS->
                            

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,3, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureFive."%"?>"> <?php echo number_format($structureFive)." %"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,3, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureFour."%"?>"><?php echo number_format($structureFour)." %"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,3, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureThree."%"?>"><?php echo number_format($structureThree)." %"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,3, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureTwo."%"?>"><?php echo number_format($structureTwo)." %"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,3, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureOne."%"?>"><?php echo number_format($structureOne)." %"?></div>
                              </div>
                            </div>




                            </div>
                     
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">
                         

                              <!-STRUCTURE CATEGORY DETAILS->
                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,4, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceFive."%"?>"> <?php echo number_format($experienceFive)." %"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,4, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceFour."%"?>"><?php echo number_format($experienceFour)." %"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,4, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceThree."%"?>"><?php echo number_format($experienceThree)." %"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,4, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceTwo."%"?>"><?php echo number_format($experienceTwo)." %"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,4, $facility_id); ?></b> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceOne."%"?>"><?php echo number_format($experienceOne)." %"?></div>
                              </div>
                            </div>


                            </div>
                            <!-- /.tab-pane -->


                          </div>
                          <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                  </div>    
                </div>
                      
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                </div>

              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


        <!- Left side Comments->
        <div class="col-md-9">
        
          <div class="nav-tabs-custom">
                          
            <ul class="nav nav-tabs">
              <li class="active"><a href="#ltab_1" data-toggle="tab">Map</a></li>
              <li><a href="#ltab_2" data-toggle="tab">Ratings</a></li>
              <li><a href="#ltab_3" data-toggle="tab">Comments</a></li>
            </ul>
                          

            <div class="tab-content">
                            

              <!-MAP->
              <div class="tab-pane active" id="ltab_1">
                <div class="box box-primary box-success">
                  <div id="viewfaci_map" style="position: relative; width:100%; height:400px"></div>
                </div>

                <div class="post">
                  <div class="user-block">
                    
                      <label>
                        From: <br />
                        <input type="text" id="routeStart">
                              <br><a href="#" class="autoLink" style="display: none;">Use current location: <span>not found</span></a>
                      </label>
                        <br>
                        <label>
                        
                        <br>
                      <label><input type="radio" name="travelMode" value="DRIVING" checked /> Driving</label>
                      <label><input type="radio" name="travelMode" value="BICYCLING" /> Bicylcing</label>
                      <label><input type="radio" name="travelMode" value="TRANSIT" /> Public transport</label>
                      <label><input type="radio" name="travelMode" value="WALKING" /> Walking</label>
                      <br><input type="submit" value="Calculate route" onclick="calcRoute();return false">
                    
                  </div>
                </div>

                <div class="post">
                  <div class="user-block">
                    <div id="directionsPanel">
                      Enter a starting point and click "Calculate route".
                    </div>
                  </div>
                </div>

              </div>



              <!-RATING->
              <!-- /.tab-pane -->

              <div class="tab-pane" id="ltab_2">
                
                <form name = "addRating" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
                  
                  <div class="box box-primary box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title"><?php echo (userHasVoted($_SESSION['user_id'], $facility_id))? "You already voted!" :"Rate the Facility!"; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       <!-- Post -->
                       
                      <?php 

                        if (userHasVoted($_SESSION['user_id'], $facility_id)){

                          echo '
                          <label id="userids" for="'.$_SESSION['user_id'].'"></label>
                          <label id="facilityids" for="'.$facility_id.'"></label>
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/process.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Process</a>                        
                                  </span>
                                    <span class="username">
                                          <label id="process-id" for="'.getRatingID($_SESSION['user_id'],$facility_id, 1).'"></label>
                                          <label id="process-before-id" for="'.getRatingValue($_SESSION['user_id'],$facility_id, 1).'"></label>
                                          <select id="process-value">
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                          <div class="rateit" data-rateit-backingfld="#process-value" data-rateit-value="'.getRatingValue($_SESSION['user_id'],$facility_id, 1).'"></div>


                                    </span>
                              <span class="description">Process measures assess whether a patient received what is known to be good care.
                              </span>

                            </div>
                            <!-- /.user-block -->
                          </div>
                          <!-- /.post -->


                           <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/medical-result.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Outcomes</a>
                                  </span>
                                  <span class="username">
                                  
                                          <label id="outcome-id" for="'.getRatingID($_SESSION['user_id'],$facility_id, 2).'"></label>
                                          <label id="outcome-before-id" for="'.getRatingValue($_SESSION['user_id'],$facility_id, 2).'"></label>
                                          <select id="outcome-value">
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                          <div class="rateit" data-rateit-backingfld="#outcome-value" data-rateit-value="'.getRatingValue($_SESSION['user_id'],$facility_id, 2).'"></div>


                                  </span>
                              <span class="description">How do you fare as a result of the care?</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            </p>
                          </div>
                          <!-- /.post -->


                          <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/flask.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Structure</a>
                                  </span>
                                  <span class="username">
                                   
                                        <label id="structure-id" for="'.getRatingID($_SESSION['user_id'],$facility_id, 3).'"></label>
                                        <label id="structure-before-id" for="'.getRatingValue($_SESSION['user_id'],$facility_id, 3).'"></label>
                                        <select id="structure-value">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="rateit" data-rateit-backingfld="#structure-value" data-rateit-value="'.getRatingValue($_SESSION['user_id'],$facility_id, 3).'"></div>

                                  </span>
                              <span class="description">How well-equipped care setting is to deliver care?</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            </p>
                    
                          </div>
                          <!-- /.post -->

                          <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="/mfspotter/dist/img/nurse.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Patient Experience</a>
                                  </span>
                                  <span class="username">
                                  
                                        <label id="experience-id" for="'.getRatingID($_SESSION['user_id'],$facility_id, 4).'"></label>
                                        <label id="experience-before-id" for="'.getRatingValue($_SESSION['user_id'],$facility_id, 4).'"></label>
                                        <select id="experience-value">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="rateit" data-rateit-backingfld="#experience-value" data-rateit-value="'.getRatingValue($_SESSION['user_id'],$facility_id, 4).'"></div>


                                  </span>
                              <span class="description">How do you evaluate the care you received?</span>
                            </div>
                            <!-- /.user-block -->
                          </div>
                          <!-- /.post -->

                          <div class="post">
                            <div class="user-block">
                              <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" onClick="updateRating()" >Update Ratings!</button>
                              
                              <span class="description"></span>
                            </div>
                            <!-- /.user-block -->
                          </div>
                          <!-- /.post -->

                           ';
                        } 
                        else{
                         echo '
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/process.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Process</a>                        
                                  </span>
                                    <span class="username">
                                          <select class="rating-processd" name="rating-process" id="backing2b">
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                          <div class="rateit" data-rateit-backingfld="#backing2b"></div>
                                        
                                    </span>
                              <span class="description">Process measures assess whether a patient received what is known to be good care.
                              </span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            </p>
                          </div>
                          <!-- /.post -->

                           <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/medical-result.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Outcomes</a>
                                  </span>
                                  <span class="username">
                                  
                                          <select class="rating-processd" name="rating-outcome" id="backing3b">
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>
                                          <div class="rateit" data-rateit-backingfld="#backing3b"></div>
                                  </span>
                              <span class="description">How do you fare as a result of the care?</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            </p>
                          </div>
                          <!-- /.post -->

                           <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/flask.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Structure</a>
                                  </span>
                                  <span class="username">
                                   
                                        <select class="rating-processd" name="rating-structure" id="backing1b">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="rateit" data-rateit-backingfld="#backing1b"></div>
                                  </span>
                              <span class="description">How well-equipped care setting is to deliver care?</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            </p>
                    
                          </div>
                          <!-- /.post -->

                            <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="/mfspotter/dist/img/nurse.png" alt="user image">
                                  <span class="username">
                                    <a href="#">Patient Experience</a>
                                  </span>
                                  <span class="username">
                                  
                                        <select class="rating-processd" name="rating-experience" id="backing0b">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="rateit" data-rateit-backingfld="#backing0b"></div>
                                  </span>
                              <span class="description">How do you evaluate the care you received?</span>
                            </div>
                            <!-- /.user-block -->
                          </div>
                          <!-- /.post -->


                          <div class="post">
                            <div class="user-block">
                              <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" >Submit Ratings!</button>
                              <input type="hidden" name="submitted" value="TRUE" />
                              <span class="description"></span>
                            </div>
                            <!-- /.user-block -->
                          </div>
                          <!-- /.post -->
                          ';
                        }

                        
                      ?>

                    </div> <!-- /.box body-->

                  </div> <!-- box -- >

                </form> <!--form -->

              </div>
              <!-- /.tab-pane2 -->


              <!-COMMENTS->
              <div class="tab-pane" id="ltab_3">

                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="post">
                       
                          <div class="form-group margin-bottom-none">
                            <div class="col-sm-9">
                              <input class="form-control input-sm" id="comment" placeholder="Post a comment">
                              <input type="text" id="username" value="<?php echo $_SESSION["user_id"]; ?>" hidden>
                              <input type="text" id="facilityID" value="<?php echo $facility_id; ?>" hidden>
                            </div>
                            <div class="col-sm-3">
                              <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" onclick="post()">Send</button>
                            </div>
                          </div>
                    
                      </div>

                      <br>

                      <div id = "all_comments">
                      
                      <?php 
                         //COMMENTS
                        $comments = array();

                        $query4 = "SELECT commentID, comment, firstName, middleName, lastName,  DATE_FORMAT( dateRated,  '%Y-%m-%d %H:%i' ) AS dateRated FROM comment c, user u WHERE c.userID = u.userID AND facilityID = " . $facility_id . " AND YEAR( dateRated ) = YEAR( CURDATE()) ORDER BY dateRated DESC";

                        $result4 = mysqli_query($connect, $query4); 

                        if(mysqli_num_rows($result4) > 0)  
                        {  
                          while($row4 = mysqli_fetch_array($result4)) 
                          {
                            $name = implode(" ", array($row4['firstName'], $row4['middleName'], $row4['lastName']));
                            $comments[] = array($row4['comment'], $name, $row4['dateRated'], $row4['commentID']);

                          }  

                        }


                        for($row = 0; $row < count($comments); $row++){

                        $comID = $comments[$row][3];
                        $uID = $_SESSION["user_id"];
                        $str_like = "like";


                        //Select Likes and Dislikes
                        $selectquery="SELECT COUNT(case when remarks = 'Like' then 1 end) as likes, COUNT(case when remarks = 'Dislike' then 1 end) as dislikes FROM remark WHERE commentID = '$comID'";

                        $selectRemarks=mysqli_query($connect, $selectquery);


                        if(mysqli_num_rows($selectRemarks) > 0){
                           while($row2=mysqli_fetch_array($selectRemarks))
                          {
                            $likes = $row2['likes'];
                            $dislikes = $row2['dislikes'];
                          }

                          $like_count = "'like_count". $comID . "'";
                          $dislike_count = "'dislike_count". $comID . "'";
                          $userRemarkLike = "";
                          $userRemarkDis = "";
                          
                            echo '
                            <div class="post">

                            <div class="user-block">

                              <img class="img-circle img-bordered-sm" src="/mfspotter/dist/img/profpic/'.$_SESSION["profilePicture"].'.jpg" alt="user image">
                                  <span class="username">
                                    <a href="#">' . $comments[$row][1] . '</a>
                                  </span>
                              <span class="description">' . $comments[$row][2] . '</span>
                            </div>
                            <!-- /.user-block -->

                            <p>' . $comments[$row][0] . '</p>';

                            
                            //CHECK IF THE USER HAS ALREADY VOTED
                            $checkQ="SELECT * FROM remark WHERE commentID = $comID AND userID = $uID";

                            $checkUser=mysqli_query($connect, $checkQ);

                            if(mysqli_num_rows($checkUser) > 0){
                               while($row2=mysqli_fetch_array($checkUser)){
                                  if($row2['remarks'] == "Like"){
                                    $userRemarkLike = "icon-success";
                                  }
                                  else if($row2['remarks'] == "Dislike"){
                                    $userRemarkDis = "icon-fail";
                                  }
                                  else{
                                    $userRemarkLike = "";
                                    $userRemarkDis = "";
                                  }
                               }

                            }

                              echo '<div class="ratings">
                              
                              <ul class="list-inline">
                                <li>
                                  <!-- Like Icon HTML -->
                                  <span class="glyphicon glyphicon-thumbs-up '. $userRemarkLike .'" onClick="cwRating('. $comID .', 1, '. $like_count .', '. $uID .')"></span>&nbsp;

                                  <!-- Like Counter -->
                                  <span class="counter" id="like_count'. $comID.'">'. $likes .'</span>&nbsp;&nbsp;&nbsp;

                                </li>

                                <li>
                                  <!-- Dislike Icon HTML -->
                                  <span class="glyphicon glyphicon-thumbs-down '. $userRemarkDis .'" onClick="cwRating('. $comID .', 0, '. $dislike_count .', '. $uID .')"></span>&nbsp;
                                  <!-- Dislike Counter -->
                                  <span class="counter" id="dislike_count'. $comID.'">'. $dislikes .'</span>&nbsp;&nbsp;&nbsp;
                                </li>
                              </ul>
                              </div> <!-- /. ratings -->';
                           // }
                          

                          echo '</div>  <!-- /.post -->';
                            
                            
                          }// Counting remarks
                        
                        
                        }// END OF FOR EACH FOR EACH COMMENT
                      
                      ?>
                      </div>  <!-- /. all_coments -->
                     
                      

                  </div>
                  <!-- /.box-body -->
                </div><!-- tab pane 3 -->

   

            </div> <!-- tab content -->
            
          </div>
          <!-- nav-tabs-custom -->
           
  
          
        </div><!-- col 9 -->

        </div>


        <!- END OF LEFT SIDE ->

        </div><!-- row-->
       </section><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Version 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="jquery.barrating.js"></script>


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk"
            type="text/javascript"></script>

<script type="text/javascript" src="plugins/rateit-scripts/jquery.rateit.min.js"></script>

<script type="text/javascript">
   /* document.getElementById("medOption").onclick = function () {
        location.href = "/mfspotter/searchCenter2.php";
    };*/

    //FOR COMMENTS
function post()
  {
    var comment = document.getElementById("comment").value;
    var name = document.getElementById("username").value;
    var facility = document.getElementById("facilityID").value;

    if(comment && name && facility)
    {

      $.ajax
      ({
        type: 'post',
        url: 'post_comments.php',
        data: 
        {
           user_comm:comment,
           user_name:name,
           facility_id:facility
        },
        success: function (response) 
        {
          document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
          document.getElementById("comment").value="";
          //document.getElementById("username").value="";
          //document.getElementById("facilityID").value="";
    
        }
      });
    }
    
    return false;
  }

  //FOR THE REMARKS
function insert_like(uID, cID)
  {

    //var uID = document.getElementById("user").value;
    //var cID = document.getElementById("commentid").value;
    console.log(uID);
    console.log(cID);

    $.ajax({
      type: 'post',
      url: 'store_remarks.php',
      data: {
        post_like:"like",
        user_id:uID,
        comment_id:cID

      },
      success: function (response) {
        $('#totalvotes').html(response);
      }
      });
  }

function insert_dislike()
  {
    $.ajax({
      type: 'post',
      url: 'store_remarks.php',
      data: {
        post_dislike:"dislike"
      },
      success: function (response) {
        $('#totalvotes').html(response);
      }
      });
  }


//FINAL REMARKS
function cwRating(id,type,target, userId){
  console.log(id);
  console.log(type);
  console.log(target);
  console.log(userId);

  $.ajax({
    type:'POST',
    url:'rating.php',
    data: {
      id:id,
      type:type,
      userId:userId

    },
    success:function(msg){
      if(msg == 'err'){
        alert('Some problem occured, please try again.');
      }else{
        $('#'+target).html(msg);
      }
    }
  });
}


</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script type="text/javascript">
 


function updateRating(){


  var process_id = document.getElementById("process-id").htmlFor;
  var outcome_id = document.getElementById("outcome-id").htmlFor;
  var structure_id = document.getElementById("structure-id").htmlFor;
  var experience_id = document.getElementById("experience-id").htmlFor;
  var sessionid = document.getElementById("userids").htmlFor;
  var faciids = document.getElementById("facilityids").htmlFor;

  var process_value, outcome_value, structure_value, experience_value;

  var p = document.getElementById("process-value");
  var o = document.getElementById("outcome-value");
  var s = document.getElementById("structure-value");
  var e = document.getElementById("experience-value");

  //********SELECTED VALUE FROM SELECT TAG
  var selectedProcessValue = p.options[p.selectedIndex].value;
  var selectedOutcomeValue = o.options[o.selectedIndex].value;
  var selectedStructureValue = s.options[s.selectedIndex].value;
  var selectedExperienceValue = e.options[e.selectedIndex].value;

  //********PROCESS
  if(selectedProcessValue == 0 && selectedProcessValue != document.getElementById('process-before-id').htmlFor){
    process_value = document.getElementById('process-before-id').htmlFor;
  }
  else{
    process_value = selectedProcessValue;
  }

  //********OUTCOME
  if(selectedOutcomeValue == 0 && selectedOutcomeValue != document.getElementById('outcome-before-id').htmlFor){
    outcome_value = document.getElementById('outcome-before-id').htmlFor;
  }
  else{
    outcome_value = selectedOutcomeValue;
  }

  //********STRUCTURE
  if(selectedStructureValue == 0 && selectedStructureValue != document.getElementById('structure-before-id').htmlFor){
    structure_value = document.getElementById('structure-before-id').htmlFor;
  }
  else{
    structure_value = selectedStructureValue;
  }

  //********EXPERIENCE
  if(selectedExperienceValue == 0 && selectedExperienceValue != document.getElementById('experience-before-id').htmlFor){
    experience_value = document.getElementById('experience-before-id').htmlFor;
  }
  else{
    experience_value = selectedExperienceValue;
  }





  $.ajax({  
          url:"updateRatings.php",  
          method:"post",  
          data:{
            pid: process_id, pval: process_value,
            oid: outcome_id, oval: outcome_value,
            sid: structure_id, sval: structure_value,
            eid: experience_id, eval: experience_value,
            usid: sessionid, faid: faciids
            },  
          dataType:"text",  
          success:function(data)  
          {  
            alert("UPDATED!"); 
          }  
        });  


 
}

var directionDisplay, map;
var directionsService = new google.maps.DirectionsService();
var geocoder = new google.maps.Geocoder();


 function load() {
      var lat = document.getElementById("facility_lati").htmlFor;
      var lng = document.getElementById("facility_long").htmlFor;
      var facname = document.getElementById("facility_name").htmlFor;
      var rendererOptions = { draggable: true };
      directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

      map = new google.maps.Map(document.getElementById("viewfaci_map"), {
        center: new google.maps.LatLng(lat, lng),
        zoom: 17,
        mapTypeId: 'roadmap',
        icon: "marker/marker.png",
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });
      infoWindow = new google.maps.InfoWindow();
      var point = new google.maps.LatLng(lat, lng);
      var marker = new google.maps.Marker({
                map: map,
                position: point
              });
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent("<b>Facility Name: " + facname + "</b>");
        infoWindow.open(map, marker);
      });

      directionsDisplay.setMap(map);
      // point the directions to the container for the direction details
      directionsDisplay.setPanel(document.getElementById("directionsPanel"));
      // start the geolocation API
      if (navigator.geolocation) {
        // when geolocation is available on your device, run this function
        navigator.geolocation.getCurrentPosition(foundYou, notFound);
      } else {
        // when no geolocation is available, alert this message
        alert('Geolocation not supported or not enabled.');
      }

  }

function calcRoute() {
  // get the travelmode, startpoint and via point from the form   
  var travelMode = $('input[name="travelMode"]:checked').val();
  var start = $("#routeStart").val();
  //var end = $("#routeEnd").val();//

  var lat = document.getElementById("facility_lati").htmlFor;
  var lng = document.getElementById("facility_long").htmlFor;
  // compose a array with options for the directions/route request
  var request = {
    origin: start,
    destination: lat + ',' + lng,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    travelMode: google.maps.DirectionsTravelMode[travelMode]
  };
  // call the directions API
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      // directions returned by the API, clear the directions panel before adding new directions
      $('#directionsPanel').empty();
      // display the direction details in the container
      directionsDisplay.setDirections(response);
    } else {
      // alert an error message when the route could nog be calculated.
      if (status == 'ZERO_RESULTS') {
        alert('No route could be found between the origin and destination.');
      } else if (status == 'UNKNOWN_ERROR') {
        alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
      } else if (status == 'REQUEST_DENIED') {
        alert('This webpage is not allowed to use the directions service.');
      } else if (status == 'OVER_QUERY_LIMIT') {
        alert('The webpage has gone over the requests limit in too short a period of time.');
      } else if (status == 'NOT_FOUND') {
        alert('At least one of the origin, destination, or waypoints could not be geocoded.');
      } else if (status == 'INVALID_REQUEST') {
        alert('The DirectionsRequest provided was invalid.');         
      } else {
        alert("There was an unknown error in your request. Requeststatus: nn"+status);
      }
    }
  });
}

function foundYou(position) {
  // convert the position returned by the geolocation API to a google coordinate object
  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  // then try to reverse geocode the location to return a human-readable address
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      // if the geolocation was recognized and an address was found
      if (results[0]) {
        // add a marker to the map on the geolocated point
        
        /*marker = new google.maps.Marker({
            position: latlng,
            map: map
        });*/

        // compose a string with the address parts
        var address = results[0].address_components[1].long_name+' '+results[0].address_components[0].long_name+', '+results[0].address_components[3].long_name
        // set the located address to the link, show the link and add a click event handler
        $('.autoLink span').html(address).parent().show().click(function(){
          // onclick, set the geocoded address to the start-point formfield
          $('#routeStart').val(address);
          // call the calcRoute function to start calculating the route
          calcRoute();
        });
      }
    } else {
      // if the address couldn't be determined, alert and error with the status message
      alert("Geocoder failed due to: " + status);
    }
  });
}

function notFound(msg) {  
  alert('Could not find your location :(')
}

$(function() {
      $('.rating-process').barrating({
        theme: 'fontawesome-stars',
        initialRating: null
      });


      
      var overallProcessRating = $('.rating-display-process-overall').data('current-rating');
      var overallOutcomeRating = $('.rating-display-outcomes-overall').data('current-rating');
      var overallStructureRating = $('.rating-display-structure-overall').data('current-rating');
      var overallExperienceRating = $('.rating-display-experience-overall').data('current-rating');
      var overallRating = $('.rating-display-overall').data('current-rating');
      var overalldetails = $('.rating-display-detail').data('current-rating');

      $('.rating-display-overall .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallRating,
        readonly: true
      });

     $('.rating-display-detail .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-detail').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overalldetails,
        readonly: true
      });

      $('.rating-display-process-overall .current-rating')
            .find('span')
            .html(overallProcessRating);

      $('.rating-display-process-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallProcessRating,
        readonly: true
      });

      $('.rating-display-outcomes-overall .current-rating')
            .find('span')
            .html(overallOutcomeRating);

      $('.rating-display-outcomes-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallOutcomeRating,
        readonly: true
      });

      $('.rating-display-structure-overall .current-rating')
            .find('span')
            .html(overallStructureRating);

      $('.rating-display-structure-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallStructureRating,
        readonly: true
      });

      $('.rating-display-experience-overall .current-rating')
            .find('span')
            .html(overallExperienceRating);

      $('.rating-display-experience-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallExperienceRating,
        readonly: true
      });







      //BREAKDOWN
      $('.rating-display-five').barrating({
        theme: 'fontawesome-stars',
        initialRating: 5,
        readonly: true
      });

      $('.rating-display-four').barrating({
        theme: 'fontawesome-stars',
        initialRating: 4,
        readonly: true
      });

      $('.rating-display-three').barrating({
        theme: 'fontawesome-stars',
        initialRating: 3,
        readonly: true
      });

      $('.rating-display-two').barrating({
        theme: 'fontawesome-stars',
        initialRating: 2,
        readonly: true
      });

      $('.rating-display-one').barrating({
        theme: 'fontawesome-stars',
        initialRating: 1,
        readonly: true
      });

   });



</script>

</body>
</html>
