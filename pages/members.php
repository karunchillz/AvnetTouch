<?php
	session_start();
	if($_SESSION['loggedInUserGroup']=="admin"){
?>
<h1><i class="fa fa-users"></i> Members</h1>

<div class="container">
	<div class="members" ng-repeat = "mem in users">
		<div class="cell memImg memRole{{mem.role}}">
			<i class="fa fa-user"></i>
		</div>
		<div class="cell">
			<div class="memName">{{mem.fname}} {{mem.lname}}</div>
			<div class="memRole memRole{{mem.role}}">{{mem.role}}</div>
		</div>
		<div class="editUser" ng-click="editUser(mem)">
			<i class="fa fa-pencil"></i>
		</div>
	</div>
	<div ng-show="editPopUp" class="popUp editPopUp">
		<span class="heading">{{selectedUser}}</span><hr/>
		{{selectedUser}} is currently <b>{{selectedUserRole}}</b> for Avnet Touch<br/><br/>
		Change {{selectedUser}}'s role<br/>
		<select ng-model="group">
			<option value="admin">Admin</option>
			<option value="manager">Manager</option>
			<option value="user">User</option>
		</select>
		<div class="buttons">
			<input type="button" value="MODIFY" ng-click="editDetails()"/>
			<input type="button" value="CANCEL" ng-click="popUpClicked()"/>
		</div>
	</div>
</div>

<?php }
	else{
		echo "<h1><i class='fa fa-minus-circle'></i> Access Denied</h1>";
	}
?>
<style>
	.members{
		position:relative;
		display:inline-table;
		width:300px;
		height:50px;
		border:1px solid #dacaca;
		margin:0 5px 5px 0;
	}
	.editUser{
		position:absolute;
		right:2px;
		top:2px;
		cursor:pointer;
	}
	.members .cell{
		display:table-cell;
		vertical-align:middle;
		padding:4px;
	}
	.members .memImg{
		font-size: 30px;
		width: 15%;
		text-align: center;
	}
	.members .memRole{
		text-transform: capitalize;
		font-size:13px;
	}
	.memRoleadmin{
		color:orange
	}
	.memRolemanager{
		color:lightskyblue
	}
	.memRoleuser{
		color:green;
	}
</style>