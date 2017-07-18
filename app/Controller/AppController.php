 <?php

App::uses('Controller', 'Controller');


class AppController extends Controller {


    public function beforeFilter(){
        if(!$this->request->is('ajax')){
            if(!isset($this->request->params['action'])){
                
            }
        }
        $sesion = $this->Session->read('Session.Player');
        if(!empty($sesion)){       
            $this->loadModel('Players');
            $id = $this->Session->read('Session.Player.id');
            $result = $this->Players->query('SELECT TIMESTAMPDIFF(SECOND, not_lives_date, NOW()) AS diff FROM players_clean WHERE id = '.$id);
            $wait = 0;
            if($this->Session->read('Session.Player.lives') <= 0){
                $result = $this->Players->query('SELECT TIMESTAMPDIFF(SECOND, not_lives_date, NOW()) AS diff FROM players_clean WHERE id = '.$id);
                $result = $result[0][0]['diff'];
                if($result >= 300 || $result == null ) {
                    $wait = 0;
                } else {
                    $wait = 300 - $result;
                }
            }
            $this->Session->write('Session.Player.wait', $wait);
        }
    }
    
    public function updateSesion(){
        $this->loadModel('Players');
        if($this->Session->read('Session.Player.id') != null){
            $id = $this->Session->read('Session.Player.id');
            $jugador = $this->Players->getPlayerByID($id);
            $wait = 0;
            if($jugador['Players']['lives'] <= 0){
                $result = $this->Players->query('SELECT TIMESTAMPDIFF(SECOND, not_lives_date, NOW()) AS diff FROM players_clean WHERE id = '.$id);
                $result = $result[0][0]['diff'];
                if($result >= 300 || $result == null ) {
                    $wait = 0;
                } else {
                    $wait = 300 - $result;
                }
            }
            $jugador['Players']['wait'] = $wait;
            $this->createSesion($jugador['Players']);
            return true;
        }else{
            $this->Session->destroy();
            return false;
        }
    }
    
    public function rankSesion(){
        $ranking = $this->getRanking();
        $this->Session->write('Session.Ranking', $ranking);
    }
    
    public function checkLogin(){
        if($this->Session->read('Session.Player') == null){
            $this->redirect('/');
        }
    }

    public function createSesion($datos = null){
        $this->loadModel('Players');    
        $this->Session->write('Session.Player', $datos);
        $id = $this->Session->read('Session.Player.id');
        $result = $this->Players->query('SELECT TIMESTAMPDIFF(SECOND, not_lives_date, NOW()) AS diff FROM players_clean WHERE id = '.$id);
        $result = $result[0][0]['diff'];
        $vidas = $this->Session->read('Session.Player.lives');
        if($vidas <= 0){
            if($result >= 300 ) {
                $wait = 0;
            } else {
                $wait = 300 - $result;
            }
        }else{
            $wait = 0;
        }
        $this->Session->write('Session.Player.result', $result);
        $this->Session->write('Session.Player.wait', $wait);
    }
    
    public function getCiudades(){
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Region');
        $id_region = $this->request->query['id_region'];
        if($id_region != null){
            $region = $this->Region->read(null, $id_region);
            $ciudades = $region['City'];
            $this->set(compact('ciudades'));
            $this->render('/Elements/cmb_ciudades');
        }else{
            echo '<option value="">Seleccione región primero</option>';
        }
    }
    
    public function restartLives(){
        $this->loadModel('Players');
        if($this->Session->read('Session.Player') != null){
            $this->Players->id = $this->Session->read('Session.Player.id');
            if($this->Players->saveField('lives', 3)){
                return $this->respondAsJson(array('exito' => 1), 200);
            }else{
                return $this->respondAsJson(array('exito' => 0), 200);
            }
        }else{
            return $this->respondAsJson(array('exito' => 0), 200);
        }
    }
    
    public function giveOne(){
        $this->loadModel('Players');
        if($this->Session->read('Session.Player') != null){
            $this->Players->id = $this->Session->read('Session.Player.id');
            if($this->Players->saveField('lives', 1)){
                return $this->respondAsJson(array('exito' => 1), 200);
            }else{
                return $this->respondAsJson(array('exito' => 0), 200);
            }
        }else{
            return $this->respondAsJson(array('exito' => 0), 200);
        }
    }
    
    public function addManyPoints(){
        $this->loadModel('Players');
        if($this->Session->read('Session.Player') != null){
            $userid = $this->Session->read('Session.Player.id');
            if($this->Players->addManyPoints($userid)){
                return $this->respondAsJson(array('exito' => 1), 200);
            }else{
                return $this->respondAsJson(array('exito' => 0), 200);
            }
        }else{
            return $this->respondAsJson(array('exito' => 0), 200);
        }
    }
    
    public function reloadSidebar(){
        $this->layout = 'ajax';
        $this->render('/Elements/controls/side-menu');
    }
    
    public function sumPoints($category = null, $comodin = false){
        if($this->Session->read('Session.Player') != null){
            $this->loadModel('Players');
            $this->Players->id = $this->Session->read('Session.Player.id');
            $campo_puntos = 'points_'.strtolower($category);
            $campo_ronda = 'round_'.strtolower($category);
            $puntaje = $this->Session->read('Session.Player.'.$campo_puntos);
            $ronda = $this->Session->read('Session.Player.'.$campo_ronda);
            if($comodin != true){
                $puntaje += 150;
            }else{
                $puntaje += 100;
            }
            if($ronda <= 45){
                if($category != 'science'){
                    $ronda += 1;
                }else{
                    $this->redirect(array('controller' => 'pages', 'action'=>'finalScreen', $category));
                }
            }
            if($this->Players->saveField($campo_puntos, $puntaje)){
                if($this->Players->saveField($campo_ronda, $ronda)){
                    $this->updateSesion();  
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function lifeAbsorb(){
        if($this->Session->read('Session.Player') != null){
            $this->loadModel('Players');
            $this->Players->id = $this->Session->read('Session.Player.id');
            $lives = $this->Session->read('Session.Player.lives');
            $lives -= 1;
            if($lives <= 0){
                $lives = 0;
                $fecha = date('Y-m-d H:i:s');
                $this->Players->saveField('not_lives_date', $fecha);
            }
            if($this->Players->saveField('lives', $lives)){
                return true;
            }
        }else{
            return false;
        }
    }
    
    public function getRanking(){
        $this->autoRender = false;
        $this->loadModel('Players');
        $categories = array('general'=> 'ranking general', 'history' => 'Historia', 'math'=> 'Matemáticas', 'language'=> 'Lenguaje', 'science'=> 'Ciencias');
        $ranking = array();
        foreach($categories as $term=>$category){
            if($term != 'general'){ 
                $jugadores = $this->Players->find('all', array('recursive'=> -1, 'conditions'=>array('id !=' => '21392'), 'fields' => array('(points_'.$term.') AS points', 'profile_pic', 'fullname'), 'order'=> 'points DESC', 'limit' => 10));
                $ranking[$term]['jugadores'] = $jugadores;
                $ranking[$term]['titulo'] = $category;
            }else{
                $jugadores = $this->Players->find('all', array('recursive'=> -1, 'conditions'=>array('id !=' => '21392'), 'fields' => array('(points_math + points_science + points_language + points_history + points_chemistry + points_physics + points_biology) AS points', 'profile_pic', 'fullname'), 'order'=> 'points DESC', 'limit' => 10));   
                $ranking[$term]['jugadores'] = $jugadores;
                $ranking[$term]['titulo'] = $category;
            }
        }
        return $ranking;
    }
    
    public function checkAward($category = null, $stage = null){
        $this->loadModel('Award');
        $this->loadModel('AwardUser');
        $this->loadModel('Notification');
        if($category != null && $stage != null){
            $user_id    =   $this->Session->read('Session.Player.id');    
            $premio     =   $this->Award->find('first', array('conditions' => array('AND' => array('subject' => $category, 'stage' => $stage))));
            if(!empty($premio)){
                $check      =   $this->AwardUser->find('first', array('conditions' => array('AND' => array('award_id' => $premio['Award']['id'], 'player_id' => $user_id))));
                if(empty($check)){
                    $elprize = array();
                    $this->Award->AwardUser->create();
                    $elprize['AwardUser']['award_id'] = $premio['Award']['id'];
                    $elprize['AwardUser']['player_id'] = $user_id;
                    if($this->AwardUser->save($elprize)){
                        $notificacion = array();
                        $this->Notification->create();
                        $notificacion['Notification']['text'] = 'Felicitaciones, has ganado el trofeo: ' . $premio['Award']['description'];
                        $notificacion['Notification']['sender_id'] = '';
                        $notificacion['Notification']['player_id'] = $this->Session->read('Session.Player.id');
                        $notificacion['Notification']['issue'] = 'NOTIFICATION';
                        $notificacion['Notification']['challenge_id'] = '';
                        $notificacion['Notification']['unread'] = 1;
                        $notificacion['Notification']['date_created'] = date('Y-m-d H:i:s');
                        if($this->Notification->save($notificacion)){
                            return true;
                        }
                    }
                }else{
                    return false;
                }
            }
        }
    }
    
    public function markNotificationAsRead(){
        if($this->request->is('post')){
            $this->loadModel('Notification');
            $datos = $this->request->data;
            $this->Notification->id = $datos['notification_id'];
            if($this->Notification->saveField('unread', 0)){
                $playerid = $this->Session->read('Session.Player.id');
                $lanotificacion = '';
                $info = $this->Notification->find('all', array(
                                                    'recursive' => -1,
                                                    'order' => 'Notification.date_created DESC', 
                                                    'conditions' => array(
                                                        'AND'=>array(
                                                                'Notification.unread' => 0, 
                                                                'Notification.player_id' => $playerid
                                                            )
                                                        )
                                                    )
                                                );
                if(count($info) <= 0){
                    $lanotificacion .= '<h5 class="azul">No tienes notificaciones leidas</h5>';
                }else{
                    foreach($info as $notificacion){
                        $lanotificacion .= '
                        <div class="la-notificacion">
                            <div class="col-xs-11">
                                <p>'.$notificacion['Notification']['text'].'</p>
                                <p><small>Generado el '.date('d-m-Y', strtotime($notificacion['Notification']['date_created'])).' a las '.date('H:i:s', strtotime($notificacion['Notification']['date_created'])).'</small></p>
                            </div>
                            <div class="col-xs-1 text-center"><i class="fa fa-caret-right"></i></div>
                            <div class="clearfix"></div>
                        </div>
                    ';
                    }
                }
                return $this->respondAsJson(array('exito' => 1, 'notifications' => $lanotificacion), 200);  
            }else{
                return $this->respondAsJson(array('exito' => 0), 200);
            }
        }else{
            return $this->respondAsJson(array('exito' => 0), 200);
        }   
    }
    
    public function _mailSend($destinatarios = null, $subject = null, $datos = array(), $titulo = null, $remitente = null){
        try{
            $baseurl = 'http://lagranprueba.preunab.cl/';   
            $email = new CakeEmail();
            $email->template('preunab');
            $email->emailFormat('html');
            $email->subject($subject);
            $email->to($destinatarios);
            $email->viewVars(array('titulo'=> $titulo, 'body' => $datos, 'baseurl' => $baseurl));
            if($remitente == null){
                $email->from(array('no-reply@preunab.cl' => 'La Gran prueba'));
            }else{
                $email->from(array($remitente['email'] => $remitente['nombre']));
            }
            $email->send();
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function respondAsJson($body = array(), $status = 200){
        return new CakeResponse(
            array(
                'status' => $status,
                'body' => json_encode($body),
                'type' => 'json'
            )
        );
    }
}
