<label>Enunciado</label>

<div id="question"><?=$question?></div>
<input type="hidden" name="question_html" id="question_html" />
<span class="help-block">Escriba el enunciado poniendo entre cajas dobles '[[]]' las palabras a completar.</span>

<br />

<label>Opciones</label>             
<div class="fib-options">
<?
if($options) {
    
    $i = 1;
    foreach($options as $option) {
        if($option['Options']['is_correct'] == 1) {
    ?>
            <input name="option[<?=$i?>]" readonly class="input-sm"  type="text" value="<?=$option['Options']['option']?>" />
    <? 
        }
        $i++;
    }
} else {?>
    <span class="help-block">Las opciones apareceran automáticamente.</span>
<?}
?>       
</div>
<br />

<label>Opciones Extras</label> 
<div class="options form-inline">    
<? if($options) {

    $i = 1;
    foreach($options as $option) {
        if($option['Options']['is_correct'] == 0) {
    ?>
            <div class="option"><input name="extra_option[<?=$i?>]" class="form-control input-sm" type="text" value="<?=$option['Options']['option']?>"  /> <button type="button" class="delete-option btn  btn-danger btn-xs">X</button></div>    
    <? 
        }
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
            height: 300,
            toolbar: [               
               ['style', ['bold', 'italic', 'underline', 'clear']],               
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['table', ['table']],               
               ['insert', ['picture']], 
               ['options', ['codeview']]
            ],
            onkeyup: function(e) {
                createOptions();
            },
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0],editor,welEditable);
            }             
        });
        
        $('.add-option').click(function() {
            
            var d = new Date();
            var timeID = d.getTime();
            
            html = '<div class="option"><input name="extra_option[' + timeID + ']" class="form-control input-sm" type="text" /> <button type="button" class="delete-option btn  btn-danger  btn-xs">X</button></div>';
            
            $('.options').append(html);
        })
        
        $('div.options').on('click', '.option .delete-option', function() {           
            $(this).parent().remove();       
        })        
        
    });
        
    function createOptions() {
        
        var sHTML = $('#question').code();      
        
        words = []
        sHTML.replace(/\[\[(.+?)\]\]/g, function($0, $1) { words.push($1) });
        
        html = '';
        
        for(i in words) {
            html = html + '<input type="text" name="option[' + i + ']" readonly class="input-sm" value="' + words[i] + '" />' ;
        }
              
        if(html == '') {
            $('.fib-options').html('<span class="help-block">Las opciones apareceran automáticamente.</span>');
        } else {
            $('.fib-options').html(html);
        }
    }
    
    function validateEspecific() {
         
         if($('.fib-options input[type="text"]').size() == 0) {
             alert('Debe ingresar como minimo una opcion');
             return false;
         }
         
         
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