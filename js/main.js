var racine = "http://book.laventurierviking.fr/";
var racineImg = racine+'media/img/';
var sections;

$(document).ready(function() {
	var page = $('main');
	var lastBackground = '';
	
	sections = $('>.section', page);

	// check bg
	sections.each(function(){
		$this = $(this);
		var background = $this.data('background');
		var anchor = $this.data('anchor');

		// to place data-background on all section
		if(background === undefined || 	background === '') {
			background = lastBackground;
			$this.attr("data-background", background);
		}
		// to load all bg
		if(background !== lastBackground) loadBackground(background, anchor);
		// save last bg
		lastBackground = background;

		// to adapt all color
		if($this.hasClass('adaptative')) {
			$.adaptiveBackground.run({
				image: racineImg+background,
				selector: $('.adapter', $this),
				exclude: [ 'rgb(0,0,0)', 'rgba(255,255,255)' ],
				transparent: 0.7
			});
			$this.removeClass('adaptative');
		}

		// to activate minimize function
		if($('.icon-cancel', $this).length !== -1) {
			$('.icon-cancel', $this).click(function(){
				var container = $(this).closest('.container');

				if(!container.hasClass('closed')) {
					this.closeBtn = new TimelineLite();
					this.closeBtn
						.to( container, .3, { height: "70px", overflow: "hidden", ease: "Cubic.easeInOut"})
						.to( $('header', container), .2, { marginTop: "70px"}, "-=.2" )			
						.to( container, .2, { width: "70px"}, "-=.1")
						.to( container, .1, { borderRadius: "50%"}, "-=.15")
						.eventCallback('onReverseComplete', function() { 
							container[0].style.removeProperty('width');
							container[0].style.removeProperty('height');
							console.log(container[0].style);
						});
				} else {
					this.closeBtn.reverse();
				}

				container.toggleClass('closed');
			});
		}
	});

	page.fullpage({
		verticalCentered: false,
		onLeave: function(index, nextIndex, direction){
        var leavingSection = $(this),
					nextElmt = $('>.section:nth-child('+nextIndex+')', page),
					nextElmtBg = nextElmt.attr('data-background');

				if(nextElmtBg !== undefined && nextElmtBg !== "") changeBackground(nextElmtBg);
    },
    afterLoad: function(anchorLink, index){
			var loadedSection = $(this);
			anchorLinkOk = 'f_'+anchorLink.replace(/-/g, '_');
			// changeBackground($(this).data('background'));
			if (typeof window[anchorLinkOk] == 'function') { window[anchorLinkOk]($(this), anchorLink); }

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
