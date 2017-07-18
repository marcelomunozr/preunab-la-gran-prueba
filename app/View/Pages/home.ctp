<div class="overlay-movil">
    <div class="download-app">
        <h2><strong>Para comenzar esta experiencia, descarga la aplicación y luego regístrate.</strong></h2>
        <a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><div class="play-logo"></div></a>
    </div>
</div>

<div class="hide-app">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span class="logo"></span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden active">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#premios">Premios</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#acerca-del-juego">Acerca del juego</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#personajes">Personajes</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- home -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 device-7">
                        <!-- <span class="personajes"></span> -->
                        <img src="<?=$this->Html->url('/')?>08-2015/img/personajes.png" alt="" class="img-center img-responsive">
                        <!-- <h3>conviértete en héroe</h3>
                        <h2>ganándole a la psu</h2> -->
                        <img src="<?=$this->Html->url('/')?>08-2015/img/txt-lgp.png" alt="" class="img-center img-responsive img-txt">
                    </div>
                    <div class="col-xs-4 device-5">
                        <div class="the-content-login">
                            <p>Para comenzar a jugar, <strong>regístrate o ingresa con facebook.</strong></p>
                            <div class="box-login">
                                <!-- ERROR -->
                                <div class="bubble">
                                    Error al ingreso de datos
                                </div>
                                <!-- ingresa -->
                                <div class="ingresa">
                                    <button class="fb-login">
                                        <i class="fa fa-facebook"></i>
                                        <span>Ingresa con facebook</span>
                                    </button>
                                    <img src="<?=$this->Html->url('/')?>08-2015/img/ingresa-o.png" alt="" class="clearfix img-responsive clear-30">
                                    <form action="#" id="FormLogin">
                                        <input name="data[Players][email]" class="form-control" id="LoginEmail" type="email" placeholder="EMAIL" required>
                                        <input name="data[Players][password]" class="form-control" id="LoginPassword" type="password" placeholder="CONTRASEÑA" required>
                                        <button type="submit" value="Ingresar" class="submit">Ingresar <i class="fa fa-angle-right"></i></button>                                
                                    </form>
                                    <div class="clear-10"></div>
                                    <h6><a href="#" class="soy-nuevo">¿eres nuevo?</a> / <a href="#" class="la-olvide">¿olvidaste tu contraseña?</a></h6>
                                </div>
                                <!-- registra -->
                                <div class="registra">
                                    <form action="#" id="FormRegistro" >
                                        <input id="FormFullname" name="data[Players][fullname]" class="form-control" type="text" placeholder="Nombre" required>
                                        <input id="FormRut" name="data[Players][rut]" class="form-control" type="text" placeholder="Rut" required>
                                        <input id="FormTelephone" name="data[Players][phone]" class="form-control" type="text" placeholder="Teléfono" required>
                                        <input id="FormEmail" name="data[Players][email]" class="form-control" type="email" placeholder="Email" required>
                                        <input id="FormPassword" name="data[Players][password]" class="form-control" type="password" placeholder="Contraseña" required>
                                        <select name="data[Players][id_region]" class="form-control" id="SelectorRegion" required>
                                            <option value="">Seleccione su región</option>
                                            <?php foreach($regiones as $id=>$region){ echo '<option value="'.$id.'">'.$region.'</option>';} ?>
                                        </select>
                                        <select name="data[Players][city_id]" class="form-control" id="SelectorComuna" required>
                                            <option value="">Seleccione región primero</option>
                                        </select>
                                        <input id="FormIdColegio" name="data[Players][colegio]" class="form-control" type="text" placeholder="Colegio" required>
                                        <input id="FormIdFacebookId" name="data[Players][facebook_id]" class="form-control" type="hidden" value="">
                                        <input type="submit" value="Registrar" class="submit">
                                        <h6><a href="#" class="estoy-registrado">¿Ya estás registrado?</a> / <a href="#" class="la-olvide">¿Olvidaste tu contraseña?</a></h6>
                                    </form>
                                </div>
                                <!-- olvida -->
                                <div class="olvida">
                                    <form action="#" id="FormResetPassword">
                                        <input id="ResetPasswordEmail" name="email" class="form-control" type="email" placeholder="Email" required>
                                        <input type="submit" value="Recuperar contraseña" class="submit">
                                        <p class="alerta-request" id="AlertaPassword" style="display:none;"></p>
                                        <h6><a href="#" class="soy-nuevo">¿Eres nuevo?</a> / <a href="#" class="estoy-registrado">¿Ya estás registrado?</a></h6>
                                    </form>
                                </div>
                            </div>
                            <div class="box-login-bottom">
                                <div class="row">
                                    <div class="col-xs-10 no-padd-r">
                                        <h4>gana grandes premios</h4>
                                        <h4 class="amarillo">¡también en tu celular!</h4>
                                        <div class="clear-5"></div>

                                        <div class="col-xs-6 no-padd-l"><a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><img src="<?=$this->Html->url('/')?>08-2015/img/google-play.png" alt="Descarga en Google Play" class="img-center img-responsive"></a></div>
                                        <div class="col-xs-6 no-padd-r"><a href="https://itunes.apple.com/us/app/preunab-la-gran-prueba-2/id1030403482?ls=1&mt=8" target="_blank"><img src="<?=$this->Html->url('/')?>08-2015/img/app-store.png" alt="Descarga en App Store" class="img-center img-responsive"></a></div>
                                        

                                    </div>
                                </div>
                                <img src="<?=$this->Html->url('/')?>08-2015/img/pack-premios.png" alt="Gana grandes premios" class="pack-premios">
                            </div>
                        </div>
                    </div>
                    <div class="clear-40"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Premios -->
    <section id="premios" class="container content-section text-center section-premios">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Premios</h2>
                <div class="clear-20"></div>
            </div>
            <div class="col-xs-4">
                <div class="clear-30"></div>
                <img src="<?=$this->Html->url('/')?>08-2015/img/premio1.jpg" alt="Mejor Puntaje Nacional" class="img-responsive img-center">
            </div>
            <div class="col-xs-4">
                <img src="<?=$this->Html->url('/')?>08-2015/img/premio2.jpg" alt="2 y 3 mejor puntaje (por sorteo)" class="img-responsive img-center">
            </div>
            <div class="col-xs-4">
                <div class="clear-20"></div>
                <img src="<?=$this->Html->url('/')?>08-2015/img/premio3.jpg" alt="Mejores puntajes, premios a repartir" class="img-responsive img-center">
            </div>
            <div class="clear-20"></div>
            <div class="col-xs-4"><h3>Mejor puntaje <br>nacional</h3><p>Celular Samsung Dual Core</p></div>
            <div class="col-xs-4"><h3>2º y 3º mejor puntaje <br>(por sorteo)</h3><p>Tablet Samsung Galaxy 2</p></div>
            <div class="col-xs-4"><h3>Mejores puntajes <br>premios a repartir</h3><p>Parlante Bluetooth, Cargador, Pendrive y Palito Selfie</p></div>
        </div>
    </section>

    <!-- Acerca del juego -->
    <section id="acerca-del-juego" class="content-section text-center acerca-del-juego">
        <div class="container">
            <div class="col-lg-12">
                <h2>acerca del juego</h2>
                <div class="clear-20"></div>
                <!-- 01 -->
                <div class="col-xs-6 no-padd-r">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego1.jpg" alt="Selecciona un personaje" class="pull-right img-responsive">
                </div>
                <div class="col-xs-6 no-padd-l">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego-txt-1.png" alt="Selecciona un personaje" class="pull-left img-responsive">
                    <div class="clear-10"></div>
                    <p>Para comenzar selecciona un personaje. Cada uno de estos grandes personajes del conocimiento representa una de las áreas evaluadas por la PSU:</p>
                    <p><i><strong>Pitágoras en “Matemáticas” <br>Colón en “Historia y Ciencias Sociales” <br>Bello en “Lenguaje y Comunicación” <br>Einstein en “Ciencias”.</strong></i></p>
                </div>
                <div class="clear-50"></div>
                <!-- 02 -->
                <div class="col-xs-6 no-padd-r">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego-txt-2.png" alt="Suma puntos y gana premios" class="pull-right img-responsive">
                    <div class="clear-10"></div>
                    <div class="text-right">
                        <p>Cada materia tiene 15 rounds de 10 preguntas cada una, que deberás responder correctamente en un tiempo limitado. <br>Cada vez que te equivoques perderás una de las 3 vidas que tienes para jugar y tendrás que volver a empezar el Round, pero tranquilo, tendrás 3 comodines para utilizar en cada Round cuando la situación lo amerite. <br>Además, puedes recuperar tus vidas esperando 5 minutos o publicando en tu muro de facebook.</p>
                    </div>
                </div>
                <div class="col-xs-6 no-padd-l">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego2.jpg" alt="Suma puntos y gana premios" class="pull-left img-responsive">
                </div>
                <div class="clear-50"></div>
                <!-- 03 -->
                <div class="col-xs-6 no-padd-r">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego1.jpg" alt="Selecciona un personaje" class="pull-right img-responsive">
                </div>
                <div class="col-xs-6 no-padd-l">
                    <img src="<?=$this->Html->url('/')?>08-2015/img/juego-txt-1.png" alt="Selecciona un personaje" class="pull-left img-responsive">
                    <div class="clear-10"></div>
                    <p>La idea central del juego es sumar la mayor cantidad de puntaje. Al subir puestos en el ranking general, podrás acceder a más premios y sorteos (<a href="#" target="_blank">ver bases</a>).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Personajes -->
    <section id="personajes" class="content-section text-center personajes-section">
        <div class="col-lg-12">
            <h2>Personajes</h2>
            <div class="clear-10"></div>
            <!-- carrusel -->
            <div id="carrusel-personajes" class="carousel slide" data-ride="carousel">
              <!-- indicadores -->
              <ol class="carousel-indicators">
                <li data-target="#carrusel-personajes" data-slide-to="0" class="active"></li>
                <li data-target="#carrusel-personajes" data-slide-to="1"></li>
                <li data-target="#carrusel-personajes" data-slide-to="2"></li>
                <li data-target="#carrusel-personajes" data-slide-to="3"></li>
                <li data-target="#carrusel-personajes" data-slide-to="4"></li>
                <li data-target="#carrusel-personajes" data-slide-to="5"></li>
                <li data-target="#carrusel-personajes" data-slide-to="6"></li>
              </ol>

              <!-- slides-->
              <div class="carousel-inner" role="listbox">
              <!-- einstein -->
                <div class="item active">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/einstein.png" alt="Albert Einstein" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-einstein.png" alt="Albert Einstein" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-ciencias.png" alt="Ciencias" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Física</p>
                            <h6>Nacionalidad</h6>
                            <p>Estadounidense (1940 - 1955)</p>
                            <h6>Nacimiento</h6>
                            <p>14 de marzo 1879, Ulm, Alemania</p>
                            <h6>Fallecimiento</h6>
                            <p>18 de Abril de 1955, Nueva Jersey, EEUU</p>
                            <h6>Conocido por</h6>
                            <p>Teoría de la relatividad</p>
                        </div>
                    </div>
                </div>
                <!-- pitagoras -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/pitagoras.png" alt="Pitágoras" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-pitagoras.png" alt="Pitágoras" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-matematicas.png" alt="Matemáticas" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Matemáticas, filosofía, astronomía</p>
                            <h6>Nacionalidad</h6>
                            <p>Griego</p>
                            <h6>Nacimiento</h6>
                            <p>569 a.C., Isla de samos</p>
                            <h6>Fallecimiento</h6>
                            <p>475 a.C. , Metaponto, Italia</p>
                            <h6>Conocido por</h6>
                            <p>Teorema de Pitágoras</p>
                        </div>
                    </div>
                </div>
                <!-- andres bello -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/andres-bello.png" alt="Andrés Bello" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-andres-bello.png" alt="Andrés Bello" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-lenguaje.png" alt="Lenguaje" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Filósofo, Poeta, educador y jurista</p>
                            <h6>Nacionalidad</h6>
                            <p>Venezolano</p>
                            <h6>Nacimiento</h6>
                            <p>29 de noviembre 1781, Caracas, Capitanía General de Venezuela</p>
                            <h6>Fallecimiento</h6>
                            <p>15 de octubre de 1865, Santiago, Chile</p>
                            <h6>Conocido por</h6>
                            <p>Gran pensador de América</p>
                        </div>
                    </div>
                </div>
                <!-- cristóbal colón -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/cristobal-colon.png" alt="Cristóbal Colón" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-cristobal-colon.png" alt="Cristóbal Colón" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-historia-social.png" alt="Historia y Ciencias Sociales" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Navegante, Cartógrafo</p>
                            <h6>Nacionalidad</h6>
                            <p>Italiano</p>
                            <h6>Nacimiento</h6>
                            <p>1436-1456, República de Génova, Italia</p>
                            <h6>Fallecimiento</h6>
                            <p>20 de Mayo 1506, Valladolid, Corona de Castilla</p>
                            <h6>Conocido por</h6>
                            <p>Descubrir América</p>
                        </div>
                    </div>
                </div>
                <!-- marie cuerie -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/marie-curie.png" alt="Marie Curie" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-marie-curie.png" alt="Marie Curie" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-quimica.png" alt="Química" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Química</p>
                            <h6>Nacionalidad</h6>
                            <p>Francesa</p>
                            <h6>Nacimiento</h6>
                            <p>7 de noviembre de 1867, Varsovia Polonia</p>
                            <h6>Fallecimiento</h6>
                            <p>4 de julio de 1934, Passy Francia</p>
                            <h6>Conocido por</h6>
                            <p>Estudio de la Radiactividad</p>
                        </div>
                    </div>
                </div>
                <!-- isaac newton -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/isaac-newton.png" alt="Isaac Newton" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-isaac-newton.png" alt="Isaac Newton" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-fisica.png" alt="Física" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Física</p>
                            <h6>Nacionalidad</h6>
                            <p>Inglés</p>
                            <h6>Nacimiento</h6>
                            <p>4 de enero de 1643, Woolsthorpe by Colsterworth Reino Unido</p>
                            <h6>Fallecimiento</h6>
                            <p>31 de marzo de 1727,Kensington Londres Reino Unido</p>
                            <h6>Conocido por</h6>
                            <p>Ley gravitación Universal</p>
                        </div>
                    </div>
                </div>
                <!-- charles darwin -->
                <div class="item">
                    <div class="container">
                        <div class="col-xs-6">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/charles-darwin.png" alt="Charles Darwin" class="img-responsive img-center">
                        </div>
                        <div class="col-xs-6">
                            <div class="clear-40"></div>
                            <img src="<?=$this->Html->url('/')?>08-2015/img/name-charles-darwin.png" alt="Charles Darwin" class="img-responsive">
                            <img src="<?=$this->Html->url('/')?>08-2015/img/materia-biologia.png" alt="Biología" class="clear-20 img-responsive">
                            <h6>Especialidad</h6>
                            <p>Biología</p>
                            <h6>Nacionalidad</h6>
                            <p>Inglés</p>
                            <h6>Nacimiento</h6>
                            <p>12 de febrero de 1809, El Monte Shrewsbury, Reino Unido</p>
                            <h6>Fallecimiento</h6>
                            <p>9 de abril de 1882, Down House Reino Unido</p>
                            <h6>Conocido por</h6>
                            <p>Teoría de la evolución</p>
                        </div>
                    </div>
                </div>
              </div>

              <!-- Flechas -->
              <a class="left carousel-control" href="#carrusel-personajes" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right carousel-control" href="#carrusel-personajes" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
        </div>
    </section>
</div>
<!-- <img src="images/ingresa-banner.png" class="img-responsive img-center img-banner-ingresa"> -->
<div class="overlay-movil">
    <div class="download-app">
        <h2><strong>Para comenzar esta experiencia, descarga la aplicación y luego regístrate.</strong></h2>
        <a href="https://play.google.com/store/apps/details?id=cl.multinet.lagranprueba" target="_blank"><div class="play-logo"></div></a>
    </div>
</div>


<!-- MODAL TERCERA ETAPA -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="clear-20"></div>
    <div class="clear-20"></div>
    <div class="clear20"></div>    
    
    <img src="<?=$this->Html->url('/')?>08-2015/img/modal-etapa-3.png" alt="Tercera etapa" class="img-responsive img-center" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">    

    <div class="text-center">
        <a class="btn-centere" data-dismiss="modal" aria-label="Close">Comenzar <i class="fa fa-angle-right"></i></a>
    </div>

</div>

<!-- MODAL DE BOBY -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-xs-4 no-padding skew">
        <div class="modalbert">
            <img src="<?=$this->Html->url('/')?>08-2015/img/modalbert.png" alt="Quedan pocos días" class="img-responsive">
        </div>
    </div>
    <div class="col-xs-8 no-padding skew">
        <div class="modal-content alerta">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Quedan pocos días</h4>
          </div>
          <div class="modal-body">
            Tienes hasta el 23 de Octubre para terminar la 2 etapa y ser el ganador de entretenidos premios.
          </div>
        </div>
    </div>
  </div>
</div> -->



<!-- <h2 data-toggle="modal" data-target="#myModal">
    <img src="<?=$this->Html->url('/')?>08-2015/img/modalbert.png" alt="Quedan pocos días" class="img-responsive">
</h2> -->