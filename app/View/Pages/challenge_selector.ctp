<style>
	.face-azar{
		height: 51px;
	}
</style>
<ul class="nav-perfil">
	<li class="zindex3 to-profile"><h3><a href="#">modificar datos</a></h3></li>
	<li class="active zindex4"><h3><a href="#">desafiar a un amigo</a></h3></li>
	<li class="zindex2 to-brigidas"><h3><a href="#">preguntas brigidas</a></h3></li>
</ul>
<div class="profile-container">
	<div class="el-perfil">
		<div class="row">
			<div class="col-4">
				<div class="skewOut">
					<div class="el-postit">
						<h4>¡Desafía a tus amigos!</h4>
						<p>Para ganar más puntos, tienes 3 formas de desafiar:</p>
						<p>&bull; <i>Invitación por facebook</i> <br>&bull; <i>Invitación por mail</i> <br>&bull; <i>Al azar</i><br></p>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="skewOut">
					<div class="wrap">
						<h3>DESAFIA A UN <br>AMIGO DE FACEBOOK</h3>
					</div>
					<div class="la-linea"></div>
					<div class="wrap">
						<h3 class="al-azar">DESAFIO AL AZAR</h3>
                        <div class="face-azar-content" id="machineFake2">
							<?php 
                            	foreach($randomplayers as $id=>$player){
                            		echo '<div id="element-'.$id.'" class="face-azar" data-userid="'.$player['Players']['id'].'">
			                                <div class="mask-face"><img src="'.$player['Players']['profile_pic'].'"></div>
			                                <span>'.$player['Players']['fullname'].'</span>
			                            </div>';
                            	} 
                            ?>
                        </div>
                        <a href="#" class="el-btn-azar">Lanzar al azar</a>
					</div>
					<div class="la-linea sin-bg"></div>
					<div class="wrap">
						<h3>INVITACIÓN POR <br>MAIL</h3>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="air-4"></div>
				<div class="skewOut">
					<?php 
						if(count($lasguardadas)< 10){
					?>
						<div class="wrap">
							<a href="#" class="el-btn" data-toggle="modal" data-target="#modalNoDesafio">Desafía aquí<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="la-linea"></div>
						<div class="wrap">
	                        <a href="#" class="el-btn" data-toggle="modal" data-target="#modalNoDesafio">Desafía aquí<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="la-linea"></div>
						<div class="wrap">
	                        <a href="#" class="el-btn"  data-toggle="modal" data-target="#inviteFriend">Invitar<i class="fa fa-chevron-right"></i></a>
						</div>
						
					<?php		
						}else{
					?>
					
						<div class="wrap">
							<a href="#" class="el-btn get-fb-friends">Desafía aquí<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="la-linea"></div>
						<div class="wrap">
	                        <a href="#" class="el-btn desafia-random" data-targetid="-1">Desafía aquí<i class="fa fa-chevron-right"></i></a>
						</div>
						<div class="la-linea"></div>
						<div class="wrap">
	                        <a href="#" class="el-btn"  data-toggle="modal" data-target="#inviteFriend">Invitar<i class="fa fa-chevron-right"></i></a>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="el-clip"></div>
</div>

<div class="modal fade" id="modalFacebookFriends" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog invita desafia">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">Desafia Amigos de Facebook</h4>
			</div>
			<div class="modal-body">
				<div id="fb-friends-playing" class="text-center"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalNoDesafio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog invita">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">No puedes desafiar</h4>
			</div>
			<div class="modal-body">
				<p>Necesitas 10 preguntas guardadas para desafiar, llevas <?=count($lasguardadas)?></p>
				<br/>
				<div class="text-center">
		            <a href="#" class="btn-salir" data-dismiss="modal">Volver</a>
		        </div>
		        <br/>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(document).ready(function(){
		$('body').off('click', '.el-btn-azar').on('click', '.el-btn-azar', function(e){
			e.preventDefault();
			slot.shuffle(30, function(index){
				var id = '#element-' + index;
				var userid = $(id).data('userid');
				$('.desafia-random').data('targetid', userid);
			});
		});
	});
	var slot = $("#machineFake2").slotMachine({
		active	: 0,
		delay	: 300,
		repeat: true,
		randomize : function(activeElementIndex){
			var maximus = $('.face-azar-content .face-azar').length;
			var random = Math.floor((Math.random() * maximus) + 1);
			return random
		}
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
	
	$('body').on('submit', '.form-amigos form', function(e){
		e.preventDefault();
	});
	
	$('body').off('click', '.desafia-random').on('click', '.desafia-random', function(e){
		e.preventDefault();
		var id_desafiado = $(this).data('targetid');
		var esto = $(this);
		if(id_desafiado != -1){
			$.post('/players/issueChallengeUponThee', {"id_desafiado": id_desafiado}, function(response){
				if(response.exito == 1){
					$('#challengeDoneModal').modal({
						keyboard: false,
						backdrop: 'static'
					});
				}
			});
		}else{
			slot.shuffle(30, function(index){
				var id = '#element-' + index;
				var userid = $(id).data('userid');
				$('.desafia-random').data('targetid', userid);
				esto.click();
			});
		}
	});
	
	
	$('body').off('click', '.btn-desafiar').on('click', '.btn-desafiar', function(e){
		var id_desafiado = $(this).data('targetid');
		$.post('/players/issueChallengeUponThee', {"id_desafiado": id_desafiado}, function(response){
			if(response.exito == 1){
				var modal =$('.modal.fade.in');
				if(modal.length == 0){
					
				}else{
					modal.modal('hide');
				}
				$('#challengeDoneModal').modal({
					keyboard: false,
					backdrop: 'static'
				});
				
			}
		});
	});
	$('body').off('click', '.get-fb-friends').on('click', '.get-fb-friends', function(e){
		var APPID = "481530158619215"
		var uri = encodeURI('http://lagranprueba.preunab.cl/?fbregister=1');
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
									//console.log('error en fb.api $.ajax:', err);
								}
							}).done(function(response){
								//console.log('done:', response);
								$('#fb-friends-playing').html(response);
								$('#modalFacebookFriends').modal('show');
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
