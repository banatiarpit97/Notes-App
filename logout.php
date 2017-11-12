<?php
if(isset($_SESSION['user_id']) && ($_GET['logout']==1)){
	session_destroy();
	setcookie("rememberme", "", time()-3600);
	setcookie('user_id', "", time() - 3600, "/");
	setcookie('username', "", time() - 3600, "/");
	setcookie('password', "", time() - 3600, "/");

}

?>