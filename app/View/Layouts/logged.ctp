<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>La Gran Prueba</title>
        <meta name="description" content="">
        <link rel="shortcut icon" href="favicon.png" type="image/png" />
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet" type="text/css">
        <script src="<?=$this->Html->url('/')?>js/jquery.min.js"></script>
        <script src="<?=$this->Html->url('/')?>js/functions.js"></script>
        <script src="<?=$this->Html->url('/')?>js/ion-sound/ion.sound.js"></script>
        <script src="<?=$this->Html->url('/')?>js/jquery.animateNumber.js"></script>
        <script src="<?=$this->Html->url('/')?>js/jquery.chrony.min.js"></script>
        <script src="<?=$this->Html->url('/')?>js/jquery.transit.min.js"></script>
        <script src="<?=$this->Html->url('/')?>	js/jquery.slotmachine.min.js"></script>
        <script src="<?=$this->Html->url('/')?>js/jquery.rut.min.js"></script>
        <script src="<?=$this->Html->url('/')?>bootstrap-3.3.4/js/bootstrap.min.js"></script>
        <link href="<?=$this->Html->url('/')?>bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=$this->Html->url('/')?>css/main.css" rel="stylesheet">
		<!--[if IE ]>
			<link href="<?=$this->Html->url('/')?>css/ie.css" rel="stylesheet">
		<![endif]-->
		<script>
			var timeout = function(seconds){
		    	window.eltimeout = true;
				$('#timer').chrony({
		            displayHours: false,
		            seconds: seconds,
		            finish: function() {
						restartLives();
		            }
		        });
		        $('.time-counter').show();
		        $('.lives').hide();
		        $('.points.points-general').hide();
		        $('.ranking.ranking-general').hide();

			}
		</script>

<script>
	$(document).ready(function(){
		/*MODAL*/
		$('#winnersModal').modal('show');
	});
</script>

    </head>
    <body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-J7JW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-J7JW');</script>
<!-- End Google Tag Manager -->    
    	<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '481530158619215',
					xfbml      : true,
					version    : 'v2.1'
				});
			};
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
        <div class="columna-menu">
            <?= $this->element('controls/side-menu'); ?>
        </div>
        <div class="bg-principal transitions">
        	<div class="contenedor">
            	<ul class="top-menu">
				    <li><a href="#" id="open-tutorial"><span class="acerca-de"></span>Acerca de La Gran Prueba</a></li>
				    <li><a href="mailto:contactos@lagranprueba.cl">Contacto</a></li>
				    <li><a href="<?=$this->Html->url('/')?>files/bases_preunab_2015.pdf" target="_blank">Bases</a></li><!-- -->
				</ul>
				<div class="el-ranking">
				    <?= $this->element('controls/ranking'); ?>
				</div>
				<div id="contenido-juego">
					<?php echo $this->fetch('content'); ?>
				</div>
            </div>
        </div>
		<div class="bg-loading bg-finished">
			<div class="finished-wrapper clearfix">
				<div class="el-logo"></div>
				<div class="finished-content">
					<div id="load-character" class="load-pitagoras"></div>
					<div class="load-frase">“Educa a los niños y no será necesario castigar a los hombres.“ <br> <strong>Pitágoras</strong></div>
				</div>
			</div>
			<div class="bg-success loading"></div>
		</div>
		<!-- MODAL CAMBIOS REALIZADOS-->
		<div class="overlay-changes">
			<div class="text-center">
				<div class="cambios-realizados">
					<h2>Cambios realizados</h2>
				</div>
			</div>
		</div>
		<?= $this->element('controls/modals'); ?>
		<!-- -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-2230421-10', {'cookieDomain': 'preunab.cl'});
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>    
    
    </body>
</html>