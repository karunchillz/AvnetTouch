<?php
	session_start();
	$users = [];
	class Users{
		public $id = "";
		public $firstName = "";
		public $lastName = "";
		public $email = "";
		public $contact = "";
		public $role= "";
	}
	
	// Create connection
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$action = $request->action;
	$userid = $request->userid;

	
	if($action == "edit"){
		$group = $request->group;
		$query = "UPDATE T_USERS SET GROUP_ROLE = '".$group."' WHERE USERID =".intval($userid);	
		mysqli_query($con,$query);
	}

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{
		$query = "SELECT * FROM T_USERS";
		$result = mysqli_query($con,$query);
		
		while($row = mysqli_fetch_array($result)) {
			$user = new Users();
			$user->id = $row['USERID'];
			$user->firstName = $row['FNAME'];
			$user->lastName = $row['LNAME'];
			$user->email = $row['EMAIL'];
			$user->contact = $row['CONTACT'];
			$user->role = $row['GROUP_ROLE'];
			array_push($users, json_encode($user));
		}
		echo json_encode($users);
	}
	mysqli_close($con);
?>