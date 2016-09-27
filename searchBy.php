<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>Searching a Medical Facility</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  

  <!--RATEIT-->
  <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk"
            type="text/javascript"></script>


  <style>
  #myMapModal .modal-dialog  {width:75%;}
  </style>
  </head>

  <body class="hold-transition skin-green sidebar-mini" style="margin:0px; padding:0px;" onload="load()">

  <!-- Site wrapper -->
  <div class="wrapper">

    <!-Main Header->
    <header class="main-header">

       <!-- Logo -->
      <a href="/mfspotter/Landing.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MFS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MFS</b>potter</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <div class="navbar-header">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </div>

   
        <!-Menu on the left side->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
         <!-- User Account: style can be found in dropdown.less -->

          <?php
            include("config.php");
            session_start();
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

    <!-Sidebar ->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/profpic/<?php echo $_SESSION["profilePicture"] ?>.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo "". $_SESSION["firstname"] ." ". $_SESSION["lastname"] . ""; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">SEARCH OPTIONS</li>
          
          <li>
            <a href="#" data-toggle="modal" data-target="#locationModal">
              <i class="fa fa-location-arrow"></i> <span>Location</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

           <li>
            <a href="#" data-toggle="modal" data-target="#specialModal">
              <i class="fa fa-user-md"></i> <span>Specialization</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

           <li>
            <a href="#" data-toggle="modal" data-target="#insuranceModal">
              <i class="fa fa-medkit"></i> <span>Insurance</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

           <li>
            <a href="#" data-toggle="modal" data-target="#schedModal">
              <i class="fa fa-book"></i> <span>Schedule</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

          <li>
            <a href="#" data-toggle="modal" data-target="#combinedModal">
              <i class="fa fa-object-group"></i> <span>Combined Search</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>


        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!- MODALS ->

    <!- LOCATION ->
    
      <div class="modal fade modal" id="locationModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Location</h4>
            </div>
            <div class="modal-body">
            
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <label class="autoLink" style="display: none;"><b>Current location:</b> <span>not found</span></label>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <div class="col-xs-12">
                        
                        <label class="control-label">Radius:</label>
                        <select id="radiusSelect" style="color: green;">
                          <option value="1">1km</option>
                          <option value="5">5km</option>
                          <option value="25" selected>25km</option>
                          <option value="100">100km</option>
                          <option value="200">200km</option>
                        </select>
                        <label class="control-label"> <button type="button" class="btn btn-block btn-danger" onclick="searchLocationsNear()">Search</button>
                   </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <label>Define Location</label>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      <select id="radiusSelect2" class="form-control" style="color: green;"> </br></br>
                          <option value="1">1km</option>
                          <option value="5">5km</option>
                          <option value="25" selected>25km</option>
                          <option value="100">100km</option>
                          <option value="200">200km</option>
                      </select>
                     <input id="address" type="text" class="form-control" placeholder="Address">
                     <button type="button" class="btn btn-block btn-danger" onclick="searchLocationsNearDefine()">Search</button>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>


            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-SPECIALIZATION ->
      <div class="modal fade modal-success" id="specialModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Specialization</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
              <div class="form-group col-xs-12">
                <select class="form-control select2" name="selected_specialization[]" id="select2_specialization" multiple="multiple" data-placeholder="Select a Medical Treatment" style="width: 100%;">

                   <?php
                  include ("config.php");
                  $q = "SELECT specializationID, specialization FROM specialization";
                  $result = mysqli_query($connect, $q);
                  if (mysqli_num_rows($result) > 0) {
    
                    while($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="'. $row['specializationID'] . '">' . $row['specialization'] . '</option>';
                    }

                  }
                  mysqli_close($connect);             
                  ?>

                </select>
              </div>
                    <!-- /.form-group -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" onclick="searchSpecialization()">Search</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-INSURANCE ->
      <div class="modal fade modal-success" id="insuranceModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Insurance</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
                <form name = "search" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">

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
                  mysqli_close($connect);             
                  ?>
                  </select>
                </div>

              </div>
            </div> <!-- /.mdoal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" onclick="searchInsurances()">Search</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-SCHEDULE ->
      <div class="modal fade modal-success" id="schedModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Schedule</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
                <form name = "search" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">

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
                        
                </div> <!-- /.form group -->
                
                </br></br></br>

                <!- Identify time ->
                <div class="bootstrap-timepicker">
              
                  <div class="form-group col-xs-12">
                    <label>Opening Time:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control timepicker" id="opentime" name="opentime" required>
                    </div>
                 
                  </div>
           
                </div>

                <!-CLOSING TIME->
                <div class="bootstrap-timepicker">
                  <div class="form-group col-xs-12">
                    <label>Closing Time:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control timepicker"  id="closetime" name="closetime" required>
                    </div>
                    
                  </div>
                    
                </div>

              </div> <!-- /.box body -->
            </div> <!-- /. modal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" id="btntest" onclick="searchSchedule()">Search</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
    <!-COMBINED SEARCH ->
      <div class="modal fade modal-success" id="combinedModal">
        <div class="modal-dialog">
          <div class="modal-content">
            
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Combined Search</h4>
            </div>

            <div class="modal-body">
             
              <div class="box-body">
                <div class="row">

                  <form name = "search" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
                  
                  <div class="col-md-6">

                      <div class="form-group">
                        
                        <label class="control-label">Radius:</label>
                        <select class="form-control" id="c-radiusSelect">
                          <option value="1">1 km</option>
                          <option value="5">5 km</option>
                          <option value="25" selected>25 km</option>
                          <option value="100">100 km</option>
                          <option value="200">200 km</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Specialization:</label>
                        <select class="form-control select2" name="c-selected_specialization[]" id="c-select2_specialization" multiple="multiple" data-placeholder="Select a Medical Treatment" style="width: 100%;">
                            <?php
                            include ("config.php");
                            $q = "SELECT specializationID, specialization FROM specialization";
                            $result = mysqli_query($connect, $q);
                            if (mysqli_num_rows($result) > 0) {           
                              while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'. $row['specializationID'] . '">' . $row['specialization'] . '</option>';
                              }
                            }
                            mysqli_close($connect);             
                            ?>
                        </select>
                      </div>

                      <div class="form-group">
                          <label>Insurances Covered:</label>
                          <select name="c-selected_insurances[]" id="c-select2_insurances" class="form-control input-group select2" multiple="multiple" placeholder="Select Insurances" style="width: 100%;">
                            <?php
                            include ("config.php");
                            $q = "SELECT insurancesID, insuranceName FROM insurances";
                            $result = mysqli_query($connect, $q);
                            if (mysqli_num_rows($result) > 0) {
                              while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'. $row['insurancesID'] . '">' . $row['insuranceName'] . '</option>';
                              }
                            }
                            mysqli_close($connect);             
                            ?>
                          </select>
                      </div>
                   
                  </div> <!-- col 1st section -->

                  
                  <div class="col-md-6">
                    <div class="form-group">
                         
                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" name="days[]" value="0"> Sun
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday"  name="days[]" value="1"> Mon
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" id="days" name="days[]" value="2"> Tue
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" name="days[]" value="3"> Wed
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" name="days[]" value="4"> Thu
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" name="days[]" value="5"> Fri
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal cday" name="days[]" value="6"> Sat
                          </label>
                        </div>
                      </div>
                            
                    </div> <!-- /.form group -->
                    
                    </br></br></br>

                    <!-OPENING TIME->
                    <div class="bootstrap-timepicker">
                  
                      <div class="form-group col-xs-12">
                        <label>Opening Time:</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control timepicker" id="c-opentime" name="c-opentime" required>
                        </div>
                     
                      </div>
                    </div>

                    <!-CLOSING TIME->
                    <div class="bootstrap-timepicker">
                      <div class="form-group col-xs-12">
                        <label>Closing Time:</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control timepicker"  id="c-closetime" name="c-closetime" required>
                        </div>
                        
                      </div>
                    </div>

                  </div> <!-- col 2nd section -->

                </div> <!-- row -->

              </div> <!-- /.box body -->

            </div> <!-- /. modal body -->
            
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" id="btntest" onclick="combinedSearch()">Search</button>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!--

<div class="modal fade" id="myMapModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">View Map</h4>

            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-md-12">
                          <div id="map" style="width: 80%; height: 80%"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
       
    </div>
   
    </div>
    -->
<!--

<div class="modal fade" id="myMapModal-each">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">View Map</h4>

            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-md-12">
                          <div id="map" style="width: 80%; height: 80%"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        
    </div>
    
    </div>
    <!-- /.modal -->




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      
        <div class="row">

          <div class="col-md-4">
            <h3> Searching a Medical Facility  </h3>
          </div>

        

        </div>
       
      </section>





      <!- Main content ->
      <section class="content">
        <div class="box box-solid box-success">
      
          <div class="box-body">
            <div class="row"> 

                          
              <!-****************************************** TABLE SECTION->  
              
              <div class="col-md-5">   
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">List of Facilities</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="result"></div>
                </div>
              </div>

              <div class="col-md-7">
                <div id="map" style="width: 100%; height: 100%"></div>
              </div>

            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->

        <div class="box-footer">
          <i></i>
        </div>
    </div>
    <!-- / end of Main content -->

  </section>

 </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Version 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">MFSpotter</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/select2.full.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

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

<!-- FUNCTIONS -->
<!-- location search functions -->

<!-- Search Insurance Function -->

<!-- Search Schedule Function -->

<script type="text/javascript" src="plugins/rateit-scripts/jquery.rateit.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#result').slimScroll({
        height: '600px'
    });
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    //Initialize Select2 Elements
    $(".select2").select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });


  });

 $('#myMapModal-each').on('shown.bs.modal', function(e) {
        var element = $(e.relatedTarget);
        var data = element.data("lat").split(',')
        initialize(new google.maps.LatLng(data[0], data[1]));
    });

    var map;
    var markers = [];
    
    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };


  function load() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.1907, 125.4553),
        zoom: 12,
        mapTypeId: 'roadmap',
        icon: "marker/marker.png",
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });
      infoWindow = new google.maps.InfoWindow();
      if (navigator.geolocation) {
              // when geolocation is available on your device, run this function
              navigator.geolocation.getCurrentPosition(foundYou, notFound);
      } else {
              // when no geolocation is available, alert this message
              alert('Geolocation not supported or not enabled.');
      }
  }

  function geocode(add){

    var geocoder = new google.maps.Geocoder();
    var address = add;

    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();


        initialize(latitude,longitude,address);

      } 

        }); 
  }
   function initialize(latitude,longitude,a) {
        var latlng = new google.maps.LatLng(latitude,longitude);
        
        var myOptions = {
          zoom: 14,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false
        };
        var map = new google.maps.Map(document.getElementById("map"),myOptions);

        var marker = new google.maps.Marker({
          position: latlng, 
          map: map, 
            title:"location : " + a
        }); 
      }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
  }

  function searchLocationsNearDefine(){
  
    var add = document.getElementById("address").value;
    var geocoder = new google.maps.Geocoder();
    var address = add;

    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
          


            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(latitude , longitude),
                zoom: 17,
                icon: "marker1.png",
                mapTypeId: 'roadmap'
              });

            var radius = document.getElementById('radiusSelect2').value;
            var infoWindow = new google.maps.InfoWindow;
            var searchUrl = 'display.php?lat=' + latitude + '&lng=' + longitude + '&radius=' + radius;
      
            // Change this depending on the name of your PHP file
            downloadUrl(searchUrl, function(data) {
              var xml = data.responseXML;
              var markers = xml.documentElement.getElementsByTagName("marker");
              for (var i = 0; i < markers.length; i++) {
                var name = markers[i].getAttribute("name");
                var address = markers[i].getAttribute("address");
                var type = markers[i].getAttribute("distance");
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var html = "<b>" + name + "</b> <br/>" + address;
                var icon = customIcons[0] || {};
                var marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  icon: icon.icon
                });
                bindInfoWindow(marker, map, infoWindow, html);
              }

              var coordi = new google.maps.LatLng(
                parseFloat(latitude),
                parseFloat(longitude));
              var mark = new google.map.Marker({
                map:map,
                position:coordi,
                icon: customIcons[0] || {}
              })
             bindInfoWindow(mark, map, infoWindow, "im here");
            });
           

            $.ajax({  
                             url:"displayTable.php",  
                             method:"post",  
                             data:{lati: latitude, longi: longitude, radi: radius},  
                             dataType:"text",  
                             success:function(data)  
                             {  
                                  $('#result').html(data);  
                             }  
             }); 



      } 
      else {alert("Error: Please try again.");}


    }); //end geocode
  }
  function searchLocationsNear() {

      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
             

            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(pos.lat, pos.lng),
                zoom: 10,
                icon: "marker1.png",
                mapTypeId: 'roadmap'
              });

            var radius = document.getElementById('radiusSelect').value;
           
            var infoWindow = new google.maps.InfoWindow;
            var searchUrl = 'display.php?lat=' + pos.lat + '&lng=' + pos.lng + '&radius=' + radius;
      
            // Change this depending on the name of your PHP file
            downloadUrl(searchUrl, function(data) {
              var xml = data.responseXML;
              var markers = xml.documentElement.getElementsByTagName("marker");
              for (var i = 0; i < markers.length; i++) {
                var name = markers[i].getAttribute("name");
                var address = markers[i].getAttribute("address");
                var type = markers[i].getAttribute("distance");
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var html = "<b>" + name + "</b> <br/>" + address;
                var icon = customIcons[0] || {};
                var marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  icon: icon.icon
                });
                bindInfoWindow(marker, map, infoWindow, html);
              }

              //add geocode here
            });
           

              $.ajax({  
                             url:"displayTable.php",  
                             method:"post",  
                             data:{lati: pos.lat, longi: pos.lng, radi: radius},  
                             dataType:"text",  
                             success:function(data)  
                             {  
                                  $('#result').html(data);  
                             }  
                        });  
           






          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

     
     
    }
  
  function searchInsurances() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.0719049, 125.6125521),
        zoom: 12,
        animation: google.maps.Animation.DROP,
        icon: "marker/marker.png",
        mapTypeId: 'roadmap'
      });

      
      var selectedInsurance = $("#select2_insurances").val();
      

      var infoWindow = new google.maps.InfoWindow;
      var searchUrl = 'searchByInsurances_Map.php?insurances=' + selectedInsurance;
   
      // Change this depending on the name of your PHP file
      downloadUrl(searchUrl, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("distance");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[0] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });


      $.ajax({  
                     url:"searchByInsurances_Table.php",  
                     method:"post",  
                     data:{insuarray: selectedInsurance},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });  
    }


  function searchSpecialization() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.0719049, 125.6125521),
        zoom: 12,
        animation: google.maps.Animation.DROP,
        icon: "marker/marker.png",
        mapTypeId: 'roadmap'
      });

      
      var selectedSpecialization = $("#select2_specialization").val();
      

      var infoWindow = new google.maps.InfoWindow;
      var searchUrl = 'searchBySpecialization_Map.php?insurances=' + selectedSpecialization;
   
      // Change this depending on the name of your PHP file
      downloadUrl(searchUrl, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("distance");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[0] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });


      $.ajax({  
                     url:"searchBySpecialization_Table.php",  
                     method:"post",  
                     data:{insuarray: selectedSpecialization},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });  
    }




  function getSelectedChbox() {
        var selchbox = [];        // array that will store the value of selected checkboxes

        // gets all the input tags in frm, and their number
       // var inpfields = frm.getElementsByTagName('input');
        var inpfields = document.getElementsByClassName("minimal");
        var nr_inpfields = inpfields.length;

        // traverse the inpfields elements, and adds the value of selected (checked) checkbox in selchbox
        for(var i=0; i<nr_inpfields; i++) {
          if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
        }

        return selchbox;
      }


  function getSelectedChboxCombined() {
        var selchbox = [];        // array that will store the value of selected checkboxes

        // gets all the input tags in frm, and their number
       // var inpfields = frm.getElementsByTagName('input');
        var inpfields = document.getElementsByClassName("cday");
        var nr_inpfields = inpfields.length;

        // traverse the inpfields elements, and adds the value of selected (checked) checkbox in selchbox
        for(var i=0; i<nr_inpfields; i++) {
          if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
        }

        return selchbox;
      }

  function searchSchedule(){


        document.getElementById('btntest').onclick = function(){
          var selchb = getSelectedChbox(this.form); 

          //ADD VALIDATION IF VARIABLE IS BLANK

          var close = $("#closetime").val();
          var open = $("#opentime").val();


         var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(7.057964, 125.585403),
            zoom: 13,
            animation: google.maps.Animation.DROP,
            icon: "marker/marker.png",
            mapTypeId: 'roadmap'
          });

          
        
          var infoWindow = new google.maps.InfoWindow;
          var searchUrl = 'searchBySchedule_Map.php?schedule='+ selchb.toString() + '&op='+ open + '&cl=' + close ;
          
          // Change this depending on the name of your PHP file
          downloadUrl(searchUrl, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var name = markers[i].getAttribute("name");
              var address = markers[i].getAttribute("address");
              var type = markers[i].getAttribute("distance");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<b>" + name + "</b> <br/>" + address;
              var icon = customIcons[0] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
          });


            $.ajax({  
                     url:"searchBySchedule_Table.php",  
                     method:"post",  
                     data:{schedule: selchb, op: open, cl:close},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });
            
        }
      }

  function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

  function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

  function doNothing() {}

  function combinedSearch(){

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
        var c_selectedInsurance = $("#c-select2_insurances").val();
        var c_selectedSpecialization = $("#c-select2_specialization").val();
        var c_radius = document.getElementById('c-radiusSelect').value;
        var c_dayOfWeek = getSelectedChboxCombined();
        var c_openTime = $("#c-opentime").val();
        var c_closeTime = $("#c-closetime").val();

        var map = new google.maps.Map(document.getElementById("map"), {center: new google.maps.LatLng(pos.lat, pos.lng),
                zoom: 10, animation: google.maps.Animation.DROP, icon: "marker/marker.png", mapTypeId: 'roadmap'});

        var searchUrl = 'searchByCombined_Map.php?lati='+ pos.lat + '&longi='+ pos.lng + '&insu=' + c_selectedInsurance.toString() + '&specia=' + c_selectedSpecialization.toString() + '&radi=' + c_radius + '&days=' + c_dayOfWeek + '&open=' + c_openTime + '&close=' + c_closeTime;

         
        downloadUrl(searchUrl, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var name = markers[i].getAttribute("name");
              var address = markers[i].getAttribute("address");
              var type = markers[i].getAttribute("distance");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<b>" + name + "</b> <br/>" + address;
              var icon = customIcons[0] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
          });

       $.ajax({  
          url:"searchByCombined_Table.php",  
          method:"post",  
          data:
            {
              lati: pos.lat, 
              longi: pos.lng, 
              insu: c_selectedInsurance, 
              specia: c_selectedSpecialization, 
              radi: c_radius, 
              days: c_dayOfWeek, 
              open: c_openTime, 
              close: c_closeTime
            },  
          dataType:"text",  
          success:function(data)  
          {  
            $('#result').html(data);  
          }  
        });

      }, function() {handleLocationError(true, infoWindow, map.getCenter());});
    } 
    else{
      handleLocationError(false, infoWindow, map.getCenter());
    }

  }

function foundYou(position) {
  var geocoder = new google.maps.Geocoder();
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

</script>

</body>
</html>