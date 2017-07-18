<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-id="<?=$question['Questions']['id']?>" data-numpregunta="<?=$ct?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt">
        <h3 class="title azul-claro pregunta-title">
        	<?php if($question['Questions']['stored'] == 1){ ?>
        		<a href="#" class="btn-guardar-pregunta guardada" data-idpregunta="<?=$question['Questions']['id']?>">
        		<i class="icon-guardar-pregunta"></i> Pregunta Guardada</a>
        	<?php }else{ ?>
        		<a href="#" class="btn-guardar-pregunta" data-idpregunta="<?=$question['Questions']['id']?>">
        		<i class="icon-guardar-pregunta"></i> Guardar Pregunta</a>
        	<?php }?>
             PREGUNTA <?=$ct?>
        </h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>
    </div>

    <? if($question['options']) { ?>
    <div class="options">
        
        <?
        foreach($question['options'] as $option) {       
        ?>
        <div class="option" data-id="<?=$option['Options']['id']?>">
            <span class="pull-left"><?=$option['Options']['option']?></span>
            
            <?
            if($option['Options']['extra']) {
               
                $extras = json_decode($option['Options']['extra']) ;
               
                foreach ($extras as $extra) {
                    $value = isset($extra->OK) ? $extra->OK : $extra->NOT_OK;
                    $is_correct = isset($extra->OK) ? 1 : 0;         
                    ?>
                    <button type="button" class="btn btn-info" data-id="<?=$option['Options']['id']?>"  data-is="<?=$is_correct?>"><?=$value?></button>  
            <?             
                }
            }?>            
            <div class="clearfix"></div>
        </div>
        <?
        }      
        ?>
    </div>
    <? } ?>  
</div>

<script>
    
    $('#question-<?=$ct?> .options button').click(function() {
        
        id = $(this).data('id');
        
        $('#question-<?=$ct?> .options .option[data-id="'+ id + '"] button').removeClass('btn-success');
        $('#question-<?=$ct?> .options .option[data-id="'+ id + '"] button').addClass('btn-info');
        
        if($(this).hasClass('btn-info')) {
            $(this).removeClass('btn-info');
        }
        
        $(this).addClass('btn-success');
        
    })        
    
</script>