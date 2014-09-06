<?php
	session_start();
	// Create connection
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$fname = $request->fname;
	$lname = $request->lname;
	$email = $request->email;
	$contact = $request->contact;
	$password = $request->password;
	
	$ck_name = "/^[A-Za-z0-9 ]{3,20}$/";
	$ck_email = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i";
	$ck_password = "/^[A-Za-z0-9!@#$%^&*()_]{5,20}$/";
	$ck_contact = "/^[0-9]{9,15}$/";
	
	$found = 0;
	
	if (!preg_match($ck_name, $fname) || !preg_match($ck_name, $lname) || !preg_match($ck_email, $email) || !preg_match($ck_password, $password) || !preg_match($ck_contact, $contact)) {
		echo "Oops! Something went wrong";
	} 
	
	else{
		$query = "SELECT EMAIL, CONTACT FROM T_USERS";
		$result = mysqli_query($con,$query);
		
		while($row = mysqli_fetch_array($result)) {
			$ex_email = $row['EMAIL'];
			$ex_contact = $row['CONTACT'];
			if($ex_email == $email || $ex_contact == $contact){
				$found++;
			}
		}
		if($found == 0){
			$query = "INSERT INTO `avnettouch`.`t_users` (`USERID`, `FNAME`, `LNAME`, `EMAIL`, `CONTACT`, `PASSWORD`, `GROUP_ROLE`) VALUES (NULL, '".$fname."', '".$lname."', '".$email."', '".$contact."', '".$password."', 'user')";
			$res = mysqli_query($con,$query);
			if( $res == 1){
				echo "Registration Successful!";
			}
		}
		else{
			echo "Email Id or Contact Number is already registered with Avnet Touch!";
		}
	}
?>