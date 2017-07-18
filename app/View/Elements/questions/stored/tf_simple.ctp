<div id="question-<?=$ct?>" class="question type-<?=strtolower($question['Questions']['type'])?>" data-id="<?=$question['Questions']['id']?>" data-numpregunta="<?=$ct?>" data-type="<?=strtolower($question['Questions']['type'])?>">
    <div class="question-prompt pregunta">
        <h3 class="title azul-claro pregunta-title"> PREGUNTA <?=$ct?> </h3>
        <h4 class="pregunta-id">ID: <?=$question['Questions']['id']?></h4>
        <?=$question['Questions']['question']?>
    </div>
</div>