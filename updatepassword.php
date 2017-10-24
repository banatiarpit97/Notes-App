<?php

session_start();
include("connection.php");

$missingCurrentPassword = "<p><b>Please enter your current password</b></p>";
$wrongCurrentPassword = "<p><b>The password entered is incorrect</b></p>";
$missingNewPassword = "<p><b>Please enter a new password </b></p>";
$invalidNewPassword = "<p><b>Your password must be atleat 6 letters long and include one capital letter and 1 number</b></p>";
$differentPasswords = "<p><b>Passwords don't match </b></p>";
$missingNewPassword2 = "<p><b> Please confirm your new password</b></p>";

if(empty($_POST['oldPassword'])){
	$error .= $missingCurrentPassword;
}
else{
	$currentPassword = $_POST['oldPassword'];
	$currentPassword = filter_var($currentPassword, FILTER_SANITIZE_STRING);   
    $currentPassword = mysqli_real_escape_string($link, $currentPassword);
    $currentPassword = hash('sha256', $currentPassword);

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT password FROM users WHERE users_id='$user_id'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
	if($count !== 1){
			echo "<div class = 'alert alert-danger'>There was a problem running the query</div>";
			exit;
		}
	else{
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		if($currentPassword != $row[password]){
	         $error .= $wrongCurrentPassword;

		}
	}	
}

if(empty($_POST['newPassword'])){
	$error .= $missingNewPassword;
}
elseif(!(strlen($_POST['newPassword'])>6 and preg_match('/[A-Z]/', $_POST['newPassword']))){
      $error .= $invalidNewPassword;
}
else{
	$newPassword = filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING);
	if(empty($_POST['confirmNewPassword'])){
	   $error .= $missingNewPassword2;
    }
    else{
       $confirmNewPassword = filter_var($_POST['confirmNewPassword'], FILTER_SANITIZE_STRING);
       if($newPassword != $confirmNewPassword){
       	  $error .= $differentPasswords;
       }
    }
}

if($error){
	$errorMessage = "<div class = 'alert alert-danger'>".$error."</div>";
	echo $errorMessage;
}
else{
	$newPassword = mysqli_real_escape_string($link, $newPassword);
    $newPassword = hash('sha256', $newPassword);
    $sql = "UPDATE users SET password = '$newPassword' WHERE users_id='$user_id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
    	echo "<div class = 'alert alert-danger'>There was a problem updating the password</div>";
			exit;
    }
    else{
    	echo "<div class = 'alert alert-success'>Your password has been updated successfully</div>";
    	exit;
    }

}


?>