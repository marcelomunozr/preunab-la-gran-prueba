<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class PlayersController extends AppController {
		
	public $uses = array('Players', 'Questions', 'Region', 'City');
	
	public function beforeFilter(){
		parent::beforeFilter();	
	}
	
	public function checkIfFirst($eljugador = null){
		if($eljugador != null){
			if($eljugador['Players']['first_login'] == 1){
				$this->Players->id = $eljugador['Players']['id'];
				if($this->Players->saveField('first_login', 0)){
					$return = true;
				}else{
					$return = false;
				}
			}else{
				$return = false;
			}
		}else{
			$return = false;
		}
		return $return;
	}
	
	public function checkRegister(){
		$fbid = $this->request->data['fbid'];
        if($fbid != 0 && $fbid != null){     
            $eljugador = $this->Players->getPlayerByFBID($fbid);
    		$respuesta = array();
    		if(!empty($eljugador)){
    			$respuesta['existe'] = true;
    			$this->checkIfFirst($eljugador);
    			$this->createSesion($eljugador['Players']);
    			$this->rankSesion();
    		}else{
    			$respuesta['existe'] = false;
    		}
    		return $this->respondAsJson($respuesta);
        }else{
            $respuesta['existe'] = false;
            return $this->respondAsJson($respuesta);
        }
	}
	
	public function register(){
		if($this->request->is('post')){
			$insert = array();
			$insert = $this->request->data;
			if($insert['Players']['facebook_id'] != 0){
				$insert['Players']['profile_pic'] = 'http://graph.facebook.com/'.$insert['Players']['facebook_id'].'/picture?type=normal';
			}else{
				$insert['Players']['profile_pic'] = Router::url('/', true).'/profile_pics/default_profile.png';
			}
			$insert['Players']['created'] = date('Y-m-d H:i:s');
			$insert['Players']['modified'] = date('Y-m-d H:i:s');
			$insert['Players']['lives'] = 3;
			$insert['Players']['password'] = sha1($insert['Players']['password']);
			$insert['Players']['first_login'] = 1;
			$this->Players->create();
			if($this->Players->save($insert)){
				$id_player = $this->Players->getLastInsertID();
				$player = $this->Players->getPlayerByID($id_player);
				$this->createSesion($player['Players']);
				$this->rankSesion();
				return $this->respondAsJson(array('exito' => 1, 'eljugador' => $player));
			}else{
				return $this->respondAsJson(array('exito' => 1, 'mensaje' => 'Ha ocurrido un error al registrar'), 200);
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function sendResetPassword(){
		if(isset($this->request->data['email']) && $this->request->data['email'] != null){
			$email = $this->request->data['email'];
			$usuario = $this->Players->find('first', array('conditions' => array('Players.email' => $email)));
			if(!empty($usuario)){
				$token = sha1($email.date('d-m-Y H:i:s'));
				$this->Players->id = $usuario['Players']['id'];
				if($this->Players->saveField('token', $token)){
					$titulo = 'REESTABLECER MI CONTRASEÑA';	
					$url = "http://lagranprueba.preunab.cl/changePassword/?email=$email&token=$token";
					$body = "<p>Hemos recibido tu solicitud para cambiar tu clave en La Gran Prueba Preunab.<br />
Para reestablecer tu contraseña ingresa <a href='$url'>aquí</a> y valida tu nueva clave siguiendo los pasos indicados.<br />
Si no solicito cambiar la contraseña ignore este correo y siga participando en <a href='http://lagranprueba.preunab.cl'>La Gran Prueba Preunab</a></p>";	
					$subject = 'Se ha solicitado recuperación de contraseña';
					$respuesta = $this->_mailSend($this->request->data['email'], $subject, $body, $titulo);
					if($respuesta == true){
						return $this->respondAsJson(array('exito' => 1, 'msg' => 'Se ha enviado a su correo las instrucciones para reestablecer la contraseña'), 200);
					}else{
						return $this->respondAsJson(array('la_respuesta'=>$respuesta, 'exito' => 0, 'msg' => 'No se pudo enviar el correo'), 200);
					}
				}else{
					return $this->respondAsJson(array('exito' => 0, 'msg' => 'No se pudo generar el token'), 200);
				}
			}else{
				return $this->respondAsJson(array('exito' => 0, 'msg' => 'No existe un usuario con esa dirección de correo'), 200);
			}
		}else{
			return $this->respondAsJson(array('exito' => 0, 'msg' => 'No se ingreso el email'), 200);
		}
	}
	
	public function login(){
		if($this->request->is('post')){
			$datos = $this->request->data;
			$eljugador = $this->Players->getPlayerByEmail($datos['Players']['email']);
			if(!empty($eljugador)){
				$ing_password = sha1($datos['Players']['password']);
				if($ing_password == $eljugador['Players']['password']){
					$this->checkIfFirst($eljugador);	
					$this->createSesion($eljugador['Players']);
					return $this->respondAsJson(array('exito' => 1));
					exit();
				}else{
					return $this->respondAsJson(array('exito' => 0, 'msg' => 'Contraseña incorrecta'));
					exit();
				}	
			}else{
				return $this->respondAsJson(array('exito' => 0, 'msg' => 'No estas registrado, registrate para participar en La Gran Prueba'));
				exit();
			}
			return $this->respondAsJson(array('exito' => 1, 'losdatos' => $datos));
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function changePassword(){
		if($this->request->is('post')){
			
		}else{
			$email		= $this->request->query['email'];
			$token		= $this->request->query['token'];
			$elplayer	= $this->Players->find('first', array('recursive' => -1, 'fields' => array('Players.email', 'Players.token'), 'conditions' => array('Players.email' => $email)));
			$error = 0;
			if(!empty($elplayer)){
				if($token == $elplayer['Players']['token']){
					
					
				}else{
					$this->Session->setFlash('El token no coincide', 'flash_danger');
					$error = 1;
				}
			}else{
				$this->Session->setFlash('No existen usuarios con ese correo', 'flash_danger');
				$error = 1;
			}
			$this->set(compact('error'));
		}
	}
	
	public function storeQuestion(){
		if($this->request->is('ajax')){
			$playerid = $this->Session->read('Session.Player.id');
			$questionid = $this->request->data['id_pregunta'];
			$lapreg = $this->Players->StoredQuestion->find('first', array('conditions' => array(
																							'AND'=>
																								array(
																									'player_id' => $playerid,
																									'question_id' => $questionid),
																									'used' => 0
																								)
																							)
																						);
			$totales = $this->Players->StoredQuestion->find('count', array('conditions' => array('AND'=>array('used'=>'0', 'player_id' => $playerid))));
			if($totales >= 10){
				$mensaje = array('exito' => 0, 'msg' => 'Ya no puedes guardar más preguntas, ¡Desafía a uno de tus amigos primero!');
				return $this->respondAsJson($mensaje, 200);
			}else{
				if(count($lapreg) == 0){
					$insert = array();
					$insert['StoredQuestion']['question_id'] = $questionid;
					$insert['StoredQuestion']['player_id'] = $playerid;
					$insert['StoredQuestion']['date_stored'] = date('Y-m-d H:i:s');
					$this->Players->StoredQuestion->create();
					if($this->Players->StoredQuestion->save($insert)){
						$mensaje = array('exito' => 1, 'msg' => 'Pregunta guardada correctamente');
						return $this->respondAsJson($mensaje, 200);
					}else{
						$mensaje = array('exito' => 0, 'msg' => 'Ha ocurrido un error al guardar la pregunta');
						return $this->respondAsJson($mensaje, 200);
					}
				}else{
					$mensaje = array('exito' => 0, 'msg' => 'Esta pregunta ya ha sido guardada');
					return $this->respondAsJson($mensaje, 200);
				}
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}

	public function deleteQuestion(){
		if($this->request->is('ajax')){
			$playerid = $this->Session->read('Session.Player.id');
			$questionid = $this->request->data['id_guardada'];
			if($questionid != null){
				if($this->Players->StoredQuestion->delete($questionid)){
					$mensaje = array('exito' => 1, 'msg' => 'Pregunta eliminada');
					return $this->respondAsJson($mensaje, 200);
				}
			}else{
				$mensaje = array('exito' => 0, 'msg' => 'No se ha podido eliminar la pregunta');
				return $this->respondAsJson($mensaje, 200);
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function checkFriends(){
		$this->autoRender = false;	
		$this->layout = 'ajax';		
		if($this->request->is('ajax')){
			$datos = $this->request->input('json_decode');
			$jugando = array();
			foreach($datos as $amigo){
				$fbid = $amigo->id;
				$resultado = $this->Players->getPlayerByFBID($fbid);
				if(!empty($resultado)){
					$jugando[] = $resultado;
				}
			}
			$this->set(compact('jugando'));
			$this->render('/Elements/friend_list');
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function issueChallengeUponThee(){
		$this->autoRender = false;
		$this->loadModel('Notification');
		$this->loadModel('Challenge');
		if($this->request->is('ajax')){
			$target_id = $this->request->data['id_desafiado'];
			$preguntas = $this->Players->StoredQuestion->find('all', 
														array(
															'limit' => 10,
															'order' => array('date_stored DESC'),
															'conditions' => array(
																'AND' => array(
																	'player_id' => $this->Session->read('Session.Player.id'),
																	'used' => 0,
																	'challenge_id' => null 
																)
															)
														)
													);
			
			if($target_id != '' && $target_id != $this->Session->read('Session.Player.id')){
				$this->Challenge->create();
				$insert = array();
				$insert['Challenge']['player_id'] = $target_id;
				$insert['Challenge']['sender_id'] = $this->Session->read('Session.Player.id');
				$insert['Challenge']['date_created'] = date('Y-m-d H:i:s');
				if($this->Challenge->save($insert)){
					$id_desafio = $this->Challenge->getLastInsertID();
					foreach($preguntas as $pregunta){
						$this->Players->StoredQuestion->id = $pregunta['StoredQuestion']['id'];
						$this->Players->StoredQuestion->saveField('challenge_id', $id_desafio);
						$this->Players->StoredQuestion->saveField('used', 1);
					}
					$insert = array();
					$insert['Notification']['text'] = '¡'.$this->Session->read('Session.Player.fullname').' te ha desafiado a un duelo de conocimientos!';
					$insert['Notification']['sender_id'] = $this->Session->read('Session.Player.id');
					$insert['Notification']['player_id'] = $target_id;
					$insert['Notification']['issue'] = 'CHALLENGE';
					$insert['Notification']['challenge_id'] = $id_desafio;
					$insert['Notification']['unread'] = 1;
					$insert['Notification']['date_created'] = date('Y-m-d H:i:s');
					$this->Notification->create();
					if($this->Notification->save($insert)){
						$desafiado = $this->Players->find('first', array('conditions'=>array('Players.id' => $target_id), 'fields' => array('Players.id', 'Players.fullname')));
						$autonot = array();	
						$autonot['Notification']['text'] = 'Has desafiado a '. $desafiado['Players']['fullname'] .'. Espera a que responda para ver si ganaste o perdiste este desafío.';
						$autonot['Notification']['sender_id'] = $this->Session->read('Session.Player.id');
						$autonot['Notification']['player_id'] = $this->Session->read('Session.Player.id');
						$autonot['Notification']['issue'] = 'NOTIFICATION';
						$autonot['Notification']['challenge_id'] = '';
						$autonot['Notification']['unread'] = 1;
						$autonot['Notification']['date_created'] = date('Y-m-d H:i:s');
						$this->Notification->create();
						$this->Notification->save($autonot);
						$mensaje = array('exito' => 1, 'msg' => 'Todo OK');
						return $this->respondAsJson($mensaje, 200);
					}else{
						$mensaje = array('exito' => 0, 'msg' => 'No se guardo la notificacion ');
						return $this->respondAsJson($mensaje, 200);
					}
				}else{
					$mensaje = array('exito' => 0, 'msg' => 'No se guardo el desafio ');
					return $this->respondAsJson($mensaje, 200);
				}
			}else{
				$mensaje = array('exito' => 0, 'msg' => 'Usuario no valido');
				return $this->respondAsJson($mensaje, 200);
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function challengeEnd(){
		if($this->request->is('post')){
			
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function sendInvite(){
		$this->autoRender = false;	
		if($this->request->is('post')){
			$datos = $this->request->data;
			if(isset($datos['emailAmigo']) && $datos['emailAmigo'] != ''){
				$url = 'http://lagranprueba.preunab.cl/';
				$email = $datos['emailAmigo'];
				$nombre = ($datos['nombreAmigo'] != '') ? $datos['nombreAmigo'] : $datos['emailAmigo'];
				$body = '
				<p>¡'.$this->Session->read('Session.Player.fullname').' te ha invitado a La Gran Prueba 2015!<br />
				Ensayando para la PSU 2015 podrás ir sumando puntaje, y así acceder a premios y sorteos.<br />
				Para comenzar haz <a href="'.$url.'">click aquí</a><br />
				<br />
				Puedes jugar en PC o Smarphone.</p>';	
				$subject = '¡¡Has sido invitado a La Gran Prueba!!';
				$titulo = 'Te invito a La Gran Prueba';
				$remitente = array();
				$remitente['nombre'] = $this->Session->read('Session.Player.fullname');
				$remitente['email'] = $this->Session->read('Session.Player.email');
				$respuesta = $this->_mailSend($email, $subject, $body, $titulo, $remitente);
				if($respuesta == true){
					return $this->respondAsJson(array('exito' => 1, 'msg' => 'Se ha invitado correctamente'), 200);
				}else{
					return $this->respondAsJson(array('la_respuesta'=>$respuesta, 'exito' => 0, 'msg' => 'No se pudo enviar el correo'), 200);
				}				
			}else{
				return $this->respondAsJson(array(), 405);
			}
		}elseif($this->request->is('options')){
			return $this->respondAsJson(array('message' => 'Carry on'), 206);
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function editProfileField(){
		$this->autoRender = false;	
		if($this->request->is('post')){
			$datos = $this->request->data;
			if(isset($datos['Player']['fieldname']) && $datos['Player']['fieldname'] != ''){
				$field = $datos['Player']['fieldname'];	
				if(isset($datos['Player'][$field]) && $datos['Player'][$field] != ''){
					$this->Players->id = $this->Session->read('Session.Player.id');
					if($this->Players->saveField($field, $datos['Player'][$field])){
						$new_field = $datos['Player'][$field];
						if($field == 'city_id'){
							$city = $this->Players->City->read(null, $datos['Player'][$field]);
							$new_field = $city['City']['name'];
						}
						return $this->respondAsJson(array('exito' => 1, 'new_field' => $new_field), 200);
					}else{
						return $this->respondAsJson(array('exito' => 0, 'reason' => 'error'), 200);
					}
				}else{
					return $this->respondAsJson(array('exito' => 0, 'reason' => 'empty'), 200);
				}
			}else{
				return $this->respondAsJson(array('exito' => 0, 'reason' => 'no-field'), 200);
			}
			
		}elseif($this->request->is('options')){
			return $this->respondAsJson(array('message' => 'Carry on'), 206);
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function endChallenge(){
		$this->autoRender = false;
		$this->loadModel('Challenge');
		$this->loadModel('Notification');
		$player_fields = array(
			'points_biology',
			'points_chemistry',
			'points_history',
			'points_language',
			'points_math',
			'points_physics',
			'points_science'
		);
		
		if($this->request->is('post')){
			$datos = $this->request->data;	
			if($datos['challenge_id'] != null){
				$desafio = $this->Challenge->read(null, $datos['challenge_id']);
				$lanot = $this->Notification->find('first', array('conditions' => array('challenge_id' => $datos['challenge_id'])));
				$text_salida = '';
				$this->Notification->id = $lanot['Notification']['id'];
				$this->Notification->saveField('unread', 0);
				$this->Challenge->id = $datos['challenge_id'];
				$this->Challenge->saveField('finished', 1);
				switch ($datos['reason']) {
					case 'END_ROUND':
						$this->Players->id = $desafio['Players']['id'];
						foreach($player_fields as $field){
							$newpts = $desafio['Players'][$field] + 15;
							$this->Players->saveField($field, $newpts);
						}
						$insert = array();
						$this->Notification->create();	
						$insert['Notification']['text'] = '¡'.$desafio['Players']['fullname'] .' te ganó el desafío! Se ha llevado 100 pts. extras.';
						$insert['Notification']['sender_id'] = '';
						$insert['Notification']['player_id'] = $desafio['Challenge']['sender_id'];
						$insert['Notification']['issue'] = 'NOTIFICATION';
						$insert['Notification']['challenge_id'] = '';
						$insert['Notification']['unread'] = 1;
						$insert['Notification']['date_created'] = date('Y-m-d H:i:s');
						if($this->Notification->save($insert)){
							$this->Notification->create();
							$not = array();
							$not['Notification']['text'] = '¡Ganaste 100 pts. extras por ganar el desafío!';
							$not['Notification']['sender_id'] = null;
							$not['Notification']['player_id'] = $this->Session->read('Session.Player.id');
							$not['Notification']['issue'] = 'NOTIFICATION';
							$not['Notification']['challenge_id'] = '';
							$not['Notification']['unread'] = 1;
							$not['Notification']['date_created'] = date('Y-m-d H:i:s');
							$this->Notification->save($not);
						}
						$text_salida = '';
						break;
					default:
						$this->Players->id = $desafio['Challenge']['sender_id'];
						foreach($player_fields as $field){
							$newpts = $desafio['Players'][$field] + 15;
							$this->Players->saveField($field, $newpts);
						}
						$insert = array();
						$this->Notification->create();
						$insert['Notification']['text'] = '¡'.$desafio['Players']['fullname'] .' no se la pudo y perdió el desafio! Te llevas 100 pts. extras por ganarle.';
						$insert['Notification']['sender_id'] = null;
						$insert['Notification']['player_id'] = $desafio['Challenge']['sender_id'];
						$insert['Notification']['issue'] = 'NOTIFICATION';
						$insert['Notification']['challenge_id'] = '';
						$insert['Notification']['unread'] = 1;
						$insert['Notification']['date_created'] = date('Y-m-d H:i:s');
						if($this->Notification->save($insert)){
							$this->Notification->create();
							$not = array();
							$not['Notification']['text'] = '¡Perdiste el desafío! Tu amigo se lleva los puntos.';
							$not['Notification']['sender_id'] = null;
							$not['Notification']['player_id'] = $this->Session->read('Session.Player.id');
							$not['Notification']['issue'] = 'NOTIFICATION';
							$not['Notification']['challenge_id'] = '';
							$not['Notification']['unread'] = 1;
							$not['Notification']['date_created'] = date('Y-m-d H:i:s');
							$this->Notification->save($not);
						}
						$text_salida = '';
						break;
				}
				return $this->respondAsJson(array('exito' => 1), 200);
			}else{
				return $this->respondAsJson(array(), 400);
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function sp($points, $category) {
        $this->autoRender = false;
        if(!$this->Session->read('Session.Player.id')) {
            return false;                    
        }                
        if($points) {            
            $this->Players->query('UPDATE players_clean SET points_'.$category.' = '.$points.' WHERE id = '.$this->Session->read('Session.Player.id'));
            return true;
        }
        return false;
    }
	
	public function logOut(){
		$this->autoRender = false;
		$this->Session->destroy();
		return $this->redirect('/');
	}
	
}
