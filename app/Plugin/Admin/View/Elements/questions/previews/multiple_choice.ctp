<div class="questions-preview preview-<?=strtolower($question['type'])?>">

    <div class="question">
        <?=$question['question']?>
    </div>

    <? if($options) { ?>
    <div class="options">
        <?
        foreach($options as $option) {       
        ?>
            <button type="button" class="btn btn-info"><?=$option['Options']['option']?></button>        
        <?    
        }
    ?>    
    </div>
    <? } ?>  

</div>

<script>
    
    $('.options button').click(function() {
        
        if($(this).hasClass('btn-success')) {        
            $(this).removeClass('btn-success');
            $(this).addClass('btn-info');
        } else {
            $(this).addClass('btn-success');
            $(this).removeClass('btn-info');
        }
    })       
    
</script>