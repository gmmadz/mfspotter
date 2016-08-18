<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>MFSpotter</title>

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

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk"
            type="text/javascript"></script>
  </head>

  <body class="hold-transition skin-green sidebar-mini" style="margin:0px; padding:0px;" onload="load()">

  <!-- Site wrapper -->
  <div class="wrapper">

    <!-Main Header->
    <header class="main-header">

       <!-- Logo -->
      <a href="../mfspotter/Landing.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MF</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MF</b>Spotter</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

   
        <!-Menu on the left side->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
          <!-- User Account: style can be found in dropdown.less -->

          <?php
  
            include("config.php");
            
            if( isset($_COOKIE['usname']) && isset($_COOKIE['pword']))
            {
                
                $user = $_COOKIE['usname'];
                $password = $_COOKIE['pword'];

                $selectQuery = "SELECT * FROM user WHERE username = '$user'";
                $SelectSql = @mysqli_query($conn, $selectQuery);
                $row = mysqli_fetch_array($SelectSql);

                $firstname = $row['firstName'];
                $lastname = $row['lastName'];
                $usertype = $row['userType'];

                echo '<li class="dropdown user user-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">'.$firstname.' '.$lastname .'</span>
                      </a>
                      <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                          <p>
                            Alexander Pierce
                            <small>'. $usertype .'</small>
                          </p>
                        </li>';            
            }
              
            else
            {
              echo "<script>alert('Not Logged in!')</script>";
              redirect('login.php');
            }
              
            
            function redirect($url)
            {
              echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
              die();
            }
            mysqli_close($conn);
            
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
    </header>

    <!-Sidebar ->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Gerald Martin Madarang</p>
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


        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!- MODALS ->

    <!- Location Modal ->
    
      <div class="modal fade modal-success" id="locationModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Location</h4>
            </div>
            <div class="modal-body">
            
              <div class="col-xs-5">
                <label class="control-label">Radius:</label>
                <select id="radiusSelect" style="color: orange;">
                  <option value="1" selected>1mi</option>
                  <option value="25" selected>25mi</option>
                  <option value="100">100mi</option>
                  <option value="200">200mi</option>
                </select>
                <label class="control-label">km</label>
              </div>
              </br>
              <!--
              <button type="button" class="btn btn-block btn-danger" onclick="searchLocationsNear()">Search</button>

              <button type="button" class="btn btn-block btn-danger btn-lg" onclick="getCurrentLocation()">Search from current location</button>
              -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline" onclick="searchLocationsNear()">Search</button>
              <button type="button" class="btn btn-outline"  onclick="getCurrentLocation()">Search from current location</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-Specialization ->
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
                <select class="form-control select2" multiple="multiple" data-placeholder="Select a Medical Treatment" style="width: 100%;">
                  <option>Dentist</option>
                  <option>Dermatology</option>
                  <option>Nutritionist</option>
                  <option>Opthalmology(Eye)</option>
                  <option>Optometrist(Eye)</option>
                  <option>Orthodontic(Teeth)</option>
                  <option>Pedetrician</option>
                </select>
              </div>
                    <!-- /.form-group -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-Insurance ->
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
                  $result = mysqli_query($conn, $q);
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

    <!-Schedule ->
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
              <button type="button" class="btn btn-outline" id="btntest" onclick="clickme()">Search</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Searching a Medical Facility
        </h1>
      </section>


      <!- Main content -->
      <section class="content">
        <div class="box box-solid box-success">
      
          <div class="box-body">
            <div class="row"> 

            <!-****************************************** MAP SECTION->
             <div class="col-md-6"> 
              <div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
                <div id="map" style="width: 100%; height: 80%"></div>
             </div>
                
              <!-****************************************** TABLE SECTION->  
              </br>
              <div class="col-md-6">   
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">List of Facilities</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="result"></div>
                </div>
              </div>

            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->

        <div class="box-footer">
          <i>Insert instruction here</i>
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
      Anything you want
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
<script src="plugins/googlemap/location.js"></script>
<!-- Search Insurance Function -->
<script src="plugins/googlemap/searchInsuranceFunc.js"></script>
<!-- Search Schedule Function -->
<script src="plugins/googlemap/searchScheduleFunc.js"></script>


<!-- page script -->
<script>
  $(function () {
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
</script>

</body>
</html>