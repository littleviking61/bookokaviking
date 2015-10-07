var 
	racine = "http://book.laventurierviking.fr/",
	racineImg = racine+'media/img/',
	historyPage = Cookies.get('activePage'),
	lastBackground = '', keepChapitre = false,
	sections, bg, page, header, nav, chap, loadedSection, loadedAnchorLink,
	widgetIframe, widget, playlist, active, carte;
$( window ).load(function(){
	$('.arrow.loading', page).removeClass('loading');

});

$(document).ready(function() {
	bg = $('.bg'),
	page = $('main > .sections');
	header = $('header.main'),
	nav = $('nav.main', header),
	chap = $('.chapitres', header);
	soundcloudPlayer = $('.player-soundcloud', header);

	// sections init
	sections = $('>.section', page);
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
	});

	// full pages init
	page.fullpage({
		verticalCentered: false,
		// scrollBar: true,
		scrollOverflow: true,
		css3: true,
		onLeave: function(index, nextIndex, direction){
			var leavingSection = $(this),
			nextElmt = $('>.section:nth-child('+nextIndex+')', page),
			nextElmtBg = nextElmt.attr('data-background');

			if(nextElmtBg !== undefined && nextElmtBg !== "") changeBackground(nextElmtBg);
			// hide video for other section
			$('[data-video-anchor="'+$(loadedSection).data('anchor')+'"]', bg).addClass('hidden');
		},
		afterLoad: function(anchorLink, index){
			Cookies.set('activePage', anchorLink);

			loadedSection = $(this);
			loadedAnchorLink = anchorLink;
			anchorLinkOk = 'f_'+anchorLink.replace(/-/g, '_');
			//
			if (typeof window[anchorLinkOk] == 'function') { window[anchorLinkOk]($(this), anchorLink); }
			// show video hidden before
			$('[data-video-anchor="'+anchorLink+'"]', bg).removeClass('hidden');
		},
	});

	$('[data-fp-action]').click(function(e){
		if(!$(this).hasClass('loading')){
			var action = $(this).data('fp-action');
			if(typeof page.fullpage[action] == 'function') page.fullpage[action]();
			e.preventDefault();
		}
	})

	// other inits
	$( 'audio' ).audioPlayer();
	initCancelContainerButton(sections);
	initMenu();

	checkCookie();
	// initSoundCloudPlayer();

});

// for audio player play on space up
$(window).keypress(function(e) {
	if (e.keyCode === 0 || e.keyCode === 32) {
		$('.audioplayer', loadedSection).trigger('click');
	}
});

/* function active event */

function checkCookie() {
	hashtag = window.location.hash;
	console.log(historyPage);
	if( historyPage !== undefined && historyPage !== 'bienvenue' && (hashtag === '' || hashtag === '#') ) {
		var r = confirm('Would you like to go to the last page you read ?');
		if (r == true) {
		    window.location.hash = historyPage;
		}
	}
}

function initCancelContainerButton(sections) {
	// to activate minimize function
	$('.icon-cancel', sections).click(function(){
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
			});
		} else this.closeBtn.reverse();
		
		container.toggleClass('closed');
	});
}

function initSoundCloudPlayer() {
	widgetIframe	= document.getElementById('sc-widget');
	widget				= SC.Widget(widgetIframe);
	playlist			= 'https://soundcloud.com/nils_frahm/sets/piano-day-playlist-march-29th';
	active;

	widget.load(playlist);
	widget.bind(SC.Widget.Events.READY, function() {

		$('[href^="#son"]', nav).removeClass('loading');

		widget.bind(SC.Widget.Events.PLAY, function() {
			// get information about currently playing sound
			widget.getCurrentSoundIndex(function(currentIndex) {
				// change background on svg
				active = currentIndex;
				// change active on link
				$('.list-sounds a[data-key]', soundcloudPlayer).removeClass('active');
				$('.list-sounds a[data-key="'+currentIndex+'"]', soundcloudPlayer).addClass('active');

				$('#play').addClass('active');
				$('#pause, #stop').removeClass('active');
			});
		});

		widget.bind(SC.Widget.Events.PAUSE, function() {
			$('#play').removeClass('active');
			$('#pause').addClass('active');
		});

		widget.bind(SC.Widget.Events.FINISH, function() {
			$('#play, #pause').removeClass('active');
		});

		$('#next').click(function(event) {
			widget.next().seekTo(0);;
			event.preventDefault();
		});

		$('#prev').click(function(event) {
			widget.prev().seekTo(0);;
			event.preventDefault();
		});

		$('#play').click(function(event) {
			widget.play();
			event.preventDefault();
		});

		$('#pause').click(function(event) {
			widget.pause();
			event.preventDefault();
		});
		
		// create list of sound
		addAllSound(widget);
		// to do optimize volume
		widget.setVolume(0.1);
	});

}

function addAllSound(widget) {
	widget.getSounds(function(allsounds) {
		var sounds = [];
		$.each(allsounds, function(index, value) {
			if(index > 15) return false;
			sounds.push('<li><a href="#" data-key="'+index+'" data-id="'+value.id+'">'+ value.title + '</a></li>');
		});
		$('.list-sounds', soundcloudPlayer).html(sounds);
		
		// nav[0].tl2 = new TimelineLite();
		nav[0].tl2
		.pause()
		.to(soundcloudPlayer, .1, {opacity:1, display: 'block'})
		.staggerFrom($('li', soundcloudPlayer), .09, { marginRight:'10px', opacity: 0}, .03);

		$('.list-sounds a', soundcloudPlayer).click(function(event) {
			widget.skip($(this).attr('data-key')).seekTo(0);;
			event.preventDefault();
		});
	});
}

function initMenu(){

		// active menu button
		nav[0].tl = new TimelineLite();
		nav[0].tl2 = new TimelineLite();

		nav[0].tl
		.pause()
		.to(chap, .1, {opacity:1, display: 'block'})
		.staggerFrom($('li', chap), .09, { marginRight:'10px', opacity: 0}, .03);

		// menu chapitre
		$('[href^="#menu"]', nav)
			.mouseenter( function () {
				nav[0].tl2.totalDuration(.2).reverse();
				nav[0].tl.totalDuration(.6).play();
			})
			.click(function(e){
				if(!$(this).hasClass('active')) {
					keepChapitre = true;
					nav[0].tl.totalDuration(.6).play();
				}else{
					keepChapitre = false;
					nav[0].tl.totalDuration(.4).reverse();
				}
				
				$(this).toggleClass('active');
				e.preventDefault();
			});

		$('[href^="#son"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(.2).reverse();
				nav[0].tl2.totalDuration(.6).play();
			})
			.click(function(e) {
				if(!$(this).hasClass('active')) {
					widget.play();
				}else{
					widget.pause();
				}
				$(this).toggleClass('active');
				e.preventDefault();
			});

		// on leave header quit nav if open
		header
			.mouseleave(function(){
				if(!keepChapitre) {
					$('a[href^="#menu"].active', nav).removeClass('active');
					nav[0].tl.reverse();
					nav[0].tl2.reverse();
				}else{
					nav[0].tl2.totalDuration(.2).reverse();
					nav[0].tl.totalDuration(.6).play();
				}
			})

		carte = $('<div class="map loading"></div>').insertAfter(header);
		$('[href^="#map"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(.2).reverse();
				nav[0].tl2.totalDuration(.2).reverse();
			})
			.click(function(e) {
				if(!$(this).hasClass('active')){			
					if(carte.hasClass('loading')) {
						var linkClick = $(this)
						linkClick.addClass('loading');
						$.ajax({
						  url: "/pages/map.php",
						  context: carte
						}).done(function(data) {
								linkClick.removeClass('loading');
								carte.html(data).addClass('active').removeClass('loading');
								header.addClass('closed');
								$.fn.fullpage.setAllowScrolling(false);
								$.fn.fullpage.setKeyboardScrolling(false);
						});
					}else{
						carte.addClass('active');
						header.addClass('closed');
						$.fn.fullpage.setAllowScrolling(false);
						$.fn.fullpage.setKeyboardScrolling(false);
					}
				}else{
					carte.removeClass('active');
					header.removeClass('closed');
					$.fn.fullpage.setAllowScrolling(true);
					$.fn.fullpage.setKeyboardScrolling(true);
				}
				$(this).toggleClass('active');
				e.preventDefault();
			});

		$('[href^="#love"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(.2).reverse();
				nav[0].tl2.totalDuration(.2).reverse();
			})
			.click(function(e) {
				$(this).toggleClass('active');
				e.preventDefault();
			});

		$('[href^="#close"]', nav).click(function(e) {
			carte.removeClass('active');
			header.removeClass('closed');
			$('a[href^="#map"]', nav).removeClass('active')
			$.fn.fullpage.setAllowScrolling(true);
			$.fn.fullpage.setKeyboardScrolling(true);
			e.preventDefault();
		});
}

/* functions utiles */

function getActiveBgVideo() {
	return $('[data-video-anchor="'+loadedAnchorLink+'"].active-video video', bg);
}

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
		$('.image', bg).toggleClass('active');
		// to prevent change bg on page scrolling
		if(anchor !== undefined) $('[data-anchor="'+anchor+'"]').attr('data-background', newBg);
	}
}

function addBgVideo(videoLink, anchorLink) {
	if( $('[data-video-anchor="'+anchorLink+'"]', bg).length === 0 ) {
		newVideo = $('<div class="video" data-video-anchor="'+anchorLink+'"></div>').appendTo(bg);
		
		if(newVideo.data('vide') === undefined) {
			newVideo.vide({
				mp4: videoLink
			}, {
				posterType: 'none',
				loop: false,
				autoplay: false,
			});
		}
		return newVideo;
	}
}
