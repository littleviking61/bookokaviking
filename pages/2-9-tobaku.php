 <section class="section" data-anchor="<?= $anchor ?>" data-background="#000">
        <div class="player-youtube flex-column loading">
            <div class="player-container"><div id="playerBaku"></div></div>
            <div class="talks-container">
                <div class="title"><h4>De Ankara à Baku</h4><small>Vidéo commentée</small></div>
                <div class="talks">
                    <div class="talk"><small>L'aventurier viking : </small><p>Bonjour c'est l'aventurier viking. Voici la deuxième vidéo commentée du voyage</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Vous avez juste à cliquer sur lecture !</p></div>
                    <div class="talk"><small>Le motarologue : </small><p>C'est trop naze ton truc !</p></div>
                    <div class="talk"><small>Cigalou : </small><p>Ouai c'est clair c'est à chier</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Merci les gars :p</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Bon alors, les premières images c'est sur un château sur une colline à Ankara.</p></div>
                    <div class="talk"><small>Adrian : </small><p>Je rêve d'aller en Cappadoce, c'était bien ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Trop beau, en plus je me suis bien amusé dans les chemins !</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Bon par contre y avait de l'orage dans l'air</p></div>
                    <div class="talk"><small>Dom : </small><p>Oh punaise je me rappelle de cette belle descente pavée.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Ouai, je suis passé vite fait, j'avais une averse au fesse.</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Après ça, j'ai tracé ma route vers Trabzon</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>C'était la période des élections alors il y avait des drapeaux partout !</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Là je suis arrivé en Georgie (la caméra a pas filmé entre les deux)</p></div>
                    <div class="talk"><small>Cigalou : </small><p>Et on a le droit de doubler sur les lignes droites là-bas ?</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Pff, je ne pense pas...</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Là je suis dans un bled trop beau dans le nord de la Georgie en attendant mon visa pour l'Azerbaïdjan</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>Puis tout d'un coup j'ai fait 600 bornes et je débarque à Baku, au bord de la mer Caspienne, pour l'ouverture des 1ers jeux européens (chez eux)</p></div>
                    <div class="talk"><small>Aliya : </small><p>;)</p></div>
                    <div class="talk"><small>L'aventurier viking : </small><p>A partir de ce moment-là, je vais attendre un bateau pour traverser la mer.</p></div>
                </div>
            </div>
        </div>

    <script>
        var playerYTtobaku = undefined;
        function f_2_9_tobaku(section, anchorLink){
            var 
                container = $('.player-youtube', section),
                talk = $('.talks-container', container),
                talks = $('> .talks > .talk', talk);

            if(playerYTtobaku === undefined) playerYTtobaku = new YT.Player('playerBaku', {
                width: 1280,
                height: 720,
                videoId: 'FpzWcsAZ92k',
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
                playerYT.push(playerYTtobaku);
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
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=16")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=22")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=30")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=36")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=43")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=49")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=53")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=61")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=63")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=66")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=70")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=76")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=80")
                    .to($(talks[p()]), 0.4, {maxHeight:150}, "start+=86")
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