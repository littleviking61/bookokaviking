<section class="section kazakh" data-anchor="<?= $anchor ?>" data-background="kazakh/bg-bateau.jpg">
	<div id="p-cematinla" class="player text-center medium" style="background-color: rgba(2, 2, 0, .7);">
        <audio class="audio" title="Il fait chaud ici" preload="auto">
                <source src="media/audio/kazakh.mp3" type="audio/mp3">
        </audio>
    </div> 

    <script>
        
    function f_3_2_deserts(section, anchorLink){
        section = section || 'main';
        var player = $('.audioplayer', section);

        if(typeof player[0].tl === 'undefined') {
            
            tl = player[0].tl = new TimelineLite();
            tl.pause()
            .add(function() { changeBackground('kazakh/bg-bateau.jpg','kazakh/bg-desert2.jpg',anchorLink) }, 0.1)
            .add(function() { changeBackground('kazakh/bg-desert2.jpg','kazakh/bg-desert3.jpg',anchorLink) }, 9)
            .add(function() { changeBackground('kazakh/bg-desert3.jpg','kazakh/bg-desert4.jpg',anchorLink) }, 16)
            .add(function() { changeBackground('kazakh/bg-desert4.jpg','kazakh/bg-desert5.jpg',anchorLink) }, 22)
            .add(function() { changeBackground('kazakh/bg-desert5.jpg','kazakh/bg-desert6.jpg',anchorLink) }, 28)
            .add(function() { changeBackground('kazakh/bg-desert6.jpg','kazakh/bg-desert7.jpg',anchorLink) }, 35)
            .add(function() { changeBackground('kazakh/bg-desert7.jpg','kazakh/bg-desert8.jpg',anchorLink) }, 42)
            .add(function() { changeBackground('kazakh/bg-desert8.jpg','kazakh/bg-desert9.jpg',anchorLink) }, 50)
            .add(function() { changeBackground('kazakh/bg-desert9.jpg') }, 62);

        }

    };

    </script>
</section>