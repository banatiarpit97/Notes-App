<?php 

session_start();
include('connection.php');

$missingEmail = "<p><b>Please enter your email address<b><p>";
$invalidEmail = "<p><b>Please enter a valid Email address<b><p>";
$missingPassword = "<p><b>Please enter a password<b><p>";
$invalidPassword = "<p><b>Password must contain atleast 6 characters, including one capital letter and a number<b><p>";
$missingPassword2 = "<p><b>Please confirm your password<b><p>";
$differentPasswords = "<p><b>Passwords don't match<b><p>";
$missingUsername = "<p><b>Please enter a username<b><p>";


if(empty($_POST['signupUsername'])){
	$signuperror .= $missingUsername;
}
else{
	$signupUsername = filter_var($_POST["signupUsername"], FILTER_SANITIZE_STRING);
}

if(empty($_POST["signupEmail"])){
	$signuperror .= $missingEmail;
}
else{
	$signupEmail = filter_var($_POST["signupEmail"], FILTER_SANITIZE_EMAIL);
	if(!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)){
      $signuperror .= $invalidEmail;
	}

}

if(empty($_POST['signupPassword'])){
	$signuperror .= $missingPassword;
}
elseif(!(strlen($_POST['signupPassword'])>6 and preg_match('/[A-Z]/', $_POST['signupPassword']))){
      $signuperror .= $invalidPassword;
}
else{
	$signupPassword = filter_var($_POST['signupPassword'], FILTER_SANITIZE_STRING);
	if(empty($_POST['signupConfirmPassword'])){
	   $signuperror .= $missingPassword2;
    }
    else{
       $signupConfirmPassword = filter_var($_POST['signupConfirmPassword'], FILTER_SANITIZE_STRING);
       if($signupPassword != $signupConfirmPassword){
       	  $signuperror .= $differentPasswords;
       }
    }
}

if($signuperror){
	$signuperrorMessage = "<div class = 'alert alert-danger'>".$signuperror."</div>";
	echo $signuperrorMessage;
}

$signupUsername = mysqli_real_escape_string($link, $signupUsername);
$signupEmail = mysqli_real_escape_string($link, $signupEmail);
$signupPassword = mysqli_real_escape_string($link, $signupPassword);
$signupPassword = hash('sha256', $signupPassword);

//if username already exist in the app

$sql = "SELECT * FROM users WHERE username = '".$signupUsername."'";
$result = mysqli_query($link, $sql);

if(!result){
	echo '<div class = "alert alert-danger">Error running the query<div>';
	exit;
}
else{
	$results = mysqli_num_rows($result);
	if($results){
		echo '<div class = "alert alert-danger">The username already exist, Do you want log in?<div>';
		exit;
	}
}

// //if email already exist in the app

$sql = "SELECT * FROM users WHERE email = '$signupEmail'";
$result = mysqli_query($link, $sql);

if(!result){
	echo '<div class = "alert alert-danger">Error running the query<div>';
	exit;
}
else{
	$results = mysqli_num_rows($result);
	if($results){
		echo '<div class = "alert alert-danger">The email already exist, Do you want log in?<div>';
		exit;
	}
}

$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
$sql = "INSERT INTO users(username, email, password, activation) VALUES('$signupUsername', '$signupEmail', '$signupPassword', '$activationKey')";
$result = mysqli_query($link, $sql);
if(!$result){
	echo '<div class = "alert alert-danger">Error inserting data in db<div>';
    exit;
}

//send user a mail activate.php with their email and activation key

$message = "Please Click on the following link to activate your account:\n\n";
$message .= "http://banati.thecompletewebhosting.com/Notes-App/activate.php?email=".urlencode($signupEmail)."&key=".$activationKey;
$activationMail = mail($signupEmail, "Confirm your Registration", $message, "From:"."arpit@banati.in");

if($activationMail){
	echo "<div class = 'alert alert-success'>Thank you for registring: A confirmation mail has been sent to ".$signupEmail."<br> Please click on the activation link to activate your account.";
}
else{
	echo "<div class = 'alert alert-danger'>Error sending Email $mysqli_error()";
}











?> 