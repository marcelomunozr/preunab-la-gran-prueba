<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-id="<?=$question['Questions']['id']?>" data-numpregunta="<?=$ct?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">
        <h3 class="title azul-claro pregunta-title">
             PREGUNTA <?=$ct?>
        </h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>
    </div>

    <div class="options">
		<? 
            $is_correct_v = $question['options'][0]['Options']['option'] == 'V' ? 1 : 0;
            $is_correct_f = $question['options'][0]['Options']['option'] == 'F' ? 1 : 0;
		?>
        <a href="#" class="alternativa" data-is="<?=$is_correct_v?>">Verdadero</a>        
        <a href="#" class="alternativa" data-is="<?=$is_correct_f?>">Falso</a>
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
	        <div class="the-question-line"></div>
		<?php } ?>
        
        <a href="#" class="pregunta-listo">
            LISTO &gt;
        </a>
    </div>
</div>