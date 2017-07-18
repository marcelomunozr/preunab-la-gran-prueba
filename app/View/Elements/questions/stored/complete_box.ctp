<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-numpregunta="<?=$ct?>" data-id="<?=$question['Questions']['id']?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">
        <h3 class="title azul-claro pregunta-title">PREGUNTA <?=$ct?></h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>       
    </div>

    <? if($question['Questions']['options']) { ?>
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
</div>