<!-- <img src="images/ingresa-banner.png" class="img-responsive img-center img-banner-ingresa"> -->
<div class="overlay-movil">
    <div class="download-app">
        <h2><strong>Para comenzar esta experiencia, descarga la aplicación y luego regístrate.</strong></h2>
        <a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><div class="play-logo"></div></a>
    </div>
</div>
<div class="hide-app">
    <div class="ingresa">
        <p class="ingreso-txt">Si estás aquí es porque te gustan los desafíos y quieres llegar bien preparado a la PSU. PREUNAB, el preuniversitario gratuito de la Universidad Andrés Bello, te invita a desafiar a uno de estos grandes personajes del conocimiento. <br><strong>Para comenzar esta experiencia, regístrate.</strong></p>
        <div class="txt-center air-20">
            <button class="fb-login">
                <i class="fa fa-facebook"></i>
                <span>Ingresa con facebook</span>
            </button>
        </div>
        <div class="ingresa-form">
            <form action="#" id="FormLogin">
                <input name="data[Players][email]" id="LoginEmail" type="email" placeholder="Email" required>
                <input name="data[Players][password]" id="LoginPassword" type="password" placeholder="Contraseña" required>
                <input type="submit" value="Ingresar" class="submit">
                <div class="first-wrap"><p class="txt-center"><small><a href="#" class="soy-nuevo"><i>¿Eres nuevo usuario?</i></a> / <a href="#" class="la-olvide"><i>¿Olvidaste tu contraseña?</i></a></small></p></div>
            </form>
        </div>
    </div>

    <div class="registra">
        <div class="ingresa-form">
            <div class="txt-center"><h2>Regístrate</h2></div>
            <form action="#" id="FormRegistro" >
                <input id="FormFullname" name="data[Players][fullname]" type="text" placeholder="Nombre" required>
                <input id="FormRut" name="data[Players][rut]" type="text" placeholder="Rut" required>
                <input id="FormTelephone" name="data[Players][phone]" type="text" placeholder="Teléfono" required>
                <input id="FormEmail" name="data[Players][email]" type="email" placeholder="Email" required>
                <input id="FormPassword" name="data[Players][password]" type="password" placeholder="Contraseña" required>
                <select name="data[Players][id_region]" id="SelectorRegion" required>
                    <option value="">Seleccione su región</option>
                    <?php foreach($regiones as $id=>$region){ echo '<option value="'.$id.'">'.$region.'</option>';} ?>
                </select>
                <select name="data[Players][city_id]" id="SelectorComuna" required>
                    <option value="">Seleccione región primero</option>
                </select>
                <input id="FormIdColegio" name="data[Players][colegio]" type="text" placeholder="Colegio" required>
                <input id="FormIdFacebookId" name="data[Players][facebook_id]" type="hidden" value="">
                <input type="submit" value="Registrar" class="submit">
                <div class="first-wrap"><p class="txt-center"><small><a href="#" class="estoy-registrado"><i>¿Ya estás registrado?</i></a> / <a href="#" class="la-olvide"><i>¿Olvidaste tu contraseña?</i></a></small></p></div>
            </form>
        </div>
    </div>
    <div class="olvida">
        <div class="txt-center air-20">
            <a href="#" class="fb-login"><img src="images/ingresa-facebook.jpg" alt="Ingresar con Facebook" class="center"></a>
        </div>
        <div class="ingresa-form">
            <form action="#" id="FormResetPassword">
                <input id="ResetPasswordEmail" name="email" type="email" placeholder="Email" required>
                <input type="submit" value  ="Recuperar contraseña" class="submit">
                <p class="alerta-request" id="AlertaPassword" style="display:none;"></p>
                <div class="first-wrap"><p class="txt-center"><small><a href="#" class="soy-nuevo"><i>¿Eres nuevo usuario?</i></a> / <a href="#" class="estoy-registrado"><i>¿Ya estás registrado?</i></a></small></p></div>
            </form>
        </div>
    </div>
    <div class="el-ranking veteranos">
        <!-- <div class="btn-ranking"></div> -->
        <div class="content-ranking">
            <div class="el-ttl">
                <h6>Veteranos 2014</h6>
                <p>Ellos fueron discípulos, ahora son veteranos y testigos del éxito con La Gran Prueba.</p>
            </div>
            <div class="rank" data-veterano="veterano1">
                <div class="numbr">1</div>
                <img src="images/veterano1.jpg" class="avatar-ranking">
                <div class="txt-ranking">
                    <h5>C. Mellado</h5>
                    <span class="puntaje">832 pts.</span>
                </div>
            </div>

            <div class="rank" data-veterano="veterano2">
                <div class="numbr">2</div>
                <img src="images/veterano2.jpg" class="avatar-ranking">
                <div class="txt-ranking">
                    <h5>C. Hildebrandt</h5>
                    <span class="puntaje">786 pts.</span>
                </div>
            </div>

            <div class="rank" data-veterano="veterano3">
                <div class="numbr">3</div>
                <img src="images/veterano3.jpg" class="avatar-ranking">
                <div class="txt-ranking">
                    <h5>F. Yevenes</h5>
                    <span class="puntaje">737 pts.</span>
                </div>
            </div>
        </div>
    </div>
	<div class="download-app-web">
        <h2>¡También en tu celular! Descarga acá</h2>
        <a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><div class="play-logo"></div></a>
    </div>

       <!-- MODALES VETERANOS -->
    <div class="overlay-veterano" id="veterano1">
        <div class="el-veterano">
            <div class="su-foto">
                <img src="images/veterano1.png" class="img-responsive">
            </div>
            <div class="su-leyenda">
                <h3>La Gran Prueba 2014</h3>
                <p>Veterano: C. Mellado <br>
                   Escuadrón: Einstein <br>
                   Puntaje PSU: 832 pts.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="overlay-veterano" id="veterano2">
        <div class="el-veterano">
            <div class="su-foto">
                <img src="images/veterano2.png" class="img-responsive">
            </div>
            <div class="su-leyenda">
                <h3>La Gran Prueba 2014</h3>
                <p>Veterano: C. Hildebrandt <br>
                   Escuadrón: Bello <br>
                   Puntaje PSU: 786 pts.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="overlay-veterano" id="veterano3">
        <div class="el-veterano">
            <div class="su-foto">
                <img src="images/veterano3.png" class="img-responsive">
            </div>
            <div class="su-leyenda">
                <h3>La Gran Prueba 2014</h3>
                <p>Veterano: F. Yevenes <br>
                   Escuadrón: Pitágoras <br>
                   Puntaje PSU: 737 pts.</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--.invisible-->
<script>
    $('.rank').mouseenter(function(e){
        var veterano = $(this).data('veterano');
        var vid = '#'+veterano;
        e.stopPropagation();
        $(this).stop(true, true).css({
            'background-color': 'rgba(255,255,255,1)'
        });
        console.log(veterano);
        $(vid).stop(true, true).fadeIn(300);
    });
    $('.rank').mouseleave(function(e){
        var veterano = $(this).data('veterano');
        var vid = '#'+veterano;
        e.stopPropagation();
        $(this).stop(true, true).css({
            'background-color': 'rgba(255,255,255,0.6)'
        });
        $(vid).stop(true, true).fadeOut(300);
    });
    var altoScreen= $(window).height();
    $(".overlay-movil").animate({height: altoScreen+'px'}, 500);
</script>