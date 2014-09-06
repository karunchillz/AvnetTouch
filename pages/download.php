<?php
	session_start();
	if($_SESSION['loggedInUserGroup']=="admin"){
?>
<h1><i class="fa fa-cloud-download"></i> Download Wish List</h1>

<table class="grid" cellspacing="0">
	<tr>
		<th class="iconBox"></th>
		<th class="titleBox">TITLE</th>
		<th class="ownerBox">OWNED BY</th>
		<th class="dateBox">DATE</th>
		<th class="statusBox">STATUS</th>
	</tr>
	
	<tr ng-repeat="proj in projects">
		<td><i class="fa fa-download"></i></td>
		<td><a href="{{proj.url}}" download">{{proj.projName}}</a></td>
		<td>{{proj.projOwner}}</td>
		<td>{{proj.uploadDate}}</td>
		<td class="status {{proj.status}}">
			<span class="small" ng-click="changeStatus(proj.projId, 'NEW')">NEW</span>
			<span class="small" ng-click="changeStatus(proj.projId, 'IN-PROGRESS')">IN-PROGRESS</span>
			<span class="small" ng-click="changeStatus(proj.projId, 'VERIFIED')">VERIFIED</span>
			<span class="small" ng-click="changeStatus(proj.projId, 'UPLOADED')">UPLOADED</span>
		</td>
	</tr>
</table>

<?php }
	else{
		echo "<h1><i class='fa fa-minus-circle'></i> Access Denied</h1>";
	}
?>
