 <section class="section" data-anchor="<?= $anchor ?>" data-background="#000">
        <div class="player-youtube flex-column loading">
            <div class="player-container"><div id="playerPamir"></div></div>
            <div class="talks-container">
                <div class="title"><h4>De Aktau à Dushanbe</h4><small>Vidéo commentée</small></div>
                <div class="talks">
                    <div class="talk"><small>L'aventurier viking : </small><p>Bon c'est pas la partie la plus palpitante mais c'était une expérience difficile et enrichissante</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Vous avez juste à cliquer sur lecture !</p></div>
                    <div class="talk"><small>Nico : </small><p>Bon on en est ou du coup là ?</p></div>
                    <div class="talk"><small>Cigalou : </small><p>C'est avant ou après que tu rencontres la belle kazakh ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Euh :p</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>C'est après ! J'ai rencontré la kazakh à Baku avant de traverser la mer Caspienne.</p></div>
                    <div class="talk"><small>Adrian : </small><p>Du coup la t'es arrivé de l'autre coté, pas loin de la mer d'Aral ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Oui c'est ça, à Aktau au Kazakhstan, au milieu du désert !</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Au début je roule avec Emma, la british en Vespa</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Et la c'est le couple de belges en acadiane</p></div>
                    <div class="talk"><small>Nico : </small><p>La route est bien merdique nan ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Ouai, et en prime il fait plus de 45 degrée dans la journée.</p></div>
                    <div class="talk"><small>Matthew : </small><p>Oh, I remember when we met you now.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Yes, Matthew sur la gauche est arrivée en Indonésie au moment où j'écris ces lignes</p></div>
                    <div class="talk"><small>Cigalou : </small><p>C'est ici que tu dors avec les serpents et rencontre la famille uzbek ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Oui c'est là ! La vue était magnifique comme vous pouvez le voir</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Après je me dirige vers Boukhara, la route était en travaux sur plus de 500 km.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>C'est ici que je vais me baigner avec les locaux.</p></div>
                    <div class="talk"><small>Nico : </small><p>Tu roulais combien d'heure par jour en général ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Entre 6 et 10 heures pour être précis, le maximum que j'ai fait c'est 13h.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>A partir de là je vais retrouver un peu de relief et de fraicheur.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Puis passer la frontière tadjik.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Direction Dushanbe puis la Pamir.</p></div>
                    <div class="talk"><small>Cigalou : </small><p>C'est qui ce gars-là ? Ca t'arrivé souvent qu'on te pose des questions comme ça ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Oui souvent, c'est plaisant mais faut éviter qu'il soit trop nombreux par contre.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Bon voilà, la prochaine étape c'est la Pamir. À bientôt</p></div>
                </div>
            </div>
        </div>

    <script>
        var playerYTtopamir = undefined;
        function f_3_8_topamir(section, anchorLink){
            var 
                container = $('.player-youtube', section),
                talk = $('.talks-container', container),
                talks = $('> .talks > .talk', talk);

            if(playerYTtopamir === undefined) playerYTtopamir = new YT.Player('playerPamir', {
                width: 1280,
                height: 720,
                videoId: '0Q6NOqw0Bsw',
                playerVars:{
                    //'controls': 0,
                    //'showinfo': 0
                },
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange,
                  // 'onError': onPlayerError
                }
            });

            function onPlayerReady(event) {
                playerYT.push(playerYTtopamir);
                $('> .talks', talk).html(talks.get().reverse());

                $allVideos.push($('iframe', container).get(0));
                if( $( window ).width() - 40 - (talks.first().outerWidth()+10) <= 1280) {
                    container.height($('iframe', container).width() * 720/1280);
                    nextHeight = ($('iframe', container).width()- talks.first().outerWidth()+10) * 720/1280;
                }else nextHeight = 720;

                talk.css("max-height", nextHeight);

                var pos = 0;
                if(typeof container[0].tl === 'undefined') {
                    container[0].tl = new TimelineMax();
                    container[0].tl.pause()
                    .to(talk, 0.4, {maxWidth: talks.first().outerWidth()+10, delay:1})
                    .to(container, 0.4, {height: nextHeight}, 1)
                    .to($(talks[0]), 0.4, {maxHeight:150, delay:0.2})
                    .to($(talks[p()]), 0.4, {maxHeight:150, delay:1})
                    .addLabel("start")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=0.5")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=3")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=5")
                    // explication
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=8")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=11")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=14")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=18")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=22")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=26")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=31")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=36")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=42")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=46")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=52")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=58")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=65")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=72")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=76")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=82")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=88")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=95")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=110")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=116")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=122")
                    ;

                }

                function p() {
                    pos = pos +1;
                    return pos;
                }

                container.removeClass('loading');
                container[0].tl.tweenFromTo(0,"start");
            }

            function onPlayerStateChange(event) {

                if (event.data == YT.PlayerState.PLAYING) {
                    container[0].tl.play();
                    widget.pause();
                }
                else if (event.data == YT.PlayerState.PAUSED) {
                    container[0].tl.pause();
                    if($('[href^="#son"]', nav).hasClass('active')) {
                        widget.play();
                    }
                }
            }
        }




    </script>

       
</section>