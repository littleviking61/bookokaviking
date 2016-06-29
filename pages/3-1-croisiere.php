<section class="section" data-anchor="<?= $anchor ?>" data-background="bg-bateau.jpg" data-play="5">
    <div class="player-youtube flex-column loading">
       <div class="player-container"><div id="playerBoat"></div></div>
    </div>

    <script>
        var playerYTtoboat = undefined;
        function f_3_1_croisiere(section, anchorLink){
            var 
                container = $('.player-youtube', section);
                // talk = $('.talks-container', container),
                // talks = $('> .talks > .talk', talk);

            if(playerYTtoboat === undefined) playerYTtoboat = new YT.Player('playerBoat', {
                width: 1280,
                height: 720,
                videoId: 'lrYWv63RTME',
                playerVars:{
                    //'controls': 0,
                    //'showinfo': 0
                },
                events: {
                   'onReady': onPlayerReady,
                  // 'onStateChange': onPlayerStateChange,
                  // 'onError': onPlayerError
                }
            });

            function onPlayerReady(event) {
                playerYT.push(playerYTtoboat);

                $allVideos.push($('iframe', container).get(0));
                
                container.removeClass('loading');
            }

           
        }


    </script>

</section>