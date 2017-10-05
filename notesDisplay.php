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
      <a class="navbar-brand" href="#"><b>Online Notes</b></a>
    </div>
    <div class="collapse navbar-collapse" id="NotesNavbar">
    <ul class="nav navbar-nav">
      <li ><a href="#">Home</a></li>
      <li><a href="#">Help</a></li>
      <li><a href="#">Contact Us</a></li>
      <li class="active"><a href="#">My Notes</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href = "#">Logged in as <b>Arpit Banati</b></a></li>
      <li><a href = "#">Log out</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="container notesDislay">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      <div class="buttons">
        <button type="button" id ="addnote" class="btn btn-info btn-lg">Add Note</button>
        <button type="button" id ="edit" class="btn btn-info btn-lg pull-right">Edit</button>
        <button type="button" id ="done" class="btn btn-lg pull-right hidden">Done</button>
        <button type="button" id ="allnotes" class="btn btn-info btn-lg hidden">All Notes</button>
      </div>
      <div class="notepad">
        <textarea rows="10"></textarea>
      </div>
    </div>
  </div>
</div>


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
  <!--Script FIles included here -->
</body>

</html>
