<ul class="nav-perfil">
	<li class="zindex2 to-profile"><h3><a href="#">modificar datos</a></h3></li>
	<li class="zindex3 to-challenge"><h3><a href="#">desafiar a un amigo</a></h3></li>
	<li class="active zindex4 to-brigidas"><h3><a href="#">preguntas brigidas</a></h3></li>
</ul>
<div class="profile-container">
	<div class="el-perfil brigido">
		<div class="row">
			<div class="col-4">
				<div class="skewOut">
                    <div class="el-postit brigido sin-bg">
                        <p>Guarda <strong>10 Preguntas Brigidas</strong> y desafía a tus amigos para obtener más puntos. </p>
                    </div>
                    <div class="la-linea brigida"></div>
                    <div class="el-postit brigido">
                        <p>Has guardado <strong><span id=""><?= count($storedQuestions); ?></span> de 10</strong><br> preguntas.</p>
                    </div>
                    <div class="air-10"></div>
                    <div class="txt-center"><?php if(count($storedQuestions) < 10){ echo '<h3>Necesitas guardar 10 preguntas para desafiar</h3>'; }else{?><a href="#" class="el-btn to-challenge">Desafía aquí<i class="fa fa-chevron-right"></i></a><?php } ?></div>
				</div>
			</div>
			<div class="col-4">
				<div class="skewOut">
					<?php 
						for($i = 0; $i<=4; $i++){
							if($i >= count($storedQuestions)){
								break;
							}
							echo '<div class="wrap">
							<h3>'.$storedQuestions[$i]['category'].'</h3>
                        	<a href="#" class="li-pregunta" data-id="'.$storedQuestions[$i]['question_id'].'">Pregunta ID '.$storedQuestions[$i]['question_id'].' / Round '.$storedQuestions[$i]['round'].'</a>
						</div>
						<div class="la-linea"></div>';
							
						} 
					?>
				</div>
			</div>
			<div class="col-4">
				<div class="air-4"></div>
				<div class="skewOut">
                    <?php 
						for($i = 5; $i<=10; $i++){
							if($i >= count($storedQuestions)){
								break;
							}
							echo '<div class="wrap">
							<h3>'.$storedQuestions[$i]['category'].'</h3>
                        	<a href="#" class="li-pregunta" data-id="'.$storedQuestions[$i]['question_id'].'">Pregunta ID '.$storedQuestions[$i]['question_id'].' / Round '.$storedQuestions[$i]['round'].'</a>
						</div>
						<div class="la-linea"></div>';
							
						} 
					?>
				</div>
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="el-clip"></div>
</div>
<script>
	$('body').off('click', '.delete-question').on('click', '.delete-question', function(e){
    	e.preventDefault();
    	var id_guardada = $(this).parents('.li-pregunta').data('id');
    	$.post('/players/deleteQuestion', {id_guardada: id_guardada}, function(response){
    	});
    });
</script>