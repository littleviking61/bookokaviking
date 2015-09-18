var audio = document.getElementById('audio');
// audio.play();

audio.addEventListener('timeupdate', function()
{
	console.log(audio.currentTime);
} , false);

fullscreen();
$(window).resize(fullscreen);
// $(window).scroll(headerParallax);

function fullscreen() {
	var header = $('.video-container');
	var windowH = $(window).height();
	var windowW = $(window).width();

	header.width(windowW);
	header.height(windowH);
}

$(document).ready(function() {

	$('.play').click(function(){
		if(audio.paused)
	  {
	    audio.play();
	  }
	  else
	  {
	    audio.pause();
	  }
	})

});

