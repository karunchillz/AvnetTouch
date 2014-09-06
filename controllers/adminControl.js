var touchApp = angular.module('touchApp',['ngRoute']);

var proj_url_path = "server/homecontroller/getProjects.php";
var wl_url_path = "server/projectcontroller/getWishList.php";
var users_url_path = "server/membermodule/getUsers.php";

/*-- AJAX OBJECT --*/
var XMLHttpRequestObject = false;
if(window.XMLHttpRequest)
{
	XMLHttpRequestObject = new XMLHttpRequest();
}
else if(window.ActiveXObject){
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}
/*--- END OF AJAX OBJECT --*/

touchApp.config(function ($routeProvider){
	$routeProvider
	.when('/',{
		controller: 'homeController',
		templateUrl: 'pages/home.php'
	})
	.when('/download',{
		controller: 'downloadController',
		templateUrl: 'pages/download.php'
	})
	.when('/upload',{
		controller: 'uploadController',
		templateUrl: 'pages/upload.php'
	})
	.when('/members',{
		controller: 'membersController',
		templateUrl: 'pages/members.php'
	})
	.when('/reminder',{
		controller: 'reminderController',
		templateUrl: 'pages/reminder.php'
	})
	.when('/settings',{
		controller: 'settingsController',
		templateUrl: 'pages/settings.php'
	})
	.otherwise({redirectTo:'/'});
});

touchApp.controller('homeController',function homeController($scope, $http){
	
	$scope.projToDel = 0;
	$scope.projects = "show";
	$scope.selectedProj = 0;
	
	$scope.loadProjects = function(){
		$scope.activeProjects = [];
		$scope.holdProjects = [];
		$scope.closedProjects = [];
	
		$http({
			method: 'POST', 
			url: proj_url_path, 
			data:{
				all:'all', 
				projId:'0'
			}
		}).
	    success(function(data, status, headers, config) {
	    	if(data!=undefined){
	    		$scope.processResponse(data);
	    	}
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	}
	
	$scope.processResponse = function(res){
		for(var i = 0; i < res.length; i++){
			var proj = JSON.parse(res[i]);
			var project = {};
			project.projName = proj.projName;
			project.visitDate = proj.visitDate;
			project.projId = proj.projId;
			
			if(proj.projStatus == "active"){
				$scope.activeProjects.push(project);
			}
			else if(proj.projStatus == "hold"){
				$scope.holdProjects.push(project);
			}
			else{
				$scope.closedProjects.push(project);
			}
		}
	}
	
	$scope.closeProject = function(projId){
		$scope.changeProjStatus(projId, "closed");
	}
	$scope.activateProject = function(projId){
		$scope.changeProjStatus(projId, "active");
	}
	$scope.deleteProject = function(projId){
		$scope.projToDel = projId;
		$scope.showPopUp();
	};
	$scope.showPopUp = function(){
		document.getElementById("popUp").style.display = "block";
	};
	$scope.popUpClicked = function(option){
		console.log(option);
		if(option=="yes"){
			$scope.changeProjStatus($scope.projToDel, "delete");
		}
		else{
			document.getElementById("popUp").style.display = "none";
			$scope.projToDel = undefined;
		}
	};
	$scope.changeProjStatus = function(projId, status){
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/homecontroller/changeProjectStatus.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res = XMLHttpRequestObject.responseText;
					$scope.message = res;
					$scope.displayMsg = "show";
					document.getElementById("popUp").style.display = "none";
					$scope.$apply();
					$scope.loadProjects();
				}		
			}
			XMLHttpRequestObject.send("projId=" +projId+ "&status=" +status);
		}
	}
	
	$scope.processWishList = function(data){
		a = data;
		$scope.wishListItems = [];
		for(var i = 0 ; i < data.length ; i++){
			var wishItem = JSON.parse(data[i]);
			var item = {};
			item.id = wishItem.wishItemId;
			item.name = wishItem.wishItemName;
			item.qty = wishItem.wishItemQty;
			item.oth = wishItem.wishItemOthers;
			item.url = wishItem.wishItemUrl;
			item.isGrant = wishItem.wishItemGrant;
			item.contName = wishItem.contributorName;
			item.contMail = wishItem.contributorMail;
			item.isCont = wishItem.isContributed;
			item.isDel =  wishItem.isDel;
			$scope.wishListItems.push(item);
		}
	};
	
	$scope.loadWishList = function(projId){
		$scope.selectedProj = projId;
		$http({
			method: 'POST', 
			url: wl_url_path, 
			data:{
				action:'get',
				projId: projId
			}
		}).
	    success(function(data, status, headers, config) {
	    	if(data!=undefined){
				$scope.projects = undefined;
	    		$scope.processWishList(data);
	    	}
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};
	
	/* Update WL after getting the item */
	$scope.updateWL = function(itemId){
		console.log(itemId);
		$http({
			method: 'POST', 
			url: wl_url_path, 
			data:{
				action:'contributed',
				projId: $scope.selectedProj,
				itemId: itemId
			}
		}).
	    success(function(data, status, headers, config) {
	    	$scope.processWishList(data);
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};
	
	$scope.goBack = function(){
		$scope.projects = "show";
	};
	
	$scope.loadProjects();
});
/* --- DOWNLOADS CONTROLLER -- */
touchApp.controller('downloadController',function downloadController($scope){

	
	$scope.loadProjects = function(){
		$scope.projects = [];
	
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/downloadcontroller/downloadWishlist.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res = XMLHttpRequestObject.responseText;
					$scope.processResponse(JSON.parse(res));
				}		
			}
			XMLHttpRequestObject.send();
		}
	};
	$scope.processResponse = function(res){
		for(var i = 0; i < res.length; i++){
			var proj = JSON.parse(res[i]);
			var project = {};
			project.projName = proj.projName;
			project.uploadDate = proj.uploadDate;
			project.url = proj.url;
			project.projOwner = proj.projOwner;
			project.status = proj.status;
			project.projId = proj.projId;
			
			$scope.projects.push(project);
			$scope.$apply();
		}
	};
	
	
	$scope.changeStatus = function(projId, status){
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/downloadcontroller/changeProjectStatus.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res = XMLHttpRequestObject.responseText;

					$scope.loadProjects();
				}		
			}
			XMLHttpRequestObject.send("projId=" +projId+ "&status=" +status);
		}
	};
	
	
	$scope.loadProjects();
});

/* --- UPLOADS CONTROLLER -- */
touchApp.controller('uploadController',function uploadController($scope){
	
});

/* --- REMINDER CONTROLLER -- */
touchApp.controller('reminderController',function reminderController($scope){
	$scope.loadDueList = function(){
		$scope.remList = [];
	
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/remindercontroller/dueList.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res = XMLHttpRequestObject.responseText;
					var list = JSON.parse(res);
					for(var i = 0; i < list.length; i++){
						var proj = JSON.parse(list[i]);
						var item = {};
						item.name = proj.wishItemName;
						item.qty = proj.wishItemQty;
						item.oth = proj.wishItemOthers;
						item.mail = proj.contributorMail;
						item.uname = proj.contributorName;
						
						$scope.remList.push(item);
						$scope.$apply();
					}
				}		
			}
			XMLHttpRequestObject.send();
		}
	};
	
	$scope.mailTo = function(mailId, all){
		if(all=="true"){
			all == "true";
		}
		else{
			all == "false";
		}
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/remindercontroller/reminder.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res = XMLHttpRequestObject.responseText;
					console.log(res);
					$scope.$apply();
				}		
			}
			XMLHttpRequestObject.send("mailId=" +mailId+"&all="+all);
		}
	}
	
	$scope.loadDueList();
});

/* --- SETTINGS CONTROLLER --- */
touchApp.controller('settingsController',function settingsController($scope){
	$scope.curPass = "";
	$scope.newPass = "";
	$scope.retypePass = "";
	
	$scope.changePassword = function(){
		if(XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST",'server/settingscontroller/changePassword.php');
			XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			XMLHttpRequestObject.onreadystatechange=function()
			{
				if(XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200)
				{
					var res=XMLHttpRequestObject.responseText;
					$scope.message = res;
					$scope.displayMsg = "show"
					$scope.$apply();
				}		
			}
			XMLHttpRequestObject.send("cur_pwd=" +$scope.curPass+ "&new_pwd=" +$scope.newPass+" &re_pwd=" +$scope.retypePass);
		}
	}
});

/* --- MEMBERS CONTROLLER --- */
touchApp.controller('membersController',function settingsController($scope, $http){
	$scope.processUsers = function(data){
		a = data;
		$scope.users = [];
		for(var i = 0 ; i < data.length ; i++){
			var members = JSON.parse(data[i]);
			var mem = {};
			mem.id = members.id;
			mem.fname = members.firstName;
			mem.lname = members.lastName;
			mem.email = members.email;
			mem.contact = members.contact;
			mem.role = members.role;
			$scope.users.push(mem);
		}
	};
	
	$scope.loadUsers = function(projId){
		$http({
			method: 'POST', 
			url: users_url_path, 
			data:{
				action:'get',
				userid: 0
			}
		}).
	    success(function(data, status, headers, config) {
	    	if(data!=undefined){
	    		$scope.processUsers(data);
	    	}
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};
	
	$scope.editDetails = function(member){
		$http({
			method: 'POST', 
			url: users_url_path,
			data:{
				action:'edit',
				userid: $scope.selectedUserId,
				group: $scope.group
			}
		}).
	    success(function(data, status, headers, config) {
	    	if(data!=undefined){
	    		$scope.processUsers(data);
				
				$scope.editPopUp = undefined;
	    	}
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};
	
	$scope.editUser = function(member){
		$scope.selectedUser = member.fname+" "+member.lname;
		$scope.selectedUserRole = member.role;
		$scope.selectedUserId = member.id;
		$scope.editPopUp = "show";
	};
	
	$scope.popUpClicked = function(option){
		$scope.editPopUp = undefined;
	};
	$scope.loadUsers();
});

function maskName(){
	document.getElementById("selectedFile").value = document.getElementById("myFile").value;
}