<?php
session_start();

include('connection.php');

$missingEmail = "<p><b>Please enter your email address<b><p>";
$invalidEmail = "<p><b>Please enter a valid Email address<b><p>";

if(empty($_POST["forgotpasswordEmail"])){
	$forgotpassworderror .= $missingEmail;
}
else{
	$forgotpasswordEmail = filter_var($_POST["forgotpasswordEmail"], FILTER_SANITIZE_EMAIL);
	if(!filter_var($forgotpasswordEmail, FILTER_VALIDATE_EMAIL)){
      $forgotpassworderror .= $invalidEmail;
	}

}

if($forgotpassworderror){
	$forgotpassworderrorMessage = "<div class = 'alert alert-danger'>".$forgotpassworderror."</div>";
	echo $forgotpassworderrorMessage;
}

$forgotpasswordEmail = mysqli_real_escape_string($link, $forgotpasswordEmail);

$sql = "SELECT * FROM users WHERE email = '$forgotpasswordEmail'";
$result = mysqli_query($link, $sql);

if(!result){
	echo '<div class = "alert alert-danger">Error running the query<div>';
	exit;
}
else{
	$count = mysqli_num_rows($result);
	if($count != 1){
		echo '<div class = "alert alert-danger">This email does not exist, Enter an existing email address<div>';
		exit;
	}
}	

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$user_id = $row['users_id'];
	$key = bin2hex(openssl_random_pseudo_bytes(16));
	$time = time();
	$status = "pending";
	$sql = "INSERT INTO forgotpasswsord (user_id, resetkey, timeset, status) VALUES('$user_id', '$key', '$time', '$status')";
	// echo $sql;
    $result = mysqli_query($link, $sql);
    // echo $result;
    // echo mysqli_error();
    if(!$result){
	echo "<div class = 'alert alert-danger'>Error inserting in db <div>".mysqli_error($link);
	exit;
    }
    
    $message = "Please Click on the following link to reset your password:\n\n";
    $message .= "http://banati.thecompletewebhosting.com/Notes-App/resetpassword.php?user_id=".$user_id."&key=".$key."\n\n\n";
    $message .= "*This link is only valid for 24 hours"; 
    $resetpasswordMail = mail($forgotpasswordEmail, "Reset your Password", $message, "From:"."arpit@banati.in");

    if($resetpasswordMail){
	    echo "<div class = 'alert alert-success'>An email has been sent to ".$forgotpasswordEmail."<br> Please click on the link to reset your password.";
    }
    else{
	    echo "<div class = 'alert alert-danger'>Error sending Email $mysqli_error()";
}




?>