
<?php 
    
  $user_id = $_GET["id"];
  session_start();
 
  include('config.php');
  $nameOfUser =  $_SESSION["firstname"]." ".$_SESSION["middlename"]." ".$_SESSION["lastname"];
  $predays = array();
  $predays2 = array();
  $days = array();

  //USERNAME
  $query0 = "SELECT * FROM `user` WHERE userID = " . $user_id . " ";

  $result0 = mysqli_query($connect, $query0); 

  if(mysqli_num_rows($result0) > 0)  
  {  
    while($row0 = mysqli_fetch_array($result0)) 
    {
      $nameOfUser = $row0['firstName'].' '.$row0['middleName'].' '.$row0['lastName'];
      $userPic = $row0['picture'];
      $userType = $row0['userType'];
    }  
    
  }

  //Comments on a faclity
  $query = "SELECT DATE_FORMAT( dateRated,  '%d %M %Y' ) AS dateRated, DATE_FORMAT( dateRated,  '%Y-%m-%d' ) AS dateRated2 FROM `comment` WHERE userID = " . $user_id . " ";

  $result = mysqli_query($connect, $query); 

  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      $predays[] =$row['dateRated'];
      $predays2[] = $row['dateRated2'];
    }  
    
  }

  //Ratings on a faclity
  $query2 = "SELECT DATE_FORMAT( dateRated,  '%d %M %Y' ) AS dateRated, DATE_FORMAT( dateRated,  '%Y-%m-%d' ) AS dateRated2 FROM `rating` WHERE userID = " . $user_id . " GROUP BY facilityID";

  $result2 = mysqli_query($connect, $query2); 

  if(mysqli_num_rows($result2) > 0)  
  {  
    while($row2 = mysqli_fetch_array($result2)) 
    {
      $predays[] = $row2['dateRated'];
      $predays2[] = $row2['dateRated2'];
    }  
    
  }

  $days = array_unique($predays);
  $days2 = array_unique($predays2);
  $comments = array();
  $rates = array();
  $p = 0;
  //date to comments
  for($i=0; $i < count($days2); $i++){
    $theDay = $days2[$i];
    $query3 = "SELECT c.facilityID, comment, DATE_FORMAT( dateRated,  '%h:%i %p' ) AS timeRated, facilityName FROM `comment` c, `facility` f WHERE c.facilityID = f.facilityID AND dateRated LIKE '%$theDay%' AND userID = " . $user_id . " ";
    //echo $query3.'<br>';

    $result3 = mysqli_query($connect, $query3); 

    if(mysqli_num_rows($result3) > 0)  
    {  
      while($row3 = mysqli_fetch_array($result3)) 
      {
        $comments[$i][] = array('comment', $row3['facilityID'], $row3['comment'], $row3['timeRated'], $row3['facilityName']);
      }  
      
    }
  }

  //date to ratings
  for($i=0; $i < count($days2); $i++){
    $theDay = $days2[$i];
    $query4 = "SELECT r.facilityID, DATE_FORMAT( dateRated,  '%h:%i %p' ) AS timeRated, facilityName FROM `rating` r, `facility` f WHERE r.facilityID = f.facilityID AND dateRated LIKE '%$theDay%' AND userID = " . $user_id . " GROUP BY r.facilityID";
    //echo $query4.'<br>';

    $result4 = mysqli_query($connect, $query4); 

    if(mysqli_num_rows($result4) > 0)  
    {  
      while($row4 = mysqli_fetch_array($result4)) 
      {
        $rates[$i][] = array('rating', $row4['facilityID'], $row4['timeRated'], $row4['facilityName']);
        $p++;
      }  
      
    }
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
  <title><?php echo $nameOfUser ?></title>
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

<script type="text/javascript">

</script>

  
</head>

<body class="hold-transition skin-green layout-top-nav" onload="load()">

<div class="wrapper">

  <!-Main Header->
   <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <div class="navbar-header">
        <a href="/mfspotter/Landing.php" class="navbar-brand"><b>MFS</b>potter</a>
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
                   <a href="userProfile.php?id=<?php echo $_SESSION['user_id'] ?>" class="btn btn-default btn-flat">Profile</a>
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
          User Profile
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
                <img class="profile-user-img img-responsive" src="/mfspotter/dist/img/profpic/<?php echo $userPic ?>.jpg" alt="User profile picture">
                
                <h3 class="profile-username text-center"><?php echo $nameOfUser ?></h3>
                <p class="text-muted text-center"><?php echo $userType ?></p>
              
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col md 3 -->
     

        <!- Left side ->
        <div class="col-md-9">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <?php 
             for($i = 0; $i < count($days); $i++)
             {
            ?>
              <li class="time-label">
                    <span class="bg-red">
                      <?php echo $days[$i]?>
                    </span>
              </li>
              <!-- /.timeline-label -->

                <?php 
                  if(count($comments[$i]) > 0){
                    $trial2 = count($comments[$i]);
                    echo $trial2;
                    for($y=0; $y < count($comments[$i]); $y++){



                ?>

                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-green"></i>
                 
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $comments[$i][$y][3] ?></span>

                        <h3 class="timeline-header">You commented on the facility <a href="facilityProfile.php?id=<?php echo $comments[$i][$y][1] ?>"><?php echo $comments[$i][$y][4] ?></a></h3>

                        <div class="timeline-body">
                          <?php echo $comments[$i][$y][2] ?>
                        </div>
                        <div class="timeline-footer">
                          
                      </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                <?php
                    } 
                  }
                  
                  if(count($rates[$i]) > 0){
                    $trial = count($rates[$i]);
                    echo $trial;
                    for($z=0; $z < count($rates[$i]); $z++){

                    
                ?>
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-star bg-yellow"></i>
                 
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo $rates[$i][$z][2] ?></span>

                      <h3 class="timeline-header">You rated a facility <a href="facilityProfile.php?id=<?php echo $rates[$i][$z][1] ?>"><?php echo $rates[$i][$z][3] ?></a></h3>
                      

   
                      <div class="timeline-footer">
                        
                      </div>
                    </div>
                  </li>
                    <!-- END timeline item -->



                <?php
                    }
                  }
                ?>

              
            <?php 
              }
            ?>

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>

        </div><!-- col 9 -->



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
