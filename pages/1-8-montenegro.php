<section class="section" data-anchor="<?= $anchor ?>" data-background="bg-montenegro2.jpg">
	<div class="player text-center medium" style="background-color: rgba(17, 12, 8, .7);">
		<div class="video-control">Monténégro</div>
	</div> 

	<script>
	
	function f_1_8_montenegro(section, anchorLink){
		section = section || 'main';
		var player = $('.video-control', section);
		var video = addBgVideo('media/video/explication.mp4', anchorLink);

		if(typeof player[0].tl === 'undefined') {
			
			player[0].tl = new TimelineLite();
			player[0].tl.pause()
			// .add(function() { changeBackground('bg-montenegro.jpg') }, 0.1)
			.add(function() { 
				video.addClass('active-video').data('vide').getVideoObject().play();
				// loadBackground('bg-montenegro2.jpg', anchorLink);
			}, 0.1)
			.add(function() {
				changeBackground('bg-montenegro2.jpg');
				video.data('vide').$wrapper.css({opacity: 0});
			}, 75)
			.add(function() { video.removeClass('active-video').data('vide').destroy(); }, 76)
			;

		}

	};

	</script>

</section>
