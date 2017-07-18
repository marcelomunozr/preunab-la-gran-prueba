<div class="questions-preview preview-<?=strtolower($question['type'])?>">

    <div class="question">
        <?=$question['question']?>
    </div>

    <? if($options) { ?>
    <div class="options">
        
        <?
        foreach($options as $option) {       
        ?>
        <div class="option" data-id="<?=$option['Options']['id']?>">
            <span class="pull-left"><?=$option['Options']['option']?></span>
            
            <?
            if($option['Options']['extra']) {
               
                $extras = json_decode($option['Options']['extra']) ;
               
                foreach ($extras as $extra) {
                    $value = isset($extra->OK) ? $extra->OK : $extra->NOT_OK;
                    ?>
                    <button type="button" class="pull-right btn btn-info" data-id="<?=$option['Options']['id']?>"><?=$value?></button>  
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
    
    $('.options button').click(function() {
        
        id = $(this).data('id');
        
        $('.options .option[data-id="'+ id + '"] button').removeClass('btn-success');
        $('.options .option[data-id="'+ id + '"] button').addClass('btn-info');
        
        if($(this).hasClass('btn-info')) {
            $(this).removeClass('btn-info');
        }
        
        $(this).addClass('btn-success');
        
    })        
    
</script>