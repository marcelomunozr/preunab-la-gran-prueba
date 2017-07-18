	<header class="preguntas-top bg-azul">
		<h2 class="titulo-layout">Mis Trofeos</h2>
	</header>
	<section class="the-trophies">
		<div class="arrow-trophies text-center">
			<div class="arrows-title">
				<h2>Resumen</h2>
				<a class="left carousel-control transitions" href="#carrusel-trophies" role="button" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="right carousel-control transitions" href="#carrusel-trophies" role="button" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="trophies-content">
			<div class="container">
				<div id="carrusel-trophies" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<div class="trophies-box">
								<div class="text-center bg-azul">
									<h3>Materias generales</h3>
								</div>
								<div class="cajas">
									<div class="col-xs-3 text-center">
										<div class="materia-caja">
											<h6>matemáticas</h6>
										</div>
										<div class="galardon">
                                            <span class="<?= ($orden[4]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[5]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[6]['obtained'] == false) ? 'trofeo-mate-off' : 'trofeo-mate'; ?>"></span>
                                        </div>
									</div>
									<div class="col-xs-3 text-center">
										<div class="materia-caja">
											<h6>lenguaje</h6>
										</div>
										<div class="galardon">
                                            <span class="<?= ($orden[1]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[2]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[3]['obtained'] == false) ? 'trofeo-lenguaje-off' : 'trofeo-lenguaje'; ?>"></span>
                                        </div>
										<!--<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-lenguaje-off"></span>
										</div>-->
									</div>
									<div class="col-xs-3 text-center">
										<div class="materia-caja">
											<h6>historia</h6>
										</div>
										<div class="galardon">
                                            <span class="<?= ($orden[7]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[8]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[9]['obtained'] == false) ? 'trofeo-historia-off' : 'trofeo-historia'; ?>"></span>
                                        </div>
										<!--<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-historia-off"></span>
										</div>-->
									</div>
									<div class="col-xs-3 text-center">
										<div class="materia-caja">
											<h6>ciencias</h6>
										</div>
										<div class="galardon">
                                            <span class="<?= ($orden[10]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[11]['obtained'] == false) ? 'la-medalla-off' : 'la-medalla'; ?>"></span>
                                        </div>
                                        <div class="galardon">
                                            <span class="<?= ($orden[12]['obtained'] == false) ? 'trofeo-ciencias-off' : 'trofeo-ciencias'; ?>"></span>
                                        </div>
										<!--<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-ciencias-off"></span>
										</div>-->
									</div>
								</div>
							</div>
							<div class="trophies-box">
								<div class="text-center bg-azul">
									<h3>Materias específicas</h3>
								</div>
								<div class="cajas">
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>biología</h6>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-mate-off"></span>
										</div>
									</div>
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>química</h6>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-lenguaje-off"></span>
										</div>
									</div>
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>física</h6>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="la-medalla-off"></span>
										</div>
										<div class="galardon">
											<span class="trofeo-historia-off"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="trophies-box">
								<div class="text-center bg-azul">
									<h3>Trofeos Supremos</h3>
								</div>
								<div class="cajas">
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>copa lgp bronce</h6>
										</div>
										<div class="galardon">
											<span class="trofeo-mate-off"></span>
										</div>
									</div>
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>copa lgp plata</h6>
										</div>
										<div class="galardon">
											<span class="trofeo-lenguaje-off"></span>
										</div>
									</div>
									<div class="col-xs-4 text-center">
										<div class="materia-caja">
											<h6>copa lgp oro</h6>
										</div>
										<div class="galardon">
											<span class="trofeo-historia-off"></span>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>

						<!-- MATEMATICAS -->
				<!--		<div class="item">
							<div class="trophies-box awards">
								<div class="text-center">
									<span class="la-medalla-big-off"></span>
									<span class="trofeo-mate-big-off"></span><!-- <span class="trofeo-mate-off-big"></span> -->
				<!--					<span class="la-medalla-big-off"></span>
								</div>
								<div class="text-center">
									<div class="ttl-awards">
										<div class="wrapper">
											<h4>Etapa 1</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards">
										<div class="wrapper bg-amarillo">
											<h4>Etapa 3</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards off">
										<div class="wrapper">
											<h4>Etapa 2</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- LENGUAJE -->
			<!--			<div class="item">
							<div class="trophies-box awards">
								<div class="text-center">
									<span class="la-medalla-big-off"></span>
									<span class="trofeo-lenguaje-big-off"></span><!-- <span class="trofeo-lenguaje-off-big"></span> -->
			<!--						<span class="la-medalla-big-off"></span>
								</div>
								<div class="text-center">
									<div class="ttl-awards">
										<div class="wrapper">
											<h4>Etapa 1</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards">
										<div class="wrapper bg-amarillo">
											<h4>Etapa 3</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards off">
										<div class="wrapper">
											<h4>Etapa 2</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- HISTORIA -->
					<!--	<div class="item">
							<div class="trophies-box awards">
								<div class="text-center">
									<span class="la-medalla-big-off"></span>
									<span class="trofeo-historia-big-off"></span><!-- <span class="trofeo-historia-off-big"></span> -->
					<!--				<span class="la-medalla-big-off"></span>
								</div>
								<div class="text-center">
									<div class="ttl-awards">
										<div class="wrapper">
											<h4>Etapa 1</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards">
										<div class="wrapper bg-amarillo">
											<h4>Etapa 3</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards off">
										<div class="wrapper">
											<h4>Etapa 2</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- CIENCIAS -->
						<!--<div class="item">
							<div class="trophies-box awards">
								<div class="text-center">
									<span class="la-medalla-big-off"></span>
									<span class="trofeo-ciencias-big-off"></span><!-- <span class="trofeo-ciencias-off-big"></span> -->
						<!--			<span class="la-medalla-big-off"></span>
								</div>
								<div class="text-center">
									<div class="ttl-awards">
										<div class="wrapper">
											<h4>Etapa 1</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards">
										<div class="wrapper bg-amarillo">
											<h4>Etapa 3</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
									<div class="ttl-awards">
										<div class="wrapper">
											<h4>Etapa 2</h4>
											<h5>Misión cumplida</h5>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>!-->
					<!-- BULLET -->
					<ol class="carousel-indicators">
						<li data-target="#carrusel-trophies" data-slide-to="0" class="active"></li>
					<!--	<li data-target="#carrusel-trophies" data-slide-to="1"></li>
						<li data-target="#carrusel-trophies" data-slide-to="2"></li>
						<li data-target="#carrusel-trophies" data-slide-to="3"></li>
						<li data-target="#carrusel-trophies" data-slide-to="4"></li>-->
					</ol>

				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>