<label>Enunciado</label>

<div id="question"><?=$question?></div>
<input type="hidden" name="question_html" id="question_html" />
<br />

<label>Opciones</label> 
<div class="options form-inline">   
<?
if($options) {
    
    $i = 1;
    foreach($options as $option) {?>    
    <div class="option-row">
        <div>
            <textarea name="option[<?=$i?>]" class="form-control" rows="2"><?=$option['Options']['option']?></textarea>
        </div>
        <div class="radio pull-right">
          <button type="button" class="delete-option btn btn-danger btn-xs pull-right">X</button>
        </div>     
        <div class="radio pull-left">
          <label>
            <input type="radio" name="correct[<?=$i?>]" value="T" <? if($option['Options']['is_correct'] == 1) {?>checked<? }?>>
            V
          </label>&nbsp;&nbsp; 
        </div>
        <div class="radio pull-left">
          <label>
            <input type="radio" name="correct[<?=$i?>]" value="F"  <? if($option['Options']['is_correct'] == 0) {?>checked<? }?>>
            F
          </label>
        </div>     
        <div class="clearfix"></div><br />
    </div>
<?  
    $i++;
    }
}?>
</div>

<span class="add-option">+ Agregar...</span>
<br />
<br />
<br />
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
               ['insert', ['picture']]
             ],
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0],editor,welEditable);
            }    
        });
              
        $('.add-option').click(function() {
            
            var d = new Date();
            var timeID = d.getTime();
                        
            html = '<div class="option-row">';
            html = html + '<div><textarea name="option[' + timeID + ']" class="form-control" rows="2"></textarea></div>';
            html = html + '<div class="radio pull-right">';
            html = html + '<button type="button" class="delete-option btn btn-danger btn-xs pull-right">X</button>';
            html = html + '</div>';
            html = html + '<div class="radio pull-left">';
            html = html + '<label>';
            html = html + '<input type="radio" name="correct[' + timeID + ']" value="T" checked>';
            html = html + ' V ';
            html = html + '</label>&nbsp;&nbsp;';
            html = html + '</div>';
            html = html + '<div class="radio pull-left">';
            html = html + '<label>';
            html = html + '<input type="radio" name="correct[' + timeID + ']" value="F">';
            html = html + ' F ';
            html = html + '</label>';
            html = html + '</div>';
            html = html + '<div class="clearfix"></div><br />';
            html = html + '</div>';
      
            $('.options').append(html);
        })              
        
        $('div.options').on('click', '.option-row .delete-option', function() {           
            $(this).parents('.option-row').remove();       
        })   
        
    });
        
    function validateEspecific() {
         
        if($('.options textarea').size() == 0) {
             alert('Debe ingresar como minimo una opcion');
             return false;
         } else {
             
             var hasEmpty = false;
             
             $('.options textarea').each(function() {
                 if($.trim($(this).val()) == '') {
                     hasEmpty = true;
                 }
             })
             
             if(hasEmpty) {
                 alert('Debe completar el texto de cada opcion');
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