<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-numpregunta="<?=$ct?>" data-id="<?=$question['Questions']['id']?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">
        <h3 class="title azul-claro pregunta-title">
            PREGUNTA <?=$ct?>
        </h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>       
    </div>

    <? if($question['options']) { ?>
    <div class="boxes">
        <?
        foreach($question['options'] as $option) {   
            
            if($option['Options']['extra']) {               
                $extras  = json_decode($option['Options']['extra']);
                $correct = '';
                foreach($extras as $extra) {                
                    $correct = isset($extra->OK) ? $extra->OK : $correct;                
                }
            }
        ?>
        <div class="box pull-left left-box"><?=$option['Options']['option']?></div>      
        <img src="/img/box_arrow_right.png" class="arrow  pull-left center-arrow" />
        <div class="box-response pull-left right-box" data-is="<?=$correct?>">&nbsp;</div> 
        
        <div class="clearfix"></div>
        <?
        }      
        ?>
    </div>
    <? } ?>  
    
    <? if($extras) { ?>
    <div class="options">
        <?
        foreach($extras as $extra) {               
            $value = isset($extra->OK) ? $extra->OK : $extra->NOT_OK;                     
        ?>
        <a href="#" class="alternativa"><?=$value?></a>        
        <?
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