var timer = 0,
	top = 0,
	loader = '<div class="loader-animation" />',
	overlay = '<div class="loader-overlay" />',
	defaults = {
		overlay: false
	};

$.fn.insertLoader = function(opt){
	
	options = $.extend({}, defaults, opt);
	
	if ($(this).css("position") == "static"){
		$(this).css("position", "relative");
	}
	if (!$(this).find(".loader-animation").length){
		if (options.overlay){
			$(this).append(overlay);
		}
		$(this).append(loader);
		startTimer();
	}
}

$.fn.removeLoader = function(){
	$(this).find(".loader-animation").remove();
	$(this).find(".overlay").remove();
	if (!$(".loader-animation").length)
		stopTimer();
}


function startTimer(){
	if (!timer)
		timer = setTimeout("changeBG()", 100);
}
function stopTimer(){
		clearTimeout(timer);
		timer = 0;
}
function changeBG(){
	top = (top < 440) ? (top + 40) : 0;
	$(".loader-animation").css("background-position", "0 -" + top + "px");
	timer = setTimeout("changeBG()", 100);
}