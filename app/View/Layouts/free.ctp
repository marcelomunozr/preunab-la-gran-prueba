<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>La Gran Prueba</title>
        <meta name="description" content="">
        <link rel="shortcut icon" href="favicon.png" type="image/png" />
        <meta name="viewport" content="width=device-width">
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
    </head>
    <body>
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
        <script>
        $(function() {
			$('#modalResultado').modal('show');
		}
		</script>
        <div class="columna-menu">
            <?= $this->element('controls/side-menu'); ?>
        </div>
        <div class="bg-principal transitions">
        	<div class="contenedor">
            	<ul class="top-menu">
				    <li><a href="#" id="open-tutorial"><span class="acerca-de"></span>Acerca de La Gran Prueba</a></li>
				    <li><a href="#">Contacto</a></li>
				    <li><a href="#" data-toggle="modal" data-target="#modalResultado">Bases</a></li><!-- -->
				</ul>
				<div class="el-ranking">
				    <?= $this->element('controls/ranking'); ?>
				</div>
				<div id="contenido-juego">
					<header class="preguntas-top bg-azul">
						<h2 class="titulo-layout">La gran prueba <span class="amarillo">&nbsp;</span></h2>
					</header>
					<section class="preguntas">
						<div class="preguntas-content">
							<?php echo $this->fetch('content'); ?>
						</div>
						<div class="lateral-preguntas">
						    <ul class="comodines no-comodos">
						    	<li class="salir">
						    		<a href="#" class="to-home">Volver</a>
						    	</li>
						    </ul>
						</div>
					</section>
					<script>
						$(document).ready(function(){
							$('.bg-principal').removeAttr("style").removeClass('bg-preguntas').removeClass('bg-notifications');
							$('.bg-principal').addClass('bg-preguntas');
							$('.top-menu').hide();
							$('.el-ranking').hide();
						});
					</script>
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
    </body>
</html>