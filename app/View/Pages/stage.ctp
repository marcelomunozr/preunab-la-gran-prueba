    <script>
        $('.bg-principal').removeAttr("style").removeClass('bg-preguntas').removeClass('bg-notifications');
    </script>
    <div class="los-personajes-home">
        <img src="<?=$this->Html->url('/')?>images/personajes-home.png" class="img-responsive" id="personajes-fondo">
    </div>
    <div class="contenedor-personajes">                
        <div class="el-flow-personajes">
            <div class="los-personajes" id="pitagoras">
                <div class="img-personaje">
                    <img src="images/personajes/pitagoras.png" alt="Pitágoras" class="img-responsive">
                </div>
                <div class="txt-personaje">
                    <div class="txt-right">
                        <div class="materia">
                            <h4>Matemáticas</h4>
                        </div>
                        <div class="nombre-personaje txt-center">
                            <h2>Pitágoras</h2>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Especialidad <br><span>Matemáticas, filosofía, astronomía</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacionalidad <br><span>Griego</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacimiento <br><span>569 a.C., Isla de samos</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Fallecimiento <br><span>475 a.C. , Metaponto, Italia</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Conocido por <br><span>Teorema de Pitágoras</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="los-personajes" id="colon">
                <div class="img-personaje">
                    <img src="images/personajes/colon.png" alt="Cristobal Colón" class="img-responsive">
                </div>
                <div class="txt-personaje">
                    <div class="txt-right">
                        <div class="materia">
                            <h4>HISTORIA Y CIENCIAS SOCIALES</h4>
                        </div>
                        <div class="nombre-personaje txt-center">
                            <h2>CRISTÓBAL COLÓN</h2>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Especialidad <br><span>Navegante, Cartógrafo</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacionalidad <br><span>Italiano</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacimiento <br><span>1436-1456, República de Génova, Italia</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Fallecimiento <br><span>20 de Mayo 1506, Valladolid, Corona de Castilla</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Conocido por <br><span>Descubrir América</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="los-personajes" id="bello">
                <div class="img-personaje">
                    <img src="images/personajes/bello.png" alt="Andrés Bello" class="img-responsive">
                </div>
                <div class="txt-personaje">
                    <div class="txt-right">
                        <div class="materia">
                            <h4>Lenguaje y Comunicación</h4>
                        </div>
                        <div class="nombre-personaje txt-center">
                            <h2>Andrés Bello</h2>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Especialidad <br><span>Filósofo, Poeta, educador y jurista</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacionalidad <br><span>Venezolano</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacimiento <br><span>1781 , Caracas, Capitanía General de Venezuela</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Fallecimiento <br><span>15 de octubre de 1865, Santiago, Chile</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Conocido por <br><span>Gran pensador de América</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="los-personajes" id="einstein">
                <div class="img-personaje">
                    <img src="images/personajes/einstein.png" alt="ALBERT EINSTEIN" class="img-responsive">
                </div>
                <div class="txt-personaje">
                    <div class="txt-right">
                        <div class="materia">
                            <h4>CIENCIAS</h4>
                        </div>
                        <div class="nombre-personaje txt-center">
                            <h2>ALBERT EINSTEIN</h2>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Especialidad <br><span>Física</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacionalidad <br><span>Estadounidense (1940-55)</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Nacimiento <br><span>1879, Ulm, Wurtemberg, Imperio Alemán</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Fallecimiento <br><span>18 de Abril de 1955, Nueva Jersey, EEUU</span></h6>
                        </div>
                        <div class="desc-personaje txt-left">
                            <h6>Conocido por <br><span>Teoría de la relatividad</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="los-personajes" id="marie-curie">
                <?php if($this->Session->read('Session.Player.round_science') >= 31){ ?>
                    <div class="img-personaje">
                        <img src="images/personajes/marie-curie-active.png" alt="MARIE CURIE" class="img-responsive">
                    </div>
                    <div class="txt-personaje">
                        <div class="txt-right">
                            <div class="materia">
                                <h4>QUÍMICA</h4>
                            </div>
                            <div class="nombre-personaje txt-center">
                                <h2>MARIE CURIE</h2>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Especialidad <br><span>Química</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacionalidad <br><span>Francesa</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacimiento <br><span>7 de noviembre de 1867, Varsovia Polonia</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Fallecimiento <br><span>4 de julio de 1934, Passy Francia</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Conocido por <br><span>Estudio de la Radiactividad</span></h6>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?> 
                    <div class="text-center">
                        <div class="img-personaje">
                            <img src="images/personajes/marie-curie.png" alt="MARIE CURIE" class="img-responsive">
                        </div>
                        <div class="msj-inactivo">
                            <span class="la-quest"><h2>?</h2></span>
                            <span class="el-msj text-left"><h6>Curie, Newton y Darwin quienes representan las pruebas específicas de Química, Física y Biología respectivamente, se activarán sólo cuando pases a la 3ª etapa de Ciencias.</h6></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="los-personajes" id="newton">
                <?php if($this->Session->read('Session.Player.round_science') >= 31){ ?>
                    <div class="img-personaje">
                        <img src="images/personajes/isaac-newton-active.png" alt="ISAAC NEWTON" class="img-responsive">
                    </div>
                    <div class="txt-personaje">
                        <div class="txt-right">
                            <div class="materia">
                                <h4>FÍSICA</h4>
                            </div>
                            <div class="nombre-personaje txt-center">
                                <h2>ISAAC NEWTON</h2>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Especialidad <br><span>Física</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacionalidad <br><span>Inglés</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacimiento <br><span>4 de enero de 1643, Linconshire,  Reino Unido</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Fallecimiento <br><span>31 de marzo de 1727, Londres, Reino Unido</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Conocido por <br><span>Ley gravitación Universal</span></h6>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>  
                    <div class="text-center">
                        <div class="img-personaje">
                            <img src="images/personajes/newton.png" alt="NEWTON" class="img-responsive">
                        </div>
                        <div class="msj-inactivo">
                            <span class="la-quest"><h2>?</h2></span>
                            <span class="el-msj text-left"><h6>Curie, Newton y Darwin quienes representan las pruebas específicas de Química, Física y Biología respectivamente, se activarán sólo cuando pases a la 3ª etapa de Ciencias.</h6></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="los-personajes" id="darwin">
                <?php if($this->Session->read('Session.Player.round_science') >= 31){ ?>
                    <div class="img-personaje">
                        <img src="images/personajes/charles-darwin-active.png" alt="CHARLES DARWIN" class="img-responsive">
                    </div>
                    <div class="txt-personaje">
                        <div class="txt-right">
                            <div class="materia">
                                <h4>BIOLOGÍA</h4>
                            </div>
                            <div class="nombre-personaje txt-center">
                                <h2>CHARLES DARWIN</h2>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Especialidad <br><span>Biología</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacionalidad <br><span>Inglés</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Nacimiento <br><span>12 de febrero de 1809, Shrewsbury, Reino Unido</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Fallecimiento <br><span>9 de abril de 1882, Down House Reino Unido</span></h6>
                            </div>
                            <div class="desc-personaje txt-left">
                                <h6>Conocido por <br><span>Teoría de la evolución</span></h6>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="text-center">
                        <div class="img-personaje">
                            <img src="images/personajes/darwin.png" alt="DARWIN" class="img-responsive">
                        </div>
                        <div class="msj-inactivo">
                            <span class="la-quest"><h2>?</h2></span>
                            <span class="el-msj text-left"><h6>Curie, Newton y Darwin quienes representan las pruebas específicas de Química, Física y Biología respectivamente, se activarán sólo cuando pases a la 3ª etapa de Ciencias.</h6></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="contenedor-seleccion">
        <h3 class="titulo-principal">Desafía a los Grandes del Conocimiento</h3>
        <h6><span>Selecciona a uno de los personajes y comienza a jugar.</span></h6>
        <div class="clearfix"></div>
        <nav class="personajes">
            <ul>
                <li class="enable"><a href="#" class="character-selector enable" data-personaje="pitagoras"><img src="images/personajes/avatar-pitagoras.png" class="transitions switcher" data-personaje="pitagoras"></a><h2>Pitágoras</h2><p>Matemáticas</p></li>
                <li class="enable"><a href="#" class="character-selector enable" data-personaje="colon"><img src="images/personajes/avatar-colon.png" class="transitions switcher" data-personaje="colon"></a><h2>Colón</h2><p>Historia</p></li>
                <li class="enable"><a href="#" class="character-selector enable" data-personaje="bello"><img src="images/personajes/avatar-bello.png" class="transitions switcher" data-personaje="bello"></a><h2>Bello</h2><p>Lenguaje</p></li>
                   
                <?php if($this->Session->read('Session.Player.round_science') >= 31){ ?>
                    <li class="disable"><a href="#" class="character-selector disable" data-personaje="einstein"><img src="images/personajes/avatar-einstein.png" class="transitions switcher-disable" data-personaje="einstein"></a><h2>Einstein</h2><p>Ciencias</p></li>
                    <li class="enable"><a href="#" class="character-selector enable" data-personaje="marie-curie"><img src="images/personajes/avatar-curie.png" class="transitions switcher" data-personaje="marie-curie"></a><h2>Curie</h2><p>Química</p></li>
                    <li class="enable"><a href="#" class="character-selector enable" data-personaje="newton"><img src="images/personajes/avatar-newton.png" class="transitions switcher" data-personaje="newton"></a><h2>Newton</h2><p>Física</p></li>
                    <li class="enable"><a href="#" class="character-selector enable" data-personaje="darwin"><img src="images/personajes/avatar-darwin.png" class="transitions switcher" data-personaje="darwin"></a><h2>Darwin</h2><p>Biología</p></li>
                <?php }else{ ?> 
                    <li class="enable"><a href="#" class="character-selector enable" data-personaje="einstein"><img src="images/personajes/avatar-einstein.png" class="transitions switcher" data-personaje="einstein"></a><h2>Einstein</h2><p>Ciencias</p></li>
                    <li class="disable"><a href="#" class="character-selector disable" data-personaje="marie-curie"><img src="images/personajes/avatar-curie.png" class="transitions switcher-disable" data-personaje="marie-curie"></a><h2>Curie</h2><p>Química</p></li>
                    <li class="disable"><a href="#" class="character-selector disable" data-personaje="newton"><img src="images/personajes/avatar-newton.png" class="transitions switcher-disable" data-personaje="newton"></a><h2>Newton</h2><p>Física</p></li>
                    <li class="disable"><a href="#" class="character-selector disable" data-personaje="darwin"><img src="images/personajes/avatar-darwin.png" class="transitions switcher-disable" data-personaje="darwin"></a><h2>Darwin</h2><p>Biología</p></li>
                <?php } ?>
            
            </ul>
        </nav>
    </div>

    <div class="overlay-tutorial" id="overlay-tutorial">
        <div class="el-tutorial">
            <div class="cerrar-tutorial" id="cerrar-tutorial"></div>
            <div class="block1"></div>
            <div class="block2"></div>
            <div class="block3"></div>
            <div class="block4"></div>
            <div class="block5"></div>
            <div class="texto-tutorial">
                <div class="i-como-jugar"></div>
                <p>Para comenzar selecciona un personaje. Cada uno de estos grandes personajes del conocimiento representa una de las áreas evaluadas por la PSU: </p>
                <p><strong>Pitágoras</strong> en “Matemáticas”<br>
                <strong>Colón</strong> en “Historia y Ciencias Sociales”<br>
                <strong>Bello</strong> en “Lenguaje y Comunicación”<br>
                <strong>Einstein</strong> en “Ciencias”. </p>
                <p>Ellos te ayudarán a lograr la meta. <strong>Curie</strong>, <strong>Newton</strong> y <strong>Darwin</strong> representan <strong>Química</strong>, <strong>Física</strong> y <strong>Biología</strong> respectivamente y se activarán cuando pases a la <strong>3ª etapa de Ciencias</strong>.</p>
                <div class="i-comienzan-los-round"></div>
                <p>Cada materia tiene <strong>15 rounds de 10 preguntas cada una</strong>, que deberás responder correctamente en un tiempo limitado. <br>
                    Cada vez que te equivoques perderás una de las <strong>3 vidas</strong> que tienes para jugar y tendrás que volver a empezar el Round, pero tranquilo, tendrás <strong>3 comodines</strong> para utilizar en cada Round cuando la situación lo amerite. <br>
                    Además, puedes recuperar tus vidas <strong>esperando 5 minutos o publicando en tu muro de facebook</strong>.</p>
                <div class="i-suma-puntos"></div>
                <p>
                    La idea central del juego es <strong>sumar la mayor cantidad de puntaje</strong>. Al subir puestos en el ranking general, podrás acceder a más premios y sorteos (ver bases).
                </p>
                <p>
                    <strong>Recuerda que puedes jugar "La Gran Prueba" en tu PC o Smartphone.</strong> 
                </p>
            </div>
        </div>
    </div>