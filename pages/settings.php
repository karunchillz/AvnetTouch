<h1><i class="fa fa-gears"></i> Settings</h1>
<div class="container">
	<div ng-show="displayMsg" class="msgDiv">{{message}}</div>
	<span class="heading">Change Password</span>
	<div class="container_left">
		Current Password <input type="password" name="cur_pwd" ng-model="curPass"/>
		New Password <input type="password" name="new_pwd" ng-model="newPass"/>
		Retype Password <input type="password" name="retype_pwd" ng-model="retypePass"/>
		<input type="button" class="normalButton" value="Change Password" ng-click="changePassword()"/>
	</div>
</div>
