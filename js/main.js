
$(document).ready(function() {
	var page = $('main');
	var sections = $('>.section', page);
	var lastBackground = '';

	// check bg
	sections.each(function(){
		background = $(this).data('background');
		// to place data-background on all section
		if(background === undefined || 	background === '') {
			background = lastBackground;
			$(this).attr("data-background", background);
		}
		// to load all bg
		if(background !== lastBackground) loadBackground(background);
		// save last bg
		lastBackground = background;
	});

	$( 'audio' ).audioPlayer();
	page.fullpage({
		verticalCentered: false,
		onLeave: function(index, nextIndex, direction){
        var leavingSection = $(this);

				var nextElmt = $('>.section:nth-child('+nextIndex+')', page);
				// var audioPlay = $('.audioplayer', nextElmt);
				// if(audioPlay !== -1 && audioPlay.length < 2) {
				// 	audioPlay.trigger('click');
				// }

				if(nextElmt.data('background') !== undefined && nextElmt.data('background') !== "") {
					changeBackground(nextElmt.data('background'));
				}
    }

	});

});

var bg = $('.bg');
function loadBackground(bg) {
	$('.bg').append('<img class="hidden" src="'+bg+'"/>');
}

function changeBackground(newBg) {

	if($('.active',bg).css('background-image') !== 'url(http://book.laventurierviking.fr/'+newBg+')') {
		$(':not(.active)',bg).css('background-image', 'url('+newBg+')');
		$('div', bg).toggleClass('active');
	}

}
