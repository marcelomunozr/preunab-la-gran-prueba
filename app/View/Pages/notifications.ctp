<style>
	h5.azul{
		color: #08305c;
	}
</style>
<div class="las-no-leidas">
<?php
	if(count($notificaciones['NoLeidas']) <= 0){
		echo '<h5 class="azul">No tienes nuevas notificaciones</h5>';
	}else{ 
		foreach($notificaciones['NoLeidas'] as $notificacion){
			if($notificacion['issue'] == 'CHALLENGE'){
				$sichallenge = ($notificacion['challenge_id'] != null) ? 'data-challenge="'.$notificacion['challenge_id'].'"' : '';
			}else{
				$sichallenge = '';
			}
			echo '
			<div class="la-notificacion" data-id="'.$notificacion['id'].'" data-type="'.$notificacion['issue'].'" '.$sichallenge.'>
				<div class="col-xs-11">
					<p>'.$notificacion['text'].'</p>
					<p><small>Generado el '.date('d-m-Y', strtotime($notificacion['date_created'])).' a las '.date('H:i:s', strtotime($notificacion['date_created'])).'</small></p>
				</div>
				<div class="col-xs-1 text-center"><i class="fa fa-caret-right"></i></div>
				<div class="clearfix"></div>
			</div>';
		}
	}
?>
</div>
<div class="las-leidas">
	<h4 class="text-center">notificaciones leídas</h4>
	<div class="contenedor-leidas">
<?php
	if(count($notificaciones['Leidas']) <= 0){
		echo '<h5 class="azul">No tienes notificaciones leidas</h5>';
	}else{
		foreach($notificaciones['Leidas'] as $notificacion){
			echo '
			<div class="la-notificacion">
				<div class="col-xs-11">
					<p>'.$notificacion['text'].'</p>
					<p><small>Generado el '.date('d-m-Y', strtotime($notificacion['date_created'])).' a las '.date('H:i:s', strtotime($notificacion['date_created'])).'</small></p>
				</div>
				<div class="col-xs-1 text-center"><i class="fa fa-caret-right"></i></div>
				<div class="clearfix"></div>
			</div>';
		}
	}
?>
	</div>
</div>
<script>
	$('body').off('click', '.la-notificacion').on('click', '.la-notificacion', function(e){
		e.preventDefault();
		var tipo = $(this).data('type');
		var notification = $(this);
		switch(tipo) {
			case 'CHALLENGE':
				var data = {challenge_id : $(this).data('challenge')};
				loadScene('pages/challengeScreen', data);
				break;
			case 'NOTIFICATION':
				var data = {notification_id : $(this).data('id')};
				$.post('/markNotificationAsRead', data, function(response){
					if(response.exito == 1){
						$(notification).hide(0, function(){
							$('.contenedor-leidas').html(response.notifications);
						});
					}
				});
				break;
			default:
				break;
		}
	});
	
</script>