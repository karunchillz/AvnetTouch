<html ng-app="atouchController">
    <head>
        <title>AVNET TOUCH</title>

        <link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/home-styles.css"/>
        <link rel="stylesheet" href="css/project-styles.css"/>

		<script src="js/jquery.js"></script>
        <script src="js/angular.min.js"></script>
        <script src="js/angular-route.min.js"></script>
        
    </head>
    <body>
        
        <div ng-view="">
        </div>
		
        <script src="controllers/homeController.js"></script>
        <script src="controllers/projectController.js"></script>

        <script src="controllers/clientController.js"></script>
    </body>
</html>