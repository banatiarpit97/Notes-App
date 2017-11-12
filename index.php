<?php
session_start();

include('connection.php');
include('logout.php');

if((isset($_COOKIE['user_id']))&&(isset($_COOKIE['username']))&&(isset($_COOKIE['password']))){
  $id = $_COOKIE['user_id'];
  $username = $_COOKIE['username'];
  $password = $_COOKIE['password'];
  $sql = "SELECT * FROM users WHERE users_id='$id' AND username = '$username' AND password = '$password'";
  $result = mysqli_query($link, $sql);
  $count = mysqli_num_rows($result);
  if($count == 1){
    $_SESSION['user_id'] = $id;
     header("location:http://banati.thecompletewebhosting.com/Notes-App/notesDisplay.php");

  }
}
// include('remember.php');

?>

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
	<title>Notes App</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body ng-app = "notesApp" ng-controller = "EditDetails">

<!--Navbar -->
<nav class="navbar navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NotesNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Online Notes</a>
    </div>
    <div class="collapse navbar-collapse" id="NotesNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Help</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href = "#loginModal" data-toggle="modal">Login</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <h1>Online Notes App</h1>
  <p>Your Notes with you wherever you go.</p>
  <p>Easy to use, protects all your notes</p>
  <button type="button" class = "btn btn-lg signupfree" data-toggle="modal" data-target="#signupModal">Sign up-It's free</button>
</div>

<!-- Signup Modal -->
<form method="post" id="SignUpForm" >

<div id="signupModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign up today and Start using our Online Notes App!</h4>
      </div>
      <div class="modal-body">
        <div id="signuperror"></div>
        <div class="form-group">
          <input type="text" name="signupUsername" placeholder="Username" class="form-control">
        </div>
        <div class="form-group">
          <input type="email" name="signupEmail" placeholder="Email Address" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="signupPassword" placeholder="Choose Password" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="signupConfirmPassword" placeholder="Confirm Password" class="form-control">
      </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="signup" value="Sign up" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
    </div>
  </div>
</div>
</form>

<!-- Sign Up Modal -->

<!-- Login Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login :</h4>
      </div>
      <form id="loginForm" method="post">
      <div class="modal-body">
        <div id="loginerror"></div>

        <div class="form-group">
          <input type="email" name="loginEmail" placeholder="Enter Email Address" class="form-control">
        </div>
      <div class="form-group">
        <input type="password" name="loginPassword" placeholder="Enter Password" class="form-control">
      </div>
      <div class="checkbox">

      <label>
        <input type="checkbox" name="remember" value="remember">
         Remember me
      </label>
      <a data-dismiss = "modal" data-toggle="modal" href="#forgotpasswordModal" class="pull-right">Forgot Passsword?</a>
     </div>

      </div>
      <div class="modal-footer">
        <input type="button" name="register" value="Register" class="btn btn-default pull-left" data-dismiss = "modal" data-toggle="modal" data-target="#signupModal">
        <input type="submit" name="login" value="Login" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Login Modal -->

<!-- forgot password Modal -->
<div id="forgotpasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password? Enter your Email Address</h4>
      </div>
      <form class="" method="post" id="forgotpassword">
      <div class="modal-body">
        <div id="forgotpassworderror"></div>

        <div class="form-group">
          <input type="email" name="forgotpasswordEmail" value="" placeholder="Enter Email Address" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <input type="button" name="register" value="Login" class="btn btn-default pull-left" data-dismiss = "modal" data-toggle="modal" data-target="#loginModal">
        <input type="submit" name="sendemail" value="Send Email" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- forgot password Modal -->





<!--footer-->
<div class="container-fluid footer">
<p>Arpit Banati &copy; <?php echo date('Y'); ?></p>
</div>
<!--footer-->




  <!--Script FIles included here -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="index.js"></script>

  <!--Script FIles included here -->
</body>

</html>
