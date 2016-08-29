
<?php 
    
  $facility_id = $_GET["id"];

  $username="root";
  $password="usbw";
  $database="mfspotter";

  $operating_period = array();

  $connect = mysqli_connect("localhost", $username, $password, $database);  
  
  $query = "SELECT * FROM `facility` WHERE facilityID = " . $facility_id . " ";

  $result = mysqli_query($connect, $query); 

  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      $facility_name = $row['facilityName'];
      $facility_tel = $row['telephoneNumber'];
      $facility_address = $row['address'];

    }  
    
  }

  //OPERATING HOURS
  $query2 = "SELECT * FROM operatingperiod WHERE facilityID = " . $facility_id . " ";

  $result2 = mysqli_query($connect, $query2); 

  if(mysqli_num_rows($result2) > 0)  
  {  
    while($row2 = mysqli_fetch_array($result2)) 
    {
      $operating_period[] = array($row2['dayofweek'],$row2['timeOpened'], $row2['timeClosed']);

    }  

  } 

  //INSURANCES COVERED
  $query3 = "SELECT * FROM insurances WHERE insurancesID IN ( SELECT insurancesID FROM insurancescovered WHERE facilityID = " . $facility_id . " )";

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
  $mysqli = new mysqli('localhost', 'root', 'usbw', 'mfspotter');
  $mysqli->autocommit(false);
  
    if(isset($_POST['submitted']))
    {
       
        $facilityID = 3;
        $userID = 1;
        $process = $_POST['rating-process'];
        $outcomes = $_POST['rating-outcome'];
        $structure = $_POST['rating-structure'];
        $experience = $_POST['rating-experience'];

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
  <title>MFSpotter </title>
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


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/themes/fontawesome-stars.css">
  <link rel="stylesheet" href="dist/themes/fontawesome-stars-o.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>

<body  class="hold-transition skin-green layout-top-nav">

<div class="wrapper">

  <!-Main Header->
   <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <div class="navbar-header">
        <a href="../mfspotter/Landing.html" class="navbar-brand"><b>MF</b>Spotter</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
          
      <!-Menu on the left side->
       
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
         <!-- User Account: style can be found in dropdown.less -->

          <?php
            session_start();

            if(!(isset($_SESSION['username'])) && !(isset($_SESSION['password'])))
            {
              echo "<script>alert('Not Logged in!')</script>";
              redirect('login.php');
                
            }
              
            else
            {

              echo '<li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">'.$_SESSION["firstname"].' '.$_SESSION["lastname"] .'</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                          Alexander Pierce
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
              <img class="profile-user-img img-responsive" src="../mfspotter/dist/img/photo1.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $facility_name ?></h3>

              <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                  <b>Rating</b> <a class="pull-right">star goes here</a>
                </li>
                <li class="list-group-item">
                  <b>Operating Hours</b> <a class="pull-right">
                  <?php
                    for($row = 0; $row < count($operating_period); $row++){

                      for($col = 0; $col < 3; $col++)
                      {

                        //FOR THE DAYS
                        if($operating_period[$row][$col] == 0)
                        {
                          $operating_period[$row][$col] = "Su";
                          $days[] = $operating_period[$row][$col];

                        }
                        else if($operating_period[$row][$col] == 1)
                        {
                          $operating_period[$row][$col] = "Mo";
                          $days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][$col] == 2)
                        {
                          $operating_period[$row][$col] = "Tu";
                          $days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][$col] == 3)
                        {
                          $operating_period[$row][$col] = "We";
                          $days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][$col] == 4)
                        {
                          $operating_period[$row][$col] = "Th";
                          $days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][$col] == 5)
                        {
                          $operating_period[$row][$col] = "Fr";
                          $days[] = $operating_period[$row][$col];
                        }
                        else if($operating_period[$row][$col] == 6)
                        {
                          $operating_period[$row][$col] = "Sa";
                          $days[] = $operating_period[$row][$col];
                        }
      

                        echo ''. $operating_period[$row][$col] . ' ';
                      }
                      echo '<br/>';

                    }


                  ?>


                  </a>
                  </br> </br></br>
                </li>
                <li class="list-group-item">
                  <b>Telephone Number</b> <a class="pull-right"><?php echo $facility_tel ?></a>
                </li>
              </ul>

              <a href="#" class="btn btn-success btn-block"><b>Set an Appointment</b></a>
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
              <strong><i class="fa fa-book margin-r-5"></i> Desciption</strong>

              <p class="text-muted">
               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
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
        <!-RATING->
        <form name = "addRating" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
          <div class="box box-primary box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Rate the Facility</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/process.png" alt="user image">
                        <span class="username">
                          <a href="#">Process</a>                        
                        </span>
                          <span class="username">
                              <div class="stars stars-example-fontawesome">
                                <select class="rating-process" name="rating-process">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                              </div>
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
                          <div class="stars stars-example-fontawesome">
                                <select class="rating-process" name="rating-outcome">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
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
                         <div class="stars stars-example-fontawesome">
                              <select class="rating-process" name="rating-structure">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                          </div>
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
                         <div class="stars stars-example-fontawesome">
                              <select class="rating-process" name="rating-experience">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                          </div>
                        </span>
                    <span class="description">How do you evaluate the care you received?</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->





                <div class="post">
                  <div class="user-block">
                    <button type="submit" class="btn btn-danger pull-right btn-block btn-sm" >Submit Ratings!</button>
                    <input type="hidden" name="submitted" value="TRUE" />
                    <span class="description"></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->








            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box on Rating -->
        </div>
        <!-- /.col -->
      </form>

        <!- Left side Comments->
        <div class="col-md-9">
 
          <!-- Comments-->
          <div class="box box-primary box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Comments</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="post">
                  <form class="form-horizontal" method='post' action="" onsubmit="return post();">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" id="comment" placeholder="Post a comment">
                        <input type="text" id="username" value="<?php echo $_SESSION["user_id"]; ?>" hidden>
                        <input type="text" id="facilityID" value="<?php echo $facility_id; ?>" hidden>
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div id = "all_comments">
                <?php 
                   //COMMENTS
                  $query4 = "SELECT commentID, comment, firstName, middleName, lastName,  DATE_FORMAT( dateRated,  '%Y-%m-%d %H:%i' ) AS dateRated FROM comment c, user u WHERE c.userID = u.userID AND facilityID = " . $facility_id . " ORDER BY dateRated DESC";

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

                  
                  echo '
                  <div class="post">

                  <div class="user-block">

                    <img class="img-circle img-bordered-sm" src="/mfspotter/dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">' . $comments[$row][1] . '</a>
                        </span>
                    <span class="description">' . $comments[$row][2] . '</span>
                  </div>
                  <!-- /.user-block -->

                  <p>' . $comments[$row][0] . '</p>
                  <div id = "totalvotes">
                    <ul class="list-inline">
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                      </li>
                      <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-down margin-r-5"></i> Dislike</a>
                      </li>
                    </ul>
                  </div>
                </div>  <!-- /.post -->';
                  }
                
                ?>
                </div>  <!-- /. all_coments -->
               
                

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box on Comments-->
          </div>


        <!- END OF LEFT SIDE ->

        </div>
       </section>

      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
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
<script type="text/javascript">
   $(function() {
      $('.rating-process').barrating({
        theme: 'fontawesome-stars',
        initialRating: null
      });
   });
</script>




<script type="text/javascript">
    document.getElementById("medOption").onclick = function () {
        location.href = "/mfspotter/searchCenter2.php";
    };

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
          document.getElementById("username").value="";
          document.getElementById("facilityID").value="";
    
        }
      });
    }
    
    return false;
  }

  //FOR THE REMARKS
  function insert_like()
  {
    var test = "fd";
    console.log(test);
    $.ajax({
      type: 'post',
      url: 'store_remarks.php',
      data: {
        post_like:"like"
      },
      success: function (response) {
        $('#totalvotes').html(response);
      }
      });
  }

  function insert_like()
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


</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script type="text/javascript">
 
  
</script>

</body>
</html>
