<?php
	session_start();

	$projId = $_REQUEST["projId"];
	echo $projId;

	$_SESSION['projId'] = $projId;

	header('Location: /atouch/proj.html'); exit;
?>