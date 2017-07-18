<h4 id="section-title" class="questions">Preguntas</h4>

<div id="section-toolbar" class="btn-toolbar">
    <div class="btn-group">        
        <button class="btn btn-primary dropdown-toggle btn-small" data-toggle="dropdown">Nueva Pregunta <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="/admin/questions/edit/multiple_choice">Selección Multiple</a></li>            
            <li class="divider"></li>
            <li><a href="/admin/questions/edit/tf_simple">Verdadero / Falso</a></li>        
            <li><a href="/admin/questions/edit/tf_multiple">Verdadero / Falso Multiple</a></li>
            <li class="divider"></li>
            <li><a href="/admin/questions/edit/complete_box">Complete el Cuadro en Blanco</a></li>
            <li><a href="/admin/questions/edit/fib">Complete el Espacio en Blanco</a></li>
        </ul>
    </div>        
    <div class="btn-group pull-right"> 
        <?        
        $labelCategoryDropDown = ($selectedCategory == '0') ? 'Todas las Tematicas' : $selectedCategoryHuman;        
        ?>        
        <button class="btn btn-success dropdown-toggle btn-small" data-toggle="dropdown"><?=$labelCategoryDropDown?> <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="/admin/questions/index/0/<?=$selectedRound?>">Todas las Tematicas</a></li>
            <li class="divider"></li>
            <? foreach($questionCategories as $k => $v) {?>
            <li><a href="/admin/questions/index/<?=strtolower($k)?>/<?=$selectedRound?>"><?=$v?></a></li>
            <? }?>                     
        </ul>
    </div>        
    <div class="btn-group pull-right">        
        <?
        $labelRoundDropDown = ($selectedRound == 0) ? 'Seleccione un Round' : 'Round: '.$selectedRound;
        ?>
        <button class="btn btn-success dropdown-toggle btn-small" data-toggle="dropdown"><?=$labelRoundDropDown?> <span class="caret"></span></button>
        <ul class="dropdown-menu">            
            <? for ($i = 1; $i <= 15; $i++) {?>
            <li><a href="/admin/questions/index/<?=$selectedCategory?>/<?=$i?>">Round: <?=$i?></a></li>
            <? }?>
        </ul>
    </div>        
</div>
<div class="clearfix"></div>

<table class="table table-striped">
    <thead>
        <tr>                 
            <th>Pregunta</th>           
            <th></th>           
            <th>Tipo</th>            
            <th>Puntos</th>            
            <th>Etapa</th>
            <th>Round</th>
            <th>Tema</th>            
            <th></th>            
        </tr>
    </thead>
    <tbody>
        <?

        if(!empty($questions)) {
            foreach($questions as $question) {
                $question['Questions']['question'] = strip_tags($question['Questions']['question']);
                $out = strlen($question['Questions']['question']) > 50 ? substr($question['Questions']['question'],0,50)."..." : $question['Questions']['question'];
        ?>
        <tr data-id="<?=$question['Questions']['id']?>">                        
            <td>
                <a href="/admin/questions/edit/<?=strtolower($question['Questions']['type'])?>/<?=$question['Questions']['id']?>"><?=$out?></a>
            </td>
            <td>                
                <button data-url="/admin/questions/preview/<?=$question['Questions']['id']?>" type="button" class="btn-question-preview btn btn-default btn-xs">
                <span class="glyphicon glyphicon-eye-open"></span></button>
            </td>
            <td><?=$question['Questions']['humanType']?></td>
            <td><?=$question['Questions']['points']?></td>
            <td><?=$question['Questions']['stage']?></td>
            <td><?=$question['Questions']['round']?></td>
            <td><?=$question['Questions']['category']?></td>  
            <td>                
                <button data-url="/admin/questions/delete/<?=$question['Questions']['id']?>" type="button" class="btn-question-delete btn btn-default btn-xs"  data-id="<?=$question['Questions']['id']?>">
                <span class="glyphicon glyphicon glyphicon-remove"></span></button>
            </td>            
        </tr>        
        <? }
        } else {
        ?>
        <tr>
            <td colspan="6">Ups!!! No hay resultados, pruebe cambiando los filtros de tematica y round</td>            
        </tr>         
        <?         
        }        
        ?>
    </tbody>
</table>

<div id="preview" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                      
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    
    $('.btn-question-preview').click(function() {        
       
        var modal = $('#preview'), modalBody = $('#preview .modal-body');
        var href  = $(this).data('url');
        
        modalBody.load(href);
        modal.modal();
        
    });
    
    $('.btn-question-delete').click(function() {        
               
        var href  = $(this).data('url');
        var id    = $(this).data('id');
        
        if(confirm('¿Desea borrar la pregunta? ' + href)) {
        
            $.post(href, function( data ) {   
                $('table tr[data-id="'+ id +'"]').slideUp('slow');
                alert('Se borro la progunta con éxito!');
            });
               
        }
        
      
    });
    
</script>