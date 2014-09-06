<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$given_cur_pass = mysqli_real_escape_string($con, $_POST['cur_pwd']);
	$given_new_pass = mysqli_real_escape_string($con, $_POST['new_pwd']);
	$given_retype_pass = mysqli_real_escape_string($con, $_POST['re_pwd']);
	$found = 0;
	

	//if($given_new_pass == $given_retype_pass){
		

		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			$query = "SELECT * FROM T_USERS WHERE EMAIL = '".$_SESSION['loggedInUser']."' AND PASSWORD = '".$given_cur_pass."'";
			$result = mysqli_query($con,$query);
			
			while($row = mysqli_fetch_array($result)) {
				$found++;
			}
		}
		
		if($found == 0){
			echo "Change Password Failed! Current Password doesn't match";
		}
		else{
			$query = "UPDATE T_USERS SET PASSWORD = '".$given_new_pass."' WHERE EMAIL = '".$_SESSION['loggedInUser']."'";
			$rows = mysqli_query($con,$query);
			
			if($rows == 1)
				echo "Password Successfully changed";
			else
				echo "Retry Password Change";
		}
		mysqli_close($con);
	//}
	//else{
	//	echo "Passwords doesn't match!";
	//}
?>