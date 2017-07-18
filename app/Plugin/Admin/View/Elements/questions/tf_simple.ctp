<label>Pregunta</label>

<div id="question"><?=$question?></div>
<input type="hidden" name="question_html" id="question_html" />
<br />

<label>Respuesta</label> 
<div class="options form-inline">    
    <div class="radio">
      <label>
        <input type="radio" name="option" value="T" <? if(isset($options[0]) && $options[0]['Options']['option'] == 'T' || !isset($options[0]) ) {?>checked<? }?>>
        Verdadero
      </label>
    </div><br />
    <div class="radio">
      <label>
        <input type="radio" name="option" value="F"  <? if(isset($options[0]) && $options[0]['Options']['option'] == 'F') {?>checked<? }?>>
        Falso
      </label>
    </div>     
</div>

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
               ['table', ['table']], // no table button
               ['insert', ['picture']]
             ],
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0],editor,welEditable);
            }
        });
                
        
    });
        

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
    
    function validateEspecific() {
                 
         return true;
    }
    

</script>