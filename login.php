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
	$_SESSION['user_id'] = $row['users_id'];
	$_SESSION['email'] = $row['email'];
  setcookie('loggedin', 'yes', time()+1296000);
	if(empty($_POST['remember'])){
		echo "success";
	}else{

    setcookie('user_id', $row['users_id'], time() + (86400 * 30), "/");
    setcookie('username', $row['username'], time() + (86400 * 30), "/");
    setcookie('password', $row['password'], time() + (86400 * 30), "/");
         echo "success";

       // $authenticator1 = bin2hex(openssl_random_pseudo_bytes(10));
       // $authenticator2 = openssl_random_pseudo_bytes(20);

       // function f1($a, $b){
       // 	 $c = $a.",".bin2hex($b);
       // 	 return $c;
       // }
       // $cookieValue = f1($authenticator1, $authenticator2);
       // setcookie('rememberme', $cookieValue, time()+1296000);

       // function f2($a){
       // 	$b = hash('sha256', $a);
       // 	return $b;
       // }
       // $user_id = $_SESSION['user_id'];
       // $authenticator2 = f2($authenticator2);
       // $expiry = date('Y-m-d H:i:s', time()+1296000);
       // $sql = "INSERT INTO rememberme (authenticator1, f2authenticator2, user_id, expires) VALUES ('$authenticator1', '$authenticator2', '$user_id', '$expiry')";
       // $result = mysqli_query($link, $sql);
       // if(!$result){
       // 	echo "<div class = 'alert alert-danger'><b>Unable to store data in db</b></div>";
       //    exit;
       // }
       // else{
       // 	echo "success";
       // }
	 }
  }
}