<div class="questions-preview preview-<?=strtolower($question['type'])?>">

    <div class="question">            
        <?       
        
        $replace      = array();
        $replace_with = array();
        
        foreach($options as $option) {            
            $replace[] = '[['.$option['Options']['option'].']]';
            $replace_with[] = '<span class="blank">&nbsp;</span>';
        }                
        
        $question_text = str_replace($replace, $replace_with, $question['question']);
        
        echo $question_text;            
        ?>       
    </div>

    <? if($options) { ?>
    <div class="options">
        <?
        
        $similarOptions = array();
        
        foreach($options as $option) {     
            if(!in_array($option['Options']['option'], $similarOptions)) {
        ?>
        <button type="button" class="btn btn-info"><?=$option['Options']['option']?></button>        
        <?
                $similarOptions[] = $option['Options']['option'];
            }
            
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
        
        $('.question .blank').addClass('ready');
        
    })
    
    $('.question .blank').click(function() {
        
        if($(this).hasClass('ready')) {                             
        
            $(this).text($('.options button.btn-success').text());
            
            $('.options button').removeClass('btn-success');
            $('.options button').addClass('btn-info');   
            $('.question .blank').removeClass('ready');
        }
                
    })
    
</script>
