<section class="section" data-anchor="<?= $anchor ?>" data-background="bg-cematinla.jpg" data-play="1">
	<div id="p-cematinla" class="player text-center medium" style="background-color: rgba(2, 2, 0, .7);">
		<audio class="audio" title="Ce matin là" preload="auto">
				<source src="media/audio/cematinla.mp3" type="audio/mp3">
		</audio>
	</div> 

	<script>
		
	function f_1_2_cematinla(section, anchorLink){
		section = section || 'main';
		var player = $('.audioplayer', section);

		if(typeof player[0].tl === 'undefined') {
			
			tl = player[0].tl = new TimelineLite();
			tl.pause()
			.add(function() { changeBackground('bg-cematinla.jpg','bg-cematinla2.jpg',anchorLink) }, 0.1)
			.add(function() { changeBackground('bg-cematinla2.jpg','bg-cematinla3.jpg',anchorLink) }, 8)
			.add(function() { changeBackground('bg-cematinla3.jpg','bg-cematinla5.jpg',anchorLink) }, 11)
			.add(function() { changeBackground('bg-cematinla5.jpg','bg-cematinla6.jpg',anchorLink) }, 17)
			.add(function() { changeBackground('bg-cematinla6.jpg','bg-cematinla7.jpg',anchorLink) }, 28)
			.add(function() { changeBackground('bg-cematinla7.jpg','bg-cematinla8.jpg',anchorLink) }, 35)
			.add(function() { changeBackground('bg-cematinla8.jpg','bg-cematinla9.jpg',anchorLink) }, 46)
			.add(function() { changeBackground('bg-cematinla9.jpg','bg-cematinla10.jpg',anchorLink) }, 54)
			.add(function() { changeBackground('bg-cematinla10.jpg','bg-cematinla11.jpg',anchorLink) }, 62)
			.add(function() { changeBackground('bg-cematinla11.jpg') }, 68);

		}

	};

	</script>

</section>
