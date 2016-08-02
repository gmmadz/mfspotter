<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title>Search By Insurance</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk" type="text/javascript"></script>
    


    <script type="text/javascript">
    //<![CDATA[
    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;

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
        zoom: 9,
        mapTypeId: 'roadmap',
        icon: "marker/marker.png",
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });
      infoWindow = new google.maps.InfoWindow();

      locationSelect = document.getElementById("locationSelect");
      locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(markers[markerNum], 'click');
        }
      };
   }

   function searchLocations() {
     var address = document.getElementById("addressInput").value;
     var geocoder = new google.maps.Geocoder();
     geocoder.geocode({address: address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
        searchLocationsNear(results[0].geometry.location);
       } else {
         alert(address + ' not found');
       }
     });
   }

   function clearLocations() {
     infoWindow.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
   }



//**************************************************************************GET CURRENT LOCATION METHOD
function searchInsurances() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(7.057964, 125.585403),
        zoom: 13,
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

    function getCheckBoxes(checkboxName){
      var checkboxes = document.getElementsByName(checkboxName);
      var checkboxesChecked = [];

      for (var i=0; i<checkboxes.length; i++){
        if (checkboxes[i].checked){
          checkboxesChecked.push(checkboxes[i]);
        }
      }

      return checkboxesChecked.length > 0 ? checkboxesChecked : null;

    }


  </script>
  </head>

  <body style="margin:0px; padding:0px;" onload="load()">
  <form name = "search" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
  <div class="box box-solid box-primary">
   
   <div class="box-body">
    
    <div class="row"> 
      <div class="col-md-6">
          <div class="form-group">
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
             

                  <input type="button" onClick="getCheckboxes(" value="Search"/>
          </div>
                  <div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
                  <div id="map" style="width: 100%; height: 80%"></div>
      </div>

    <div class="col-md-6">   
      <div class="box">
              <div class="box-header">
                <h3 class="box-title">List of Facilities</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body" id="result">
               
              </div>
      </div>
    </div>


      </div>
    </div>
  </div>


</body>














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
<!-- page script -->
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
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


    $(".select2").select2();
    $(".select2").select2({
      placeholder: "Select a Insurances",
      allowClear: true
    });
  });
</script>







  </body>
</html>