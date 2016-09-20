<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MFSpotter| Facility Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATN0ljqJSiqBz7nO_arntrrdMjyoSTsXk"
            type="text/javascript"></script>-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk"
            type="text/javascript"></script>
<style>
  #map { margin: 20px 0; padding: 0; height: 300px; float: left; width: 100%; }
</style>

</head>



<?php
    //include ("config.php");

    $mysqli = new mysqli('localhost', 'root', 'usbw', 'mfspotter');
    $mysqli->autocommit(false);


    if(isset($_POST['submitted']))
    {
        $facilityName = $_POST['fname'];
        $telephoneNumber = $_POST['telnum'];
        $address = $_POST['address'];
        $longhitude = $_POST['lng'];
        $latitude = $_POST['lat'];

        $userType = "staff";
        $username = $_POST['usn'];
        $password = $_POST['pw'];
        $fn = $_POST['fname'];
        $mn = $_POST['mname'];   
        $ln = $_POST['lname'];  

        $days = isset($_POST['days']) ? $_POST['days'] : false;
        $ot = isset($_POST['opentime']) ? $_POST['opentime'] : false;
        $ct = isset($_POST['closetime']) ? $_POST['closetime'] : false;

        $insID = isset($_POST['selected_insurances']) ? $_POST['selected_insurances'] : false;
        $specID = isset($_POST['selected_specialization']) ? $_POST['selected_specialization'] : false;

        //INSERT INTO FACILITY
        $mysqli->query("INSERT INTO facility(facilityName, telephoneNumber,address, longhitude, latitude) VALUES ('$facilityName', '$telephoneNumber', '$address', '$longhitude', '$latitude')");

        //GENERATE FACILITY ID
        $facID = $mysqli->insert_id;

        //GENERATE INSURANCES ID FROM SELECT2 TAG
       


        //INSERT INTO DAYS
        if($days && $ot && $ct)
        {
          foreach($days as $d)
          {
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', '".$d."', '".$ot."', '".$ct."')");
          }

        }


        //INSERT INTO INSURANCES
        if($insID)
        {
          foreach ($insID as $i)
          {
            $mysqli->query("INSERT INTO insurancescovered(facilityID, insuranceID) VALUES('".$facID."', '".$i."')");
          }
        }

        //INSERT INTO SPECIALIZATION
        if($specID)
        {
          foreach($specID as $s)
          {
            $mysqli->query("INSERT INTO hasspecialization(specializationID, facilityID) VALUES('".$s."', '".$facID."')");
          }
        }
        

        //INSERT INTO USERS
        $mysqli->query("INSERT INTO user(userType, username, password, firstName, middleName, lastName) VALUES('".$userType."', '".$username."', '".$password."', '".$fn."', '".$mn."', '".$ln."')");


        //GENERATE USERID
        $usrID = $mysqli->insert_id;


        //ASSOCIATE FACILITY AND USER TABLES
        $mysqli->query("INSERT INTO facilityhasstaff(facilityID, userID) VALUES('".$facID."', '".$usrID."')");
        
        $mysqli->commit();
              
    }
      
?>



<body class="hold-transition skin-purple layout-top-nav" onload="initialize()">

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
            <li><a href="#">Log In</a></li>
          </ul>
          
        </div>
        <!-- /.navbar-collapse -->

    </nav>

  </header>


  <!-CONTENT WRAPPER>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-CONTENT HEADER->
    <section class="content-header">
      
      <h1>
        Facility Registration
        <small>Register as a Medical Facility</small>
      </h1>

    </section>

    <!-MAIN CONTENT->
    <section class="content">

    <!FORM ACTION START->
  <form name = "addFacility" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
 

      <!-****************************************** GENERAL INFORMATION ******************************************->
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-info-circle"></i> - General Information</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!-****************************************** FIRST SECTION->
            <div class="col-md-6">
             
              <!-FACILITY NAME->
              <div class="form-group">
                <label>Facility Name:</label>
                <div class = "input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-hospital-o"></i>
                  </div>
                  <input type="text" class="form-control" id="facilityName" name="fname" placeholder="Facility Name" required>
                </div>
              </div>

              <!-PHONE NUMBER->
              <div class="form-group">
                <label>Telephone Number:</label>

                <div class="input-group">
                  
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" id="telnumber" name="telnum" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="Telephone Number" required>
                </div>

              </div>

              <!-SPECIALIZATION->
              <div class="form-group">

                <label>Specialization:</label>

                <select name="selected_specialization[]" class="form-control select2" multiple="multiple" data-placeholder="Select Specialization" style="width: 100%;">

    <?php
                  include("config.php");
                  $q = "SELECT * FROM specialization";
                  $result = mysqli_query($connect, $q);
                  if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                      echo '<option value="' . $row['specializationID'] . '">' . $row['specialization'] . '</option>';
                    }
                  }
    mysqli_close($conn);             
    ?>
                </select>

              </div>

              <!-INSURANCES->
              <div class="form-group">
                <label>Insurances Covered:</label>
                <select name="selected_insurances[]" id="select2_insurances" class="form-control input-group select2" multiple="multiple" placeholder="Select Insurances" style="width: 100%;">
    <?php
                  include ("config.php");
                  $q = "SELECT insurancesID, insuranceName FROM insurances";
                  $result = mysqli_query($connect, $q);
                  if (mysqli_num_rows($result) > 0) {
    
                    while($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="'. $row['insurancesID'] . '">' . $row['insuranceName'] . '</option>';
                    }

                  }
    mysqli_close($conn);             
    ?>
                </select>
              
              </div>

     
            </div>


            <!-****************************************** SECOND SECTION->
            <!-- /.col -->
            <div class="col-md-6">
              <label>Opening Days:</label>
              
              
              <div class="form-group">
               
                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="0"> Sun
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="1"> Mon
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="2"> Tue
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="3"> Wed
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="4"> Thu
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="5"> Fri
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-1">
                    <label>
                      <input type="checkbox" class="minimal" name="days[]" value="6"> Sat
                    </label>
                  </div>
                </div>
                  
              </div>
       

              </br></br></br>


               <!-OPENING TIME->
              <div class="bootstrap-timepicker">
                
                <div class="form-group">
                  <label>Opening Time:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control timepicker" name="opentime" required>
                  </div>
               
                </div>
         
              </div>

              <!-CLOSING TIME->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Closing Time:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control timepicker" name="closetime" required>
                  </div>
                  
                </div>
                
              </div>
              

            </div>
              

              
                           
          </div>
            <!-- /.col -->
        </div>
          <!-- /.row -->
      
        <!-- /.box-body -->
        <div class="box-footer">
        
        </div>
      </div>
      

      <!-****************************************** LOCATION DETAILS ******************************************->
      <div class="box box-solid box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa fa-map-marker""></i> - Location Details</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            </div>
        </div>

        <div class="box-body">
          <div class="row">

            <!-****************************************** FIRST SECTION->
            <div class="col-md-6">
                <div id="map" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
                <div id="message"></div>
            </div>

            <!-****************************************** SECOND SECTION->
            <div class="col-md-6">
                
                <div class="form-group">
                  <label>Longhitude:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-map"></i>
                    </div>
                    <input type="text" class="form-control" id="longhi" name="lng" placeholder="Longhitude" required readonly >
                  </div>
                </div>

                <div class="form-group">
                  <label>Latitude:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-map-o"></i>
                    </div>
                    <input type="text" class="form-control" id="lati" name="lat" placeholder="Latitude" required readonly >
                  </div>
                </div>

                <div class="form-group">
                  <label>Address:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-map-pin"></i>
                    </div>
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                  </div>
                </div>

            </div>

          </div>


          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <i>Plot the location of the facility.</i>
        </div>
      </div>

    
      <!-****************************************** USER DETAILS ******************************************->
      <div class="box box-solid box-warning">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa fa-user-md""></i> - Staff Details</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>

        <div class="box-body">
          <div class="row">

            <!-****************************************** FIRST SECTION->
            <div class="col-md-6">
                <div class="form-group">
                  <label>First Name:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input name="fname" type="text" class="form-control" placeholder="First Name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label>Middle Name:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input name="mname" type="text" class="form-control" placeholder="Middle Name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label>Last Name:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input name="lname" type="text" class="form-control" placeholder="Last Name" required>
                  </div>
                </div>

                

            </div>

            <!-****************************************** SECOND SECTION->
            <div class="col-md-6">
                

              <div class="form-group">
                  <label>Username:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input name="usn" type="text" class="form-control" placeholder="Username" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Password:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </div>
                    <input name="pw" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </div>
                    <input name="cpw" type="password" class="form-control" data-match="#inputPassword" data-match-error="Password don't match!" placeholder="Confirm Password" required>

                  </div>
              </div>



            </div>

          </div>


          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        
        </div>
      </div>

      <div class="row">
        
      

        <div class="col-md-12">
          <button type="submit" name="register" id="registerFacility" class="btn btn-block btn-lg btn-danger">Register Facility</button>
          <input type="hidden" name="submitted" value="TRUE" />
        </div>


      </div>

  </form>

          

      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <i>Helping displaced people find medical facilities</i>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">MF Spotter</a>.</strong> All rights reserved.
  </footer>


<php?

?>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->


<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select2").select2({
      placeholder: "Select a Specialization",
      allowClear: true
    });
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();


    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
  });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

   /*$("#buttonsample").click(function() {
     alert("Selected value is: "+ $("#select2_insurances").select2("val"));

    });*/



    
</script>



<script type="text/javascript">
/*GOOGLE MAP*/
    

    var marker;

    function initialize() {
      
      //var latlng = new google.maps.LatLng(7.057964, 125.585403);
     if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
         var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
         var options = {
            /*zoom: 13,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.SATELLITE
            */
            zoom: 13,
            center: new google.maps.LatLng(pos.lat, pos.lng),
             // disableDefaultUI: true,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
              },
            draggableCursor:'crosshair',
            draggingCursor: 'move'
          }
          var map = new google.maps.Map(document.getElementById("map"), options);
          var geocoder = new google.maps.Geocoder;
          var infowindow = new google.maps.InfoWindow;   

          google.maps.event.addListener(map, 'click', function(event) {
             //placeMarker(event.latLng);
              marker = new google.maps.Marker({
              position: event.latLng,
              map: map,
              draggable: true,
              animation: google.maps.Animation.DROP
              });
              //place the latlng into the inputs
              document.getElementById("longhi").value = event.latLng.lng();
              document.getElementById("lati").value = event.latLng.lat();
              //geocodeLatLng(geocoder, map, infowindow);
          });

      }, function() {handleLocationError(true, infoWindow, map.getCenter());});
        } 
      else{
          handleLocationError(false, infoWindow, map.getCenter());
      }

      }



    function placeMarker(location){
      var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
 
      if(marker)
      {
        marker.setPosition(location);
      }
      else
      {
        marker = new google.maps.Marker({
        position: location.latLng,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP
        });


      }
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
    }


   /* function initialize() {
  // set the default center of the map
      var latlng = new google.maps.LatLng(51.764696,5.526042);
      // set route options (draggable means you can alter/drag the route in the map)
      var rendererOptions = { draggable: true };
      directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
      // set the display options for the map
      var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
      };
      // add the map to the map placeholder
      map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
      // bind the map to the directions
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
*/
</script>

</body>
</html>
