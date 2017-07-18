$(document).ready(function(){
	$('body').on('change', '#SelectorRegion', function(e){
    	e.preventDefault();
    	var id_region = $(this).val();
    	$.get('/updateCiudades', {id_region : id_region}, function(response){
    		$('#SelectorComuna').html(response);
    	});
    });	

    $('body').on('submit', '#FormRegistro', function(e){
		e.preventDefault();
		$.post('/players/register', $(this).serialize(), function(response){
			console.log('Responde registro', response);
			if(response.exito == 1){
				location.reload();
			}else{
                $('.bubble').text(response.msg).show(500, function(){
                    setTimeout(function(){
                        $('.bubble').hide(500);
                    }, 5000);
                });
			}
		});
    });
    
    $('body').on('submit', '#FormLogin', function(e){
		e.preventDefault();
		$.post('/players/login', $(this).serialize(), function(response){
			if(response.exito == 1){
				location.reload();
			}else{
                $('.bubble').text(response.msg).show(500, function(){
                    setTimeout(function(){
                        $('.bubble').hide(500);
                    }, 5000);
                });
			}
		});
    });
    
    $('body').on('submit', '#FormResetPassword', function(e){
    	e.preventDefault();
   		var inputemail = $('#ResetPasswordEmail').val();
    	if(inputemail != ''){
    		var datos = {email:inputemail};
    		$.post('/players/sendResetPassword', datos, function(respuesta){
				if(respuesta.exito == 1){
					$('#AlertaPassword').text('');
					$('#AlertaPassword').text(respuesta.msg);
    				$('#AlertaPassword').show(200);
    				setTimeout(function(){
		    			$('#AlertaPassword').hide(200);
		    		}, 5000);
				}else{
					$('#AlertaPassword').text('');
					$('#AlertaPassword').text(respuesta.msg);
    				$('#AlertaPassword').show(200);
    				setTimeout(function(){
		    			$('#AlertaPassword').hide(200);
		    		}, 5000);
				}
    		});
    	}else{
    		$('#AlertaPassword').text('El mail no puede ser vacio');
    		$('#AlertaPassword').show(200);
    		setTimeout(function(){
    			$('#AlertaPassword').hide(200);
    		}, 5000);
    	}
    });
    
    $(".soy-nuevo").click(function(e){
		e.preventDefault();
		$(".ingresa, .olvida").hide();
		$(".registra").fadeIn(300);
    });

    $(".la-olvide").click(function(e){
		e.preventDefault();
		$(".ingresa, .registra").hide();
		$(".olvida").fadeIn(300);
    });

    $(".estoy-registrado").click(function(e){
    	e.preventDefault();
        $(".registra, .olvida").hide();
        $(".ingresa").fadeIn(300);
    });
    
});
