<?php
session_start();

// if((empty($_SESSION['user_id'])) && (!empty($_COOKIE['rememberme']))){

// 	list($authenticator1, $authenticator2) = explode(",", $_COOKIE['rememberme'] );
// 	$authenticator2 = hex2bin($authenticator2);
// 	$f2authenticator2 = hash('sha256', $authenticator2);

// 	$sql = "SELECT * FROM rememberme WHERE authenticator1 = '$authenticator1'";
// 	$result = mysqli_query($link, $sql);
// 	if(!$result){
// 		echo "<div class = 'alert alert-danger'><b>Unable to store data in db</b></div>";
//         exit;
// 	}

// 	$count = mysqli_num_rows($result);
//     if($count !== 1){

//         echo "<div class = 'alert alert-danger'><b>Remember me process failed</b></div>";
//         exit;
//     }
// 	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//     if(!hash_equals($row['f2authenticator2'], $f2authenticator2)){

//     	 echo "<div class = 'alert alert-danger'><b>Hash equals returned false</b></div>";
//     }
//     else{
//     	$authenticator1 = bin2hex(openssl_random_pseudo_bytes(10));
//        $authenticator2 = openssl_random_pseudo_bytes(20);

//        function f1($a, $b){
//        	 $c = $a.",".bin2hex($b);
//        	 return $c;
//        }
//        $cookieValue = f1($authenticator1, $authenticator2);
//        setcookie('rememberme', $cookieValue, time()+1296000);

//        function f2($a){
//        	$b = hash('sha256', $a);
//        	return $b;
//        }
//        $_SESSION['user_id'] = $row['user_id'];
//        $user_id = $_SESSION['user_id'];
//        $authenticator2 = f2($authenticator2);
//        $expiry = date('Y-m-d H:i:s', time()+1296000);
//        $sql = "INSERT INTO rememberme (authenticator1, f2authenticator2, user_id, expires) VALUES ('$authenticator1', '$authenticator2', '$user_id', '$expiry')";
//        $result = mysqli_query($link, $sql);
//        if(!$result){
//        	echo "<div class = 'alert alert-danger'><b>Unable to store data in db</b></div>";
//           exit; 
//        }
//     	$_SESSION['user_id'] = $row['user_id']; 
//     	header("location:http://banati.thecompletewebhosting.com/Notes-App/notesDisplay.php");

//     }
// }



?>