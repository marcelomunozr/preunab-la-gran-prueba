<div class="questions-preview preview-<?=strtolower($question['type'])?>">

    <div class="question">
        <?=$question['question']?>
    </div>

    <div class="options">
        
        <button type="button" class="btn btn-info">Verdadero</button>        
        <button type="button" class="btn btn-info">Falso</button>           

    </div>

</div>

<script>
                
    $('.options button').click(function() {
        
        $('.options button').removeClass('btn-success');
        $('.options button').addClass('btn-info');
         
        $(this).removeClass('btn-info');
        $(this).addClass('btn-success');
        
    })
    
</script>