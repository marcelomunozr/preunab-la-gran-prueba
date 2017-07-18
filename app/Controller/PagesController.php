<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class PagesController extends AppController {

    public function display() {
        $path = func_get_args();
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));
        // add this snippet before the last line 
        if (method_exists($this, $page)) {
            $this->$page(); 
        } 
        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
    
    public function beforeFilter(){
        parent::beforeFilter();
    }
    
    public function stage(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
        }else{
            $this->layout = 'logged';
        }
        $this->checkLogin();
        $this->rankSesion();
    }
    
    public function home(){
        $this->loadModel('Region');
        $regiones = $this->Region->find('list');
        if($this->Session->read('Session.Player') != null){
            $this->redirect('/stage');
        }
        if(isset($this->request->query['fbregister'])){
            $this->set('registro_facebook', true);
        }else{
            $this->set('registro_facebook', false);
        }
        $this->set(compact('regiones'));
    }
    
        
    
    public function profile(){
        if($this->request->is('ajax')){
            $this->loadModel('Region');
            $this->loadModel('Players');
            $this->checkLogin();
            $datos = $this->Players->find('first', array(
                                        'recursive' => -1,
                                        'conditions' => array('Players.id' => $this->Session->read('Session.Player.id')),
                                        'fields' => array(
                                            'Players.fullname',
                                            'Players.profile_pic',
                                            'Players.rut',
                                            'Players.phone',
                                            'Players.email',
                                            'Players.colegio',
                                            'Players.city_id')
                )
            );
            $this->Session->write('Session.Player.fullname', $datos['Players']['fullname']);
            $this->Session->write('Session.Player.profile_pic', $datos['Players']['profile_pic']);
            $this->Session->write('Session.Player.rut', $datos['Players']['rut']);
            $this->Session->write('Session.Player.phone', $datos['Players']['phone']);
            $this->Session->write('Session.Player.email', $datos['Players']['email']);
            $this->Session->write('Session.Player.colegio', $datos['Players']['colegio']);
            $this->Session->write('Session.Player.city_id', $datos['Players']['city_id']);
            $detroit = $this->Players->City->find('first', array('recursive' => -1, 'conditions' => array('id' => $datos['Players']['city_id'])));
            $this->Session->write('Session.Player.City', $detroit['City']);
            $regiones = $this->Region->find('list');
            $this->layout = 'profile';
            $region_id = ($this->Session->read('Session.Player.City.region_id') === null) ? '' : $this->Session->read('Session.Player.City.region_id');
            if($region_id != ''){
                $region = $this->Region->read(null, $region_id);
                $ciudades = $region['City'];
                foreach($region['City'] as $id=>$ciudad){
                    $ciudades_lista[$ciudad['id']] = $ciudad['name'];
                }
            }else{
                $ciudades = '';
                $ciudades_lista = array();
            }
            $this->set(compact('ciudades_lista', 'regiones', 'ciudades', 'region_id', 'notificaciones'));
        }else{
            $this->redirect('/');
        }
    }
    
    public function gameplay(){
        $this->loadModel('Questions');
        $this->loadModel('Players');    
        if($this->request->is('ajax')){
            $this->checkLogin();
            if($this->Session->read('Session.Player.wait') > 0){
                $this->layout = 'naked';
            }else{
                $this->layout = 'game';
            }
            $personaje = $this->request->data['personaje'];
            $roundQuestions = $this->Questions->getRoundQuestions($personaje);
            $category = $this->Questions->characterToCategory($personaje);
            $guardadas = $this->Session->read('Session.Player.StoredQuestion');
            $storeds = array();
            $materia = 'stage_'.strtolower($category);
            $puntaje = 'points_'.strtolower($category);
            $laronda = 'round_'.strtolower($category);
            $stage = $this->Session->read('Session.Player.'.$materia);
            $playerInfo = $this->Players->find('first', array('conditions' => array('Players.id' => $this->Session->read('Session.Player.id')), 'recursive' => -1));
            $this->Session->write('Session.Player.lives', $playerInfo['Players']['lives']);
            $this->Session->write('Session.Player.'.$puntaje, $playerInfo['Players'][$puntaje]);
            $this->Session->write('Session.Player.'.$laronda, $playerInfo['Players'][$laronda]);
            if($stage > 1){
                if($stage == 2){
                    $this->checkAward(strtolower($category), 1);    
                }elseif($stage == 3){
                    $this->checkAward(strtolower($category), 2);
                    if($laronda >= 46){
                        $this->checkAward(strtolower($category), 3);
                        $this->redirect(array('action'=>'finalScreen', $category));
                    }
                }else{
                    $this->redirect(array('action'=>'finalScreen', $category));
                }
            }
            if(is_array($guardadas)){
                foreach($guardadas as $guardada){
                    $storeds[] = $guardada['question_id'];
                }
            }
            foreach($roundQuestions as $id=>$pregunta){
                $roundQuestions[$id]['Questions']['stored'] = 0;    
                if(in_array($pregunta['Questions']['id'], $storeds)){
                    $roundQuestions[$id]['Questions']['stored'] = 1;
                }
            }
            $this->set('categoria_human', $this->Questions->categoryToHumanFriendly($category));
            $this->set('character', $personaje);
            $this->set('category', $category);
            $this->set('roundQuestions', $roundQuestions);
        }else{
            $this->redirect('/');
        }
    }
    
    public function successRound(){
        if($this->request->is('ajax')){
            $this->loadModel('Players');
            $this->loadModel('Questions');
            $this->layout = 'naked';
            $personaje  = $this->request->data['personaje'];
            $category   = $this->Questions->characterToCategory($personaje);
            $comodin    = isset($this->request->data['comodin']) ? $this->request->data['comodin'] : false;
            $this->sumPoints($category, $comodin);
            $category = strtolower($category);
            $puntaje = 'points_'.strtolower($category);
            $laronda = 'round_'.strtolower($category);
            $playerInfo = $this->Players->find('first', array('fields' => array($puntaje, $laronda, 'id'), 'conditions' => array('Players.id' => $this->Session->read('Session.Player.id')), 'recursive' => -1));
            $this->Session->write('Session.Player.'.$puntaje, $playerInfo['Players'][$puntaje]);
            $this->Session->write('Session.Player.'.$laronda, $playerInfo['Players'][$laronda]);
            $this->set(compact('category', 'personaje'));
        }else{
            $this->redirect('/');
        }
    }
    
    public function failedRound(){
        if($this->request->is('ajax')){
            $this->loadModel('Players');
            $this->loadModel('Questions');
            $this->layout = 'naked';
            $causa  = $this->request->data['reason'];
            if($causa != 'NO LIVES'){
                $this->lifeAbsorb();
            }
            $personaje  = $this->request->data['personaje'];
            $category   = $this->Questions->characterToCategory($personaje);
            $category = strtolower($category);
            $puntaje = 'points_'.strtolower($category);
            $laronda = 'round_'.strtolower($category);
            $playerInfo = $this->Players->find('first', array('conditions' => array('Players.id' => $this->Session->read('Session.Player.id')), 'recursive' => -1));
            $this->Session->write('Session.Player.lives', $playerInfo['Players']['lives']);
            $this->Session->write('Session.Player.'.$puntaje, $playerInfo['Players'][$puntaje]);
            $this->Session->write('Session.Player.'.$laronda, $playerInfo['Players'][$laronda]);
            $this->set(compact('category', 'personaje', 'causa'));
        }else{
            $this->redirect('/');
        }
    }

    public function storedQuestions(){
        if($this->request->is('ajax')){
            $this->loadModel('Players');
            $this->loadModel('Options');
            $this->layout = 'naked';
            $ordenadas = array();   
            $lasguardadas = $this->Players->StoredQuestion->find('all', array('conditions'=>array('AND'=>array('used'=>'0', 'player_id' => $this->Session->read('Session.Player.id')))));
            foreach($lasguardadas as $id=>$pregunta){
                $lasguardadas[$id]['Questions']['options'] = $this->Options->find('all', array('conditions' => array('question_id' => $pregunta['Questions']['id'])));
                $lasguardadas[$id]['StoredQuestion']['category'] = $this->Players->StoredQuestion->Questions->categoryToHumanFriendly($pregunta['Questions']['category']);
            }
            $primera = 0;
            if(isset($this->request->data['id_pregunta']) && $this->request->data['id_pregunta'] != null){
                $primera = $this->request->data['id_pregunta'];
            }
            $this->set('guardadas', $lasguardadas);
            $this->set('primera', $primera);
        }else{
            $this->redirect('/');
        }
    }
    
    public function challengeSelector(){
        if($this->request->is('ajax')){
            $this->checkLogin();
            $this->loadModel('Players');    
            $this->layout = 'profile';
            $lasguardadas = $this->Players->StoredQuestion->find('all', array('conditions'=>array('AND'=>array('used'=>'0', 'player_id' => $this->Session->read('Session.Player.id')))));
            $randomplayers = $this->Players->find('all', array('recursive' => -1 , 'fields'=>array('Players.id', 'Players.fullname', 'Players.email', 'Players.facebook_id', 'Players.profile_pic'), 'limit'=>'20', 'order'=>'RAND()', 'conditions' => array('Players.id !=' => $this->Session->read('Session.Player.id'))));
            $this->set(compact('randomplayers', 'lasguardadas'));
        }else{
            $this->redirect('/');
        }
    }
    
    public function hairyQuestions(){
        if($this->request->is('ajax')){
            $this->checkLogin();    
            $this->layout = 'profile';
            $this->loadModel('Players');
            $this->loadModel('Questions');  
            $this->loadModel('Region');
            $this->loadModel('Notification');
            $ordenadas = array();
            $lasguardadas = $this->Players->StoredQuestion->find('all', array('conditions'=>array('AND'=>array('used'=>'0', 'player_id' => $this->Session->read('Session.Player.id')))));
            foreach($lasguardadas as $id=>$guardada){
                $ordenadas[$id] = $guardada['StoredQuestion'];
                $ordenadas[$id]['round'] = $guardada['Questions']['round'];
                $ordenadas[$id]['stage'] = $guardada['Questions']['stage'];
                $ordenadas[$id]['category'] = $this->Questions->categoryToHumanFriendly($guardada['Questions']['category']);
            }
            $this->set('storedQuestions', $ordenadas);
        }else{
            $this->redirect('/');
        }
    }

    public function notifications(){
        if($this->request->is('ajax')){
            $this->checkLogin();    
            $this->loadModel('Players');    
            $this->layout = 'notifications';
            $playerid = $this->Session->read('Session.Player.id');
            $info = $this->Players->Notification->find('all', array('recursive' => -1,'order' => 'Notification.date_created DESC', 'conditions' => array(
                                                                                 'Notification.player_id' => $playerid)
                                                                            )
                                                                        );
            $notificaciones = array();
            $notificaciones['NoLeidas'] = array();
            $notificaciones['Leidas'] = array();
            foreach($info as $notification){
                if($notification['Notification']['unread'] == true){
                    $notificaciones['NoLeidas'][] = $notification['Notification'];
                }else{
                    $notificaciones['Leidas'][] = $notification['Notification'];
                }
            }
            $this->set(compact('notificaciones'));
        }else{
            $this->redirect('/');
        }
    }
    
    public function trophies(){
        if($this->request->is('ajax')){
            $this->loadModel('Players');
            $this->loadModel('Award');
            $this->layout = 'trophies';
            $this->updateSesion();
            $trofeos = $this->Players->AwardUser->find('all', array('recursive' => -1, 'conditions' => array('AwardUser.player_id')));
            $lista_trofeos = $this->Award->find('all', array('recursive' => -1));
            $orden = array();
            foreach($lista_trofeos as $trophy){
                $orden[$trophy['Award']['id']]['subject'] = $trophy['Award']['subject'];
                $orden[$trophy['Award']['id']]['stage'] = $trophy['Award']['stage'];
                $orden[$trophy['Award']['id']]['obtained'] = false;
            }
            foreach($trofeos as $trofeo){
                $orden[$trofeo['AwardUser']['award_id']]['obtained'] = true;
            }
            $this->set(compact('orden'));
        }else{
            $this->redirect('/');
        }
    }
    
    public function finalScreen($category = null){
        if($this->request->is('ajax')){
            $this->layout = 'naked';
        }else{
            $this->layout = 'naked';
        }

    }
    
    public function challengeScreen(){
        if($this->request->is('ajax')){
            $this->loadModel('StoredQuestion');
            $this->loadModel('Questions');
            $this->updateSesion();
            $this->layout = 'challenge';
            $datos = $this->request->data;
            $guardadas = $this->StoredQuestion->find('all',
                                                array('recursive'=> -1, 'conditions' => 
                                                    array('challenge_id' => $datos['challenge_id'])
                                                )
                                            );
            $preguntas = $this->Questions->getChallengeQuestion($guardadas);    
            $challenge_id = $datos['challenge_id'];                         
            $this->set(compact('preguntas', 'challenge_id'));
        }else{
            $this->redirect('/');
        }
    }
}
