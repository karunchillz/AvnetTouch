<?php
	session_start();
	if($_SESSION['loggedInUserGroup']=="admin"){
?>
<h1><i class="fa fa-clock-o"></i> Send Reminder</h1>
<div class="remSection">
	<input type="button" class="sendAll" ng-click="mailTo(item.umail, 'true')" value="SEND TO ALL"/>

	<table class="grid" cellspacing="0">
		<tr>
			<th class="iconBox"></th>
			<th class="titleBox">WISH ITEM</th>
			<th class="ownerBox">QUANTITY</th>
			<th class="ownerBox">OTHERS</th>
			<th class="ownerBox">OWNED BY</th>
			<th class="dateBox">NOTIFY</th>
		</tr>
		
		<tr ng-repeat="item in remList">
			<td><i class="fa fa-check"></i></td>
			<td>{{item.name}}</td>
			<td>{{item.qty}}</td>
			<td>{{item.oth}}</td>
			<td>{{item.uname}}</td>
			<td><input type="button" class="send" ng-click="mailTo(item.umail, 'false')" value="SEND"/></td>
		</tr>

	</table>
</div>

<?php }
	else{
		echo "<h1><i class='fa fa-minus-circle'></i> Access Denied</h1>";
	}
?>