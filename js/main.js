var racine = "http://book.laventurierviking.fr/";
var racineImg = racine+'media/img/';
var sections;

$(document).ready(function() {
	var page = $('main');
	var lastBackground = '';
	
	sections = $('>.section', page);

	// check bg
	sections.each(function(){
		var background = $(this).data('background');
		var anchor = $(this).data('anchor');
		// to place data-background on all section
		if(background === undefined || 	background === '') {
			background = lastBackground;
			$(this).attr("data-background", background);
		}
		// to load all bg
		if(background !== lastBackground) loadBackground(background, anchor);
		// save last bg
		lastBackground = background;
	});

	page.fullpage({
		verticalCentered: false,
		onLeave: function(index, nextIndex, direction){
        var leavingSection = $(this);
				var nextElmt = $('>.section:nth-child('+nextIndex+')', page);

				if(nextElmt.attr('data-background') !== undefined && nextElmt.attr('data-background') !== "") {
					changeBackground(nextElmt.attr('data-background'));
				}
    },
    afterLoad: function(anchorLink, index){
			var loadedSection = $(this);
			// changeBackground($(this).data('background'));
			if (typeof window[anchorLink] == 'function') { window[anchorLink]($(this), anchorLink); }
    }

	});

	$( 'audio' ).audioPlayer();


});

var bg = $('.bg');
function loadBackground(bg, anchor) {
	var	id = anchor !== undefined  && anchor !== '' ? 'id="bg-'+anchor+'"' : ""; 
	bg = racineImg+bg;
	$('.bg').append('<img '+id+' class="hidden" src="'+bg+'"/>');
}

function changeBackground(newBg, nextBg, anchor) {
	// check if racine is on attr
	if(newBg.indexOf(racineImg) === -1)	newBg = racineImg+newBg;
	if(nextBg !== undefined) loadBackground(nextBg, anchor);

	if($('.active',bg).css('background-image') !== 'url('+newBg+')') {
		$(':not(.active)',bg).css('background-image', 'url('+newBg+')');
		$('div', bg).toggleClass('active');
		// to prevent change bg on page scrolling
		if(anchor !== undefined) $('[data-anchor="'+anchor+'"]').attr('data-background', newBg);
	}

}
