<?php
session_start();
include("connection.php");

		if((!isset($_POST['user_id']))||(!isset($_POST['key']))){
			echo "<div class = 'alert alert-danger'><h2>There was an error, Please open a valid link sent to you!</h2></div>";
			exit;
		}

		$user_id = $_POST['user_id'];
		$key = $_POST['key'];
		$time = time()-86400;



		$user_id = mysqli_real_escape_string($link, $user_id);
		$key = mysqli_real_escape_string($link, $key);

		$sql = "SELECT user_id FROM forgotpassword WHERE resetkey = '$key' AND user_id = '$user_id' AND timeset>'$time' AND status = 'pending'";
		echo $sql;
		$result = mysqli_query($link, $sql);
		if(!$result){
	     echo "<div class = 'alert alert-danger'>Error running the query <div>".mysqli_error($link);
	     exit;
        }
    $count = mysqli_num_rows($result);

		if($count !== 1){
			echo "<div class = 'alert alert-danger'>You either opened a wrong link or the link expired222</div>";
			exit;
		}

$missingPassword = "<p><b>Please enter a password<b><p>";
$invalidPassword = "<p><b>Password must contain atleast 6 characters, including one capital letter and a number<b><p>";
$missingPassword2 = "<p><b>Please confirm your password<b><p>";
$differentPasswords = "<p><b>Passwords don't match<b><p>";

if(empty($_POST['password'])){
	$error .= $missingPassword;
}
elseif(!(strlen($_POST['password'])>6 and preg_match('/[A-Z]/', $_POST['password']))){
      $error .= $invalidPassword;
}
else{
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	if(empty($_POST['password2'])){
	   $error .= $missingPassword2;
    }
    else{
       $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
       if($password != $password2){
       	  $error .= $differentPasswords;
       }
    }
}

if($error){
	$signuperrorMessage = "<div class = 'alert alert-danger'>".$error."</div>";
	echo $signuperrorMessage;
	exit;

	
}
$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);
$user_id = mysqli_real_escape_string($link, $user_id);

$sql = "UPDATE users SET password = '$password' WHERE users_id = '$user_id'";
$result = mysqli_query($link, $sql);

if(!result){
	echo '<div class = "alert alert-danger">There was a problem updating the password in the db<div>';
	exit;
}

$used = "used";

$sql = "UPDATE forgotpassword SET status='$used' WHERE user_id = '$user_id' AND resetkey = '$key'";
echo $sql;
$result = mysqli_query($link, $sql);

if(!result){
	echo '<div class = "alert alert-danger">Error running the query<div>';
}
else{
	echo '<div class = "alert alert-success">Your password has been changed.<a href="http://banati.thecompletewebhosting.com/Notes-App/index.php"></a><div>';
}




?>