<?php
	session_start();
	$_SESSION['loggedIn'] = 0;
	$_SESSION['loggedInUser'] = "";
	$_SESSION['loggedInUserName'] = "";
	$_SESSION['loggedInUserGroup'] = "";
	$_SESSION['loggedInError'] = "";
	header('Location: /atouch/administration.php'); exit;
?>