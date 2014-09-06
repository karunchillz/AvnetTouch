<?php
	$projList = [];
	class Project{
		public $projId = "";
		public $projName = "";
		public $projOwner = "";
		public $url = "";
		public $uploadDate = "";
		public $status = "";
	}
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$query = "SELECT * FROM T_USER_PROJECTS ORDER BY UPLOAD_DATE DESC";
	$result = mysqli_query($con,$query);
			
	while($row = mysqli_fetch_array($result)) {
		$proj = new Project();
		$proj->projId = $row['PROJ_ID'];
		$proj->projName = $row['PROJ_NAME'];
		$proj->projOwner = $row['OWNER'];
		$proj->url = $row['PROJ_URL'];
		$proj->uploadDate = $row['UPLOAD_DATE'];
		$proj->status = $row['STATUS'];
		array_push($projList, json_encode($proj));
	}
	echo json_encode($projList);
	mysqli_close($con);
?>