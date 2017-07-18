$(document).ready(function() {
    try{
    	ion.sound({
	        sounds: [
	            {name: "bonus"},
	            {name: "correct"},
	            {name: "fail"},
	            {name: "fighter_choose_sf2", volume: "1.2"},
	            {name: "selection_hover_sf2", volume: "0.9", multiplay: true},
	            {name: "sf_fight", volume: "0.9"},
	        ],
	        path: "/sounds/",
	        volume: "0.4",
	        preload: true
	    });
    }catch(err){
    	
    }
    
    $('[data-toggle="tooltip"]').tooltip({  
        template: '<div class="tooltip modificado" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        title:'Ayuda de la Gran Prueba',
        html: true
    });
    $('body').on('submit', '.form-invite', function(e){
    	e.preventDefault();
    	var errores	= 0;
    	var form	= $(this);
    	var nombre	= form.find('[name=nombreAmigo]').val();
    	var email	= form.find('[name=emailAmigo]').val();
    	var data	= form.serialize();
    	if(nombre == ''){
    		errores += 1;
    	}
    	if(email == ''){
    		errores += 1;
    	}
    	if(errores == 0){
    		$.post('/players/sendInvite', data, function(respuesta){
    			if(respuesta.exito == 1){
    				$('#inviteFriend').modal('hide');
    				setTimeout(function(){
    					showAlert('Se le ha enviado la invitación a tu amigo');
    					form[0].reset();
    				}, 300);
    				
    			}
    		});
    	}
    });
    
    $('body').on('click', '.losers-share', function(){
    	FB.ui({
			  method: 'share',
			  href: 'http://lagranprueba.preunab.cl/landing',
		}, function(response){
			if(typeof(response) != 'undefined'){
				secondWind();
			}
			loadScene('home');
		});
    })
    
    $('body').on('click', '.btn-fb.btn-comparte', function(e){
    	FB.ui({
			  method: 'share',
			  href: 'http://lagranprueba.preunab.cl/landing',
		}, function(response){
			if(typeof(response) != 'undefined'){
				secondWind();
			}
			loadScene('home');
		});
    });
    
    $('body').on('mouseenter','#theMenu', function(e){
        e.stopPropagation();
        $(this).find('.list').addClass('active');
        $(this).find('.submenu').stop(true, true).animate({'margin-left':'200px'}, 300);
    });
    $('body').on('mouseleave', '#theMenu', function(e){
        e.stopPropagation();
        $(this).find('.list').removeClass('active');
        $(this).find('.submenu').stop(true, true).animate({'margin-left':'-40px'}, 300);
    });
    $('body').on('mouseenter','.el-avatar', function(e){
    	e.stopPropagation;
        $(this).find('.camera').stop(true, true).fadeIn(200);
    });
    $('body').on('mouseleave','.el-avatar', function(e){
    	e.stopPropagation;
        $(this).find('.camera').stop(true, true).fadeOut(200);
    });

	$('.btn-ranking').click(function(){
        if($('.el-ranking').hasClass('movido')){
            $('.el-ranking').removeClass('movido');
            $('.el-ranking').animate({ "margin-left": "+=200px" }, "fast" );
        }else{
            $('.el-ranking').addClass('movido');
            $('.el-ranking').animate({ "margin-left": "-=200px" }, "fast" );
        }
    });
    $('body').on('mouseenter', '.switcher', function(e){
        e.stopPropagation();
        var personaje = $(this).data('personaje');
        var laid = '#'+personaje;
        //$('.bg-principal').css("background-image", "url(images/bg-desenfoque.jpg)");
        $('#personajes-fondo').attr('src', '/images/personajes-home-desenfoque.png');
        ion.sound.play("selection_hover_sf2");
        $(laid).stop(true, true).animate({
          "margin-left": "-=100px",
          opacity: 1
        }, 300, '', function(){
            $(this).find(".txt-personaje").animate({
                "margin-left": "-=100px",
                opacity: 1
            }, 200);
        } );
        e.stopPropagation();
    }).on('mouseout', '.switcher', function(e){
        e.stopPropagation();
        var personaje = $(this).data('personaje');
        var laid = '#'+personaje;
        //$('.bg-principal').css("background-image", "url(images/bg.jpg)");
        $('#personajes-fondo').attr('src', '/images/personajes-home.png');
        $(laid).stop(true, true).animate({
          "margin-left": "+=100px",
          opacity: 0
        }, 200, '', function(){
            $(this).find(".txt-personaje").animate({
                "margin-left": "+=100px",
                opacity: 0
            }, 200);
        } );
    });
    $('body').on('mouseenter', '.switcher-disable', function(e){
        e.stopPropagation();
        var personajeDead = $(this).data('personaje');
        var laidInactiva = '#'+personajeDead;
        $(laidInactiva).stop(true, true).animate({
            "margin-left": "+=100px",
            opacity: 1
        }, 300);
        ion.sound.play("selection_hover_sf2");

    }).on('mouseout', '.switcher-disable', function(e){
        e.stopPropagation();
        var personajeDead = $(this).data('personaje');
        var laidInactiva = '#'+personajeDead;
        $(laidInactiva).stop(true, true).animate({
            "margin-left": "-=100px",
            opacity: 0
        }, 300);
        ion.sound.play("selection_hover_sf2");

    });
    
    //tutorial
    $('body').on('click', '#open-tutorial', function(){
        $('#overlay-tutorial').fadeIn(300);
    });
    $('body').on('click', '#cerrar-tutorial', function(){
        $('#overlay-tutorial').fadeOut(300);
    });
    $('body').on('click', '#overlay-tutorial', function(){
        $('#overlay-tutorial').fadeOut(300);
    });

    $('body').off('click', '.btn-continuar').on('click', '.btn-continuar', function(e){
    	var datos = {personaje : $(this).data('personaje')};
    	ion.sound.play("fighter_choose_sf2");
    	loadScene('gameplay', datos);
    	e.preventDefault();
    });
    /** Navegaciones 
	**/
    $('body').on('click', '.to-profile', function(e){
    	e.preventDefault();
    	loadScene('profile');
    });
    
    $('body').on('click', '.to-challenge', function(e){
    	e.preventDefault();
    	loadScene('challengeSelector');
    });
    
    $('body').on('click', '.to-brigidas', function(e){
    	e.preventDefault();
    	loadScene('hairyQuestions');
    });
    
    $('body').on('click', '.toTrophies', function(e){
    	e.preventDefault();
    	loadScene('trophies');
    });
    
    $('body').on('click', '.toNotifications', function(e){
    	e.preventDefault();
    	loadScene('notifications');
    });
    
	$('body').on('click', '.character-selector.enable', function(e){
    	var datos = {personaje : $(this).data('personaje')};
    	ion.sound.play("fighter_choose_sf2");
    	loadScene('gameplay', datos);
    	e.preventDefault();
    });

    $('body').on('click', '#to-home', function(e){
    	e.preventDefault();
    	loadScene('home');
    });
    $('body').on('click', '.to-home', function(e){
    	e.preventDefault();
    	loadScene('home');
    });
    
    $('body').on('click', '.li-pregunta', function(e){
    	e.preventDefault();
    	var datos = {id_pregunta : $(this).data('id')};
    	loadScene('storedQuestions', datos);
    });
    
    $('body').on('click', '.overlay-changes', function(e){
    	e.preventDefault();
    	$(this).fadeOut(500);
    });
    
    $('#challengeDoneModal').on('hidden.bs.modal', function (e) {
		loadScene('notifications');
	});
	
	$('#modalResultado').on('hidden.bs.modal', function(e){
		loadScene('notifications');
	});
});

function showAlert(texto){
	$('.overlay-changes .cambios-realizados h2').text(texto);
	$('.overlay-changes').fadeIn(500, function(){
		setTimeout(function(){
			$('.overlay-changes').fadeOut(500, function(){
				$('.overlay-changes .cambios-realizados h2').text('');
			});
		}, 5000);
	});	
}

function restartLives(){
	if(window.eltimeout){
		stayingAlive();
		$('.time-counter').hide();
		$('.lives').show();
	    $('.points.points-general').show();
	    $('.ranking.ranking-general').show();
	    $('<img src="images/cuchara.png"><img src="images/cuchara.png"><img src="images/cuchara.png">').appendTo('.lives');
		window.eltimeout = false;
	}
}

/*Si, es una referencia a los Beegees*/
function stayingAlive(){
	$.post('/restartLives', null, function(response){
		if(response.exito == 1){
			return true;
		}else{
			return false;
		}
	});
}

function secondWind(){
	$.post('/giveOne', null, function(response){
		if(response.exito == 1){
			return true;
		}else{
			return false;
		}
	});
}
function moarPoints(){
	$.post('/addManyPoints', null, function(response){
		if(response.exito == 1){
			return true;
		}else{
			return false;
		}
	});
}

function storeThisQuestion(idpregunta){
	var datos = {id_pregunta : idpregunta},
		resultado = false;

	$.ajax({
		url : '/players/storeQuestion',
		async: false,
		method : 'POST',
		data: datos
	}).done(function(response){
		if(response.exito == 1){
			resultado = true;
			showAlert('La pregunta ha sido guardada');
		}else{
			showAlert(response.msg);
		}
	});
	return resultado;
}

function loadingCharacter(){
	var personaje = '';
	var numberPersonaje = Math.floor((Math.random() * 4) + 1);
	var numberFrase = Math.floor((Math.random() * 4) + 1);
	var frases = Array(4);
	for(var i= 1; i<=4; i++){
		frases[i] = new Array(4);
	}
	frases[1][1] = '"Cállate o di algo mejor que el silencio."';
	frases[1][2] = '"Educad a los niños y no será necesario castigar a los hombres."';
	frases[1][3] = '"Escucha, serás sabio. El comienzo de la sabiduría es el silencio."';
	frases[1][4] = '"No despreciéis a nadie: un átomo hace sombra."';
	frases[2][1] = '"El mar dará a cada hombre una nueva esperanza, como el dormir le da sueños"';
	frases[2][2] = '"Las riquezas no hacen a un hombre mas rico, solo lo hacen mas ocupado"';
	frases[2][3] = '"El mar dará a cada hombre una nueva esperanza, como el dormir le da sueños"';
	frases[2][4] = '"Las riquezas no hacen a un hombre mas rico, solo lo hacen mas ocupado"';
	frases[3][1] = '"Sólo la unidad del pueblo y la solidaridad de sus dirigentes garantizan la grandeza de las naciones."';
	frases[3][2] = '"Sólo la unidad del pueblo y la solidaridad de sus dirigentes garantizan la grandeza de las naciones."';
	frases[3][3] = '"Por la corrupción del lenguaje empiezan otras muchas corrupciones..."';
	frases[3][4] = '"Los que no moderan pasiones son arrastrados a lamentables precipicios."';
	frases[4][1] = '"El estudio y, en general, la búsqueda de la verdad y la belleza conforman un área donde podemos seguir siendo niños toda la vida."';
	frases[4][2] = '"Es el verdadero arte del maestro despertar la alegría por el trabajo y el conocimiento"';
	frases[4][3] = '"La mente es como un paracaídas… Solo funciona si la tenemos abierta"';
	frases[4][4] = '"Todos somos muy ignorantes. Lo que ocurre es que no todos ignoramos las mismas cosas"';
	switch(numberPersonaje) {
	    case 1:
	  		personaje = 'load-pitagoras';
	  		autor = '<br> <strong>Pitágoras</strong>';
	    	break;
	    case 2:
	    	personaje = 'load-colon'
	    	autor = '<br> <strong>Cristóbal Colón</strong>';
	    	break;
	    case 3:
	    	personaje = 'load-bello'
	    	autor = '<br> <strong>Andrés Bello</strong>';
	    	break;
	    case 4:
	    	personaje = 'load-einstein'
	    	autor = '<br> <strong>Albert Einstein</strong>';
	    	break;	
	    default:
	    	personaje = 'load-pitagoras';
	    	autor = '<br> <strong>Pitágoras</strong>';
	    	break;
	}
	$('#load-character').removeClass().addClass(personaje);
	$('.load-frase').html(frases[numberPersonaje][numberFrase] + autor);
    
}

function loadScene(scene, parameters) {
	loadingCharacter();
	if(typeof window.roundTimer != 'undefined'){
		clearInterval(window.roundTimer);
	}
	if(scene == 'stage' || scene == '' || scene == 'home'){
		$('.bg-principal').removeClass('bg-preguntas');
		$('.top-menu').show();
		$('.el-ranking').show();
		scene = 'stage';
	}
	$('.pregunta-listo').off();
	$('.bg-loading').addClass('active');
	setTimeout(function(){
		$('.columna-menu').load('/refreshSidebar');
		$('#contenido-juego').load('/' + scene, parameters, function() {
	        $('.bg-loading').removeClass('active');
	        switch(scene){
				case 'trophies':
					$('.toTrophies').addClass('fix-active');
					break;
				case 'notifications':
					$('.toNotifications').addClass('fix-active');
					break;
				case 'challengeSelector':
					$('.to-profile').addClass('fix-active');
					$('.to-challenge').addClass('fix-active');
					break;
				case 'profile':
					$('.to-profile').addClass('fix-active');
					break;
				case 'hairyQuestions':
					$('.to-profile').addClass('fix-active');
					$('.to-brigidas').addClass('fix-active');
					break;		
			}	        
	    });
	}, 1500);
}
/*$(window).load(function(){
    $('#modalResultado').modal('show');
});*/