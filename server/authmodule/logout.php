<?php
	session_start();
	session_destroy();
	header('Location: /atouch/index.php'); exit;
?>