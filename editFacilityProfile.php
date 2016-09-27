<?php
  $facility_id = $_GET["id"];

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
      //$facility_address = $row['address'];
      //$facility_lat = $row['latitude'];
      //$facility_lng = $row['longhitude'];
      //$facility_picture = $row['facilityPicture'];
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
  $query3 = "SELECT * FROM insurances WHERE insurancesID IN ( SELECT insurancesID FROM insurancescovered WHERE facilityID = " . $facility_id . " )";

  $result3 = mysqli_query($connect, $query3); 

  if(mysqli_num_rows($result3) > 0)  
  {  
    while($row3 = mysqli_fetch_array($result3)) 
    {
      $insurance_name[] = $row3['insuranceName'];

    }  

  } 

?>

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
    include ("config2.php");
    session_start();

    
    //$mysqli = new mysqli('localhost', 'root', 'usbw', 'mfspotter');
    $mysqli->autocommit(false);


    if(isset($_POST['submitted']))
    {
        $facilityName = $_POST['facname'];
        $telephoneNumber = $_POST['telnum'];
        $address = $_POST['address'];
        /*
        $longhitude = $_POST['lng'];
        $latitude = $_POST['lat'];

        $userType = "staff";
        $username = $_POST['usn'];
        $password = $_POST['pw'];
        $conPassword = $_POST['cpw'];
        $fn = $_POST['fname'];
        $mn = $_POST['mname'];   
        $ln = $_POST['lname'];  

         */
        $sunday = isset($_POST['sunday']) ? true : false;
        $monday = isset($_POST['monday']) ? true : false;
        $tuesday = isset($_POST['tuesday']) ? true : false;
        $wednesday = isset($_POST['wednesday']) ? true : false;
        $thursday = isset($_POST['thursday']) ? true : false;
        $friday = isset($_POST['friday']) ? true : false;
        $saturday = isset($_POST['saturday']) ? true : false;

       /*
        $insID = isset($_POST['selected_insurances']) ? $_POST['selected_insurances'] : false;
        $specID = isset($_POST['selected_specialization']) ? $_POST['selected_specialization'] : false;


        //Validate first if user already exists!
        $validateUser = $mysqli->query("SELECT * FROM user WHERE username = '$username'");
        $validUSerRow = mysqli_fetch_array($validateUser);

        //Validate first if facility already exists!
        $validateFac = $mysqli->query("SELECT * FROM facility WHERE facilityName = '$facilityName'");
        $validFacRow = mysqli_fetch_array($validateFac);
        
          
        //Username Existence Validation
        if(mysqli_num_rows($validateUser) > 0)
          echo "<script>alert('Username already exists!')</script>";
        
        //Password Validation
        else if(!($password == $conPassword))
          echo "<script>alert('Password does not match!')</script>";
        else if(mysqli_num_rows($validateFac) > 0)
          echo "<script>alert('Facility already exists!')</script>";

*/
        //else{

          //INSERT INTO FACILITY
          $mysqli->query("UPDATE `facility` SET `facilityName`= $facilityName,`telephoneNumber`=  $telephoneNumber WHERE facilityID= $facility_id");

          /*
          //GENERATE FACILITY ID
          $facID = $mysqli->insert_id;

          //GENERATE INSURANCES ID FROM SELECT2 TAG
         

          if($sunday)
          {
           
            $sot = $_POST['sun_opentime'];
            $sct = $_POST['sun_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 0, '".$sot."', '".$sct."')");
            
          }

          if($monday)
          {
           
            $mot = $_POST['mon_opentime'];
            $mct = $_POST['mon_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 1, '".$mot."', '".$mct."')");
            
          }

          if($tuesday)
          {
            
            $tot = $_POST['tue_opentime'];
            $tct = $_POST['tue_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 2, '".$tot."', '".$tct."')");
          }

          if($wednesday)
          {
            
            $wot = $_POST['wed_opentime'];
            $wct = $_POST['wed_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 3, '".$wot."', '".$wct."')");
          }

          if($thursday)
          {
            
            $thot = $_POST['thu_opentime'];
            $thct = $_POST['thu_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 4, '".$thot."', '".$thct."')");
          }

          if($friday)
          {
            
            $fot = $_POST['fri_opentime'];
            $fct = $_POST['fri_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 5, '".$fot."', '".$fct."')");
          }

          if($saturday)
          {
            
            $saot = $_POST['sat_opentime'];
            $sact = $_POST['sat_closetime'];
            $mysqli->query("INSERT INTO operatingperiod(facilityID, dayofweek, timeopened, timeclosed) VALUES('".$facID."', 6, '".$saot."', '".$sact."')");
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
          $mysqli->query("INSERT INTO user(userType, username, password, firstName, middleName, lastName, picture) VALUES('".$userType."', '".$username."', '".$password."', '".$fn."', '".$mn."', '".$ln."', 'default')");


          //GENERATE USERID
          $usrID = $mysqli->insert_id;


          //ASSOCIATE FACILITY AND USER TABLES
          $mysqli->query("INSERT INTO facilityhasstaff(facilityID, userID) VALUES('".$facID."', '".$usrID."')");
          */
          
          $mysqli->commit();  

          echo '<script> alert("Facility successfully registered"); </script>';
          redirect("login.php");
        //}
        
    }
    echo "";

    function redirect($url)
    {
      echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
      die();
    }
      
?>



<body class="hold-transition skin-purple layout-top-nav" onload="initialize()">

<div class="wrapper">

  <!-Main Header->
  <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <div class="navbar-header">
        <a href="/mfspotter/Landing.php" class="navbar-brand"><b>MF</b>Spotter</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
          
      <!-Menu on the left side->
       
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
            <li><a href="login.php">Log In</a></li>
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
            <!****************************************** FIRST SECTION->
            <div class="col-md-6">
             
              <!-FACILITY NAME->
              <div class="form-group">
                <label>Facility Name:</label>
                <div class = "input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-hospital-o"></i>
                  </div>
                  <input type="text" class="form-control" id="facilityName" name="facname" placeholder="Facility Name" value="<?php echo $facility_name ?>" required>
                </div>
              </div>

              <!-PHONE NUMBER->
              <div class="form-group">
                <label>Telephone Number:</label>

                <div class="input-group">
                  
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" id="telnumber" name="telnum" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="Telephone Number" value="<?php echo $facility_tel ?>" required>
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
                <a href="#" data-toggle="modal" data-target="#addInsurance"> Add Insurance </a>
              
              </div>

     
            </div>


            <!-****************************************** SECOND SECTION->
            <!-- /.col -->
            <div class="col-md-6">
              <label>Opening Days:</label>
              
              
            
                <!-SUNDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="sunday" value="0"> Sunday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="sun_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="sun_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

                <!-MONDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="monday" value="1"> Monday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="mon_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="mon_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

              <!-TUESDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="tuesday" value="2"> Tuesday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="tue_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="tue_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

              <!-WEDNESDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="wednesday" value="3"> Wednesday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="wed_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="wed_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

              <!-THURSDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="thursday" value="4"> Thursday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="thu_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="thu_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

              <!-FRIDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="friday" value="5"> Friday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="fri_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="fri_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

              <!-SATURDAY->
                <div class="form-group">
                  
                      <div class="col-xs-4 col-lg-3">
                        <label>
                          <input type="checkbox" name="saturday" value="6"> Saturday
                        </label>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="sat_opentime" required>
                          </div>
                            
                        </div>
                      </div>

                      <div class="col-xs-3">
                        <div class="bootstrap-timepicker">
                          <div class="form-group">
                             <input type="text" class="form-control timepicker" name="sat_closetime" required>
                          </div>
                        </div>
                      </div>

                </div>
             
       

              </br></br>

        

            </div>
              

            
                           
          </div>
            <!-- /.col -->
        </div>
          <!-- /.row -->
      
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

          
      
  <div class="modal fade modal-primary" id="addInsurance">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Insurance</h4>
            </div>
            <div class="modal-body">
              <input name="newInsuranceName" id="newInsuranceModal" type="text" class="form-control" placeholder="Insurance Name">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" onclick="addNewInsurance()">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- /.modal -->

      
      

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
            zoom: 17,
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

    function addNewInsurance(){

      var newInsurance = document.getElementById("newInsuranceModal").value;
      
       $.ajax({  
                     url:"addNewInsurances.php",  
                     method:"post",  
                     data:{insu: newInsurance},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                        window.location.reload();  
                     }  
                });  
    }


</script>

</body>
</html>
