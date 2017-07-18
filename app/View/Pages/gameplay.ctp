<?php
    $vidas = $this->Session->read('Session.Player.lives');
    if($vidas <= 0){
        echo "
        <script>
            var datos = {personaje : '".$character."', reason: 'NO LIVES'};
            loadScene('pages/failedRound', datos);
        </script>";
    }else{
        $rondaActual = $this->Session->read('Session.Player.round_'.strtolower($category));
        $cat_points = $this->Session->read('Session.Player.points_'.strtolower($category));
        $puntos = $this->Session->read('Session.Player.points');
        $etapaActual = 1;
        if($rondaActual >= 16):
            if($rondaActual >= 31):
                $rondaActual = $rondaActual - 30;
                $etapaActual = 3;
            else:
                $rondaActual = $rondaActual - 15;
                $etapaActual = 2;
            endif;
            if($rondaActual == 1):
                $alerta = 1;
            endif;
        endif;

        $ct = 1;
        foreach($roundQuestions as $question){
            echo $this->element('/questions/'.strtolower($question['Questions']['type']), array('desafio' => '0', 'question' => $question, 'ct' => $ct));
            $ct += 1;
        }
    ?>
    <div class="progreso" data-current="0">
        <i class="progreso-titulo"><?= count($roundQuestions) ?> preguntas en este round</i>
        <?php
            if(count($roundQuestions) > 1){
                $ct = 1;
                echo '<ul class="progreso-container">';
                foreach($roundQuestions as $question){
                    echo '<li id="circulo-'.$ct.'" class="venidera" alt-index="'.$ct.'">'.$ct.'</li>';
                    $ct += 1;
                }
                echo '</ul>';
            }
        ?>
    </div>
    <div class="correct-check"><img src="/img/correct_answer.png" alt="Correcto" /></div>
    <script type="text/javascript">
        console.log('EL QUE SE HACE VERDADERO');
        var countDownTimer      = false;
        window.roundTimer       = false;
        var totalRoundTime      = 420;
        var currentRoundTime    = totalRoundTime;
        var points              = <?=$puntos?>;
        var categoryPoints      = <?=$cat_points?>;
        var lives               = <?=$this->Session->read('Session.Player.lives')?>;
        var answersOK           = 0;
        var pointRound          = 0;
        var character           = '<?=$character?>';
        var categoria_human     = '<?=$categoria_human?>';
        var category            = '<?=strtolower($category)?>';
        var currentRound        = <?= $rondaActual ?>;
        var currentStage        = <?= $etapaActual ?>;

        var wilcardsUse    = new Array();
            wilcardsUse[0] = 0;
            wilcardsUse[1] = 0;
            wilcardsUse[2] = 0;

        $(document).ready(function(){
            $('.mapa-content .thug').addClass('round-' + currentRound);
            setTimeout(function(){
                $('.img-mapa').addClass('round-' + currentRound);
                setTimeout(function(){
                    $('.mapa-content .thug').show();
                }, 2000);
            }, 450);
        });
        var titulo = categoria_human +' - <span class="color-fifi"> Round '+ currentRound +' / Etapa '+ currentStage +'</span><span class="puntos-en"><small>En esta materia:</small>&nbsp;<i>' + categoryPoints  + '</i><small>pts.</small></span>';
        var tituloMapa = '<h2>' + categoria_human + '</h2>';
        var mapa = '';
        switch(character) {
            case 'einstein':
                mapa = 'images/mapas/ciencias.png';
                $('.img-mapa').addClass('science');
                $('.mapa-content .thug').addClass('science');
                break;
            case 'colon':
                mapa = 'images/mapas/historia.png';
                $('.img-mapa').addClass('history');
                $('.mapa-content .thug').addClass('history');
                break;
            case 'bello':
                mapa = 'images/mapas/lenguaje.png';
                $('.img-mapa').addClass('language');
                $('.mapa-content .thug').addClass('language');
                break;
            case 'pitagoras':
                mapa = 'images/mapas/matematicas.png';
                $('.img-mapa').addClass('math');
                $('.mapa-content .thug').addClass('math');
                break;
            case 'marie-curie':
                mapa = 'images/mapas/quimica.png';
                $('.img-mapa').addClass('chemistry');
                $('.mapa-content .thug').addClass('chemistry');
                break;
            case 'newton':
                mapa = 'images/mapas/fisica.png';
                $('.img-mapa').addClass('physics');
                $('.mapa-content .thug').addClass('physics');
                break;
            case 'darwin':
                mapa = 'images/mapas/biologia.png';
                $('.img-mapa').addClass('biology');
                $('.mapa-content .thug').addClass('biology');
                break;
            default:
                mapa = 'images/mapas/ciencias.png'; break;
        }
        
        $('.titulo-layout').html(titulo);
        $('.materia-desafio').html(tituloMapa);
        $('.img-mapa').attr('src', mapa);
        
        $('body').off('click', '.btn-empezar').on('click', '.btn-empezar', function(e){
            startPlayingTheFuckMotheringGame();
            e.preventDefault();
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
                statusClass = 'round-ok';
                pointRound  = answersOK * 10;
                if(wilcardsUse[0] == 0 && wilcardsUse[1] == 0 &&  wilcardsUse[2] == 0) {
                    pointRound = pointRound + 50;
                    var datos = {personaje : character, comodin: false};
                } else {
                   var datos = {personaje : character, comodin: true};
                }
                points = points + pointRound;
                $('.points-general span').animateNumbers(points, false);
                loadScene('pages/successRound', datos);
            } else {
                ion.sound.play("fail");
                statusClass = 'round-not-ok';
                if(reason == 'TIME_OVER') {
                    ion.sound.play("fail");
                    var datos = {personaje : character, reason: 'TIME OVER'};
                    loadScene('pages/failedRound', datos);
                } else {
                    var datos = {personaje : character, reason: 'FAILED'};
                    loadScene('pages/failedRound', datos);
                }
           }
        }

        function updateAvailableWildcars() {
            if(categoryPoints < 20) {
                $('.comodin.comodin-saltar').parents().removeClass('sin-usar').addClass('usado');
            }
            if(categoryPoints < 30) {
                $('.comodin.comodin-tiempo').parents().removeClass('sin-usar').addClass('usado');
                $('.comodin.comodin-agranda').parents().removeClass('sin-usar').addClass('usado');
                $('.comodin.comodin-saltar').parents().removeClass('sin-usar').addClass('usado');
            }
        }

        function useWilcard(type) {
            if(type == 'auto-responder') {
                wilcardsUse[0]++;
                if(wilcardsUse[0] > 1) { return false; }
                if(categoryPoints < 30) {return false;}
                autoResponder($('.progreso').data('current'));
                var lapregunta = '#question-' + $('.progreso').data('current');
                $(lapregunta).find('.pregunta-listo').addClass('listo');
                categoryPoints = categoryPoints - 30;
                points = points - 30;
                $('.points-general span').animateNumbers(points, false);
                $('.puntos-en i').animateNumbers(categoryPoints, false);
                $.post('/players/sp/' + categoryPoints + '/<?=strtolower($category)?>');
                ion.sound.play("bonus");
                updateAvailableWildcars();
                showAlert('Agrandaste tu cerebro y la pregunta se respondio sola');
                return true;
            }
            if(type == 'more-time') {
               wilcardsUse[1]++;
                if(wilcardsUse[1] > 1) { return false;}
                if(categoryPoints < 30) {return false;}
                categoryPoints = categoryPoints - 30;
                points = points - 30;
                $('.points-general span').animateNumbers(points, false);
                $('.puntos-en i').animateNumbers(categoryPoints, false);
                $.post('/players/sp/' + categoryPoints + '/<?=strtolower($category)?>');
                var actualTime = currentRoundTime;
                var wildTime =  30;
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
                if(categoryPoints < 20) {return false;}
                categoryPoints = categoryPoints - 20;
                points = points - 30;
                $('.points-general span').animateNumbers(points, false);
                $('.puntos-en i').animateNumbers(categoryPoints, false);
                $.post('/players/sp/' + categoryPoints + '/<?=strtolower($category)?>');
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
<?php } ?>