<?php

session_start();
include("connection.php");

$user_id = $_SESSION['user_id'];
$newemail = $_POST['editEmail'];

$sql = "SELECT * FROM users WHERE email='$newemail'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count>0){
	echo '<div class = "alert alert-danger">This email already exist, Please choose another one.<div>';
	exit;
}

$sql = "SELECT * FROM users WHERE users_id = '$user_id'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count == 1){
   $row = mysqli_fetch_array($result, MYSQL_ASSOC);
   $email = $row['email'];

}
else{
    echo "There was a problem retrieving username and email from db";
}

$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
$sql = "UPDATE users SET activation2 = '$activationKey' WHERE users_id = '$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
	echo '<div class = "alert alert-danger">Unable to insert details in the db.<div>';
	exit;
}
else{
	$message = "Please Click on the following link to change you email:\n\n";
    $message .= "http://banati.thecompletewebhosting.com/Notes-App/activatenewemail.php?email=".urlencode($email)."&newemail=".urlencode($newemail)."&key=".$activationKey;
    $activationMail = mail($newemail, "Chane your email", $message, "From:"."arpit@banati.in");

    if($activationMail){
	    echo "<div class = 'alert alert-success'>A confirmation mail has been sent to ".$newemail."<br> Please click on the link to change your email.";
    }
    else{
	    echo "<div class = 'alert alert-danger'>Error sending Email $mysqli_error()";
}
}



?> 	