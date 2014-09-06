<!DOCTYPE html>
<html ng-app="touchApp">
	<head>
		<link rel="stylesheet" href="css/font-awesome.min.css"/>
		<script src="js/angular.min.js"></script>
		<script src="js/angular-route.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/adminStyles.css"/>
		<title>AVNET TOUCH | ADMIN</title>
	</head>

	<body>
	
		<header>
			<h1>AVNET TOUCH admin</h1>
			<?php 
				session_start();
				if($_SESSION['loggedIn'] == 1){?>
					<div class="profile">
						<i class="fa fa-user"></i> Hi, <?php echo $_SESSION['loggedInUserName']." | ". $_SESSION['loggedInUserGroup']." | " ?>  
						<form action="atouchAdmin.php">
							<input type="submit" value="LOGOUT"/>
						</form>
					</div>
				<?php } ?>
		</header>
		<section>
			<?php
				if($_SESSION['loggedIn'] == 1){?>
					<div class="sideMenu">
						<ul>
							<a ng-href="#/"><li><i class="fa fa-home"></i> Home</li></a>
							<?php
								if($_SESSION['loggedInUserGroup']=="admin"){
							?>
							<a ng-href="#/download"><li><i class="fa fa-cloud-download"></i> Download Wish List</li></a>
							<a ng-href="#/upload"><li><i class="fa fa-cloud-upload"></i> Upload Wish List</li></a>
							<a ng-href="#/members"><li><i class="fa fa-users"></i> Members</li></a>
							<a ng-href="#/reminder"><li><i class="fa fa-clock-o"></i> Send Reminder</li></a>
							<?php }
							?>
							<a ng-href="#/settings"><li><i class="fa fa-gears"></i> Settings</li></a>
						</ul>
					</div>
					
					<div class="content" ng-view=""></div>
				<?php }else{ ?>
					<div class="loginBlock">
						<span class="heading">Admin Login</span>
						<form action="server/authmodule/adminLogin.php" method="post">
							<input type="text" name="username" placeholder="Enter Username"/>
							<input type="password" name="password" placeholder="Enter Password"/>
							<input type="submit" value="LOGIN"/>
							<?php echo $_SESSION['loggedInError'] ; ?>
						</form>
					</div>
				<?php } ?>
		</section>
		<footer>
		</footer>
		<script src="controllers/adminControl.js"></script>
	</body>

</html>