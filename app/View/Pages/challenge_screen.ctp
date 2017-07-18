<?php
	$ct = 1;
	$vidas = $this->Session->read('Session.Player.lives');
	foreach($preguntas as $question){
		echo $this->element('/questions/'.strtolower($question['Questions']['type']), array('desafio' => '1', 'question' => $question, 'ct' => $ct));
		$ct += 1;
	}
	?>
	<style>
		.btn-modal-verde{
			width: 180px;
			padding: 12px 0;
			font-size: 24px;
			line-height: 22px;
			text-align: center;
			font-family: 'Sports World-Regular','Alfa Slab One','Open Sans',sans-serif;
			font-weight: normal;
			color: #fff;
			text-decoration: none;
			margin: 10px;
			background: #049b00;
			border-bottom: 2px solid #025f00;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;
			-o--radius: 4px;
			border-radius: 4px;
			float: none;
			display: inline-block;
			position: relative;
			text-transform: uppercase;
		}
	</style>
	<div class="progreso" data-current="0">
		<i class="progreso-titulo"><?= count($preguntas) ?> preguntas en este round</i>
		<?php
			if(count($preguntas) > 1){
				$ct = 1;
				echo '<ul class="progreso-container">';
				foreach($preguntas as $question){
					echo '<li id="circulo-'.$ct.'" class="venidera" alt-index="'.$ct.'">'.$ct.'</li>';
					$ct += 1;
				}
				echo '</ul>';
			}
		?>
	</div>
	<div class="correct-check"><img src="/img/correct_answer.png" alt="Correcto" /></div>
	<script type="text/javascript">
		console.log('Le Script');
		var countDownTimer		= false;
	   	window.roundTimer		= false;
	    var totalRoundTime		= 420;
	    var currentRoundTime	= totalRoundTime;
	    var points				= <?=$this->Session->read('Session.Player.points')?>;
	    var lives				= <?=$this->Session->read('Session.Player.lives')?>;
	    var answersOK			= 0;
	    var pointRound			= 0;
		var challengeId			= <?=$challenge_id?>;

		var wilcardsUse    = new Array();
	        wilcardsUse[0] = 0;
	        wilcardsUse[1] = 0;
	        wilcardsUse[2] = 0;
		
		$(document).ready(function(e){
			$('#challengeDialog').modal('show');
			$('body').off('click', '.btn-empezar').on('click', '.btn-empezar', function(e){
				e.preventDefault();
				startPlayingTheFuckMotheringGame();
				$('#challengeDialog').modal('hide');
			});
		});
		
		$('body').off('click', '.btn-salir').on('click', '.btn-salir', function(e){
			e.preventDefault();
			$('#challengeDialog').modal('hide');
			loadScene('home');
			
		});
		
		$('body').off('click', '.pregunta-listo.listo').on('click', '.pregunta-listo.listo', function(e){
			checkThisQuestion(e);
			e.preventDefault();
		});

		$('body').off('click', '.comodin').on('click', '.comodin', function(e){
			var tipo = $(this).data('comodin');
			var resultado = useWilcard(tipo);
			if(resultado == true){
				$(this).parent().removeClass('sin-usar').addClass('usado');
			}
			e.preventDefault();
		});

		$('body').off('click', '.btn-guardar-pregunta').on('click', '.btn-guardar-pregunta', function(e){
			if(!$(this).hasClass('guardada')){
				var idpregunta = $(this).data('idpregunta');
				var resultado = storeThisQuestion(idpregunta);
				if(resultado){
					$(this).addClass('guardada').html('<i class="icon-guardar-pregunta-guardada"></i> <span>Pregunta guardada</span>');
				}
			}
			e.preventDefault();
		});
		
		function updateTimer(percent){
			var deg;
			if(percent<(totalRoundTime/2)){
				deg = 90 + (360*percent/totalRoundTime);
				$('.pie').css('background-image', 'linear-gradient('+deg+'deg, transparent 50%, #ccf2ff 50%),linear-gradient(90deg, #ccf2ff 50%, transparent 50%)');
			}else if(percent>=(totalRoundTime/2)){
				deg = -90 + (360*percent/totalRoundTime);
				$('.pie').css('background-image', 'linear-gradient('+deg+'deg, transparent 50%, #df2020 50%),linear-gradient(90deg, #ccf2ff 50%, transparent 50%)');
			}
		}
		function startPlayingTheFuckMotheringGame(){
			updateAvailableWildcars();
			ion.sound.play("sf_fight");
			startPlay();
			$('.map-container').hide();
			$('.preguntas-content').show();
			$('.lateral-preguntas').show();
		}
		
		function checkThisQuestion(e){
			//console.log('Targeting', e.currentTarget);
			$(e.currentTarget).off();
			var parent = $(e.currentTarget).parents('.question');
			var index = parent.data('numpregunta');
			var type = parent.data('type');
			var respuesta = checkAnswer(index, type);
			var circulo = '#circulo-'+index;
			if(respuesta === true){
				goNext();
				$(circulo).addClass('pasada');
				$(circulo).removeClass('venidera');
				$(circulo).removeClass('actual');
				$('.correct-check').transit({scale: 1.9, opacity: 1, duration: 0}); 
	            $('.correct-check').show(); 
	            $('.correct-check').transit({scale: 0, opacity: 0 ,duration: 700}, 'snap', function() {
	                $('.correct-check').hide(); 
	                $('.correct-check').transit({scale: 1.5, opacity: 1, duration: 0});                 
	            });
			}else{
				endPlay('WRONG_ANSWER');
			}
		}

		function startPlay() {
	        clearInterval(countDownTimer);
	        var count = 0;
	        window.roundTimer = setInterval(function() {
	            currentRoundTime--;
	            var minutos = Math.floor(currentRoundTime / 60);
	            var segundos = currentRoundTime % 60;
				var compuesto = '';
				count = totalRoundTime - currentRoundTime;
				if(minutos <= 0){
					minutos = 0;
				}
				if(segundos <= 9){
					segundos = '0'+segundos;
				}
				compuesto = minutos + ':' + segundos;
				count+=1;
	            updateTimer(count);
	            $('#time').html(currentRoundTime);
			    $('#timer span.seconds').text(compuesto);
	            if(currentRoundTime == 0) {
	                endPlay('TIME_OVER');
	            }
	        }, 1000);
	        goNext();
	    }

		function goNext() {
	        currentQuestion = parseInt($('.progreso').data('current'));
	        $('#question-' + currentQuestion).hide();
	        currentQuestion++;
	        if($('#question-' + currentQuestion).size() == 0) {
	            endPlay('END_ROUND');
	        } else {
	            $('#question-' + currentQuestion).show();
	        }
	        $('.progreso').data('current', currentQuestion);
	        var circulo = '#circulo-'+currentQuestion;
	        $(circulo).removeClass('venidera');
			$(circulo).addClass('actual');
	    }

		function checkAnswer(index, type) {
	        question = $('#question-' + index);
	        //console.log('La pregunta', question);
	        haveError = false;
	        if(type == 'multiple_choice') {
	            options = $(question).find('.options .alternativa');
	            $(options).each(function() {
	                if($(this).data('is') == 31 && !$(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	                if($(this).data('is') == 3 && $(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	            })
	        }
	        if(type == 'complete_box') {
	            options = $(question).find('.boxes .box-response');
	            $(options).each(function() {
	                if($(this).data('is') != $(this).text()) {
	                    haveError = true;
	                }
	            })
	        }
	        if(type == 'fib') {
	            options = $(question).find('span.blank');
	            $(options).each(function() {
	                if($(this).data('is') != $(this).text()) {
	                    haveError = true;
	                }
	            })
	        }
	        if(type == 'tf_simple') {
	            options = $(question).find('.options .alternativa');
	            $(options).each(function() {
	                if($(this).data('is') == 1 && !$(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	                if($(this).data('is') == 0 && $(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	            })
	        }
	        if(type == 'tf_multiple') {
	            options = $(question).find('.options .alternativa');
	            $(options).each(function() {
	                if($(this).data('is') == 1 && !$(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	                if($(this).data('is') == 0 && $(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	            })
	        }
	        if(type == 'option_choices') {
	            options = $(question).find('.options .alternativa');
	            $(options).each(function() {
	                if($(this).data('is') == 1 && !$(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	                if($(this).data('is') == 0 && $(this).hasClass('seleccionada')) {
	                    haveError = true;
	                }
	            })
	        }
	        if(!haveError) {
	            answersOK++;
	            ion.sound.play("correct");
	        }
	        return !haveError;
	    }

		function endPlay(reason) {
		    clearInterval(window.roundTimer);
		    $('body').scrollTop(0);
		    if(reason == 'END_ROUND') {
		        pointRound = 110;
		        points = points + pointRound;
		        var datos = {challenge_id: challengeId, reason:'END_ROUND'};
		        $.post('/players/endChallenge', datos, function(response){
		        	if(response.exito == 1){
			        	var cadena = 'has ganado <span>120pts<7span> en el desafío';
			        	$('#modalResultado .modal-body h4').html(cadena);
			        	$('#modalResultado').modal({
			        		show: true,
			        		backdrop: 'static',
			        		keyboard: false
			        	});      		
		        	}
		        });
		        $('.points-general span').animateNumbers(points, false);
		        console.log('Fin ronda: END_ROUND');
		    } else {
		        ion.sound.play("fail");
		        statusClass = 'round-not-ok';
				if(reason == 'TIME_OVER') {
					ion.sound.play("fail");
					var datos = {challenge_id: challengeId, reason:'TIME_OVER'};
			        $.post('/players/endChallenge', datos, function(response){
			        	if(response.exito == 1){
			        		var cadena = '¡Te quedaste sin tiempo! demoraste mucho y perdiste el desafío';
				        	$('#modalResultado .modal-body h4').html(cadena);
				        	$('#modalResultado').modal({
				        		show: true,
				        		backdrop: 'static',
				        		keyboard: false
				        	});
			        	}
			        });
				} else {
					var datos = {challenge_id: challengeId, reason:'FAILED'};
			        $.post('/players/endChallenge', datos, function(response){
			        	if(response.exito == 1){
				        	var cadena = '¡Perdiste el desafío! no supiste la respuesta y terminó el juego';
				        	$('#modalResultado .modal-body h4').html(cadena);
				        	$('#modalResultado').modal({
				        		show: true,
				        		backdrop: 'static',
				        		keyboard: false
				        	});
			        	}
			        });
	            }
		   }
		}

		function updateAvailableWildcars() {
	        if(points < 20) {
	            $('.comodin.comodin-saltar').parents().removeClass('sin-usar').addClass('usado');
	        }
	        if(points < 30) {
				$('.comodin.comodin-tiempo').parents().removeClass('sin-usar').addClass('usado');
				$('.comodin.comodin-agranda').parents().removeClass('sin-usar').addClass('usado');
				$('.comodin.comodin-saltar').parents().removeClass('sin-usar').addClass('usado');
	        }
		}

		function useWilcard(type) {
	       	if(type == 'auto-responder') {
	            wilcardsUse[0]++;
	            if(wilcardsUse[0] > 1) { return false; }
	            if(points < 30) {return false;}
	            autoResponder($('.progreso').data('current'));
	            var lapregunta = '#question-' + $('.progreso').data('current');
	            $(lapregunta).find('.pregunta-listo').addClass('listo');
	            points = points - 30;
	            $('.points-general span').animateNumbers(points, false);
	            ion.sound.play("bonus");
	           	updateAvailableWildcars();
	           	showAlert('Agrandaste tu cerebro y la pregunta se respondio sola');
	            return true;
	        }
	        if(type == 'more-time') {
	           wilcardsUse[1]++;
	            if(wilcardsUse[1] > 1) { return false;}
	            if(points < 30) {return false;}
	            points = points - 30;
	            $('.points-general span').animateNumbers(points, false);
	            var actualTime = currentRoundTime;
				var wildTime = 	30;
				comodinTime = setInterval(function() {
					wildTime --;
					currentRoundTime = actualTime;
					//console.log(wildTime);
					if(wildTime == 0){
						clearInterval(comodinTime);
					}
		        }, 1000);
	            ion.sound.play("bonus");
	            updateAvailableWildcars();
	            showAlert('¡CONGELASTE EL TIEMPO, Aprovecha!');
	            return true;
	        }
	        if(type == 'change-question') {
	            wilcardsUse[2]++;
	            if(wilcardsUse[2] > 1) { return false;}
	            if(points < 20) {return false;}
	            points = points - 30;
				$('.points-general span').animateNumbers(points, false);
				ion.sound.play("bonus");
				answersOK++;
				goNext();
	            updateAvailableWildcars();
	            showAlert('¿No te gusto? ¡Venga la siguiente pregunta!');
	            return true;
	        }
	        
	    }

	    function autoResponder(index) {
	        if(wilcardsUse[0] > 1) { return false; }
	        question = $('#question-' + index);
	        type     = $('#question-' + index).data('type');
	        if(type == 'multiple_choice'){
	            $(question).find('.options .alternativa').removeClass('seleccionada');
	            $(question).find('.options .alternativa[data-is=31]').addClass('seleccionada');
			}
			if(type == 'complete_box') {
	            options = $(question).find('.boxes .box-response');
	            $(options).each(function() {
					$(this).text($(this).data('is'));
				})
	        }
			if(type == 'fib') {
	            options = $(question).find('span.blank');
	            $(options).each(function() {
					$(this).text($(this).data('is'));
				})
	        }
	        if(type == 'tf_simple') {
	        	$(question).find('.options .alternativa').removeClass('seleccionada');
				$(question).find('.options .alternativa[data-is=1]').addClass('seleccionada');
			}
			if(type == 'tf_multiple') {
				$(question).find('.options .alternativa').removeClass('seleccionada');
				$(question).find('.options .alternativa[data-is=1]').addClass('seleccionada');
			}
			if(type == 'option_choices') {
	            $(question).find('.options .alternativa').removeClass('seleccionada');
				$(question).find('.options .alternativa[data-is=1]').addClass('seleccionada');
			}
	    }
	</script>
	
	