<div class="questions-preview preview-<?=strtolower($question['type'])?>">

    <div class="question">  
        <?=$question['question']?>       
    </div>

    <? if($options) { ?>
    <div class="boxes">
        <?
        foreach($options as $option) {   
            
            if($option['Options']['extra']) {               
                $extras = json_decode($option['Options']['extra']) ;
            }
        ?>
        <div class="box pull-left"><?=$option['Options']['option']?></div>      
        <img src="/img/box_arrow_right.png" class="arrow  pull-left" />
        <div class="box-response pull-left">&nbsp;</div> 
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
        <button type="button" class="btn btn-info"><?=$value?></button>        
        <?
        }      
        ?>
    </div>
    <? } ?>  

</div>

<script>   

    $('.options button').click(function() {
        
        $('.options button').removeClass('btn-success');
        $('.options button').addClass('btn-info');
          
        $(this).removeClass('btn-info');
        $(this).addClass('btn-success');
        
        $('.boxes .box-response').addClass('ready');
        
    })
    
    $('.boxes .box-response').click(function() {
        
        if($(this).hasClass('ready')) {                             
        
            $(this).text($('.options button.btn-success').text());
            
            $('.options button').removeClass('btn-success');
            $('.options button').addClass('btn-info');   
            $('.boxes .box-response').removeClass('ready');
        }
                
    })

    
</script>
