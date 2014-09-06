var atouchController = angular.module('atouchController', ['ngRoute']);
atouchController.controller("homeController",['$scope','$http', '$location', '$rootScope','$timeout','$interval',homeCtrl.homeController]);
atouchController.controller("projectController",['$scope', '$interval', '$http','$routeParams','$location', projCtrl.projectController]);

atouchController.controller("registerController",function($scope, $http){
	$scope.fields = function(){
		$scope.firstName = "";
		$scope.lastName = "";
		$scope.email = "";
		$scope.password = "";
		$scope.contact = "";
	};
	$scope.fields();
	
	var reg_url_path = "server/authmodule/register.php";
	
	var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
	var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var ck_password = /^[A-Za-z0-9!@#$%^&*()_]{5,20}$/;
	var ck_contact = /^[0-9]{9,15}$/;
	
	$scope.register = function(){
		$scope.reset();
		var set = 0;
		if(!ck_name.test($scope.firstName)){
			$scope.firstNameError = " is invalid";
			set = 1;
		}
		if(!ck_name.test($scope.lastName)){
			$scope.lastNameError = " is invalid";
			set = 1;
		}
		if(!ck_email.test($scope.email)){
			$scope.emailError = " is Invalid";
			set = 1;
		}
		if(!ck_password.test($scope.password)){
			$scope.passError = " is invalid.. Minimum 5 characters";
			set = 1;
		}
		if(!ck_contact.test($scope.contact)){
			$scope.contactError = " is Invalid";
			set = 1;
		}
		
		if(set == 0){
			$http({
				method: 'POST', 
				url: reg_url_path, 
				data:{
					fname:$scope.firstName, 
					lname:$scope.lastName,
					email:$scope.email,
					password:$scope.password,
					contact:$scope.contact
				}
			}).
			success(function(data, status, headers, config) {
				if(data!=undefined){
					$scope.alertMsg = data;
					$scope.fields();
					$("#alertPopUp").show();
					$("#registerPopUp").hide();
				}
			}).
			error(function(data, status, headers, config) {
				console.log("Error");
			});
		}
	};
	
	$scope.reset = function(){
		$scope.firstNameError = "";
		$scope.lastNameError = "";
		$scope.emailError = "";
		$scope.passError = "";
		$scope.contactError = "";
	};
});


atouchController.config(function ($routeProvider){
	$routeProvider
	.when('/',{
		controller: 'homeController',
		templateUrl: 'pages/client/home.php'
	})
	.when('/proj',{
		controller: 'projectController',
		templateUrl: 'pages/client/proj.php'
	})
	.otherwise({redirectTo:'/'});
});

