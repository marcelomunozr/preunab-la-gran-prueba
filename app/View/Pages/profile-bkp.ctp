<?php
	$guardadas = count($this->Session->read('Session.Player.StoredQuestion'));
?>

<div class="clearfix">
	<div class="col col-4-col">
		<div class="profile-box">
			<h4 class="profile-title">Matemáticas</h4>
			<div class="profile-medals">
				<img src="images/medal.png" alt="120 de Santa Rita. Elíjalo... por sus medallas." />
			</div>
			<h6><strong><?= $this->Session->read('Session.Player.points_math') ?></strong> puntos</h6>
			<h6>Round <?= $this->Session->read('Session.Player.round_math') ?>  </h6>
		</div>
	</div>
	<div class="col col-4-col">
		<div class="profile-box">
			<h4 class="profile-title">Lenguaje</h4>
			<div class="profile-medals">
				<img src="images/medal.png" alt="120 de Santa Rita. Elíjalo... por sus medallas." />
			</div>
			<h6><strong><?= $this->Session->read('Session.Player.points_language') ?></strong> puntos</h6>
			<h6>Round <?= $this->Session->read('Session.Player.round_language') ?>  </h6>
		</div>
	</div>
	<div class="col col-4-col">
		<div class="profile-box">
			<h4 class="profile-title">Historia</h4>
			<div class="profile-medals">
				<img src="images/medal.png" alt="120 de Santa Rita. Elíjalo... por sus medallas." />
			</div>
			<h6><strong><?= $this->Session->read('Session.Player.points_history') ?></strong> puntos</h6>
			<h6>Round <?= $this->Session->read('Session.Player.round_history') ?> </h6>
		</div>
	</div>
	<div class="col col-4-col">
		<div class="profile-box">
			<h4 class="profile-title">Ciencias</h4>
			<div class="profile-medals">
				<img src="images/medal.png" alt="120 de Santa Rita. Elíjalo... por sus medallas." />
			</div>
			<h6><strong><?= $this->Session->read('Session.Player.points_science') ?></strong> puntos</h6>
			<h6>Round <?= $this->Session->read('Session.Player.round_science') ?> </h6>
		</div>
	</div>
</div>
<h4 class="subttl"><strong>"Notificaciones"</strong></h4>
<div class="clearfix">
	<?php 
	if(count($notificaciones['activas']) >= 1){
		echo '<ul class="notifica-list">';	
		foreach($notificaciones['activas'] as $notificacion){
			echo '<li><a href="#">'.$notificacion['Notification']['text'].'<i class="fa fa-chevron-right"></i></a></li>';
		}
		echo '</ul>';
	}else{
		echo '<h3>No tienes notificaciones nuevas</h3>'; 
	} ?>
</div>
<h4 class="subttl"><strong>Preguntas "Peludas" </strong> Has guardado <strong><?= count($storedQuestions); ?> de 10</strong> preguntas <?php if(count($storedQuestions)>0){ ?> <a href="#" class="pull-right challenge-selector">HAZ UN DESAFÍO <i class="fa fa-chevron-right"></i></a><?php } ?></h4>
<div class="clearfix">
	<?php
		if(count($storedQuestions) > 0){
			foreach($storedQuestions as $id=>$pregunta){
				if($id == 0 || $id == 5){
					echo '<div class="col col-2-col"><ul class="peluda-list">';
				}
				echo '<li class="li-pregunta" data-id="'.$pregunta['question_id'].'">
						<a href="#"> 
							<span class="peluda-category">'.$pregunta['category'].'</span>
							Pregunta ID '.$pregunta['question_id'].' / Round '.$pregunta['round'].'
							<i class="fa fa-chevron-right"></i>
						</a>
					</li>';
				if($id == 4 || $id == count($storedQuestions) -1 ){
					echo '</ul></div>';
				}
			}
		}
	?>
</div>

</div>
<script>
	$('body').on('change', '#SelectorRegion', function(e){
    	e.preventDefault();
    	var id_region = $(this).val();
    	$.get('/updateCiudades', {id_region : id_region}, function(response){
    		$('#SelectorCiudad').html(response);
    	});
    });
    $('body').off('click', '.delete-question').on('click', '.delete-question', function(e){
    	e.preventDefault();
    	var id_guardada = $(this).parents('.li-pregunta').data('id');
    	$.post('/players/deleteQuestion', {id_guardada: id_guardada}, function(response){
    		
    	});
    });
    $('body').on('click', '.challenge-selector', function(e){
    	e.preventDefault();
    	loadScene('challengeSelector');
    });
</script>