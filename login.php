<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MFSpotter | Log in</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>MF</b>Spotter</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" class="popup-form" action="">

    <!-- LOG IN PHP -->
    <?php
      include("config.php");
      
      //START OF CODE
      
      if( isset($_POST["username"]) || isset($_POST["password"]))
      {
        $user = $_POST["username"];
        $password = $_POST["password"];
        
        if(!empty($user) && !empty($password))
        {
          $selectQuery = "SELECT * FROM user WHERE username = '$user'";
          $SelectSql = @mysqli_query($conn, $selectQuery);
          $row = mysqli_fetch_array($SelectSql);
        
          
          //Username Existence Validation
          
          if(mysqli_num_rows($SelectSql) == 0)
            echo "<br/> Username does not exist!";
          
          //Password Validation
          
          else if(!($row['password'] == $password))
            echo "<br/>Password is incorrect!";
          
          //If everything is correct and valid
          
          else
          { 

            session_start();
            // Set session variables
            $_SESSION["username"] = $user;
            $_SESSION["password"] = $password;
            $_SESSION["user_id"] = $row['userID'];
            $_SESSION["firstname"] = $row['firstName'];
            $_SESSION["middlename"] = $row['middleName'];
            $_SESSION["lastname"] = $row['lastName'];
            $_SESSION["usertype"] = $row['userType'];

            
            redirect("Landing.php");
          }
            
        }
        
        else
          echo "<script>alert('INVALID! Input All fields')</script>";
      
      }
      else
        echo "";
      
      function redirect($url)
      {
        echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">';
        die();
      }
      
      mysqli_close($conn);
    ?>

    <!-- end of PHP -->

      <div class="form-group has-feedback">
        <input type="username" name="username" value="" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" value="" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" value="Log In" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

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

