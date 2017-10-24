<?php

session_start();
if(!isset($_SESSION['user_id'])){
  header("location:http://banati.thecompletewebhosting.com/Notes-App/index.php");
  
}

include("connection.php");
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE users_id = '$user_id'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count == 1){
   $row = mysqli_fetch_array($result, MYSQL_ASSOC);
   $username = $row['username'];
   $email = $row['email'];

}
else{
    echo "There was a problem retrieving username and email from db";
}

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
  <div class="container-fluid" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NotesNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b>Online Notes</b></a>
    </div>
    <div class="collapse navbar-collapse" id="NotesNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://banati.thecompletewebhosting.com/Notes-App/profile.php">Profile</a></li>
      <li><a href="#">Help</a></li>
      <li><a href="#">Contact Us</a></li>
      <li ><a href="http://banati.thecompletewebhosting.com/Notes-App/notesDisplay.php">My Notes</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href = "#">Logged in as <b><?php echo $username; ?></b></a></li>
      <li><a href = "http://banati.thecompletewebhosting.com/Notes-App/index.php?logout=1">Log out</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="container notesDislay">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      <h2><b>Genereal Account Settings:</b></h2>
      <div class="table-resonsive">
        <table class="table table-condensed table-hover table-bordered settingsTable">
          <tr data-toggle = "modal" data-target = "#editusernameModal">
            <td>Username</td>
            <td><?php echo $username; ?><span class="edit pull-right"><i class="fa fa-pencil"></i></span></td>
          </tr>
          <tr data-toggle = "modal" data-target = "#editemailModal">
            <td>Email</td>
            <td><?php echo $email; ?><span class="edit pull-right"><i class="fa fa-pencil"></i></span></td>
          </tr >
          <tr data-toggle = "modal" data-target = "#editpasswordModal">
            <td>Password</td>
            <td>*********** <span class="edit pull-right"><i class="fa fa-pencil"></i></span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit Username Modal -->
<div id="editusernameModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Username:</h4>
      </div>
      <form id = "updateusername" method="post">
      <div class="modal-body">
        <div id="updateusernamemessage"></div>
        <div class="form-group">
          <input type="text" name="editUsername" placeholder="New Username" class="form-control" value="<?php echo $username; ?>">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="editUsernameBtn" value="Submit" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Username Modal -->

<!-- Edit Username Modal -->
<div id="editemailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Email Address:</h4>
      </div>
      <form id="updateemail" method="post">
      <div class="modal-body">
        <div id="updateemailmessage"></div>

        <div class="form-group">
          <input type="text" name="editEmail" placeholder="New Email Address" class="form-control" value="<?php echo $email; ?>">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="editEmailBtn" value="Submit" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Email Modal -->

<!-- Edit Password Modal -->
<div id="editpasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Password:</h4>
      </div>
      <form id="updatepassword" method="post">
      <div class="modal-body">
        <div id="updatepasswordmessage"></div>

        <div class="form-group">
          <input type="password" name="oldPassword" placeholder="Current Password" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="newPassword" placeholder="New Password" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="confirmNewPassword" placeholder="Confirm New Password" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="editPassword" value="Submit" class="btn signup">
        <input type="button" name="cancel" value="Cancel" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Password Modal -->



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
  <script type="text/javascript" src="profile.js"></script>
  <!--Script FIles included here -->
</body>

</html>
