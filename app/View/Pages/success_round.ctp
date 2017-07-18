<script>
	$('.columna-menu').load('/refreshSidebar');
</script>
<div class="finished-wrapper clearfix">
	<div class="cara cara-<?=$category?>-bien"></div>
	<div class="finished-content">
		<h2 class="negro">¡Al fin! Pasaste al siguiente round.</h2>
		<p class="azul">Puntos totales: <strong><?= $this->Session->read('Session.Player.points'); ?> pts</strong></p>
		<p>
			<a href="#" class="btn-fb btn-comparte"><i class="fa fa-facebook"></i> Comparte</a> y obtén 50 pts. más
		</p>
		<div class="finished-content-bottom">
			<a href="#" class="btn-salir pull-left to-home"  ><i class="fa fa-chevron-left"></i> Salir</a>
			<a href="#" class="btn-continuar pull-right" data-personaje="<?=$personaje?>"><i class="fa fa-chevron-right"></i>
Continuar</a>
		</div>
	</div>
</div>
<div class="bg-success"></div>