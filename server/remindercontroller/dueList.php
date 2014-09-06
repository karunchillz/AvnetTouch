<?php
	$remList = [];
	class Project{
		public $wishItemName = "";
		public $wishItemQty = "";
		public $wishItemOthers = "";
		public $contributorName = "";
		public $contributorMail = "";
	}
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	
	$query = "SELECT * FROM T_WISH_LIST WHERE WL_IS_CONTRIBUTED = 'NO'";
	$result = mysqli_query($con,$query);
			
	while($row = mysqli_fetch_array($result)) {
		$proj = new Project();
		$proj->wishItemName = $row['WL_ITEMNAME'];
		$proj->wishItemQty = $row['WL_QTY'];
		$proj->wishItemOthers = $row['WL_OTHER'];
		$proj->contributorMail = $row['WL_CONTRIBUTOR_MAIL'];
		$proj->contributorName = $row['WL_CONTRIBUTOR_NAME'];
		array_push($remList, json_encode($proj));
	}
	echo json_encode($remList);
	mysqli_close($con);
?>