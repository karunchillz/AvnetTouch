<?php
	session_start();
	$given_user = $_REQUEST['username'];
	$given_pass = $_REQUEST['password'];
	
	$user_firstname = "";
	
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
			$found++;
		}
	}
	mysqli_close($con);
	
	if($found == 0){
		echo "not found";
		$_SESSION['loggedInError'] = "Invalid Username or Password";	
		$_SESSION['logged'] = 0;
		header('Location: /atouch/administration.php'); exit;
	}
	else{
		echo "found";
		$_SESSION['logged'] = 1;
		$_SESSION['loggedInUser'] = $given_user;
		$_SESSION['loggedInUserName'] = $user_firstname;
		echo $_SESSION['loggedInUser'] ;
		$_SESSION['loggedInError'] = "";
		header('Location: /atouch/administration.php'); exit;
	}
?>