<?php

session_start();

include('connection.php');

$missingEmail = "<p><b>Please enter your email address<b><p>";
$missingPassword = "<p><b>Please enter a password<b><p>";

if(empty($_POST["loginEmail"])){
	$loginerror .= $missingEmail;
}
else{
	$loginEmail = filter_var($_POST["loginEmail"], FILTER_SANITIZE_EMAIL);
}

if(empty($_POST["loginPassword"])){
	$loginerror .= $missingPassword;
}
else{
	$loginPassword = filter_var($_POST["loginPassword"], FILTER_SANITIZE_STRING);
}

if($loginerror){
	echo '<div class = "alert alert-danger">'.$loginerror.'</div>';
}
else{
	$loginEmail = mysqli_real_escape_string($link, $loginEmail);
    $loginPassword = mysqli_real_escape_string($link, $loginPassword);
    $loginPassword = hash('sha256', $loginPassword);

$sql = "SELECT * FROM users WHERE (email = '$loginEmail' AND password = '$loginPassword' AND activation = 'activated')";
$result = mysqli_query($link, $sql);
if(!result){
	echo '<div class = "alert alert-danger">Error running the query<div>';
	exit;
}
$count = mysqli_num_rows($result);

if($count != 1){
    echo "<div class = 'alert alert-danger'><b>Wrong Email or Password</b></div>";
}
else{
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$_SESSION['username'] = $row['username'];
	$_SESSION['email'] = $row['email'];
	if(empty($_POST['rememberme'])){
		echo "success";
	}else{

	}
  }
}