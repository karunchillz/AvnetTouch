<?php
	$projList = [];
	class Project{
		public $projId = "";
		public $projName = "";
		public $projDesc = "";
		public $visitDate = "";
		public $dueDate = "";
		public $wishCount = 0;
		public $wishGrant = 0;
		public $projUrl = "";
		public $projStatus = "";
	}
	

	$con = mysqli_connect("localhost","root","passw0rd1","avnettouch");

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$all = $request->all;
	$projId = $request->projId;

	
	$query = "";

	if($all == "all"){
		$query = "SELECT * FROM T_PROJECTS";
	}
	else if($all == "active"){
		$query = "SELECT * FROM T_PROJECTS WHERE PROJ_STATUS = 'active'";
	}

	else{
		$query = "SELECT * FROM T_PROJECTS WHERE PROJ_ID = ".$projId;
	}


	$result = mysqli_query($con,$query);
			
	while($row = mysqli_fetch_array($result)) {
		$proj = new Project();
		$proj->projId = $row['PROJ_ID'];
		$proj->projName = $row['PROJ_NAME'];
		$proj->projDesc = $row['PROJ_DESC'];
		$proj->visitDate = $row['PROJ_VISIT_DATE'];
		$proj->dueDate = $row['PROJ_DUE_DATE'];
		$proj->wishCount = $row['PROJ_WISH_COUNT'];
		$proj->wishGrant = $row['PROJ_WISH_GRANT'];
		$proj->projUrl = $row['PROJ_WL_URL'];
		$proj->projStatus = $row['PROJ_STATUS'];
		array_push($projList, json_encode($proj));
	}
	echo json_encode($projList);
	mysqli_close($con);
?>