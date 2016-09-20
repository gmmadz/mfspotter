<?php
  $facility_id = $_GET["id"];
  

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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Full Calendar stuffs -->
  <link href='assets/css/fullcalendar.css' rel='stylesheet' />
  <link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

  <style>

  body {
  
    text-align: center;
    font-size: 14px;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  }

  #trash{
    width:32px;
    height:32px;
    float:left;
    padding-bottom: 15px;
    position: relative;
  }
    
  #wrap {
    width: 1100px;
    margin: 0 auto;
  }
    
  #external-events {
    float: left;
    width: 150px;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;
    text-align: left;
  }
    
  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
  }
    
  #external-events .fc-event {
    margin: 10px 0;
    cursor: pointer;
  }
    
  #external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
  }
    
  #external-events p input {
    margin: 0;
    vertical-align: middle;
  }

  #calendar {
    float: right;
    width: 900px;
  }

</style>


</head>

<body class="hold-transition skin-green layout-top-nav">

<div class="wrapper">

  <!-Main Header->
   <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <div class="navbar-header">
        <a href="/mfspotter/Landing.html" class="navbar-brand"><b>MF</b>Spotter</a>
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
    <?php 

    echo '
      <label id="facility_id" for="'. $facility_id . '"></label>
      <label id="user_id" for="'. $_SESSION["user_id"] . '"></label>';
    ?>

    <!- Main content -->

    <!- Main content --> 

      <!-- Your Page Content Here -->
        <br>
        <div id='wrap'>

          <div id='external-events'>
            <h4>Draggable Events</h4>
            <div class='fc-event'>New Event</div>
            <p>
              <img src="assets/img/trashcan.png" id="trash" alt="">
            </p>
          </div>

          <div id='calendar'></div>

          <div style='clear:both'></div>

          <xspan class="tt">x</xspan>

        </div>
    

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

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Full calendar scripts -->
<script src='assets/js/moment.min.js'></script>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src='assets/js/jquery-ui.min.js'></script>
<script src='assets/js/fullcalendar.min.js'></script>
<script>

  $(document).ready(function() {

    var zone = "05:30";  //Change this to your timezone
    var facID = document.getElementById("facility_id").htmlFor;
    var usID = document.getElementById("user_id").htmlFor;

    console.log(facID);
    console.log(usID)

  $.ajax({
    url: 'process.php',
        type: 'post', // Send post data
        data: {
          type:"fetch",
          user_id:usID,
          facility_id:facID
        },
        async: false,
        success: function(s){
          json_events = s;
        }
  });


  var currentMousePos = {
      x: -1,
      y: -1
  };
    jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/

    $('#calendar').fullCalendar({
      events: JSON.parse(json_events),
      //events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
      utc: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: true,
      droppable: true, 
      slotDuration: '00:30:00',
      eventReceive: function(event){
        var title = event.title;
        var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
        $.ajax({
            url: 'process.php',
            data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
            data: {
              type:"new",
              title: title,
              startdate: start,
              zone: zone,
              user_id:usID,
              facility_id:facID
            },
            type: 'POST',
            dataType: 'json',
            success: function(response){
              event.id = response.eventid;
              $('#calendar').fullCalendar('updateEvent',event);
            },
            error: function(e){
              console.log(e.responseText);

            }
          });
        $('#calendar').fullCalendar('updateEvent',event);
        console.log(event);
      },
      eventDrop: function(event, delta, revertFunc) {
            var title = event.title;
            var start = event.start.format();
            var end = (event.end == null) ? start : event.end.format();
            $.ajax({
          url: 'process.php',
          data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
          type: 'POST',
          dataType: 'json',
          success: function(response){
            if(response.status != 'success')                
            revertFunc();
          },
          error: function(e){             
            revertFunc();
            alert('Error processing your request: '+e.responseText);
          }
        });
        },
        eventClick: function(event, jsEvent, view) {
          console.log(event.id);
              var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
              if (title){
                  event.title = title;
                  console.log('type=changetitle&title='+title+'&eventid='+event.id);
                  $.ajax({
                url: 'process.php',
                data: 'type=changetitle&title='+title+'&eventid='+event.id,
                type: 'POST',
                dataType: 'json',
                success: function(response){  
                  if(response.status == 'success')                
                          $('#calendar').fullCalendar('updateEvent',event);
                },
                error: function(e){
                  alert('Error processing your request: '+e.responseText);
                }
              });
              }
      },
      eventResize: function(event, delta, revertFunc) {
        console.log(event);
        var title = event.title;
        var end = event.end.format();
        var start = event.start.format();
            $.ajax({
          url: 'process.php',
          data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
          type: 'POST',
          dataType: 'json',
          success: function(response){
            if(response.status != 'success')                
            revertFunc();
          },
          error: function(e){             
            revertFunc();
            alert('Error processing your request: '+e.responseText);
          }
        });
        },
      eventDragStop: function (event, jsEvent, ui, view) {
          if (isElemOverDiv()) {
            var con = confirm('Are you sure to delete this event permanently?');
            if(con == true) {
            $.ajax({
                url: 'process.php',
                data: 'type=remove&eventid='+event.id,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                  console.log(response);
                  if(response.status == 'success'){
                    $('#calendar').fullCalendar('removeEvents');
                        getFreshEvents();
                      }
                },
                error: function(e){ 
                  alert('Error processing your request: '+e.responseText);
                }
              });
          }   
        }
      }
    });

  function getFreshEvents(){
    $.ajax({
      url: 'process.php',
          type: 'POST', // Send post data
          data: 'type=fetch',
          async: false,
          success: function(s){
            freshevents = s;
          }
    });
    $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
  }


  function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

  });

</script>


<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<script type="text/javascript">
    document.getElementById("medOption").onclick = function () {
        location.href = "/mfspotter/searchCenter2.php";
    };
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->





</body>
</html>
