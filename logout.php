<?php
	session_start();
	session_unset();
	session_destroy();
	setcookie("cookie_user", $_COOKIE['user'], time() - (2 * 365 * 24 * 60 * 60));
	setcookie("cookie_pass", $_COOKIE['pass'],time() - (2 * 365 * 24 * 60 * 60));
	header("location:index.php");
?>