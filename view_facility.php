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
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk"
            type="text/javascript"></script>
  <style>
    #map { margin: 20px 0; padding: 0; height: 300px; float: left; width: 100%; }
  </style>


  <style>
    .header-text{
    background-image: url('dist/img/MedicalFacility.jpg');
    height: 700px;
    width: auto;
    margin:auto;
  }
  </style>

</head>

<body class="hold-transition skin-green layout-top-nav">
<!-- Site wrapper -->
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
                <div id="map" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
                <div id="message"></div>
            </div>

            <!- Search Radius ->  
            <div class="col-md-4">
              
                <form class="form-horizontal">
              
                  <div class="form-group">
                    <label class="col-sm-2 control-label" style="color: orange; ">Radius</label>

                    <div class="col-xs-3">
                      <select class="form-control">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                    </div>

                     <label class="control-label" style="color: orange; ">km</label>
                  </div>

                </form>

              
              <!-************ SEARCH BY OPTIONS AND LOCATION->

              <button type="button" class="btn btn-block btn-danger btn-lg">Search from current location</button>

              </br>

              <!-********************** DEFINE AREA OF SEARCH ->
              <div class="panel box box-solid box-warning">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                      Define Area of Search
                    </a>
                  </h4>
                </div>

                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                    <div class="row">

                    <!- Identify Location->
                    <center><div class="input-group margin col-xs-8">
                      <input type="text" class="form-control" placeholder="Identify Location">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-info">Go!</button>
                          </span>
                    </div>
                    </center>

                    <!- Select a medical treatment->
                      
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

                    <!- Select schedule->

                    
                    <div class="form-group">
                     
                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Sun
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Mon
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Tue
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Wed
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Thu
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Fri
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-1">
                          <label>
                            <input type="checkbox" class="minimal"> Sat
                          </label>
                        </div>
                      </div>
                        
                    </div>
                
                    </br></br></br>

                    <!- Identify time ->

                    <div class="bootstrap-timepicker">
                
                    <div class="form-group col-xs-12">
                      <label>Opening Time:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control timepicker">
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
                        <input type="text" class="form-control timepicker">
                      </div>
                      
                    </div>
                    
                  </div>

                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" class="btn btn-block btn-danger">Search</button>
                  </div>
              
                </div>
                <!--/ collapseOne  -->

              </div>
              <!--/ panelbox -->










            </div>
            <!--/ col-md-4 -->
          
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
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

  });

</script>

<script type="text/javascript">
/*GOOGLE MAP*/
    

    var marker;

    function initialize() {
      
      //var latlng = new google.maps.LatLng(7.057964, 125.585403);
     
      var options = {
        /*zoom: 13,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.SATELLITE
        */
        zoom: 13,
        center: new google.maps.LatLng(7.057964, 125.585403),
         // disableDefaultUI: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
          },
        mapTypeId: 'terrain',
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
  

    /*function geocodeLatLng(geocoder, map, infowindow) {
        var input = "7.057964, 125.585403";
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        var latlng = {lat: parseFloat(document.getElementById("longhi").value), lng: parseFloat(document.getElementById("longhi").value)};
       
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[1].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
    */

    function saveData() {
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("address").value);
      var type = document.getElementById("type").value;
      var latlng = marker.getPosition();

      var url = "phpsqlinfo_addrow.php?name=" + name + "&address=" + address +
                "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();
      downloadUrl(url, function(data, responseCode) {
        if (responseCode == 200 && data.length >= 1) {
          infowindow.close();
          document.getElementById("message").innerHTML = "Location added.";
        }
      });
    
    }

    function insertData(){
      var lat = marker.getPosition().lat();
      var long = marker.getPosition().lng();
      document.getElementById("longhi").value = ""+long;
      document.getElementById("lati").value = ""+lat;
      alert("hi" + lat + "long " + long);
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
</script>

</body>
</html>
