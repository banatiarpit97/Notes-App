

<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/png">
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <style>

      .container{
        margin-top: 12%;
      }
      .alert-success{
        height: 300px;
        width: 80%;
        margin: auto;
        text-align: center;
        padding:25px;
      }
      p{
        font-size: 18px;
      }
      a p{
        margin-top: 7%;
      }
      h4{
        margin-top: 9% !important;
      }
      a{
        font-weight: bold;
        margin-top: 3%;
      }
    </style>
</head>
  <body>

<div class="container">
  <?php

    session_start();
    include('connection.php');

    if((!isset($_GET['email']))||(!isset($_GET['newemail']))||(!isset($_GET['key']))){
      echo "<div class = 'alert alert-danger'><h2>There was an error, Please open a valid link sent to you!</h2></div>";
      exit;
    }

    $email = ($_GET['email']);
    $newemail = ($_GET['newemail']);
    $key = ($_GET['key']);

    $email = mysqli_real_escape_string($link, $email);
    $newemail = mysqli_real_escape_string($link, $newemail);
    $key = mysqli_real_escape_string($link, $key);

    $sql = "UPDATE users SET email = '$newemail', activation2='0' WHERE (email = '$email' AND activation2 = '$key') LIMIT 1";
    $result = mysqli_query($link, $sql);

    if(mysqli_affected_rows($link) == 1){
      session_destroy();
      setcookie("rememberme", "", time()-3600);
      echo "<div class = 'alert alert-success'><h1>Your email has been changed.</h1><h4>You can continue to login now:<br><a href = 'http://banati.thecompletewebhosting.com/Notes-App/index.php' class = 'btn btn-info'>Log In</a></h4></div>";
    }
    else{
      echo "<div class = 'alert alert-danger'><h2>There was an error, either check the link or try again later!</h2></div>";
      exit;
    }


  ?>

</div>

  <!--Script FIles included here -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <!--Script FIles included here -->
  </body>

  </html>
