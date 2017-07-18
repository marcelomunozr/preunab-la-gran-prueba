<script src="<?=$this->Html->url('/')?>js/questions-functions.js"></script>
<link href="<?=$this->Html->url('/')?>css/map-positions.css" rel="stylesheet" type="text/css">
<header class="preguntas-top bg-azul">
	<h2 class="titulo-layout">La gran prueba <span class="color-fifi">&nbsp;</span><span class="puntos-en"><small>En esta materia:</small><i>400</i><small>pts.</small></span></h2>
</header>
<section class="preguntas">
	<div class="map-container">
		<div class="el-logo"></div>
		<div class="text-center">
		    <div class="materia-desafio">
		        <h2>MATEMÁTICAS</h2>               
		    </div>
		</div>
		<section class="mapa">
			<div class="mapa-content clearfix">
		        <div class="el-mapa">
		            <img class="img-mapa" src="images/mapas/matematicas.png">
		            <div class="thug">
		                <img src="<?= $this->Session->read('Session.Player.profile_pic') ?>" class="avatar map-avatar">
		            </div>
		        </div>
		        <div class="text-center">
		            <a href="#" class="btn-map rojo to-home"><i class="fa fa-chevron-left"></i>Volver</a>
		            <a href="#" class="btn-map btn-empezar">Empezar<i class="fa fa-chevron-right"></i></a>
		        </div>
			</div>
		</section>
	</div>
	<div class="preguntas-content" style="display:none;">
		<?php echo $this->fetch('content'); ?>
	</div>
	<div class="lateral-preguntas" style="display: none">
	<div class="pie degree">
        <span class="block"></span>
        <div id="timer"><span class="seconds">&nbsp;</span></div>
        <span id="time" style="display:none">0</span>
    </div>
	    <ul class="comodines">
	    	<li class="sin-usar">
	    		<a href="#" class="comodin comodin-agranda" data-comodin="auto-responder">¡Agranda tu cerebro!</a>
	    	</li>
	    	<li class="sin-usar">
	    		<a href="#" class="comodin comodin-tiempo" data-comodin="more-time">¡Freeze!</a>
	    	</li>
	    	<li class="sin-usar">
	    		<a href="#" class="comodin comodin-saltar" data-comodin="change-question">¡Omite la pregunta!</a>
	    	</li>
	    	<li class="salir">
	    		<a href="#" class="to-home">Volver</a>
	    	</li>
	    </ul>
	</div>
</section>

<script src="<?=$this->Html->url('/')?>js/ProgressBar.js"></script>

<script>
	$(document).ready(function(){
		$('.bg-principal').removeAttr("style").removeClass('bg-preguntas').removeClass('bg-notifications');
		$('.bg-principal').addClass('bg-preguntas');
		$('.top-menu').hide();
		$('.el-ranking').hide();
	});
</script>
