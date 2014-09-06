<?php
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$projId = mysqli_real_escape_string($con, $_POST['projId']);
	$projStatus = mysqli_real_escape_string($con, $_POST['status']);
	
	
	if($projStatus == "delete"){
		$query = "DELETE FROM T_PROJECTS WHERE PROJ_ID = ".intval($projId);
		$r = mysqli_query($con,$query);
		if($r == 1){
			$query = "DELETE FROM T_WISH_LIST WHERE PROJ_ID = ".intval($projId);
			$r = mysqli_query($con,$query);
			if($r == 1){
				echo "Project Successfully deleted!";
			}
		}
		else{
			echo "Oops! Error in Project Deletion";
		}
	}
	else{
		$query = "UPDATE T_PROJECTS SET PROJ_STATUS = '".$projStatus."' WHERE PROJ_ID = ".intval($projId);
		$r = mysqli_query($con,$query);
	
		if($r == 1){
			echo "Project Status Changed";
		}
		else{
			echo "Oops ! Something went wrong. Project Status not Changed";
		}
	}
	mysqli_close($con);
?>