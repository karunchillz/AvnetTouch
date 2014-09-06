<?php
include 'excel_reader.php';

$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");

class WishItem{
	public $wishItemName = "";
	public $wishItemQty = "";
	public $wishItemOther = "";
	public $wishItemUrl = "";
	public $query = "";
}
	
$allowedExts = array("xls", "xlsx");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "text/csv")
|| ($_FILES["file"]["type"] == "text/plain")
|| ($_FILES["file"]["type"] == "application/csv")
|| ($_FILES["file"]["type"] == "text/comma-separated-values")
|| ($_FILES["file"]["type"] == "application/excel")
|| ($_FILES["file"]["type"] == "application/vnd.ms-excel")
|| ($_FILES["file"]["type"] == "application/vnd.msexcel")
|| ($_FILES["file"]["type"] == "text/anytext")
|| ($_FILES["file"]["type"] == "application/octet-stream")
|| ($_FILES["file"]["type"] == "application/download"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
	else
    {
		$proj_name =$_REQUEST['projName'];
		$proj_visit_date =$_REQUEST['visitDate'];
		$proj_due_date =$_REQUEST['endDate'];
		$proj_set_active =$_REQUEST['active'];
		
		if($proj_set_active == "on"){
			$proj_set_active = "active";
		}else{
			$proj_set_active = "hold";
		}
		
		
		$proj_desc = "Help";
		echo $proj_name."<br/>";
		echo $proj_visit_date."<br/>";
		echo $proj_due_date."<br/>";
		echo $proj_set_active."<br/>";
		
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br/><br/>";
		
		$timestamp = date("Y-m-d-H-i-s");
		$fileName = "uploads/Wishlist".$timestamp.".".$extension;
		
		move_uploaded_file($_FILES["file"]["tmp_name"],$fileName);
		
		/* -- End of File Upload --*/
	
		
		/*-- Inserting Project into Project Table --*/
		$query = "INSERT INTO T_PROJECTS (`PROJ_ID`, `PROJ_NAME`, `PROJ_DESC`, `PROJ_VISIT_DATE`, `PROJ_DUE_DATE`, `PROJ_WISH_COUNT`, `PROJ_WISH_GRANT`, `PROJ_WL_URL`, `PROJ_STATUS`) VALUES 
		(NULL, '".$proj_name."', '".$proj_desc."', '".$proj_visit_date."', '".$proj_due_date."', 0, 0, '.$fileName.', '".$proj_set_active."')";
		
		$row = mysqli_query($con,$query);
		
		
		/*-- Get inserted project id--*/
		$query = "SELECT PROJ_ID, PROJ_VISIT_DATE FROM T_PROJECTS WHERE PROJ_NAME = '".$proj_name."'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)) {
			if($row['PROJ_VISIT_DATE'] == $proj_visit_date){
				echo "Found";
				$newProjId = $row['PROJ_ID'];
				break;
			}
		}
		
		echo "New Proj Id:".$newProjId."<br/>";
		
		
		
		/* -- Reading Excel and Saving Details to WL --*/
		$wishList = [];

		
		$excel = new PhpExcelReader;
		$excel->read($fileName);

		$sheet = $excel->sheets[0];
		$x = 2;
		while($x <= $sheet['numRows']) {
			$item = new WishItem();
			$item->wishItemName = isset($sheet['cells'][$x][2]) ? "'".$sheet['cells'][$x][2]."'" : 'NULL';
			$item->wishItemQty = isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : 'NULL';
			$item->wishItemOther = isset($sheet['cells'][$x][4]) ? "'".$sheet['cells'][$x][4]."'"  : 'NULL'; 
			$item->wishItemUrl = isset($sheet['cells'][$x][5]) ? "'".$sheet['cells'][$x][5]."'"  : 'NULL'; 
			
			
			$items = "(".$item->wishItemName.",".$newProjId.",".$item->wishItemQty.",".$item->wishItemOther.",".$item->wishItemUrl.")";
			
			array_push($wishList, $items);
			$x++;
		}
		
		$wishItemCount = sizeof($wishList);
		
		
		/* -- Query Construction for insertion into WL table --*/
		$insertValues = "";
		for($i = 0; $i < sizeof($wishList); $i++){
			$insertValues .= $wishList[$i];
			if(($i+1) != sizeof($wishList))
				$insertValues .= ",";
		}
		
		
		/*-- Inserting Wish Items into WL Table --*/
		
		if($newProjId != 0){
			$query = "INSERT INTO `t_wish_list`(`WL_ITEMNAME`, `PROJ_ID`, `WL_QTY`, `WL_OTHER`, `WL_IMG_URL`) VALUES ".$insertValues;
			echo $query;
			$row = mysqli_query($con,$query);
			if($row == 1){
				$query = "UPDATE T_PROJECTS SET PROJ_WISH_COUNT = ".$wishItemCount." WHERE PROJ_NAME = '".$proj_name."'";
				$row = mysqli_query($con,$query);
				if($row == 1){
					echo "Success";
					header('Location: /atouch/administration.php#/'); exit;
				}
			}
		}
	}
	echo "<br/><br/>File Type Supported";
	mysqli_close($con);
}
else{
	echo "File Type not supported";
}
?>