$('.question.type-multiple_choice .options .alternativa').click(function(e) {
    e.preventDefault();
    var parent = $(this).parents('.question.type-multiple_choice');
    if($(this).hasClass('seleccionada')) {        
        $(this).removeClass('seleccionada');
    } else {
        $(this).addClass('seleccionada');
    }
    var numItems = parent.find('.seleccionada').length;
	if(numItems > 0){
		parent.find('.pregunta-listo').addClass('listo');
	}else{
		parent.find('.pregunta-listo').removeClass('listo');
	}
});

$('.question.type-fib .options .alternativa').click(function(e) {
	e.preventDefault();
	var parent = $(this).parents('.question.type-fib');
	parent.find('.seleccionada').removeClass('seleccionada');
	$(this).removeClass('seleccionada');
	$(this).addClass('seleccionada');
	parent.find('.question-prompt .blank').addClass('ready');
});

$('.question.type-fib .question-prompt .blank').click(function(e) {
    e.preventDefault();
    if($(this).hasClass('ready')) {
    	var parent = $(this).parents('.question.type-fib');
        $(this).text(parent.find('.alternativa.seleccionada').text());
        parent.find('.seleccionada').removeClass('seleccionada');   
        parent.find('.question-prompt .blank').removeClass('ready');
        parent.find('.pregunta-listo').addClass('listo');
    }
});

$('.question.type-complete_box .options .alternativa').click(function(e) {
	e.preventDefault();
	var parent = $(this).parents('.question.type-complete_box');
	parent.find('.alternativa.seleccionada').removeClass('seleccionada');
    $(this).addClass('seleccionada');
    parent.find('.boxes .box-response').addClass('ready');
});

$('.question.type-complete_box .boxes .box-response').click(function(e) {
	e.preventDefault();
    if($(this).hasClass('ready')) {                             
		var parent = $(this).parents('.question.type-complete_box');
		$(this).text(parent.find('.options .alternativa.seleccionada').text());
        parent.find('.options .alternativa.seleccionada').removeClass('seleccionada');
        parent.find('.boxes .box-response.ready').removeClass('ready');
        parent.find('.pregunta-listo').addClass('listo');
    }
});

$('.question.type-tf_multiple .options .alternativa').click(function(e) {
	e.preventDefault();
	id = $(this).data('id');
    var parent = $(this).parents('.question.type-tf_multiple');
    parent.find('.option[data-id="'+ id + '"] .alternativa').removeClass('seleccionada');
    $(this).addClass('seleccionada');
    parent.find('.pregunta-listo').addClass('listo');
});

$('.question.type-tf_simple .options .alternativa').click(function(e) {
	e.preventDefault();
	var parent = $(this).parents('.question.type-tf_simple');
	parent.find('.options .alternativa').removeClass('seleccionada');
	parent.find('.options .alternativa').addClass('seleccionada');
	$(this).addClass('seleccionada');
	parent.find('.pregunta-listo').addClass('listo');
});

$('.alternativa.seleccionada').click(function(e){
	e.preventDefault();
	$(this).removeClass('seleccionada');
	
});
$('.question').find('table').addClass('table');