	(function($) {
		$(document).ready(function(){
			
	window.addEventListener('popstate', function(event) {
		console.log(CONTENT);
		if (firstVisit){
			firstVisit = false;
			//TweenLite.to('#bg_image', 1, {opacity:0});
			makeAjaxSend("firstVisit"); //u slucaju prvog posjeta sajtu, zbog opacity tweena
			return;
		}
		if (CONTENT == "left"){
			TweenLite.to($('#container'), 1, {css:{left:wWidth+"px"}, ease:Power4.easeIn, onComplete:makeAjaxSend});
		} else {
			TweenLite.to($('#container'), 1, {css:{right:wWidth+"px"}, ease:Power4.easeIn, onComplete:makeAjaxSend});
		}
		
	//	alert("Sorry, debugging in progress: "+ajaxSend);
	});
	
	$('.menu ul li a, #close_button').on('click', function(event) {
		event.preventDefault();
		if ($(event.target).is('#logo') && document.URL == HOME+"/")
			return false;
		console.log($(event.target));
		console.log(document.URL);
		if(event.target.href == document.URL) {
			return false;
			console.log("JEDNAKI!");
		}
		//$('.active').removeClass('active');
	//	$(event.target).parent().addClass('active');
		window.history.pushState('','',event.target.href);
		TweenLite.to('#bg_image', 1, {opacity:0});
		if (CONTENT == "left"){
			if ($('#container').offset().left > 0){
				console.log('kontejner je vani');
				TweenLite.to('#container', 1, {left:"-1000px", ease:Power4.easeIn, onComplete:makeAjaxSend});
			}else{
				makeAjaxSend();
			}	
		} else {
			if ($('#container').offset().left < wWidth){
				console.log('kontejner je vani');
				TweenLite.to('#container', 1, {right:"-1000px", ease:Power4.easeIn, onComplete:makeAjaxSend});
			}else{
				makeAjaxSend();
			}
		}
		//TweenLite.to($('#container'), 1, {css:{left:"-3000px"}, onComplete:makeAjaxSend});
		return false;
	});
	
	function trimming(data){
		var toTrim =data;
		
		if (toTrim.substring(toTrim.length - 1) == "/"){
			toTrim = toTrim.substring(0, toTrim.length - 1);
		}
		if (toTrim.substring(toTrim.length - 3) == "com"){
			return "index";
		}
		toTrim = toTrim.split('/').pop();
		
		toTrim = toTrim.split('.');
		toTrim.pop();
		return toTrim;
	}
	
	function makeAjaxSend(visitType) {
		//KREAIRANJE AJAX POZIVA
		//STARI NON WP NACIN 
		/*ajaxSend=trimming(document.URL);
		console.log(ajaxSend);
		update(visitType);*/
		ajaxSend = document.URL;
		if (ajaxSend.substring(ajaxSend.length - 1) == "/"){
			ajaxSend = ajaxSend.substring(0, ajaxSend.length - 1);
		}
		if (ajaxSend == HOME){
			$(window).resize();
			$('#main_content').data('jsp').reinitialise();
			return;
		}	
			
		ajaxSend = ajaxSend.split('/').pop();
		console.log(ajaxSend);
		update(visitType);
	}
	
	
	
	function update(visitType) {
		//UPDATE MENUA
		
		//UPDATE CONTENTA
		if (ajaxSend=='' || ajaxSend == HOME || !ajaxSend) { // IF DESTINATION = HOMEPAGE
	   		TweenLite.to('#bg_image', 1 ,{opacity:1});
			updateNav();			
	   	} else {
	  		go();
	  	}
		
		function go(){
			console.log(ajaxSend);
			jQuery.ajax({
				type:"POST",
				url: HOME+"/wp-admin/admin-ajax.php",
				data: {action:"postaj", q:ajaxSend},
				success: function (response) {
					var json = eval('(' + response + ')'); //jQuery.parseJSON(response); //eval('(' + response + ')');
					
					TweenLite.to("#cover", 0.5,{opacity: 0}); //Ne znam jos tocno kaje ovo
					$('#cover').css({'z-index':'-100'});
					$('#main_content').data('jsp').getContentPane().html(json.content);
					//$('#main_content').append("<script type='text/javascript'>jQuery(function(){jQuery('#main_content').jScrollPane();$jsp = jQuery('#main_content');});</script>");		
					if (ajaxSend = 'contact') {
						$('#main_content').data('jsp').getContentPane().append("<?php if (function_exists('serveCustomContactForm')) { serveCustomContactForm(1); } ?>");
					}
					$('#main_content').imagesLoaded(function( $images, $proper, $broken ) {
	    				console.log( $images.length + ' images total have been loaded' );
	    				console.log( $proper.length + ' properly loaded images' );
	    				console.log( $broken.length + ' broken images' );
	    				returnContent(visitType);
					}); //End Images Loadeda
				}
			});
		}//End go()
	}
	
	function returnContent(visitType) {
		if (visitType == 'firstVisit'){ 
			$(window).resize();
			if (CONTENT =="left"){
				TweenLite.to('#container', 1, {left: containerLeft});
			} else {
				TweenLite.to('#container', 1, {right: containerLeft});
			}
			
			return;
		}
		/*
		else if (visitType=="backVisit"){
			$("#container").css({"left": -wWidth+"px"});
		} else {
			$("#container").css({"left": wWidth+"px"});
		}*/
		/*if ($('#container').position().left>containerLeft){
			$('#container').css({
				left: -wWidth+"px"
			});
		} else {
			$('#container').css({
				left: wWidth+"px"
			});
		}*/
		if (CONTENT =="left"){
			TweenLite.to('#container', 1, {left:containerLeft, ease:Power4.easeOut, onComplete: resize});
		} else {
			TweenLite.to('#container', 1, {right:containerLeft, ease:Power4.easeOut, onComplete: resize});
		}
		$(window).resize();
		$('#main_content').data('jsp').reinitialise();
		$('#main_content').data('jsp').scrollTo(0,0);
		function resize(){
			$('#main_content').data('jsp').reinitialise();
			$(window).resize();
		}
	}
	
	});
	})( jQuery );