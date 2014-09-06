<?php
	session_start();
	$given_user = $_REQUEST['username'];
	$given_pass = $_REQUEST['password'];
	$given_projId = $_REQUEST['projId'];

	$user_firstname = "";
	$user_group = "";
	$found = 0;
	
	// Create connection
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{
		$query = "SELECT * FROM T_USERS WHERE EMAIL = '".$given_user."' AND PASSWORD = '".$given_pass."'";
		$result = mysqli_query($con,$query);
		
		while($row = mysqli_fetch_array($result)) {
			$user_firstname = $row['FNAME']." ".$row['LNAME'];
			$user_group = $row['GROUP_ROLE'];
			$found++;
		}
	}
	mysqli_close($con);
	
	if($found == 0){
		$_SESSION['loggedInError'] = "Invalid Username or Password";		
		header('Location: /atouch/login.php'); exit;
	}
	else{
		echo "found";
		$_SESSION['logged'] = 1;
		$_SESSION['loggedInUser'] = $given_user;
		$_SESSION['loggedInUserName'] = $user_firstname;
		$_SESSION['loggedInUserGroup'] = $user_group;
		
		if($given_projId == 0){
			$location = 'Location: /atouch/index.php';
		}else{
			$location = 'Location: /atouch/index.php#/proj?projId='.$given_projId;
		}
		header($location); exit;
	}
?>