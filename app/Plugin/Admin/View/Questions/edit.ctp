<?

$id       = isset($postData['Questions']['id']) ? $postData['Questions']['id'] : 0;
$question = isset($postData['Questions']['question']) ? $postData['Questions']['question'] : '';
$options  = isset($postData['Options']) ? $postData['Options'] : false;
$stage    = isset($postData['Questions']['stage']) ? $postData['Questions']['stage'] : 1;
$category = isset($postData['Questions']['category']) ? $postData['Questions']['category'] : 0;
$round    = isset($postData['Questions']['round']) ? $postData['Questions']['round'] : 0;
$points   = isset($postData['Questions']['points']) ? $postData['Questions']['points'] : 0;
$time     = isset($postData['Questions']['time']) ? $postData['Questions']['time'] : '';

echo $this->Session->flash();
?>


<h4 id="section-title" class="questions"><?=$title?>: <?=$humanType?></h4>

<div class="clearfix"></div>

<form method="post" id="edit-question" class="form-horizontal" role="form">    
    
    <input type="hidden" name="id" id="id" value="<?=$id?>" />
    
    <div class="especific">
        <?php echo $this->element('/questions/'.strtolower($type), array('question' => $question, 'options' => $options)); ?>       
    </div>

    <div class="general panel panel-success">
        <div class="panel-heading"><b>Opciones Generales</b></div>
        <div class="panel-body">
            
            <label>Etapa</label><br />
            <select name="stage" id="stage" class="form-control">
                <option value="0" <? if($stage == 0) { ?>selected="selected"<? }?>>Seleccionar...</option>               
                <option value="1" <? if($stage == 1) { ?>selected="selected"<? }?>>1</option>
                <option value="2" <? if($stage == 2) { ?>selected="selected"<? }?>>2</option>
                <option value="3" <? if($stage == 3) { ?>selected="selected"<? }?>>3</option>                                
            </select>
            <br />
            
            <label>Categoria</label><br />
            
            <select name="category" id="category" class="form-control">
                <option value="0" <? if($category == 0) { ?>selected="selected"<? }?>>Seleccionar...</option>
                <? foreach($questionCategories as $k => $v) { ?>
                <option value="<?=$k?>" <? if($category === $k) { ?>selected="selected"<? }?>><?=$v?></option>
                <? }?>                                
            </select>

            <br />
            <label>Round</label><br />
            <select name="round" id="round" class="form-control">
                <option value="0" <? if($round == 0) { ?>selected="selected"<? }?>>Seleccionar...</option>
                <option value="1" <? if($round == 1) { ?>selected="selected"<? }?>>Round 1</option>
                <option value="2" <? if($round == 2) { ?>selected="selected"<? }?>>Round 2</option>
                <option value="3" <? if($round == 3) { ?>selected="selected"<? }?>>Round 3</option>
                <option value="4" <? if($round == 4) { ?>selected="selected"<? }?>>Round 4</option>
                <option value="5" <? if($round == 5) { ?>selected="selected"<? }?>>Round 5</option>
                <option value="6" <? if($round == 6) { ?>selected="selected"<? }?>>Round 6</option>
                <option value="7" <? if($round == 7) { ?>selected="selected"<? }?>>Round 7</option>
                <option value="8" <? if($round == 8) { ?>selected="selected"<? }?>>Round 8</option>
                <option value="9" <? if($round == 9) { ?>selected="selected"<? }?>>Round 9</option>
                <option value="10" <? if($round == 10) { ?>selected="selected"<? }?>>Round 10</option>
                <option value="11" <? if($round == 11) { ?>selected="selected"<? }?>>Round 11</option>
                <option value="12" <? if($round == 12) { ?>selected="selected"<? }?>>Round 12</option>
                <option value="13" <? if($round == 13) { ?>selected="selected"<? }?>>Round 13</option>
                <option value="14" <? if($round == 14) { ?>selected="selected"<? }?>>Round 14</option>
                <option value="15" <? if($round == 15) { ?>selected="selected"<? }?>>Round 15</option>                                
            </select>
			<input type="hidden" name="points" id="points" value="10" />
            <input type="hidden" name="time" id="time" value="20" />
            <br />
           <!-- <label>Puntos</label><br />
            <select name="points" id="points" class="form-control">
                <option value="0"  <? if($points == 0)  { ?>selected="selected"<? }?>>Seleccionar...</option>
                <option value="10" <? if($points == 10) { ?>selected="selected"<? }?>>10 Puntos</option>
                <option value="12" <? if($points == 12) { ?>selected="selected"<? }?>>12 Puntos</option>
                <option value="15" <? if($points == 15) { ?>selected="selected"<? }?>>15 Puntos</option>
                <option value="17" <? if($points == 17) { ?>selected="selected"<? }?>>17 Puntos</option>
                <option value="20" <? if($points == 20) { ?>selected="selected"<? }?>>20 Puntos</option>
                <option value="22" <? if($points == 22) { ?>selected="selected"<? }?>>22 Puntos</option>
                <option value="25" <? if($points == 25) { ?>selected="selected"<? }?>>25 Puntos</option>
                <option value="30" <? if($points == 30) { ?>selected="selected"<? }?>>30 Puntos</option>
            </select>            
          
            <br />
            <label>Tiempo</label><br />
            <select name="time" id="time" class="form-control">
                <option value="0"  <? if($time == 0)  { ?>selected="selected"<? }?>>Seleccionar...</option>
                <option value="10" <? if($time == 10) { ?>selected="selected"<? }?>>10 Segundos</option>
                <option value="15" <? if($time == 15) { ?>selected="selected"<? }?>>15 Segundos</option>
                <option value="20" <? if($time == 20) { ?>selected="selected"<? }?>>20 Segundos</option>
                <option value="30" <? if($time == 30) { ?>selected="selected"<? }?>>30 Segundos</option>
                <option value="40" <? if($time == 40) { ?>selected="selected"<? }?>>40 Segundos</option>
            </select>
            <br />
			-->
        </div>
    </div>
    
    <div class="clearfix"></div>
    
</form>
<script>
     $(document).ready(function(){
    	$('body').on('change', '#category', function(e){
    		var categoria = $(this).val();
    		switch(categoria){
    			case 'CHEMISTRY':
    				$('#stage').val('3');
    				$('#stage option:not(:selected)').attr('disabled', true);
    				break;
    			case 'PHYSICS':
    				$('#stage').val('3');
    				$('#stage option:not(:selected)').attr('disabled', true);
    				break;
    			case 'BIOLOGY':
    				$('#stage').val('3');
    				$('#stage option:not(:selected)').attr('disabled', true);
    				break;
    			default:
    				$('#stage').val();
    				$('#stage option:not(:selected)').attr('disabled', false);
    		}
    	});
    });
    $('#edit-question').submit(function() {        
       
       var sHTML = $('#question').code();                
       
       if($.trim(sHTML.replace(/(<([^>]+)>)/ig,"")) == '') {
           alert('Debe completar la pregunta');
           return false;
       }   
       
       if($('#stage').val() == 0) {
           alert('Debe seleccionar la etapa');
           return false;
       }              
       if($('#category').val() == 0) {
           alert('Debe seleccionar la categoria');
           return false;
       }              
       if($('#round').val() == 0) {
           alert('Debe seleccionar el round');
           return false;
       }              
       if($('#points').val() == 0) {
           alert('Debe seleccionar los puntos');
           return false;
       }              
       if($('#time').val() == 0) {
           alert('Debe seleccionar el tiempo de respuesta');
           return false;
       }              
       
       $("#question_html").val(sHTML);
        
        return validateEspecific();
         
    });
</script>