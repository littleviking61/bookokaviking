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
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="bg">
            <div class="active"></div>
            <div></div>
        </div>

        <main>
             <header class="banner no-cover section" role="banner" data-anchor="bienvenue" data-background="bg-intro.jpg">

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
                 <div class="arrow"></div>

             </header>
             <section class="section" data-anchor="remerciement">
                    
                <div class="text-center">
                    <img src="media/img/portrait.png" alt="Baptiste Régné">
                    <p>À vous tous qui m'avez aidé</p>
                    
                    <p>À mes parent<br>
                    À mes amis<br>
                    et tous ceux que j'ai rencontré sur la route</p>
                </div>

             </section>

            <?php include "pages/0-instruction.php"; ?>
            <?php include "pages/0-prologue.php"; ?>
            <?php include "pages/1-1-jirai-labas.php"; ?>
            <?php include "pages/1-2-cematin-la.php"; ?>


        </main>
        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>

        <!-- <script src="js/plugins.js"></script> -->
        <script src="js/vendor/audioplayer.min.js"></script>
        <script src="js/vendor/jquery.fullPage.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
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
