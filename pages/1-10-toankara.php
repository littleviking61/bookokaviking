 <section class="section" data-anchor="<?= $anchor ?>" data-background="#000">
        <div class="player-youtube flex-column loading">
            <div class="player-container"><div id="playerAnkara"></div></div>
            <div class="talks">
                <div class="title"><h4>De Rennes à Ankara</h4><small>Vidéo commentée</small></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Bonjour c'est l'aventurier viking. Je vais vous commenter cette vidéo en live</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Vous avez juste à cliquer sur lecture !</p></div>
                <div class="talk"><small>Cigalou : </small><p>C'est quoi ce truc de fou ?</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>C'est un outils fait maison alors si ça vous plait dites le moi</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Et soyez sympa, c'est ma première vidéo du voyage :p</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Les premières images c'est la Croatie</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Juste après mon accident</p></div>
                <div class="talk"><small>Elsa : </small><p>C'est ou cette cascade ou tu fais le beau ?</p></div>
                <div class="talk"><small>L'aventurier viking : </small><p>Krka National Park, c'est magnifique !</p></div>
            </div>
        </div>

    <script>
        
       function f_1_10_toankara(section, anchorLink){
            var 
                player, 
                container = $('.player-youtube', section),
                talk = $('> .talks', container),
                talks = $('> .talk', talk);

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


            function onPlayerStateChange(event) {

                if (event.data == YT.PlayerState.PLAYING) {
                    player.tl.play();
                }
                else if (event.data == YT.PlayerState.PAUSED) {
                    player.tl.pause();
                }
            }

            function onPlayerReady(event) {

                $allVideos.push($('iframe', container).get(0));
                if( $( window ).width() - 40 - (talks.first().outerWidth()+10) <= 1280) {
                    $('iframe', container).height($('iframe', container).width() * 720/1280);
                    nextHeight = ($('iframe', container).width()- talks.first().outerWidth()+10) * 720/1280;
                }else nextHeight = 720;

                if(typeof player.tl === 'undefined') {

                    player.tl = new TimelineMax();
                    player.tl.pause()
                    .to(talk, 0.4, {maxWidth: talks.first().outerWidth()+10, delay:1})
                    .to($('iframe', container), 0.4, {height: nextHeight}, 1)
                    .to($(talks[0]), 0.4, {maxHeight:100, delay:0.5})
                    .to($(talks[1]), 0.4, {maxHeight:100, delay:2})
                    .addLabel("start")
                    .to($(talks[2]), 0.4, {maxHeight:100}, "start+=0.5")
                    .to($(talks[3]), 0.4, {maxHeight:100}, "start+=2")
                    .to($(talks[4]), 0.4, {maxHeight:100}, "start+=7")
                    // explication
                    .to($(talks[5]), 0.4, {maxHeight:100}, "start+=12")
                    .to($(talks[6]), 0.4, {maxHeight:100}, "start+=15")
                    .to($(talks[7]), 0.4, {maxHeight:100}, "start+=22")
                    .to($(talks[8]), 0.4, {maxHeight:100}, "start+=24")
                    ;

                }

                container.removeClass('loading');
                player.tl.tweenFromTo(0,"start");
            }

           
        }




    </script>

       
</section>