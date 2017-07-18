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
