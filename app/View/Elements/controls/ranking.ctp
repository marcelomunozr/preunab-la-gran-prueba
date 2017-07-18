<div class="el-ranking">
    <div class="btn-ranking"></div>
    <div class="content-ranking">
        <div id="carousel-ranking" class="carousel slide carousel-ranking" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
				<?php 
					$ct = 0;
					foreach($this->Session->read('Session.Ranking') as $ranking){ ?>
				<div class="item <?= ($ct == 0)? 'active': ''; ?>">
					<div class="rank-ttl">
                        <h4><?= $ranking['titulo'] ?></h4>
                        <a class="left carousel-control" href="#carousel-ranking" role="button" data-slide="prev">
                            <i class="fa fa-caret-left"></i>
                        </a>
                        <a class="right carousel-control" href="#carousel-ranking" role="button" data-slide="next">
                            <i class="fa fa-caret-right"></i>
                        </a>
                    </div>
                    <?php foreach($ranking['jugadores'] as $id=>$players){?>
					<div class="rank">
						<div class="numbr"><?= $id + 1; ?></div>
						<img src="<?= $players['Players']['profile_pic']?>" class="avatar-ranking">
						<div class="txt-ranking">
							<h5><?= $players['Players']['fullname']?></h5>
							<span class="puntaje"><?= (isset($players['Players']['points']))? $players['Players']['points'] : $players[0]['points']; ?></span>
						</div>
					</div>
                    <?php } ?>
				</div>
				<?php $ct += 1; } ?>
            </div>
        </div> 
    </div>
</div>
<script>
    $('.carousel-ranking').carousel({
        pause: true,
        interval: false
    });
</script>



