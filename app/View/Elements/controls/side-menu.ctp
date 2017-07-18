	<?php 
		$notificaciones = $this->Session->read('Session.Player.Notifications');
	?>
	<a href="#" class="list" id="to-home">
		<div class="menu-ico">
			<div class="air-5"></div>
			<div class="home-ico"></div>
		</div>
		<div class="text-list">
			<h2>Bienvenido a la<br>
				<span class="sporter">Etapa 2</span>
			</h2>
		</div>
	</a>
	<div class="relative" id="theMenu">
		<a href="#" class="list light to-profile">
			<div class="menu-ico">
				<div class="profile-ico"></div>
			</div>
			<div class="text-list">
				<div class="air-5"></div>
				<h3>
					<span class="sporter">Mi Perfil</span>
				</h3>
			</div>
			<i class="fa fa-caret-right"></i>
		</a>
		<ul class="submenu">
			<li><a href="#" class="to-profile">Modificar mis datos</a></li>
			<li><a href="#" class="to-challenge" data-toggle="tooltip" data-placement="right" title="<p>Suma puntos para subir en el ranking desafiando a tus amigos en un versus ¡¡de miedo!!<br/> Elige 10 preguntas de La Gran Prueba, selecciona tu oponente y desafíalo a responder tu test, si lo logra él se queda con los 50 puntos en juego, sino ¡son todos  tuyos!</p>">desafiar a un amigo</a></li>
			<li><a href="#" class="to-brigidas" data-toggle="tooltip" data-placement="right" title="<p>Aquí se acumularán las preguntas que selecciones, junta 10 y estarás listo para retar a un duelo a cualquiera de tus amigos a 1 un round y comprobar, en definitiva, quién es más seco!</p>">mis preguntas brigidas</a></li>
		</ul>
	</div>
	<div class="info">
		<div class="clearfix"></div>
		<div class="img-avatar-top">
			<img src="<?= $this->Session->read('Session.Player.profile_pic') ?>" class="avatar">
		</div>
		<div class="puntos-top">
			<div class="name"><?= $this->Session->read('Session.Player.fullname') ?></div>
			<div class="points points-general"><span><?= $this->Session->read('Session.Player.points') ?></span> Pts.</div>
			<div class="ranking ranking-general">Ranking <strong><?= $this->Session->read('Session.Player.rank_global') ?></strong></div>
			<div class="lives">
				<?php
					for($i=0; $i< $this->Session->read('Session.Player.lives'); $i++):
						echo '<img src="'.$this->Html->url('/').'images/cuchara.png">';
					endfor;
				?>
			</div>
			<div class="time-counter">
				<div class="air-5"></div>
				<span id="timer"></span>&nbsp; para tener vidas
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<span  data-toggle="modal" data-target="#inviteFriend">
		<a href="#" class="list light" data-toggle="tooltip" data-placement="right" title='Inicia a tus amigos en "La gran prueba”, has que ellos también puedan desafiar a los grandes del conocimiento y logren competir contra ti ó viceversa.'>
			<div class="menu-ico">
				<div class="invite-friend-ico"></div>
			</div>
			<div class="text-list">
				<h3>
					<span class="sporter">Invita un amigo</span>
				</h3>
			</div>
		</a>
	</span>



	<a href="#" class="list light toNotifications" data-toggle="tooltip" data-placement="right" title='<p>Aquí podrás enterarte de todo lo que está sucediendo en La Gran Prueba.</p>'>
		<div class="menu-ico">
			<?= ($notificaciones > 0) ? '<span class="badge notification-badge">'.$notificaciones.'</span>' : '';?>
			<div class="bell-ico"></div>
		</div>
		<div class="text-list">
			<div class="air-5"></div>
			<h3>
				<span class="sporter">Notificaciones</span>
			</h3>
		</div>
	</a>
	<a href="#" class="list light toTrophies" data-toggle="tooltip" data-placement="right" title='<p>Aquí podrás ver tus medallas y galardones y con ellos, los premios asociados a los puntajes obtenidos..</p>'>
		<div class="menu-ico">
			<div class="trofeo-ico"></div>
		</div>
		<div class="text-list">
			<div class="air-5"></div>
			<h3>
				<span class="sporter">Mis Trofeos</span>
			</h3>
		</div>
	</a>
	<div class="links-externos">
		<ul>
			<li><a href="http://www.preunab.cl/?_ga=1.214460830.806873815.1406730160" target="_blank"><div class="btn preunab-link"></div></a></li>
			<li><a href="http://www.orientaunab.cl/" target="_blank"><div class="btn orienta-preunab"></div></a></li>
			<li><a href="http://www.unab.cl" target="_blank"><div class="btn unab-link"></div></a></li>
			<li><p><small>Disponible en:</small></p><a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><div class="btn google-play"></div></a><a href="https://itunes.apple.com/us/app/preunab-la-gran-prueba-2/id1030403482?ls=1&mt=8" target="_blank"><div class="btn apple-store"></div></a></li>
		</ul>
	</div>
	<script>
		/**/
	</script>
	
<?php 
	if($this->Session->read('Session.Player.lives') <= 0){
		if($this->Session->read('Session.Player.wait') == 0){ ?>
		<script>
			window.eltimeout = true;
			restartLives();
		</script>
	<?php	}else{	?>
		<script>
			var seconds = <?= $this->Session->read('Session.Player.wait') ?>;
			console.log(seconds);
			timeout(seconds);
		</script><?php
		}
	} 
?>