
<div id="carousel-iff" class="carousel slide iff" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
<?php 
	foreach($jugando as $jugador){
		echo '
		<li>
			<div class="row antiSkewX">
				<div class="col-xs-4">
					<div class="la-mascara text-center"><img src="http://graph.facebook.com/'.$jugador['Players']['facebook_id'].'/picture?type=normal" class="desafia-avatar-friend"></div>
				</div>
				<div class="col-xs-8 text-left">
					<span>'.$jugador['Players']['fullname'].'</span>
					<div class="cleardix"><a href="#" class="btn-desafiar" data-targetid="'.$jugador['Players']['id'].'">Desafiar</a></div>
				</div>
			</div>
		</li>';
	}

?>
    </div>
  </div>

	<!-- Controles -->
	<a class="left carousel-control" href="#carousel-iff" role="button" data-slide="prev">
		<i class="fa fa-caret-left"></i>
	</a>
	<a class="right carousel-control" href="#carousel-iff" role="button" data-slide="next">
		<i class="fa fa-caret-right"></i>
	</a>
</div>