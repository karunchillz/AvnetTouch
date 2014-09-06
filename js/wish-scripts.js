$(document).ready(function(){
	//setupBlocks();
	$('.block').hover(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).find('.sponsorButton').hide();

		}
		else{
			$(this).addClass("active");
			$(this).find('.sponsorButton').show();			
		}
	});
	
	$('.contributeButton').click(function(){
		$(this).html("SPONSORED");
		$(this).css("background","green");
	});
});
	
var colCount = 0;
var colWidth = 0;
var margin = 15;
var windowWidth = 0;
var blocks = [];

function setupBlocks() {
	windowWidth = $(window).width();
	frameWidth = calculateFrameWidth(windowWidth);
	setFrameWidths(frameWidth);
	colWidth = $('.block').outerWidth();
	colCount = Math.floor(frameWidth/(colWidth+margin));
	for(var i=0; i < colCount; i++) {
		blocks.push(margin);
	}
	positionBlocks();
	
}

function setFrameWidths(frameWidth){
	$(".wishListSection").width(frameWidth);
	$(".projSection").width(frameWidth);
}
function calculateFrameWidth(windowWidth){
	if(windowWidth > 1300)
		return 1260;
	else if(windowWidth > 960 && windowWidth <=1200)
		return 960;
}
function positionBlocks() {
	$('.block').each(function(){
		console.log("inside this");
		var min = Array.min(blocks);
		var index = $.inArray(min, blocks);
		var leftPos = margin+(index*(colWidth+margin));
		$(this).css({
			'left':leftPos+'px',
			'top':min+'px'
		});
		blocks[index] = min + $(this).outerHeight()+margin;
	});
	$(".wishListSection").height(Array.max(blocks) + 20);
}

// Function to get the Min value in Array
Array.min = function(array) {
	return Math.min.apply(Math, array);
};

// Function to get the Min value in Array
Array.max = function(array) {
	return Math.max.apply(Math, array);
};
	
	