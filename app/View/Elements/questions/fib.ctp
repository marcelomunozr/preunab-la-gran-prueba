<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-numpregunta="<?=$ct?>" data-id="<?=$question['Questions']['id']?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">  
        <h3 class="title azul-claro pregunta-title">
             PREGUNTA <?=$ct?>
        </h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?       
        
        $replace      = array();
        $replace_with = array();
        
        if($question['options']) { 
            foreach($question['options'] as $option) {            
                $replace[] = '[['.$option['Options']['option'].']]';
                $replace_with[] = '<span class="blank" data-is="'.$option['Options']['option'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
            }                
        }
        
        $question_text = str_replace($replace, $replace_with, $question['Questions']['question']);
        
        echo $question_text;            
        ?>       
    </div>
    <? if($question['options']) { ?>
    <div class="options">
        <?
        $similarOptions = array();
        foreach($question['options'] as $option) {    
            if(!in_array($option['Options']['option'], $similarOptions)) {
        ?>
        <a href="#" class="alternativa" data-is="<?=$option['Options']['is_correct']?>"><?=$option['Options']['option']?></a>        
        <?
                $similarOptions[] = $option['Options']['option'];
            }            
        }      
        ?>
    </div>
    <? } ?>
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
