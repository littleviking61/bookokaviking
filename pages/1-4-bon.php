<section class="section" data-anchor="<?= $anchor ?>" data-background="bg-bon.jpg">
	<div class="player text-center medium" style="background-color: rgba(17, 12, 8, .7);">
		<audio class="audio" title="Bon" preload="auto">
				<source src="media/audio/bon-2.mp3" type="audio/mp3">
		</audio>
	</div> 

	<script>

		
	function f_1_4_bon(section, anchorLink){
		section = section || 'main';
		var player = $('.audioplayer', section);
		var videoBon = addBgVideo('media/video/bon.mp4', anchorLink);

		if(typeof player[0].tl === 'undefined') {
			
			player[0].tl = new TimelineLite();
			player[0].tl.pause()
			.add(function() { changeBackground('bg-bon.jpg','bg-bon1.JPG',anchorLink) }, 0.1)
			.add(function() { 
				videoBon.addClass('active-video').data('vide').getVideoObject().play();
			}, 3)
			.add(function() {
				changeBackground('bg-bon1.JPG','bg-bon2.JPG',anchorLink);
				videoBon.data('vide').$wrapper.css({opacity: 0});
			}, 26)
			.add(function() { changeBackground('bg-bon2.JPG','bg-bon3.JPG',anchorLink);  videoBon.removeClass('active-video'); }, 30)
			.add(function() { changeBackground('bg-bon3.JPG','bg-bon4.JPG',anchorLink) }, 34)
			.add(function() { changeBackground('bg-bon4.JPG','bg-bon5.JPG',anchorLink) }, 38)
			.add(function() { changeBackground('bg-bon5.JPG','bg-bon6.JPG',anchorLink) }, 42)
			.add(function() { changeBackground('bg-bon6.JPG','bg-bon7.JPG',anchorLink) }, 50)
			.add(function() { changeBackground('bg-bon7.JPG','bg-bon8.JPG',anchorLink) }, 55)
			.add(function() { changeBackground('bg-bon8.JPG','bg-bon9.JPG',anchorLink) }, 58)
			.add(function() { changeBackground('bg-bon9.JPG','bg-bon10.JPG',anchorLink) }, 61)
			.add(function() { changeBackground('bg-bon10.JPG','bg-bon11.JPG',anchorLink) }, 64)
			.add(function() { changeBackground('bg-bon11.JPG') }, 68)
			;

		}

	};

	</script>

</section>
