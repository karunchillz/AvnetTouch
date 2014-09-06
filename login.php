<!DOCTYPE html>
<html ng-app="touchApp">
	<head>
		<link rel="stylesheet" href="css/font-awesome.min.css"/>
		<script src="js/angular.min.js"></script>
		<script src="js/angular-route.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/adminStyles.css"/>
		<title>AVNET TOUCH | LOGIN</title>
	</head>

	<body>
	
		<header>
			<h1>AVNET TOUCH</h1>
		</header>
		<section>
			<div class="loginBlock">
				<span class="heading">Login</span>
				
				<form action="server/authmodule/login.php" method="post">
					<?php 
					session_start();
					if(isset($_SESSION['loggedInError'])){
						echo $_SESSION['loggedInError'] ; 
					}
					?>
					<input type="text" name="username" placeholder="Enter Username" required/>
					<input type="password" name="password" placeholder="Enter Password" required/>
					<input type="submit" value="LOGIN"/>
				</form>
			</div>
		</section>
		<footer>
		</footer>
	</body>

</html>