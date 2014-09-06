<?php
	session_start();
	
	$wishList = [];
	class WishItem{
		public $wishItemId = "";
		public $wishItemName = "";
		public $wishItemQty = "";
		public $wishItemOthers = "";
		public $wishItemUrl = "";
		public $wishItemGrant = "";
		public $contributorName = "";
		public $contributorMail = "";
		public $isDel = "";
		public $isContributed = "";
	}
	
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$action = $request->action;
	$projId = $request->projId;

	if($action == "update"){
		
		$itemId = $request->itemId;
		$contMail = $_SESSION['loggedInUser'];
		$contName = $_SESSION['loggedInUserName'];

		$query = "UPDATE T_WISH_LIST SET WL_IS_GRANT = 'YES', WL_CONTRIBUTOR_MAIL = '".$contMail."', WL_CONTRIBUTOR_NAME = '".$contName."' WHERE PROJ_ID =".intval($projId)." AND WL_ID = ".intval($itemId);	
		mysqli_query($con,$query);	
		
		$query = "SELECT COUNT(WL_IS_GRANT) FROM T_WISH_LIST WHERE WL_IS_GRANT = 'YES'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)) {
			$wl_count = $row['COUNT(WL_IS_GRANT)'];
		}
		
		$query = "UPDATE T_PROJECTS SET PROJ_WISH_GRANT = ".$wl_count." WHERE PROJ_ID =".intval($projId);	
		mysqli_query($con,$query);		
	}
	
	else if($action == "contributed"){
		
		$itemId = $request->itemId;

		$query = "UPDATE T_WISH_LIST SET WL_IS_CONTRIBUTED = 'YES' WHERE PROJ_ID =".intval($projId)." AND WL_ID = ".intval($itemId);	
		mysqli_query($con,$query);	
	}

	else if($action == "delete"){
		$itemId = $request->itemId;

		$query = "UPDATE T_WISH_LIST SET WL_IS_GRANT = NULL, WL_CONTRIBUTOR_MAIL = NULL, WL_CONTRIBUTOR_NAME = NULL WHERE PROJ_ID =".intval($projId)." AND WL_ID = ".intval($itemId);	
		mysqli_query($con,$query);
		
		$query = "SELECT COUNT(WL_IS_GRANT) FROM T_WISH_LIST WHERE WL_IS_GRANT = 'YES'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)) {
			$wl_count = $row['COUNT(WL_IS_GRANT)'];
		}
		
		$query = "UPDATE T_PROJECTS SET PROJ_WISH_GRANT = ".$wl_count." WHERE PROJ_ID =".intval($projId);	
		mysqli_query($con,$query);
	}


	$query = "SELECT * FROM T_WISH_LIST WHERE PROJ_ID =".$projId;
	$result = mysqli_query($con,$query);
			
	while($row = mysqli_fetch_array($result)) {
		$proj = new WishItem();
		$proj->wishItemId = $row['WL_ID'];
		$proj->wishItemName = $row['WL_ITEMNAME'];
		$proj->wishItemQty = $row['WL_QTY'];
		$proj->wishItemOthers = $row['WL_OTHER'];
		$proj->wishItemUrl = $row['WL_IMG_URL'];
		$proj->wishItemGrant = $row['WL_IS_GRANT'];
		$proj->contributorMail = $row['WL_CONTRIBUTOR_MAIL'];
		$proj->contributorName = $row['WL_CONTRIBUTOR_NAME'];
		$proj->isContributed = $row['WL_IS_CONTRIBUTED'];
		
		if(isset($_SESSION['logged'])){
			if($_SESSION['loggedInUser'] == $proj->contributorMail){
				$proj->isDel = "true";
			}
		}else{
			$proj->isDel = "false";
		}
		array_push($wishList, json_encode($proj));
	}
	echo json_encode($wishList);
	mysqli_close($con);
?>