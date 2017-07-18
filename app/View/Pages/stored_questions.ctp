<?php 
	$ct = 1;
	foreach($guardadas as $guardada){
		$guardada['options'] = $guardada['Questions']['options'];
		echo $this->element('/questions/stored/'.strtolower($guardada['Questions']['type']), array('question' => $guardada, 'ct' => $ct));
		$ct += 1;
	}
	if(count($guardadas) > 0){
		foreach($guardadas as $id=>$pregunta){
			if($id == 0 || $id == 5){
				echo '<div class="col col-2-col"><ul class="peluda-list">';
			}
			echo '<li class="pregunta-selector" data-id="'.$pregunta['StoredQuestion']['question_id'].'">';
			echo	($primera != null && $primera >0 && $primera == $pregunta['StoredQuestion']['question_id'])? '<a href="#" class="selected">' : '<a href="#">'; 
			echo		'<span class="peluda-category">'.$pregunta['StoredQuestion']['category'].'</span>
						Pregunta ID '.$pregunta['StoredQuestion']['question_id'].' / Round '.$pregunta['Questions']['round'].'
						<i class="fa fa-chevron-right"></i>
					</a>
				</li>';
			if($id == 4 || $id == count($guardadas) -1 ){
				echo '</ul></div>';
			}
		}
	}
?>
<script>
	$('body').on('click', '.pregunta-selector', function(e){
		console.log('Hizo click');
		var id_pregunta = $(this).data('id');
		$('.question').hide();
		$('.pregunta-selector a').removeClass('selected');
		$('.question[data-id="'+ id_pregunta +'"]').show();
		$(this).find('a').addClass('selected');
		e.preventDefault();
	});
	<?php if($primera != null && $primera >0){ ?>
		$('.question[data-id="'+ <?= $primera ?> +'"]').show();
	<? }?>
</script>