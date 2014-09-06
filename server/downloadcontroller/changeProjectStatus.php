<?php
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$projId = mysqli_real_escape_string($con, $_POST['projId']);
	$projStatus = mysqli_real_escape_string($con, $_POST['status']);
	
	
	$query = "UPDATE T_USER_PROJECTS SET STATUS = '".$projStatus."' WHERE PROJ_ID = ".intval($projId);
	$r = mysqli_query($con,$query);
			
	echo $r;
	
	if($r == 1){
		echo "Project Status Changed";
	}
	else{
		echo "Oops ! Something went wrong. Project Status not Changed";
	}
	mysqli_close($con);
?>