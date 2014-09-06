<?php
	session_start();
	if($_SESSION['loggedInUserGroup']=="admin"){
?>
<h1><i class="fa fa-cloud-upload"></i> Upload Wish List</h1>
<div class="container">
	<form action="/atouch/server/uploadcontroller/upload.php" method="post" enctype="multipart/form-data">
		Choose Wish List to Upload
		<div class='styled-file-area'>
			<input type='text' id='selectedFile' readonly ng-model="fileName"/>
			<input type='button' class='morphed-area' value='Browse'>
			<input type='file' class='morphed-area' id='myFile' name="file" ng-model="fileName" onchange="maskName()">
		</div>
		
		<div class="projDetails">
			<span class="heading">Let us know something about the project</span><br/>
			Project Name
			<input type="text" name="projName" value=""/>
			
			Project Visit Date
			<input type="date" name="visitDate" value=""/>
			
			Project Due Date
			<input type="date" name="endDate" value=""/>
			<input type="checkbox" name="active" checked/>Set as Active
			<input type="submit" value="ADD PROJECT"/>
		</div>
	</form>
	<div class="errorMsg"></div>
</div>
<?php }
	else{
		echo "<h1><i class='fa fa-minus-circle'></i> Access Denied</h1>";
	}
?>