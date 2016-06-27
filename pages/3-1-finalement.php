 <section class="section" data-anchor="<?= $anchor ?>" data-background="bg-bateau.jpg">
    <div class="slide">
    	<div class="slide-content">
	    	<div class="container small" style="background-color: rgba(17, 12, 8, .7);">
	        <header>
	            <h2>Et finalement</h2>
	            <div class="stamp">
	                <span><i class="icon-cloud"></i> Souvenir</span>
	                <span><i class="icon-marker"></i> Port d'Alat, Azeraïdjan</span>
	                <span><i class="icon-clock"></i> juin 2015</span>
	            </div>
	            <div class="icon-cancel"></div>
	        </header>
	        <div class="content column">
	            <p>Le jour même de mon expulsion, juste après être sortie du bureau j'appelle et on m'annonce qu'il y a un bateau qui part le soir pour Aktau au Kazakhstan.
	            <p>Wouhouuuuuu !</p>
	            <p>Au port je rencontre Emma, elle est partie d'angleterre et souhaite rejoindre le Kirgizstan avec son Vespa. Nous partagerons la cabine dans le bateau pendant deux nuits. Je vous épargne les invitations douteuse qu'elle a recu du capitaine et de toute la joyeuse bande de marin</p>
	            <p>Moi j'étais au ange, j'avais enfin quitter ce pays.</p>
	        </div>
	    	</div>
    	</div>
		</div>
	
		<div class="slide">
			<div class="slide-content">
				<div class="player-youtube flex-column loading">
		        <div class="player-container"><div id="playerBoat"></div></div>
		    </div>
	    </div>
		</div>

    <script>
        var playerYTtoboat = undefined;
        function f_3_1_finalement(section, anchorLink){
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