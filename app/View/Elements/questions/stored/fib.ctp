<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-numpregunta="<?=$ct?>" data-id="<?=$question['Questions']['id']?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">  
        <h3 class="title azul-claro pregunta-title">PREGUNTA <?=$ct?></h3>
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
</div>
