<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Récits de voyage par l'aventurier viking</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<link rel="icon" type="image/png" href="favicon.png" />
		<link rel="stylesheet" href="css/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/style.css">

		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	<body>
		<?php 
			$anchor;
			$pages = [
				[ 'title' => 'Intro', 'parts' => [
						['Instruction','1-instruction'],
						['Remerciement','2-remerciement'],
						['Prologue','3-prologue'],
					]
				], [ 'title' => 'Avant Zagreb', 'parts' => [
						['J\'irai là-bas','1-jirailabas'],
						['Ce matin-là','2-cematinla'],
						['Hier','3-hier'],
						['Bon','4-bon'],
						['Pizza','5-pizza'],
						['Plitvice','6-plitvice'],
						['Reparti','7-reparti'],
						['Monténégro','8-montenegro'],
						['Albanie','9-albanie'],
						['De Rennes à Ankara','10-toankara'],
					]
				]
			]
		?>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<header class="main">
			<hgroup>
				<div class="container">
					<h2 class="page-description">Récits de voyages par</h2>
					<h1 class="page-title">L'aventurier viking</h1>
				</div>
			</hgroup>

			<nav class="main">
			    <ul>
						<li class="arrow up unactive" data-fp-action="moveSectionUp"></li><!--
         --><li><a href="#close" title="Réouvrir au livre" ><i class="icon-cancel"></i></a></li><!--
         --><li><a href="#menu" title="Afficher les chapitres" ><i class="icon-bookmark"></i></a></li><!--
		     --><li><a href="#map" title="Voir la carte" ><i class="icon-map"></i></a></li><!--
		     --><li><a href="#love" title="S'abonner ou laisser un commentaire" ><i class="icon-heart"></i></a></li><!--
		     --><li><a href="#son" title="Gérer la musique" class=""><i class="icon-volume-1"></i></a></li>
			    </ul>
			</nav>
			
			<nav class="chapitres">
			    <?php 
			    	$chap = 0;
			    	foreach ($pages as $chapitre) {
			    		echo '<ul class="chap-'.$chap.'">';
			    		foreach ($chapitre['parts'] as $page){
			    			echo '<li><a href="#'.$chap.'-'.$page[1].'" title="'.$page[0].'">'.$page[0].'</a></li>';
			    		}
			    		echo '</ul>';
			    		$chap++;
			    	}
			    ?>
			</nav>

			<nav class="player-soundcloud">
				<ul class="controls">
					<li><a href="https://soundcloud.com/littleviking/sets/bande-son-livre-num-rique" target="new" id="soundcloud" title="Voir la playlist sur SoundCloud"><i class="icon-soundcloud"></i></a></li>
					<li><a href="#" class="active" id="auto" title="Désactiver le changement de musique au chargement d'une page"><i class="icon-bolt"></i></a></li>
					<!-- <li><a href="#" id="prev"><i class="icon-to-start"></i></a></li> -->
					<li><a href="#" id="play"><i class="icon-play"></i></a></li>
					<li><a href="#" id="pause"><i class="icon-pause"></i></a></li>
					<li><a href="#" id="next"><i class="icon-to-end"></i></a></li>
				</ul>
				<ul class="list-sounds"></ul>
			</nav>

			<div class="soundcloud-player">
				<iframe id="soundcloud-player-iframe" width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/162339580&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>
			</div>

		</header>

		<div class="bg">
			<div class="image active data-adaptive-background data-ab-css-background"></div>
			<div class="image data-adaptive-background data-ab-css-background"></div>
		</div>

		<main>
			<div class="sections">
				<section class="banner no-cover section" role="banner" data-anchor="bienvenue" data-background="bg-intro.jpg">

					<div class="viking">
						<img src="img/viking-yak.svg">
					</div>
					<div class="header-inner">
						<hgroup>
							<div class="container">
								<h2 class="page-description">Récits de voyages par</h2>
								<h1 class="page-title">
									L'aventurier viking            
								</h1>
							</div>
						</hgroup>
					</div>
					<div class="clear-intro"></div>

				</section>

				<?php 
					$chap = 0;
					foreach ($pages as $chapitre) {
						foreach ($chapitre['parts'] as $page){
							$open = "pages/".$chap."-".$page[1].".php";
							$anchor = $chap."-".$page[1];
							include $open;
						}
						$chap++;
					}
				?>

				<section class="section social" data-anchor="love" data-background="bg-intro.jpg" data-play="12">
					<?php include('social.php') ?>
				</section>
				
				<footer class="main section fp-auto-height"  data-anchor="merci">
					<div class="flex-column-center-middle">Livre numérique réalisé par&nbsp;<a href="http://www.nuagegraphik.com" target="new">Nuagegraphik</a>&nbsp;- © 2015 - Baptiste Régné - Tous droits réservés</div>
				</footer>
			</div>
			<div class="arrow down loading active" data-fp-action="moveSectionDown"></div>
		</main>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>
		
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="https://w.soundcloud.com/player/api.js" type="text/javascript"></script>
		<script src="https://www.youtube.com/iframe_api" type="text/javascript"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
		
		<?php if ($_SERVER['SERVER_NAME'] === "livre.laventurierviking.fr"): ?>
			<script src="js/vendor/plugins.min.js"></script>
			<script src="js/main.min.js"></script>
		<?php else: ?>
			<!-- <script src="js/vendor/TweenMax.js"></script> -->
			<script src="js/vendor/audioplayer.js"></script>
			<script src="js/vendor/jquery.slimscroll.js"></script>
			<script src="js/vendor/jquery.fullPage.js"></script>
			<script src="js/vendor/jquery.vide.js"></script>
			<script src="js/vendor/jquery.cookie.js"></script>			
			<script src="js/vendor/sweetalert.js"></script>			
			<script src="js/main.js"></script>
		<?php endif ?>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>

			if(window.location.origin === "http://livre.laventurierviking.fr") {
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-69882311-1', 'auto');
			  ga('send', 'pageview');

			  var analytics = true;
			}

		</script>
	</body>
</html>
