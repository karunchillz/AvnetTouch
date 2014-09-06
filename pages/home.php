<h1><i class="fa fa-home"></i> Home</h1>
<?php
	session_start();
?>
<div ng-show="projects" class="container">
	<div ng-show="displayMsg" class="msgDiv">{{message}}</div>
	<span class="heading">Active Projects</span><br/>
	<div class="projList">
		<div ng-repeat="activeProj in activeProjects" class="projBox active">
			<div class="projectName"><a ng-click="loadWishList(activeProj.projId)">{{activeProj.projName}}</a></div>
			<div class="projectDate"><i class="fa fa-calendar"></i> {{activeProj.visitDate}}</div>
			<?php
				if($_SESSION['loggedInUserGroup']=="admin"){
			?>
			<div class="status"><a ng-click="closeProject(activeProj.projId)"><i class="fa fa-chain-broken"></i> Close</a></div>
			<div class="delIcon"><a ng-click="deleteProject(activeProj.projId)"><i class="fa fa-trash-o"></i></a></div>
			<?php } ?>
		</div>
	</div>
	<span class="heading">Hold Projects</span><br/>
	<div class="projList">
		<div ng-repeat="holdProj in holdProjects" class="projBox inactive">
			<div class="projectName">{{holdProj.projName}}</div>
			<div class="projectDate"><i class="fa fa-calendar"></i> {{holdProj.visitDate}}</div>
			<?php
				if($_SESSION['loggedInUserGroup']=="admin"){
			?>
			<div class="status">
				<a ng-click="activateProject(holdProj.projId)"><i class="fa fa-chain"></i> Activate</a>
				<a ng-click="closeProject(holdProj.projId)"><i class="fa fa-chain-broken"></i> Close</a>
			</div>
			<div class="delIcon"><a ng-click="deleteProject(holdProj.projId)"><i class="fa fa-trash-o"></i></a></div>
			<?php } ?>
		</div>
	</div>
	<span class="heading">Closed Projects</span><br/>
	<div class="projList">
		<div ng-repeat="closeProj in closedProjects"  class="projBox closed">
			<div class="projectName">{{closeProj.projName}}</div>
			<div class="projectDate"><i class="fa fa-calendar"></i> {{closeProj.visitDate}}</div>
			<?php
				if($_SESSION['loggedInUserGroup']=="admin"){
			?>
			<div class="delIcon"><a ng-click="deleteProject(closeProj.projId)"><i class="fa fa-trash-o"></i></a></div>
			<?php } ?>
		</div>
	</div>
</div>
<div ng-hide="projects">
	<?php
		if($_SESSION['loggedInUserGroup']=="admin" || $_SESSION['loggedInUserGroup']=="manager"){
	?>
	<a ng-click="goBack()"><i class="fa fa-arrow-circle-left"></i> Back to Projects </a> &nbsp;&nbsp;&nbsp;
	<a ng-click="loadWishList(selectedProj)""><i class="fa fa-refresh"></i> Refresh </a>
	
	<div class="container">
		<table class="grid" cellspacing="0">
			<tr>
				<th class="iconBox"></th>
				<th class="titleBox">WISH ITEM</th>
				<th class="dateBox">QTY</th>
				<th class="ownerBox">CONTRIBUTED BY</th>
				<th class="statusBox">CONTRIBUTED</th>
			</tr>
			
			<tr ng-repeat="item in wishListItems">
				<td><i class="fa fa-gift"></i></td>
				<td>{{item.name}}</a></td>
				<td>{{item.qty}}</a></td>
				<td>{{item.contName}}</td>
				<td>
					<input type="checkbox" ng-model="item.isCont" ng-true-value="YES" ng-false-value="NO" ng-change="updateWL(item.id)"/>
				</td>
			</tr>
		</table>
	</div>
	<?php } 
	
			else{
			echo "<h1><i class='fa fa-minus-circle'></i> Access Denied</h1>";
		}
	?>
</div>


<div class="popUp" id="popUp">
	<span class="heading">Delete Project?</span><hr/>
	You are about to delete this Project. This action cannot be undone!
	<div class="buttons">
		<input type="button" value="DELETE" ng-click="popUpClicked('yes')"/>
		<input type="button" value="CANCEL" ng-click="popUpClicked('no')"/>
	</div>
</div>