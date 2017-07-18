<ul class="nav-perfil">
	<li class="active zindex4"><h3><a href="#">modificar datos</a></h3></li>
	<li class="zindex3 to-challenge"><h3><a href="#">desafiar a un amigo</a></h3></li>
	<li class="zindex2 to-brigidas"><h3><a href="#">preguntas brigidas</a></h3></li>
</ul>
<div class="profile-container">
	<div class="el-perfil">
		<div class="row">
			<div class="col-4">
				<div class="skewOut">
					<div class="el-avatar">
						<a href="#">
    						<img src="<?= $this->Session->read('Session.Player.profile_pic'); ?>">
    						<div class="camera">
    							<div class="camera-ico"></div>
    						</div>
						</a>
					</div>
					<div class="text-center">
						<!--<a href="#">Cambiar mi foto</a>-->
					</div>
					<div class="la-linea"></div>
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= $this->Session->read('Session.Player.fullname') ?></h3>
							<a href="#" class="dragon-call">Editar mi nombre</a>
						</div>
						<div class="hidden-dragon">
							<form class="hidden-dragon-form">
								<input type="hidden" name="data[Player][fieldname]" value="fullname">
								<input type="text" name="data[Player][fullname]" id="PlayerFullname" value="<?= $this->Session->read('Session.Player.fullname') ?>">
								<div class="clearfix"></div>
								<button type="submit" class="btn btn-success btn-xs">Editar</button>
								<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="skewOut">
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= $this->Session->read('Session.Player.rut') ?></h3>
							<a href="#" class="dragon-call">Editar mi Rut</a>
						</div>
						<div class="hidden-dragon">
							<form class="hidden-dragon-form">
								<input type="hidden" name="data[Player][fieldname]" value="rut">
								<input type="text" name="data[Player][rut]" class="rut" id="PlayerRut" value="<?= $this->Session->read('Session.Player.rut') ?>">
								<div class="clearfix"></div>
								<button type="submit" class="btn btn-success btn-xs">Editar</button>
								<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
							</form>
						</div>
						
					</div>
					<div class="la-linea"></div>
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= $this->Session->read('Session.Player.phone') ?></h3>
							<a href="#" class="dragon-call">Editar mi teléfono</a>
						</div>
						<div class="hidden-dragon">
							<form class="hidden-dragon-form">
								<input type="hidden" name="data[Player][fieldname]" value="phone">
								<input type="text" name="data[Player][phone]" id="PlayerPhone" value="<?= $this->Session->read('Session.Player.phone') ?>">
								<div class="clearfix"></div>
								<button type="submit" class="btn btn-success btn-xs">Editar</button>
								<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
							</form>
						</div>
					</div>
					<div class="la-linea"></div>
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= $this->Session->read('Session.Player.email') ?></h3>
							<a href="#" class="dragon-call">Editar mi email</a>
						</div>
						<div class="hidden-dragon">
							<form class="hidden-dragon-form">
								<input type="hidden" name="data[Player][fieldname]" value="email">
								<input type="text" name="data[Player][email]" id="PlayerEmail" value="<?= $this->Session->read('Session.Player.email') ?>">
								<div class="clearfix"></div>
								<button type="submit" class="btn btn-success btn-xs">Editar</button>
								<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="skewOut">
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= $this->Session->read('Session.Player.colegio') ?></h3>
							<a href="#" class="dragon-call">Editar mi Colegio</a>
						</div>
						<div class="hidden-dragon">
							<form class="hidden-dragon-form">
								<input type="hidden" name="data[Player][fieldname]" value="colegio">
								<input type="text" name="data[Player][colegio]" id="PlayerColegio" value="<?= $this->Session->read('Session.Player.colegio') ?>">
								<div class="clearfix"></div>
								<button type="submit" class="btn btn-success btn-xs">Editar</button>
								<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
							</form>
						</div>
					</div>
					<div class="la-linea"></div>
					<div class="text-center">
						<div class="crouching-tiger">
							<h3><?= ($this->Session->read('Session.Player.city_id') != '') ? $ciudades_lista[$this->Session->read('Session.Player.city_id')] : 'Sin Ciudad'; ?></h3>
							<a href="#" class="dragon-call">Editar mi ciudad</a>
						</div>
						<div class="hidden-dragon">
							<div class="col-md-12">
								<form class="hidden-dragon-form">
									<input type="hidden" name="data[Player][fieldname]" id="PlayerFieldName" value="city_id">
									<select name="data[Player][id_region]" id="SelectorRegion" class="form-control input-sm" required>
										<option value="">Seleccione su región</option>
							           	<?php
											foreach($regiones as $id=>$region){
												if($region_id == $id){
													echo '<option selected value="'.$id.'">'.$region.'</option>';
												}else{	
													echo '<option value="'.$id.'">'.$region.'</option>';
												}
											} ?>
									</select>
									<br />
									<select name="data[Player][city_id]" id="SelectorComuna" class="form-control input-sm" required>
										<?php 
											if(count($ciudades) > 0){
												echo '<option value="">Seleccione su ciudad</option>';
												foreach($ciudades as $ciudad){
													if($ciudad['id'] == $this->Session->read('Session.Player.city_id')){
														echo '<option selected value="'.$ciudad['id'].'">'.$ciudad['name'].'</option>';
													}else{
														echo '<option value="'.$ciudad['id'].'">'.$ciudad['name'].'</option>';
													}
												}
											}else{
												echo '<option value="">Seleccione región primero</option>';
											}
										?>
									</select>
									<?php ?>
									<div class="clearfix"></div>
									<button type="submit" class="btn btn-success btn-xs">Editar</button>
									<button class="hide-dragon btn btn-success btn-danger btn-xs">Cancelar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="both"></div>
		</div>
	</div>
	<div class="el-clip"></div>
</div>
<style>
	
</style>
<script>

	$("input.rut").rut({
		formatOn: 'keyup',
		validateOn: 'change' // si no se quiere validar, pasar null
	});
	$('body').on('submit', '.hidden-dragon-form', function(e){
		e.preventDefault();
		var data	= $(this).serialize();
		var label	= $(this).parents('.text-center').find('.crouching-tiger h3');
		var parent	= $(this).parents('.hidden-dragon');
		$.post('/players/editProfileField.json', data, function(response){
			if(response.exito == 1){
				label.text(response.new_field);
				parent.hide();
				parent.prev('.crouching-tiger').show();
				$('.columna-menu').load('/refreshSidebar');
			}else if(response.exito == 0){
				parent.hide();
				parent.prev('.crouching-tiger').show();
			}
		});
	});
	
	$('body').on('change', '#SelectorRegion', function(e){
    	e.preventDefault();
    	var id_region = $(this).val();
    	$.get('/updateCiudades', {id_region : id_region}, function(response){
    		$('#SelectorComuna').html(response);
    	});
    });
	
	$('body').on('click', '.dragon-call', function(e){
		e.preventDefault();
		$(this).parent().hide();
		$(this).parent().next('.hidden-dragon').show();
	});
	
	$('body').on('click', '.hide-dragon', function(e){
		e.preventDefault();
		var parent = $(this).parents('.hidden-dragon');
		parent.hide();
		parent.prev('.crouching-tiger').show();
	})
</script>