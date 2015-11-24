 <section class="section" data-anchor="<?= $anchor ?>" data-background="#000">
        <div class="flex-column">
            <div class="player-youtube loading"><div id="playerAnkara"></div></div>
            <div class="talks">
                <div class="talk"><small>L'aventurier viking : </small><p>Bonjour c'est l'aventurier viking</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Je vais vous commenter cette vidéo en live</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Vous avez juste à cliquer sur play !</p></div>
                <div class="talk"><small>Cigalou : </small><p>C'est quoi ce truc de fou ?</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>C'est un outils fait maison alors si ça vous plait dites le moi</p></div>
                <div class="talk"><small>Cigalou : </small><p>Ok</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Et soyez sympa, c'est ma première vidéo du voyage :p</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Les premières images c'est la Croatie</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Juste après mon accident</p></div>
                <div class="talk"><small>Elsa : </small><p>C'est ou cette cascade ou tu fais le beau ?</p></div>
            </div>
        </div>
        <!-- <iframe id="playerYTUBE" width="1280" height="720" src="https://www.youtube.com/embed/eoJWFPmth_s?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe> -->

    <script>
        
       function f_1_10_toankara(section, anchorLink){
            var player;
            var talks = $('.talks > .talk', section);

            player = new YT.Player('playerAnkara', {
                width: 1280,
                height: 720,
                videoId: 'eoJWFPmth_s',
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange,
                  // 'onError': onPlayerError
                }
            });

            if(typeof player.tl === 'undefined') {
            
                player.tl = new TimelineMax();
                player.tl.pause()
                .to($(talks[0]), 0.4, {opacity:1})
                .to($(talks[1]), 0.4, {opacity:1, delay:1})
                .to($(talks[2]), 0.4, {opacity:1, delay:1})
                .addLabel("start")
                .to($(talks[3]), 0.4, {opacity:1}, "start+=0.5")
                .to($(talks[4]), 0.4, {opacity:1}, "start+=2")
                .to($(talks[5]), 0.4, {opacity:1}, "start+=5")
                .to($(talks[6]), 0.4, {opacity:1}, "start+=7")
                // explication
                .to($(talks[7]), 0.4, {opacity:1}, "start+=12")
                .to($(talks[8]), 0.4, {opacity:1}, "start+=15")
                .to($(talks[9]), 0.4, {opacity:1}, "start+=21")
                // .to($(talks[0]), 1, {opacity:0, height:0})
                ;

            }

            function onPlayerStateChange(event) {

                if (event.data == YT.PlayerState.PLAYING) {
                    player.tl.play();
                }
                else if (event.data == YT.PlayerState.PAUSED) {
                    player.tl.pause();
                }
            }

            function onPlayerReady(event) {
              player.tl.tweenFromTo(0,"start");
            }

           
        }




    </script>

       
</section>