var projCtrl = {};

projCtrl.projectController = function ($scope, $interval, $http, $routeParams, $location){
	console.log($routeParams);

	var colCount = 0;
	var colWidth = 0;
	var margin = 15;
	var windowWidth = 0;
	var blocks = [];

	$scope.projectId = 0;
	$scope.projectName = "";
	$scope.projectWishesCount = 0;
	$scope.projectWishesGrant = 0;
	$scope.projectWishesGrantByMe = 0;
	$scope.projectCounter = 0;

	
	$scope.wishListItems = [];

	if($routeParams != undefined){
		$scope.projectId = $routeParams.projId;
	}
	else{
		$location.path('/');
	}

	var proj_url_path = "server/homecontroller/getProjects.php";
	var wl_url_path = "server/projectcontroller/getWishList.php";

	$scope.countDate = function(day){
		var date = new Date(day);
		var today = new Date();
		var timeDiff = Math.abs(date.getTime() - today.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		return diffDays;
	};

	// Get Project Details
	$scope.getProjectDetails = function(){
		console.log($scope.projectId);

		$http({
			method: 'POST', 
			url: proj_url_path, 
			data:{
				all:'none', 
				projId: $scope.projectId
			}
		}).
	    success(function(data, status, headers, config) {
	    	a = data;
	    	if(data!=undefined){
	    		var projData = JSON.parse(data[0]);
	    		$scope.projectId = projData.projId;
				$scope.projectName = projData.projName;
				$scope.projectWishesCount = projData.wishCount;
				$scope.projectWishesGrant = projData.wishGrant;
				$scope.projectCounter = $scope.countDate(projData.dueDate);
	    	}

	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};


	$scope.processWishList = function(data){
		$scope.wishListItems = [];
		$scope.projectWishesGrantByMe = 0;
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
			item.isDel =  wishItem.isDel;
			if(wishItem.isDel == "true") {$scope.projectWishesGrantByMe++;}
			$scope.wishListItems.push(item);
		}
	};

	// Get Wish list Items
	$scope.getWishList = function(){
		$http({
			method: 'POST', 
			url: wl_url_path, 
			data:{
				action:'get',
				projId:$scope.projectId
			}
		}).
	    success(function(data, status, headers, config) {
	    	if(data!=undefined){
	    		$scope.processWishList(data);
				$scope.getProjectDetails();
	    	}
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};


	/*-- Contribute Item --*/
	$scope.contributeItem = function(itemId){
		console.log(itemId);
		$http({
			method: 'POST', 
			url: wl_url_path, 
			data:{
				action:'update',
				projId:$scope.projectId,
				itemId:itemId,
			}
		}).
	    success(function(data, status, headers, config) {
	    	$scope.processWishList(data);
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};

	$scope.cancelItem = function(itemId){
		console.log(itemId);
		$http({
			method: 'POST', 
			url: wl_url_path, 
			data:{
				action:'delete',
				projId: $scope.projectId,
				itemId:itemId
			}
		}).
	    success(function(data, status, headers, config) {
	    	$scope.processWishList(data);
	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};


	// Refresh Wish List Items in every interval
	$scope.getRefreshedList = function(){

	};


	$scope.showPop = function(div){
		$(".popUp").hide();
		$(div).show();
	};

	$scope.hidePop = function(){
		$(".popUp").hide();
	};
	
	
	
	$scope.getProjectDetails();
	$scope.getWishList();
};


