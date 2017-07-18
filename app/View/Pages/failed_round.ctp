<script>
	$('.columna-menu').load('/refreshSidebar');
	$('.animate1').animate({marginTop: '+=20px', opacity: '1'});
    $('.animate2').delay(400).animate({marginTop: '+=20px', opacity: '1'});
    $('.animate3').delay(600).animate({marginTop: '+=0', opacity: '1'});
    $('.animate4').delay(800).animate({marginTop: '+=40px', opacity: '1'});
    $('.animate5').delay(1000).animate({marginTop: '+=70px', opacity: '1'});
    $('.animate6').delay(1200).animate({marginTop: '+=80px', opacity: '1'});
    $('.animate7').delay(1400).animate({marginTop: '+=50px', opacity: '1'});
    $('.animate8').delay(1600).animate({marginTop: '+=80px', opacity: '1'});
    $(".info").hover(function(){
        $(".overlay-info").fadeIn(300);
    })
    $(".info").mouseleave(function(){
        $(".overlay-info").fadeOut(300);
    })
</script>
<style>
	.bg-fail{
		z-index: -1;
	}
</style>
<div class="finished-wrapper clearfix">
	<div class="cara cara-<?=$category?>-mal"></div>
	<div class="finished-content">
		<?php
			switch ($causa) {
				case 'NO LIVES':
					echo '<h2 class="negro">¡No tienes vidas!.</h2>';
					echo '<p class="azul">Tienes que esperar a que te demos mas vidas para seguir jugando<strong></strong></p>';
					echo '<p><a href="#" class="btn-fb losers-share"><i class="fa fa-facebook"></i> Comparte</a> obtendras 1 vida para seguir</p>';
					break;
				case 'FAILED':
					echo '<h2 class="negro">¡Te Equivocaste!.</h2>';
					echo '<p class="azul">La respuesta estaba incorrecta<strong></strong></p>';
					break;
				case 'TIME OVER':
					echo '<h2 class="negro">¡Te quedaste sin tiempo!.</h2>';
					echo '<p class="azul">Te demoraste mucho y se acabo la ronda, recuerda que solo tienes <strong>7 Minutos</strong> para responder las preguntas</p>';
					break;
				default:
					break;
			}
		?>
		
		<div class="finished-content-bottom">
			<?php if($causa != 'NO LIVES'){ ?>
				<a href="#" class="btn-salir pull-left to-home"><i class="fa fa-chevron-left"></i> Salir</a>
				<a href="#" class="btn-continuar pull-right" data-personaje="<?=$personaje?>"><i class="fa fa-chevron-right" ></i>Continuar</a>
			<?php }else{ ?>
				<a href="#" class="btn-salir btn-block btn-center to-home"><i class="fa fa-chevron-left"></i> Salir</a>
			<?php } ?>
		</div>
	</div>
	<div class="bg-fail">
		<span>
		    <i class="fa animate1 fa-flash"></i>
		    <i class="fa animate2 fa-flash"></i>
		    <i class="fa animate3 fa-flash"></i>
		    <i class="fa animate4 fa-flash"></i>
		    <i class="fa animate5 fa-flash"></i>
		    <i class="fa animate6 fa-flash"></i>
		    <i class="fa animate7 fa-flash"></i>
		    <i class="fa animate8 fa-flash"></i>
		    <!--<i class="fa fa-bomb"></i>-->
		</span>
	</div>
</div>
