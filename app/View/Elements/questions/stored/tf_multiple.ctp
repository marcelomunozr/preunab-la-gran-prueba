<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-id="<?=$question['Questions']['id']?>" data-numpregunta="<?=$ct?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">
        <h3 class="title azul-claro pregunta-title"> PREGUNTA <?=$ct?></h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>
    </div>
    <? if($question['options']) { ?>
    <div class="options">
         <?
        foreach($question['options'] as $option) {       
            
            $is_correct_v = $option['Options']['is_correct'] == 1 ? 1 : 0;
            $is_correct_f = $option['Options']['is_correct'] == 0 ? 1 : 0;
        ?>
        <div class="option" data-id="<?=$option['Options']['id']?>">
            <div class="option-text"><p><?=$option['Options']['option']?></p></div>
            <div class="clearfix"></div>
        </div>
        <?
        }      
        ?>
    </div>
    <? } ?>
</div>
