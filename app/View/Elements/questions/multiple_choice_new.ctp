<div id="pregunta-<?= $ct ?>" data-id="<?= $question['Questions']['id']?>" style="<?= ($ct==1) ? '':'';?>">
	<h3 class="title azul-claro pregunta-title">
		PREGUNTA <?=$ct?>
    </h3>
    <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
	<div class="pregunta">
		<?= $question['Questions']['question']?>
	</div>
	<div class="alternativas">
		<?php foreach($question['options'] as $opcion){
			echo '<a href="#" class="alternativa" data-idopcion="'.$opcion['Options']['id'].'" >'.$opcion['Options']['option'].'</a>';
		} ?>
	</div>
    <div class="text-center botones-preguntas">
		<?php if(isset($desafio) && $desafio != 1){ ?>
	        <?php if($question['Questions']['stored'] == 1){ ?>
	            <a href="#" class="btn-guardar-pregunta guardada" data-idpregunta="<?=$question['Questions']['id']?>">
	                <i class="icon-guardar-pregunta-guardada"></i> <span>Pregunta guardada</span>
	            </a>
	        <?php }else{ ?>
	            <a href="#" class="btn-guardar-pregunta" data-idpregunta="<?=$question['Questions']['id']?>">
	                <i class="icon-guardar-pregunta"></i> <span>Guardar esta pregunta</span>
	            </a>
	        <?php }?>
		<?php } ?>

        <div class="the-question-line"></div>
		<a href="#" class="pregunta-listo">
			LISTO &gt;
		</a>
	</div>
</div>