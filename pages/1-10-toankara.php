 <section class="section" data-anchor="<?= $anchor ?>" data-background="#000">
        <div class="player-youtube flex-column loading">
            <div class="player-container"><div id="playerAnkara"></div></div>
            <div class="talks-container">
                <div class="title"><h4>De Rennes à Ankara</h4><small>Vidéo commentée</small></div>
                <div class="talks">
                    <div class="talk"><small>L'aventurier viking : </small><p>Bonjour c'est l'aventurier viking. Je vais vous commenter cette vidéo en live</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Vous avez juste à cliquer sur lecture !</p></div>
                    <div class="talk"><small>Cigalou : </small><p>C'est quoi ce truc de fou ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>C'est un outils fait maison alors si ça vous plait dites le moi.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Et soyez sympa, c'est ma première vidéo du voyage :p</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Les premières images c'est la Croatie, juste après mon accident.</p></div>
                    <div class="talk"><small>Elsa : </small><p>C'est ou cette cascade ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Krka National Park, c'est magnifique !</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Après je vais prendre mon temps sur la côte sud de la Croatie jusqu'au Monténégro.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Histoire de reprendre confiance tout en continuant ma route vers la Turquie.</p></div>
                    <div class="talk"><small>Cigalou : </small><p>C'est les suisses dont tu nous parles dans la vidéo juste avant ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Oui, on est parti s'amuser dans les montagnes. Tu vas voir c'était mythique !</p></div>
                    <div class="talk"><small>Cigalou : </small><p>Oula, fallait pas avoir le vertige :) </p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>C'est sur et c'est pas fini, on a eu le droit à un belle orage pour redescendre !</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Après ça va très vite, j'ai perdu des vidéos mais en gros j'ai traversé l'Albanie, la Macédoine, la Grêce pour arriver en Turquie à Ankara</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Si vous avez des questions envoyez-moi un mail ici <a href="mailto:baptiste.regne@gmail.com">baptiste.regne@gmail.com</a> avec la position et je l'ajouterai peut-être !</p></div>
                </div>
            </div>
        </div>

    <script>
        var playerYTtoankara = undefined;
        function f_1_10_toankara(section, anchorLink){
            var 
                container = $('.player-youtube', section),
                talk = $('.talks-container', container),
                talks = $('> .talks > .talk', talk);

            if(playerYTtoankara === undefined) playerYTtoankara = new YT.Player('playerAnkara', {
                width: 1280,
                height: 720,
                videoId: 'eoJWFPmth_s',
                playerVars:{
                    'controls': 0,
                    'showinfo': 0
                },
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange,
                  // 'onError': onPlayerError
                }
            });

            function onPlayerReady(event) {
                playerYT.push(playerYTtoankara);
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
                    .to($(talks[0]), 0.4, {maxHeight:150, delay:0.5})
                    .to($(talks[p()]), 0.4, {maxHeight:150, delay:2})
                    .addLabel("start")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=0.5")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=2")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=5")
                    // explication
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=10")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=22")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=24")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=29")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=33")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=64")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=67")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=80")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=86")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=94")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=115")
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
                }
                else if (event.data == YT.PlayerState.PAUSED) {
                    container[0].tl.pause();
                }
            }
        }




    </script>

       
</section>