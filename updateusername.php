<?php

session_start();
include("connection.php");

$id = $_SESSION['user_id'];

$username = $_POST['editUsername'];

$sql = "UPDATE users SET username='$username' WHERE users_id='$id'";
$result = mysqli_query($link, $sql);

if(!result){
	 echo '<div class="alert alert-danger">There was a problem updating the new username in the database!</div>';
    exit;
}


?>