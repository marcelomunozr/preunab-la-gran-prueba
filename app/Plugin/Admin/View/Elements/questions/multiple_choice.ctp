<label>Pregunta</label>

<div id="question"><?=$question?></div>
<input type="hidden" name="question_html" id="question_html" />
<br />

<label>Opciones</label> 
<div class="options form-inline">
    
<? 
if($options) {            
    $i = 1;
    foreach($options as $option) {
        $is_correct = $option['Options']['is_correct'] == 0 ? '' : 'checked="checked"';
    ?>
            <div class="option"><div class="checkbox"><input type="checkbox" <?=$is_correct?> name="correct[<?=$i?>]" value="1"> </div>&nbsp;&nbsp; <input name="option[<?=$i?>]" class="form-control input-sm" type="text" value="<?=$option['Options']['option']?>" /> <button type="button" class="delete-option btn  btn-danger  btn-xs">X</button></div>
    <? 
        $i++;
    }
}
?>
</div>
<span class="add-option">+ Agregar...</span>

<br /><br />
<div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="/admin/questions" class="btn btn-default">Cancelar</a>
</div>

<script>
    
    $(document).ready(function() {
        
        $('#question').summernote({
            height: 200,
            toolbar: [
               ['style', ['bold', 'italic', 'underline', 'clear']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['table', ['table']], 
               ['insert', ['picture']],
               ['options', ['codeview']]               
             ],
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0],editor,welEditable);
            }         
        });
        
        $('.add-option').click(function() {
            
            var d = new Date();
            var timeID = d.getTime();
            
            html = '<div class="option"><div class="checkbox"><input type="checkbox" name="correct[' + timeID + ']" value="1"> </div>&nbsp;&nbsp; <input name="option[' + timeID + ']" class="form-control input-sm" type="text" /> <button type="button" class="delete-option  btn-danger  btn btn-xs">X</button></div>';
            
            $('.options').append(html);
        })
        
        $('div.options').on('click', '.option .delete-option', function() {           
            $(this).parent().remove();       
        })
        
    });
        
    function validateEspecific() {
         
         if($('.options input[type="text"]').size() == 0) {
             alert('Debe ingresar como minimo una opcion');
             return false;
         } else {
             
             var hasEmpty = false;
             
             $('.options input[type="text"]').each(function() {
                 if($.trim($(this).val()) == '') {
                     hasEmpty = true;
                 }
             })
             
             if(hasEmpty) {
                 alert('Debe completar el texto de cada opcion');
                 return false;
             }
             
             if($('.options input[type="checkbox"]:checked').size() == 0) {
                alert('Debe haber como minimo una opcion correcta');
                return false;
             }
         }
         return true;
    }
    

    function sendFile(file,editor,welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: "/admin/questions/saveImage",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {                
                editor.insertImage(welEditable, url);
            }
        });
    }        
</script>