<h4 class="subttl">DESAFÍA AQUÍ</h4>
<p>Guarda <strong>10 Preguntas Brigidas</strong> y desafía a tus amigos para obtener más puntos.</p>
<?php if(count($this->Session->read('Session.Player.StoredQuestion')) < 10 ){
	echo '<h2>Aun no tienes las 10 preguntas necesarias</h2>'; ?>
	<script>
		$('section .profile').addClass('desafia');
		$('section .profile').removeClass('profile');
		$('.profile-content').addClass('desafia-content');
		$('.profile-content').removeClass('profile-content');
		$('.titulo-layout').text('Preguntas Brigidas');
	</script>
<?php }else{ ?>
<ul class="nav-tabs">
	<li class="active tab-selector" data-tab="desAmigos" id="toAmigos">Amigos</li>
	<li class="tab-selector" id="toAzar" data-tab="desAzar">Al Azar</li>
	<li class="tab-selector" id="toInvita" data-tab="desInvita">Invita a un amigo</li>
</ul>
<div class="los-desafios" id="desAmigos">
	<ul class="desafia-list">
		<li><a href="#" class="get-fb-friends">Cargar lista de amigos jugando</a></li>
	</ul>
</div>
<div class="clearfix"></div>
<div class="los-desafios" id="desAzar" style="display:none;">
	<div class="azar-list">
<!--
	<ul class="azar-list">
		<li>
-->
		<div class="azar-select-wrapper">
			<div class="azar-select" id="machineFake2" style="height: 50px">
				<?php
					$ct = 1;
					foreach($randomplayers as $player){
						echo '<div class="slot slot'.$ct.'" data-targetid="'.$player['Players']['id'].'"><img src="http://graph.facebook.com/'.$player['Players']['facebook_id'].'/picture?type=normal" class="desafia-avatar"><span>'.$player['Players']['fullname'].'</span></div>';
						$ct += 1;
					} 
				?>
			</div>
		</div>
		<a href="#" class="btn-azar" id="btn-azar">Lanzar al azar<i class="ico-palanca"></i></a>
		<div class="clearfix"></div>
		<div class="text-center">
			<a href="#" class="btn-continuar">Desafiar<i class="fa fa-chevron-right"></i></a>
		</div>
		<div class="clearfix"></div>
<!--
		</li>
	</ul>
-->
	</div>
</div>
<div class="clearfix"></div>
<div class="los-desafios" id="desInvita" style="display:none;">
	<ul class="desafia-list">

		<!--<li><img src="http://graph.facebook.com/5021146/picture?type=normal" class="desafia-avatar"><span>Gabriela Farías Godoy</span><a href="#" class="btn-continuar pull-right">Invitar<i class="fa fa-chevron-right"></i></a></li>
		<li><img src="http://graph.facebook.com/5021146/picture?type=normal" class="desafia-avatar"><span>Gabriela Farías Godoy</span><a href="#" class="btn-continuar pull-right">Invitar<i class="fa fa-chevron-right"></i></a></li>
		<li><img src="http://graph.facebook.com/5021146/picture?type=normal" class="desafia-avatar"><span>Gabriela Farías Godoy</span><a href="#" class="btn-continuar pull-right">Invitar<i class="fa fa-chevron-right"></i></a></li>
		-->
	</ul>
</div>
<script>
	$(document).ready(function(){

		var slot = $("#machineFake2").slotMachine({
			active	: 0,
			delay	: 300,
			repeat: true,
			randomize : function(activeElementIndex){
				var maximus = $('.azar-select .slot').length;
				var random = Math.floor((Math.random() * maximus) + 1);
				return random
			}
		});

		$('body').off('click', '#btn-azar').on('click', '#btn-azar', function(){
			slot.shuffle(2);
		});
	});
	$('section .profile').addClass('desafia');
	$('section .profile').removeClass('profile');
	$('.profile-content').addClass('desafia-content');
	$('.profile-content').removeClass('profile-content');
	$('.titulo-layout').text('Preguntas Brigidas');
	$('.tab-selector').click(function(e){
		var tab = '#' + $(this).data('tab');
		$('.nav-tabs li').removeClass('active');
		$(this).addClass('active');
		$('.los-desafios').hide();
		$(tab).fadeIn(300);
		e.preventDefault();
	});
	$('body').off('click', '.btn-desafiar').on('click', '.btn-desafiar', function(e){
		var id_desafiado = $(this).data('targetid');
		$.post('/players/issueChallengeUponThee', {"id_desafiado":id_desafiado}, function(response){
			console.log('Vino de la app', response);
		});
	});
	$('body').off('click', '.get-fb-friends').on('click', '.get-fb-friends', function(e){
		var APPID = "481530158619215"
		var uri = encodeURI('http://lagranprueba2.multinetlabs.com/?fbregister=1');
		FB.getLoginStatus(function(response) {
			if(response.status == 'connected'){
				FB.api('/me/permissions', function(response){
					var permisoAmigos = false;
					$.each(response.data, function(key, value){
						if(value.permission == 'user_friends' && value.status == 'granted'){
							permisoAmigos = true;
						}
					});
					if(!permisoAmigos){
						window.location = encodeURI("https://www.facebook.com/dialog/oauth?client_id=" + APPID + "&redirect_uri="+uri+"&response_type=token&scope=email,user_friends");
					}else{
						FB.api('/me/friends', function(respuesta){
							$.ajax({
								url : '/players/checkFriends',
								type : 'POST',
								data : JSON.stringify(respuesta.data),
								error: function(err){
									console.log('error en fb.api $.ajax:', err);
								}
							}).done(function(response){
								console.log('done:', response);
								$('#desAmigos .desafia-list').html(response);
							});

						});
					}
				});
			}else{
				window.location = encodeURI("https://www.facebook.com/dialog/oauth?client_id=" + APPID + "&redirect_uri="+uri+"&response_type=token&scope=email,user_friends");
			}
		});
		e.preventDefault();
	});
</script>
<?php } ?>