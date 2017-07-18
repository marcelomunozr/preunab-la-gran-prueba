MODAL INVITE FRIEND-->
<div class="modal fade bs-example-modal-sm" id="inviteFriend" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm invita">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">INVITA UN AMIGO</h4>
			</div>
			<div class="modal-body">
				<form class="form-group form-invite" >
					<div class="row">
						<div class="col-xs-12 text-center">
							<p>Ingresa nombre y mail de un amigo para desafiarlo a jugar en La Gran Prueba</p>
							<div class="form-group">
								<input type="text" class="form-control" name="nombreAmigo" placeholder="Nombre de tu amigo">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="emailAmigo" placeholder="email.amigo@ejemplo.com">
							</div>
							<button type="submit" class="btn inviteFriend-btn">Enviar <i class="fa fa-angle-right"></i></button>
							<div class="clearfix"></div>
							<div class="alert" style="display:none;"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- FIN MODAL -->
<!-- MODAL Challenge accepted-->
<div class="modal fade bs-example-modal-sm" id="challengeDialog" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm invita">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">¡Aceptaste el desafío!</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 text-center">
						<p>Aceptaste el desafío y jugarás una ronda de 10 preguntas, ¡Si pierdes los puntos se los llevará tu desafiante!</p>
						<div class="clearfix"></div>
						<br />
						<div class="text-center">
				            <a href="#" class="btn-salir"><i class="fa fa-chevron-left"></i>Volver</a>
				            <a href="#" class="btn-empezar btn-modal-verde">Empezar<i class="fa fa-chevron-right"></i></a>
				        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FIN MODAL -->
<!-- MODAL TE LO PITEASTE (lo desafiaste)-->
<div class="modal fade bs-example-modal-sm" id="challengeDoneModal" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm invita">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">¡Has enviado un desafío!</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 text-center">
						<p>Le enviaste las preguntas guardadas a uno de tus amigos para desafiarlo, ¡Si se equivoca, los puntos serán tuyos!</p>
						<div class="clearfix"></div>
						<br />
						<div class="text-center">
				            <a href="#" class="btn-salir" data-dismiss="modal"><i class="fa fa-chevron-left"></i>Volver</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FIN MODAL -->

<!-- MODAL RESULTADO DEL DESAFIO -->
<div class="modal fade bs-example-modal-sm" id="modalResultado" tabindex="-1" role="dialog" aria-labelledby="resultadoLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm invita result">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">Desafío a un amigo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h4>Has ganado <span>180 Puntos</span> en el desafío con <span>Roberto Acosta</span></h4>
						<div class="clearfix"></div>
						<br />
						<div class="text-center">
				            <a href="#" class="btn-empezar btn-modal-verde" data-dismiss="modal" aria-label="Close">Finalizar<i class="fa fa-chevron-right"></i></a>
				        </div>
					</div>
				</div>
			</div>
			<div class="master-bullying">
				<span class="the-master"></span>
			</div>
		</div>
	</div>
</div>
<!-- FIN MODAL -->



<!-- showed -->
<!-- <div class="modal fade bs-example-modal-sm" id="modalChangeDay" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm invita">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">Extendemos el plazo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h4 style="color: #08305c;text-shadow:none;font-size:17px;">Tienes hasta el <span style="color: #0068e7;">5 de julio</span> para terminar la primera etapa y ser el ganador de entretenidos premios.</h4>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<!-- GANADORES PRIMERA ETAPA -->
<div class="modal fade bs-example-modal-sm" id="winnersModal" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm invita etapaUno">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
				<h4 class="modal-title text-center">¡FELICITAMOS A LOS GANADORES QUE FINALIZARON <br>LA SEGUNDA ETAPA!</h4>
			</div>
			<div class="modal-body">
				<img src="images/modal-late.png" alt="Ganadores">
			</div>
		</div>
	</div>
</div>

<!-- FIN MODAL