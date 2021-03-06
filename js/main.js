var 
	racine = window.location.origin + '/',
	racineImg = racine+'media/img/',
	historyPage = Cookies.get('activePage'),
	autoplay = window.location.host.indexOf('book') !== -1 ? false : true, 
	autoMusique = true, musiqueActive = 0, playerYT = [],
	$allVideos = $("iframe[src^='//www.youtube.com']"), ratio = 720/1280,
	lastBackground = '', lastPlay = '', keepChapitre = false, mapActive = false,
	sections, bg, page, header, nav, chap, loadedSection, loadedAnchorLink,
	widgetIframe, widget, playlist, active, carte, loader, arrowDown, arrowUp;

$(document).ready(function() {

	bg = $('.bg');
	page = $('main > .sections');
	header = $('header.main');
	nav = $('nav.main', header);
	chap = $('.chapitres', header);
	soundcloudPlayer = $('.player-soundcloud', header);
	arrowDown = $('main > .arrow.loading');
	arrowUp = $('.arrow.unactive', header);

	$('a[onclick]').click(function(e){
		e.preventDefault();
	});

	// sections init
	sections = $('>.section', page);

	sections.each(function(){
		$this = $(this);

		var 
			background = $this.data('background'),
			musique = $this.data('play'),
			anchor = $this.data('anchor');

		// to place data-background on all section
		if(background === undefined || 	background === '') {
			background = lastBackground;
			$this.attr("data-background", background);
		}
		// to place data-play on all section
		if(musique === undefined || 	musique === '') {
			musique = lastPlay;
			$this.attr("data-play", musique);
		}
		// to load all bg
		if(background !== lastBackground) loadBackground(background, anchor);
		// save last bg
		lastBackground = background;
		lastPlay = musique;
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
			nextElmtBg = nextElmt.attr('data-background'),
			audioEvent = parseInt(nextElmt.data('play'),10);

			if(leavingSection.hasClass('banner') ) {
				arrowDown.removeClass('active'); 
				arrowUp.removeClass('unactive'); 
			}else if(nextElmt.hasClass('banner') ) {
				arrowDown.addClass('active');
				arrowUp.addClass('unactive');
			}  

			if(nextElmtBg !== undefined && nextElmtBg !== "") changeBackground(nextElmtBg,undefined,undefined,nextElmt);
			// hide video for other section
			$('[data-video-anchor="'+$(loadedSection).data('anchor')+'"]', bg).addClass('hidden');

			if(!isNaN(audioEvent) && autoMusique && $('[href^="#son"]', nav).hasClass('active') ) {
				widget.getCurrentSoundIndex(function(currentIndex) { 
					if(audioEvent !== currentIndex && audioEvent !== musiqueActive) {
						musiqueActive = audioEvent;
						widget.seekTo(0).skip(audioEvent);
					}
				});
			}

			// check slide bg 
			var slides = $( '.slide[data-background]',nextElmt);
			if(slides.length > 0 ) {
				slides.each(function(){
					// console.log($(this).data('background'));
					loadBackground($(this).data('background'));
				});
			}

			//pause every youtube video
			if(playerYT.length > 0) $.each(playerYT,function(index,value) {
				if(this.getPlayerState() === 1) this.pauseVideo();
			});

			// to stop video if is playing
			if($('.video-control', leavingSection).hasClass('active')) $('.video-control', leavingSection).trigger('click');
		},
		afterLoad: function(anchorLink, index){
			// save cookies and active analytics event
			Cookies.set('activePage', anchorLink);
			if(analytics && anchorLink !== "bienvenue") ga('send', { hitType: 'pageview', page: window.location.pathname + window.location.hash });

			loadedSection = $(this);
			loadedAnchorLink = anchorLink;
			anchorLinkOk = 'f_'+anchorLink.replace(/-/g, '_');
			//
			if (typeof window[anchorLinkOk] == 'function') { window[anchorLinkOk]($(this), anchorLink); }
			// show video hidden before
			$('[data-video-anchor="'+anchorLink+'"]', bg).removeClass('hidden');

			initCancelContainerButton(loadedSection);
		},
		onSlideLeave: function( anchorLink, index, slideIndex, direction, nextSlideIndex){
      var leavingSlide = $(this),
      sectionActive = leavingSlide.closest('section.section'),
      nextElmt = $('.fp-slidesContainer > .slide:nth-child('+(nextSlideIndex+1)+')', sectionActive),
			nextElmtBg = nextElmt.data('background');

			sectionActive.attr('data-background', nextElmtBg);
      //leaving the first slide of the 2nd Section to the right

			if(nextElmtBg !== undefined && nextElmtBg !== "") changeBackground(nextElmtBg,undefined,undefined,nextElmt);
	  }
	});

	$('[data-fp-action]').click(function(e){
		if(!$(this).hasClass('loading')){
			var action = $(this).data('fp-action');
			if(typeof page.fullpage[action] == 'function') page.fullpage[action]();
			e.preventDefault();
		}
	});

	// other inits
	$( 'audio' ).audioPlayer();
	initMenu();
	initSoundCloudPlayer();
	initTooltip();

	checkCookie();
});

$( window ).load(function(){
	arrowDown.removeClass('loading');

	$(".panorama").panorama_viewer({
	    repeat: false,              // The image will repeat when the user scroll reach the bounding box. The default value is false.
	    direction: "horizontal",    // Let you define the direction of the scroll. Acceptable values are "horizontal" and "vertical". The default value is horizontal
	    animationTime: 400,         // This allows you to set the easing time when the image is being dragged. Set this to 0 to make it instant. The default value is 700.
	    easing: "ease-out",         // You can define the easing options here. This option accepts CSS easing options. Available options are "ease", "linear", "ease-in", "ease-out", "ease-in-out", and "cubic-bezier(...))". The default value is "ease-out".
	    overlay: true               // Toggle this to false to hide the initial instruction overlay
	  });
});

// for audio player play on space up

$(window).keypress(function(e) {
	if (e.keyCode === 0 || e.keyCode === 32) {
		$('.audioplayer', loadedSection).trigger('click');
	}
});

// for map hashchange and other (repond to hash not click)
$(window).on('hashchange', function() {

	if(window.location.hash == "#map" || mapActive) {
		if(analytics) ga('send', { hitType: 'pageview', page: '/#map' });

		if(!mapActive){			
			if(carte.hasClass('loading')) {
				var linkClick = $('[href^="#map"]', nav);
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
		$('[href^="#map"]', nav).toggleClass('active');

		mapActive = !mapActive;
	}
});


$(window).resize(function() {
  $allVideos.each(function() {
    if($(this).width() <= 1280) {
    	$(this).closest('.player-youtube').height($(this).width() * ratio);
    }

  });

// Kick off one resize to fix all videos on page load
}).resize();

$('.video-control').click(function(){
	if($(this).hasClass('active')) {
		if($('.active-video', bg).length > 0) $('.active-video', bg).data('vide').getVideoObject().pause();
		this.tl.pause();
		this.paused = true;
		widget.setVolume(0.3);
	}else{
		if(this.paused && $('.active-video', bg).length > 0) $('.active-video', bg).data('vide').getVideoObject().play();
		this.tl.play();
		widget.setVolume(0.1);
	}

	$(this).toggleClass('active');
});

function restartVideo() {
	// console.log('restart');
	this.seek(0).pause();
	widget.setVolume(0.3);
	$('.video-control').removeClass('active');
}

/* function active event */

function checkCookie() {
	hashtag = window.location.hash;
	// console.log(historyPage);
	if( historyPage !== undefined && historyPage !== 'bienvenue' && (hashtag === '' || hashtag === '#') ) {
		
		$.fn.fullpage.setAllowScrolling(false);
		$.fn.fullpage.setKeyboardScrolling(false);

		swal({
			title: "Voulez-vous accéder directement à la dernière page visionnée ?",
			// text: "You will not be able to recover this imaginary file!",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Oui, merci !",
			cancelButtonText: "Non",
			closeOnConfirm: true 
		}, function(){  
			window.location.hash = historyPage;
		});

	}
}

function initCancelContainerButton(sections) {
	// to activate minimize function
	$('.icon-cancel', sections).each(function(){
		var container = $(this).closest('.container');
		if(this.closeBtn === undefined) {
			this.closeBtn = new TimelineLite();
			this.closeBtn
			.pause()
			.to( container, 0.3, { height: "70px", overflow: "hidden", ease: "Cubic.easeInOut"})
			.to( $('header', container), 0.2, { marginTop: "70px"}, "-=.2" )			
			.to( container, 0.2, { width: "70px"}, "-=.1")
			.to( container, 0.1, { borderRadius: "50%"}, "-=.15")
			.addLabel("end")
			.eventCallback('onReverseComplete', function() { 
				container[0].style.removeProperty('width');
				container[0].style.removeProperty('height');
			});

			if(container.hasClass('closed')) {
				this.closeBtn.seek("end");
			} 
		}

	}).unbind('click').click(function(){
		var container = $(this).closest('.container');

		if(!container.hasClass('closed')) {
			this.closeBtn.play()
		} else this.closeBtn.reverse();
		
		container.toggleClass('closed');
	});
	
	if(sections.hasClass('closeIt')) {
		var container = $('.container', sections);

		this.closeBtn = new TimelineLite();
		this.closeBtn
		.pause()
		.to( container, 0.3, { height: "70px", overflow: "hidden", ease: "Cubic.easeInOut"})
		.to( $('header', container), 0.2, { marginTop: "70px"}, "-=.2" )			
		.to( container, 0.2, { width: "70px"}, "-=.1")
		.to( container, 0.1, { borderRadius: "50%"}, "-=.15")
		.eventCallback('onReverseComplete', function() { 
			container[0].style.removeProperty('width');
			container[0].style.removeProperty('height');
		})
		.seek(1);

		container.addClass('closed');

	}	
}

function initMenu(){

		// active menu button
		nav[0].tl = new TimelineLite();
		nav[0].tl2 = new TimelineLite();

		nav[0].tl
		.pause()
		.to(chap, 0.1, {opacity:1, display: 'block'})
		.staggerFrom($('li', chap), 0.09, { marginRight:'10px', opacity: 0}, 0.03);

		// menu chapitre
		$('[href^="#menu"]', nav)
			.mouseenter( function () {
				nav[0].tl2.totalDuration(0.2).reverse();
				nav[0].tl.totalDuration(0.6).play();
			})
			.click(function(e){
				if(!$(this).hasClass('active')) {
					keepChapitre = true;
					nav[0].tl.totalDuration(0.6).play();
				}else{
					keepChapitre = false;
					nav[0].tl.totalDuration(0.4).reverse();
				}
				
				$(this).toggleClass('active');
				e.preventDefault();
			});

		$('[href^="#son"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(0.2).reverse();
				nav[0].tl2.totalDuration(0.6).play();
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
					nav[0].tl2.totalDuration(0.2).reverse();
					nav[0].tl.totalDuration(0.6).play();
				}
			});

		carte = $('<div class="map loading"></div>').insertAfter(header);
		$('[href^="#map"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(0.2).reverse();
				nav[0].tl2.totalDuration(0.2).reverse();
			});

		$('[href^="#love"]', nav)
			.mouseenter( function () {
				nav[0].tl.totalDuration(0.2).reverse();
				nav[0].tl2.totalDuration(0.2).reverse();
			})
			.click(function(e) {
				// $(this).toggleClass('active');
				// e.preventDefault();
			});

		$('[href^="#close"]', nav).click(function(e) {
			e.preventDefault();
			window.history.back();
		});
}

function initSoundCloudPlayer() {

	var widgetIframe = document.getElementById('soundcloud-player-iframe');
	widget = SC.Widget(widgetIframe);

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
			widget.next().seekTo(0);
			event.preventDefault();
		});

		$('#prev').click(function(event) {
			widget.prev().seekTo(0);
			event.preventDefault();
		});

		$('#auto').click(function(event) {
			autoMusique = !autoMusique;
			$(this).toggleClass('active');
			event.preventDefault();
		});

		$('#play').click(function(event) {
			widget.play();
			$('[href^="#son"]', nav).addClass('active');
			event.preventDefault();
		});

		$('#pause').click(function(event) {
			widget.pause();
			$('[href^="#son"]', nav).removeClass('active');
			event.preventDefault();
		});
		
		// create list of sound
		//addAllSound(widget);
		nav[0].tl2
		.pause()
		.to(soundcloudPlayer, 0.1, {opacity:1, display: 'block'})
		.staggerFrom($('li', soundcloudPlayer), 0.09, { marginRight:'10px', opacity: 0}, 0.03);

		widget.setVolume(0.3);

		if(autoplay) $('#play').trigger('click');
	});

}

function addAllSound(widget) {
	widget.getSounds(function(allsounds) {
		var sounds = [];

		$.each(allsounds, function(index, value) {
			if(index > 15) return false;
			// console.log(value);

			sounds.push('<li><a href="#' + value.title + '" data-key="'+index+'" data-id="'+value.id+'">'+ value.title + '</a></li>');
		});
		$('.list-sounds', soundcloudPlayer).html(sounds);
		
		// nav[0].tl2 = new TimelineLite();
		nav[0].tl2
		.pause()
		.to(soundcloudPlayer, 0.1, {opacity:1, display: 'block'})
		.staggerFrom($('li', soundcloudPlayer), 0.09, { marginRight:'10px', opacity: 0}, 0.03);

		$('.list-sounds a', soundcloudPlayer).click(function(event) {
			widget.seekTo(0).skip($(this).attr('data-key'));
			event.preventDefault();
		});
	});
}

/* functions utiles */

function getActiveBgVideo() {
	return $('[data-video-anchor="'+loadedAnchorLink+'"].active-video video', bg);
}

function loadBackground(loadBg, anchor) {
	var	id = anchor !== undefined && anchor !== '' ? 'id="bg-'+anchor+'"' : ""; 
	
	if(loadBg.indexOf('#') === -1) {
		// console.log('loadBG : '+ bg);
		loadBg = racineImg+loadBg;
		bg.append('<img '+id+' class="hidden" src="'+loadBg+'"/>');
	}
}

function changeBackground(newBg, nextBg, anchor, section) {
	if(newBg.indexOf('#') === -1) {
		bg.css('background-color', 'transparent');
		// check if racine is on attr
		if(newBg.indexOf(racineImg) === -1)	newBg = racineImg+newBg;
		if(nextBg !== undefined) loadBackground(nextBg, anchor);

		if($('.active',bg).css('background-image') !== 'url("'+newBg+'")') {
			nextActive = $(':not(.active)',bg).first();
			$('.active', bg).removeClass('active');
			nextActive.css('background-image', 'url('+newBg+')');
			nextActive.addClass('active');
			// to prevent change bg on page scrolling
			if(anchor !== undefined) $('[data-anchor="'+anchor+'"]').attr('data-background', newBg);
		}
	}else {
		nextActive = $(':not(.active)',bg).first();
		$('.active', bg).removeClass('active');
		nextActive.css('background-image', 'none').css('background-color', newBg);
		nextActive.addClass('active');
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
				muted: false,
				loop: false,
				autoplay: false,
			});
		}
		return newVideo;
	}
}

function initTooltip()
{
    var targets = $( '[rel~=tooltip]' ),
        target  = false,
        tooltip = false,
        title   = false;
 
    targets.bind( 'mouseenter', function()
    {
        target  = $( this );
        tip     = target.attr( 'title' );
        tooltip = $( '<div class="tooltip"></div>' );
 
        if( !tip || tip == '' )
            return false;
 
        target.removeAttr( 'title' );
        tooltip.css( 'opacity', 0 )
               .html( tip )
               .appendTo( 'body' );
 
        var init_tooltip = function()
        {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 );
 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20;
 
            if( pos_left < 0 )
            {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else
                tooltip.removeClass( 'left' );
 
            if( pos_left + tooltip.outerWidth() > $( window ).width() )
            {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
 
            if( pos_top < 0 )
            {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 
            tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        };
 
        init_tooltip();
        $( window ).resize( init_tooltip );
 
        var remove_tooltip = function()
        {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
            {
                $( this ).remove();
            });
 
            target.attr( 'title', tip );
        };
 
        target.bind( 'mouseleave', remove_tooltip );
        tooltip.bind( 'click', remove_tooltip );
    });
}
