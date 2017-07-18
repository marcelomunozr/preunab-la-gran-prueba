<label>Enunciado</label>

<div id="question"><?=$question?></div>
<input type="hidden" name="question_html" id="question_html" />

<br />

<label>Opciones</label>             
<div class="options form-inline">
        
<? 

$extras = isset($options[0]['Options']['extra']) ? json_decode($options[0]['Options']['extra'], true) : false;

if($extras) {            
    $i = 1;
    foreach($extras as $extra) {      
        $value = isset($extra['NOT_OK']) ? $extra['NOT_OK'] : $extra['OK'];
    ?>
        <div class="option"><input name="option[<?=$i?>]" data-id="<?=$i?>" class="form-control input-sm" type="text" value="<?=$value?>" /> <button data-id="<?=$i?>" type="button" class="delete-option btn  btn-danger  btn-xs">X</button></div>
    <? 
        $i++;
    }
}
?>       
</div>
<span class="add-option">+ Agregar...</span>
<br /><br />
<label>Cuadros</label>             
<div class="boxes form-inline">       
<? 

if($options) {            
    $i = 1;
    foreach($options as $option) {     
       $extras = isset($option['Options']['extra']) ? json_decode($option['Options']['extra'], true) : false;
    ?>
    <div class="box-row">
        <div><textarea name="box[<?=$i?>]" class="form-control" rows="2"><?=$option['Options']['option']?></textarea></div>
        <div class="radio pull-right">
            <button type="button" class="delete-box btn btn-danger btn-xs pull-right">X</button>
        </div>
        <div class="radio pull-left">
            
            <select name="correct[<?=$i?>]">
                <option value="">Opcion Correcta...</option>
                <? 
                if($extras) {
                    
                    $j = 1;
                    
                    foreach($extras as $extra) {     
                        
                        $value    = isset($extra['NOT_OK']) ? $extra['NOT_OK'] : $extra['OK'];
                        $selected = isset($extra['NOT_OK']) ? '' : 'selected';

                ?>
                        <option data-id="<?=$j?>"value="<?=$value?>" <?=$selected?>><?=$value?></option>
                <?
                        $j++;
                    }                
                }?>
            </select>
        </div>
        <div class="clearfix"></div><br />
    </div>
    <? 
        $i++;
    }
}
            
?>
</div>

<span class="add-box">+ Agregar...</span>

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
               ['insert', ['picture']]               
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
                        
            html = '<div class="option"><input name="option[' + timeID + ']" data-id="' + timeID + '" class="form-control input-sm" type="text" value="" /> <button type="button"  data-id="' + timeID + '" class="delete-option btn  btn-danger  btn-xs">X</button></div>';
            
            $('.options').append(html);
            
            addToSelect(timeID);
                       
        }) 
        
        $('.add-box').click(function() {
            
            var d = new Date();
            var timeID = d.getTime();
                        
            html = '<div class="box-row">';
            html = html + '<div><textarea name="box[' + timeID + ']" class="form-control" rows="2"></textarea></div>';
            html = html + '<div class="radio pull-right">';
            html = html + '<button type="button" class="delete-box btn btn-danger btn-xs pull-right">X</button>';
            html = html + '</div>';
            html = html + '<div class="radio pull-left">';
            html = html + '<select name="correct[' + timeID + ']"><option value="">Opcion Correcta...</option></select>';
            html = html + '</div>';
            html = html + '<div class="clearfix"></div><br />';
            html = html + '</div>';
            
            $('.boxes').append(html);
            
            populateOptions(timeID);
            
        })              
        
        $('div.options').on('keyup', '.option  input', function() {                  
            updateSelect($(this).data('id'), $(this).val())
        })   
        
        $('div.options').on('click', '.option .delete-option', function() {           
            $(this).parents('.option').remove();     
            removeFromSelect($(this).data('id'))
        })   
        
        $('div.boxes').on('click', '.box-row .delete-box', function() {           
            $(this).parents('.box-row').remove();       
        })        
        
    });
        
 
    function validateEspecific() {
         
        if($('.options input').size() == 0) {
             alert('Debe ingresar como minimo una opcion');
             return false;
         } else {
             
             var hasEmpty = false;
             
             $('.options input').each(function() {
                 if($.trim($(this).val()) == '') {
                     hasEmpty = true;
                 }
             })
             
             if(hasEmpty) {
                 alert('Debe completar el texto de cada opcion');
                 return false;
             }
 
            if($('.boxes textarea').size() == 0) {
                alert('Debe ingresar como minimo un cuadro');
                return false;
            } else {
                                
                var hasEmpty      = false;
                var withoutAnswer = false;

                $('.boxes textarea').each(function() {
                    if($.trim($(this).val()) == '') {
                        hasEmpty = true;
                    }
                })

                if(hasEmpty) {
                    alert('Debe completar el texto de cada cuadro');
                    return false;
                }    
                
                $('.boxes select').each(function() {
                    if($.trim($(this).val()) == '') {
                        withoutAnswer = true;
                    }
                })

                if(withoutAnswer) {
                    alert('Debe seleccionar una respuesta correcta por cuadro');
                    return false;
                }                
            }
            
         }
         
         return true;
    }
    
    function addToSelect(id) {
        $('.box-row select').append('<option data-id="' + id + '"></option>');
    }
    
    function removeFromSelect(id) {  
        $('.box-row select option[data-id="'+ id + '"]').remove();
    }
    
    function updateSelect(id, value) {   
        $('.box-row select option[data-id="'+ id + '"]').text(value);
    }
        
    function populateOptions(id) {   
        
        $('.options input').each(function() {
            $('.box-row select[name="correct[' + id + ']"]').append('<option data-id="' + $(this).data('id') + '">' + $(this).val() + '</option>');
        })   
        
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