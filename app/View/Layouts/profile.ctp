<header class="preguntas-top bg-azul">
	<h2 class="titulo-layout">Tu Perfil <span class="amarillo">&nbsp;</span></h2>
</header>
<section class="profile">
	<div class="profile-content">
		<?php echo $this->fetch('content'); ?>
	</div>
</section>
<script>
	$('.bg-principal').removeAttr("style").removeClass('bg-preguntas').removeClass('bg-notifications');
	$('.bg-principal').addClass('bg-preguntas');
	$('.top-menu').hide();
	$('.el-ranking').hide();
</script>