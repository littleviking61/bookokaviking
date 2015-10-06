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

		<link href="https://fontastic.s3.amazonaws.com/M53bjwByAnWQumjz3YuaEf/icons.css" rel="stylesheet">
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
						['Plitvice','6-plitvice']
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
			        <li><a href="#close" title="Réouvrir au livre" ><i class="icon-cancel"></i></a></li><!--
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
					<li><a href="#" id="prev"><i class="icon-to-start"></i></a></li>
					<li><a href="#" id="play"><i class="icon-play"></i></a></li>
					<li><a href="#" id="pause"><i class="icon-pause"></i></a></li>
					<li><a href="#" id="next"><i class="icon-to-end"></i></a></li>
				</ul>
				<ul class="list-sounds"></ul>
			</nav>
			<!-- <iframe id="sc-widget" src="https://w.soundcloud.com/player/?url=" width="100%" height="465" scrolling="no" frameborder="no" style="display: none;"></iframe> -->
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
								<!-- <p><input type="checkbox" name="instructions" id=""> <small>Passer les instructions</small></p> -->
							</div>
						</hgroup>
					</div>
					<div class="arrow" data-fp-action="moveSectionDown">
						<!-- <p>Commencer la lecture</p> -->
					</div>

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
				<footer class="main section fp-auto-height" data-anchor="inscription">
					<div>
						<h3>Vous avez aimez ?</h3>
						<p>Ce livre n'est pas fini et j'y ajouterai du contenu de facon hebdomadaire. En vous inscrivant à cette newsletter vous recevrais un mail à chaque fois que j'ajouterai un nouvelle page. Vous pouvez aussi me suivre sur Facebook ou Twitter. Merci !</p>
						<button>S'inscrire à la newsletter</button>
					</div>
					<div>
						<h3>Vous avez un commentaire à faire</h3>
						<p>N'hésitez pas, ce contenu est complétement amateur et expirimentale. L'idée principale est simplement de partager mon aventure et mon expérience. Noté simplement que je ne suis pas un professionnel du son, de la vidéo ou du cinéma, je suis juste un webdesigner un brin aventurier et j'essaye de faire au mieux !</p>
						<button>Laisser un commentaire</button>
					</div>
				</footer>
			</div>
		</main>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>

		<!-- <script src="js/plugins.js"></script> -->
		<script src="js/vendor/audioplayer.min.js"></script>
		<!-- <script src="https://w.soundcloud.com/player/api.js" type="text/javascript"></script> -->
		<script src="js/vendor/jquery.slimscroll.min.js"></script>
		<script src="js/vendor/jquery.fullPage.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
		<script src="js/vendor/jquery.vide.min.js"></script>
		<script src="js/vendor/vex.combined.min.js"></script>
		<script src="js/vendor/jquery.cookie.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="js/main.js"></script>

		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X','auto');ga('send','pageview');
		</script>
	</body>
</html>
