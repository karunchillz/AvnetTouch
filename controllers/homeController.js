var homeCtrl = {};

var proj_url_path = "server/homecontroller/getProjects.php";
var suggestion_url_path = "";


homeCtrl.homeController = function($scope, $http, $location, $rootScope, $timeout, $interval){

	var prev = 0;
	$scope.projects = [];
	$scope.partners = [{logo:'avnet.png', width:'100', height:'35'}];
	$scope.gallery = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	
	$scope.gallery = [
		{name:'1', content:'EDUCATE'},
		{name:'2', content:'HELP THEM'},
		{name:'3', content:'SERVE'},
		{name:'4', content:'SAVE CHILDREN'},
		{name:'5', content:'HELPING HAND'},
		{name:'6', content:'GIFT A CHILD'},
		{name:'7', content:'BE A TEACHER'},
		{name:'8', content:'EDUCATION'},
		{name:'9', content:'WORLD NEEDS YOU'},
		{name:'10', content:'PLAY YOUR PART'},
		{name:'11', content:'START CARING'},
		{name:'12', content:'CARVE A SMILE'},
		{name:'13', content:'BE A LEADER'},
		{name:'14', content:'ADOPT A CHILD'},
		{name:'15', content:'LIGHTEN KIDS'},
		{name:'16', content:'EDUCATE'},
		{name:'17', content:'PLAY YOUR PART'},
		{name:'18', content:'GIFT A CHILD'},
		{name:'19', content:'DONATE'},
		{name:'20', content:'FEED THE NEEDY'},
		{name:'21', content:'ENRICH KNOWLEDGE'},
		{name:'22', content:'EDUCATE ALL'},
		{name:'23', content:'DONATE'},
		{name:'24', content:'EDUCATE A CHILD'}
	];
	
	$scope.orgName = "";
	$scope.orgPhone = "";
	$scope.orgRef = "";
	$scope.orgSugg = "";

	
	$interval(function(){
		var i = Math.floor((Math.random() * 24) + 1);
		$(".contentBox"+i).slideDown(function(){
			$(".contentBox"+prev).slideUp();
			prev = i;
		});
	}, 1500);
	

	$scope.loadProjects = function(){
		$http({
			method: 'POST', 
			url: proj_url_path, 
			data:{
				all:'active', 
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


	};
	$scope.processResponse = function(res){
		for(var i = 0; i < res.length; i++){
			var proj = JSON.parse(res[i]);
			var project = {};
			project.id = proj.projId;
			project.name = proj.projName;
			project.desc = proj.projDesc;
			project.visitDate = proj.visitDate;
			project.dueDate = proj.dueDate;
			project.wishCount = proj.wishCount;
			project.wishGrant = proj.wishGrant;
			project.countTimer = $scope.countDate(proj.dueDate);
			project.status = proj.projStatus;
			$scope.projects.push(project);
		}
	};
	
	
	$scope.countDate = function(day){
		var date = new Date(day);
		var today = new Date();
		var timeDiff = Math.abs(date.getTime() - today.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		return diffDays;
	};

	$scope.showPop = function(div){
		$(".popUp").hide();
		$(div).show();
	};

	$scope.hidePop = function(){
		$(".popUp").hide();
	};

	$scope.ScrollCtrl = function(aid){
		var aTag = $("a[name='"+ aid +"']");
        $('html,body').animate({scrollTop: aTag.offset().top},'slow');
	};

	$scope.submitSuggestion = function(){
		if($scope.orgName == "" || $scope.orgPhone == "" || $scope.orgRef == ""){
			$scope.validateSugg = "show";
			return;
		}
	
		$scope.successSugg = "Working on it...";
		
		$http({
			method: 'POST', 
			url: suggestion_url_path, 
			data:{
				orgName:$scope.orgName, 
				orgPhone:$scope.orgPhone,
				orgRef:$scope.orgRef,
				orgSugg: $scope.orgSugg
			}
		}).
	    success(function(data, status, headers, config) {
			$scope.validateSugg = undefined;
	    	$scope.successSugg = "show";
			$scope.orgName = "";
			$scope.orgPhone = "";
			$scope.orgRef = "";
			$scope.orgSugg = "";

	    }).
	    error(function(data, status, headers, config) {
	    	console.log("Error");
	    });
	};
	$scope.loadProjects();
};
