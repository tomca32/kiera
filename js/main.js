// DOM Ready
var wHeight;
var wWidth;
var containerLeft;

(function($) {

$(window).resize(function(){
	wHeight = $(window).innerHeight();
	wWidth = $(window).innerWidth();
	
	/*$('#container').css({
		width: wWidth * 0.8+'px',
		height: (wHeight - $('header').height() - $('footer').height()) * 0.9 + 'px'
	})*/
	function reinit(){
		if($('#container #main_content').data('jsp')){
			$('#container #main_content').data('jsp').reinitialise();	
	}}
	if (TITLE == 'left'){
		$('#title').css({left:"1%", top: $('.menu ul').offset().top - $('#title').height() - 20});
	} else {
		$('#title').css({right:"1%", top: $('.menu ul').offset().top - $('#title').height() - 20});
	}
	if (MENU == "left"){
		TweenLite.to('.menu', 1, {left:'1%'});
	} else {
		TweenLite.to('.menu', 1, {right:'1%'});
	}
	var containerTop = wHeight/10;
	var containerW = wWidth * 0.4;
	var containerH = $('#title').offset().top *0.8;
	TweenLite.to('#container', 0.5, {width: containerW, height: containerH,onComplete: reinit});
	containerLeft = "1%";	
	TweenLite.to('#container', 0.5,{top:containerTop});
	if ($('#container').offset().left > 0 && $('#container').offset().left < wWidth){
		console.log($('#container').offset().left)
		if (CONTENT == 'left'){
			TweenLite.to('#container', 0.5,{left:"1%"});
		} else {
			TweenLite.to('#container', 0.5,{right:"1%"});
		}
	}
	
	if($('#main_content').data('jsp')){
			console.log('juhu');
			$('#main_content').data('jsp').reinitialise();
			$('#main_content').css({width: '100%'});
			$('.jspContainer').css({width: '100%', height:'100%'});
			$('.jspTrack').css({height:'100%'});
			$('.jspPane').css({width: '96%'});
			$('#main_content').data('jsp').hijackInternalLinks();
			$('#main_content').data('jsp').reinitialise();
	}
	
});
	
	
$(window).load(function() {
	if (MENU == "left"){
		$(".menu").css({left:"-20%"});
	} else {
		$(".menu").css({right:"-20%"});
	}
	if (ANIMATED_MENU){
		animateAmount = 20;
		currentWidth = $('.menu ul li').width();
		$('.menu ul li').css({width: currentWidth+'px', 'max-width': '100%'});
		$('.menu ul li').on('mouseover', function(evt){
			animateTarget = ($(evt.target).parent());
			TweenLite.to(animateTarget, 0.5, {width: currentWidth+animateAmount+'px'});
		});
		$('.menu ul li').on('mouseout', function(evt){
			animateTarget = ($(evt.target).parent());
			TweenLite.to(animateTarget, 0.5, {width: currentWidth+'px'});
		});
	}
	
	if (CONTENT == "left"){
		$("#container").css({left:"-1000px"});
	} else {
		$("#container").css({right:"-2000px"});
	}
	console.log($('#container').offset().left)
	jQuery('#main_content').jScrollPane();
	$jsp = $('#main_content').data('jsp');
	$(window).resize();
	$('.nav-collapse').on('hidden', function () {
 		 $(window).resize();
	});
	$('.nav-collapse').on('shown', function () {
 		 $(window).resize();
	});
	
	function removeCover(){
		$('#cover').css({'z-index': '-100'});
	}
	TweenLite.to("#cover", 2, {opacity:0, onComplete:removeCover});

	
	// SVG custom feature detection and svg to png fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
	function supportsSVG() {
		return !! document.createElementNS && !! document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect;	
	}
	if (supportsSVG()) {
		document.documentElement.className += ' svg';
	} else {
		document.documentElement.className += ' no-svg';
		var imgs = document.getElementsByTagName('img'),
			dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}

});


})( jQuery );