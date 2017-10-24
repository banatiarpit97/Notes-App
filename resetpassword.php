<?php
session_start();
include('connection.php');

?>



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

<!--     <style>

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
    </style> -->
</head>
  <body>

<div class="container">
    <h1>Reset Password</h1>
    <div id="resetpassworderror"></div>
	<?php

		if((!isset($_GET['user_id']))||(!isset($_GET['key']))){
			echo "<div class = 'alert alert-danger'><h2>There was an error, Please open a valid link sent to you!</h2></div>";
			exit;
		}

		$user_id = ($_GET['user_id']);
		$key = ($_GET['key']);
		$time = time()-86400;


		$user_id = mysqli_real_escape_string($link, $user_id);
		$key = mysqli_real_escape_string($link, $key);

		$sql = "SELECT user_id FROM forgotpassword WHERE (resetkey = '$key' AND user_id = '$user_id' AND timeset>'$time' AND status = 'pending')";
		$result = mysqli_query($link, $sql);
		if(!$result){
	     echo "<div class = 'alert alert-danger'>Error running the query <div>".mysqli_error($link);
	     exit;
        }
    $count = mysqli_num_rows($result);

		if($count !== 1){
			echo "<div class = 'alert alert-danger'>You either opened a wrong link or the link expired111</div>";
			exit;
		}

		echo "<form method='POST' id='passwordreset'>
	           <input type='hidden' name='key' value=$key>
	           <input type='hidden' name='user_id' value=$user_id>
	           <div class='form-group'>
		         <label>Enter your new Password:</label>
		         <input type='password' name='password' id='password' class='form-control'>
	           </div>
	           <div class='form-group'>
		         <label>Re-enter your new Password:</label>
		         <input type='password' name='password2' id='password2' class='form-control'>
	           </div>
	            <input type='submit' name='resetpassrord' class='btn btn-lg btn-success' value='Reset-Passrord'>

              </form>"


	?>

</div>

  <!--Script FIles included here -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">

  	$("#passwordreset").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
      console.log(datatopost);


    $.ajax({
			url: "storeresetpassword.php",
			type: "POST",
			data: datatopost,
			success: function(data){
					$("#resetpassworderror").html(data);
			},
			error: function(){
			    $("#resetpassworderror").html("<div class = 'alert alert-danger'>There was an error with the ajax call.Please try again later</div>");	
			}
		});

   });
  </script>
  <!--Script FIles included here -->
  </body>

  </html>
