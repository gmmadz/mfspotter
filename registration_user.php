<!DOCTYPE html>
<html>
<!- ADD SESSION->

<!-IMPORT->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MFSpotter | Registration Page</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>


<body class="hold-transition register-page">

<div class="register-box">
  
  <div class="register-logo">
    <a href="/mfspotter/login.php"><b>MFS</b>potter</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register as a user</p>


    <!-NEED TO CHANGE FORM ACTION->
    <form action="" method="post" >

    <!- Validation, insert to database and Session ->
    <?php
      include("config.php");
      
      
      
      if( isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["repassword"]))
      {
        $fName = $_POST["firstname"];
        $mName = $_POST["middlename"];
        $lName = $_POST["lastname"];
        $user = $_POST["username"];
        $pword = $_POST["password"];
        $repword = $_POST["repassword"];

        //Check if inputs are filled

        if(!empty($fName) && !empty($mName) && !empty($lName) && !empty($user) && !empty($pword) && !empty($repword))
        {
          $selectQuery = "SELECT * FROM user WHERE username = '$user'";
          $SelectSql = @mysqli_query($connect, $selectQuery);
          $row = mysqli_fetch_array($SelectSql);
        
          
          //Username Existence Validation
          if(mysqli_num_rows($SelectSql) > 0)
            echo "<br/> Username already exist!";
          
          //Password Validation
          else if(!($pword == $repword))
            echo "<br/>Password does not match!";
          
          //If everything is correct and valid   
          else
          { 
            //INSERT TO DATABASE
            $insertquery = "INSERT INTO `user`(`userType`, `username`, `password`, `firstName`, `middleName`, `lastName`, `picture`) VALUES ('User', '$user', '$pword', '$fName', '$mName', '$lName', 'default')";

            $insert=mysqli_query($connect, $insertquery);

            //SELECT AGAIN THE NEWLY INSERTED USER
            $selectQuery2 = "SELECT * FROM user WHERE username = '$user'";
            $SelectSql2 = @mysqli_query($connect, $selectQuery2);
            $row2 = mysqli_fetch_array($SelectSql2);

            //START THE SESSION

            session_start();
            // Set session variables
            $_SESSION["username"] = $user;
            $_SESSION["password"] = $pword;
            $_SESSION["user_id"] = $row2['userID'];
            $_SESSION["firstname"] = $row2['firstName'];
            $_SESSION["middlename"] = $row2['middleName'];
            $_SESSION["lastname"] = $row2['lastName'];
            $_SESSION["usertype"] = $row2['userType'];
            $_SESSION["profilePicture"] = $row2['picture'];

            
            redirect("Landing.php");
          }
            
        }
        
        else
          echo "<script>alert('Please fill up all fields!')</script>";
      
      }      
      else
        echo "";
      
      function redirect($url)
      {
        echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
        die();
      }
      
      mysqli_close($connect);
    ?>
      

     	<!-FIRST NAME->
      <div class="form-group has-feedback">
        <input type="text" name="firstname" value="" class="form-control" placeholder="First Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

	  	<!-MIDDLE NAME->
      <div class="form-group has-feedback">
        <input type="text" name="middlename" value="" class="form-control" placeholder="Middle Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	 
	  	<!-LAST NAME->
	  <div class="form-group has-feedback">
        <input type="text" name="lastname" value="" class="form-control" placeholder="Last Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

		<!-USER NAME->
      <div class="form-group has-feedback">
        <input type="text" name="username" value="" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
     
     	<!-PASSWORD->
      <div class="form-group has-feedback">
        <input type="password" name="password" value="" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <!-CONFIRM PASSWORD->
      <div class="form-group has-feedback">
        <input type="password" name="repassword" value="" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>


      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>

		<!-REGISTER BUTTON->
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" value="Register" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  <!-NEED TO CHANGE HREF->
    <a href="/mfspotter/login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>




<!-- /.register-box -->




<!-JAVASCRIPT IMPORT->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
