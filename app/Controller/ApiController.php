<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ApiController extends AppController {
		
	public $components = array('Paginator', 'RequestHandler');
	public $uses = array('Players', 'Questions', 'Region', 'City', 'GlobalMessage', 'Challenge', 'StoredQuestion');
	
	public function beforeFilter(){
		if(!$this->request->is('ajax')){
			if(!$this->request->is('options')){
				return $this->respondAsJson(array(), 401);
				exit();	
			}else{
				return $this->respondAsJson(array('mensaje' => 'Carry on my wayward son, There will be peace when you are done'), 206);
			}
		}
	}
	
	public function actualStage(){
		return $this->respondAsJson(array('actual_stage' => 2), 200);	
	}
	
	public function restartLives(){
		if($this->request->is('post')){
			$datos = $this->request->input('json_decode');
			if(isset($datos->user_id) && $datos->user_id != null){
				$this->Players->id = $datos->user_id;
				if($this->Players->saveField('lives', 3)){
					$this->updateSesion();	
					return $this->respondAsJson(array('exito' => 1), 200);
				}else{
					return $this->respondAsJson(array('exito' => 0), 400);
				}
			}
		}else{
			return $this->respondAsJson(array(), 401);
			exit();
		}
	}
	
	public function getTheRanking(){
		$elranking = $this->getRanking();
		$ranking_ordenado = array();
		$counter = 0;
		$categorias = array(
			'general' => 'Ranking General',
			'history' => 'Historia',
			'math' => 'Matemáticas',
			'language' => 'Lenguaje',
			'science' => 'Ciencias'
		);
		foreach($elranking as $ct=>$ranking){
			$ranking_ordenado[$counter]['titulo'] = $categorias[$ct];	
			foreach($ranking['jugadores'] as $id=>$jugador){
				$ranking_ordenado[$counter]['jugadores'][$id] = $jugador['Players'];
				if(isset($jugador[0]['points'])){
					$ranking_ordenado[$counter]['jugadores'][$id]['points'] = $jugador[0]['points'];
				}
			}
			$counter += 1;
		}
		return $this->respondAsJson(array('ranking' => $ranking_ordenado), 200);
		exit();
	}
	
	public function checkLastUpdates(){
		$lastupdate = $this->Questions->find('all', array('fields' => array('Questions.modified'), 'order' => 'Questions.modified DESC'));
		$sorted = array();
		foreach($lastupdate as $id=>$fecha){
			$sorted[$fecha['Questions']['id']] =  $fecha['Questions']['modified'];
		}
		$respuesta = array('ultimas' => $sorted);
		return $this->respondAsJson($respuesta, 200);
	}
	
	public function checkLastUpdate(){
		$lastupdate = $this->Questions->find('first', array('fields' => array('Questions.modified'), 'order' => 'Questions.modified DESC'));
		$respuesta = array('ultima_modificacion' => $lastupdate['Questions']['modified']);
		return $this->respondAsJson($respuesta, 200);
	}
	
	public function biLogin(){
		if(!$this->request->is('post')){
			if($this->request->is('options')){
				return $this->respondAsJson(array('mensaje' => 'Carry On'), 206);
				exit();	
			}else{
				return $this->respondAsJson(array(), 401);
				exit();	
			}
		}else{
			$mail_login = false;
			$datos = $this->request->input('json_decode');
			if(empty($datos)){
				return $this->respondAsJson(array(), 400);
				exit();
			}
			if(isset($datos->facebook_id)){
				$fbid = $datos->facebook_id;
				$eljugador = $this->Players->getPlayerByFBID($fbid);
				if(isset($datos->email) && empty($eljugador)){
					$eljugador = $this->Players->getPlayerByEmail($datos->email);
					if(!empty($eljugador)){
						$this->Players->id = $eljugador['Players']['id'];
						if($this->Players->saveField('facebook_id', $datos->facebook_id)){
							$eljugador = $this->Players->getPlayerById($eljugador['Players']['id']);
						}
					}
				}
			}else{
				$email = $datos->email;
				$eljugador = $this->Players->getPlayerByEmail($email);
				$mail_login = true;
			}
			if(!empty($eljugador)){
				if($mail_login == true){
					if(sha1($datos->password) != $eljugador['Players']['password']){
						return $this->respondAsJson(array('exito' => 0, 'msg' => 'Contraseña incorrecta'), 200);
 						exit();
					}
				}
				$eljugador['Players']['password'] = 'ITS A MYSTERY';
				return $this->respondAsJson($eljugador, 200);
			}else{
				if(!isset($datos->email)){
					return $this->respondAsJson(array('msg' => 'No pueden estar vacios ni nombre ni email'), 402);
					exit();
				}else{
					$data = array();
					if(isset($datos->facebook_id)){
						$password = sha1($datos->facebook_id);
						$elemail = (isset($datos->email)) ? $datos->email : $datos->facebook_id.'@facebook.com';
					}else{
						$elemail = $datos->email;
						$password = sha1($datos->password);
					}
					$data['Players']['fullname']		= isset($datos->fullname) ? $datos->fullname : $email;
					$data['Players']['email']			= $elemail;
					$data['Players']['facebook_id']		= isset($datos->facebook_id) ? $datos->facebook_id : '';
					$data['Players']['created']			= date('Y-m-d H:i:s');
					$data['Players']['modified']		= date('Y-m-d H:i:s');
					$data['Players']['lives']			= 3;
					$data['Players']['password']		= $password;
					if(isset($datos->facebook_id) && $datos->facebook_id != 0){
						$data['Players']['profile_pic'] = 'http://graph.facebook.com/'.$datos->facebook_id.'/picture?type=normal';
					}else{
						$data['Players']['profile_pic'] = Router::url('/', true).'/profile_pics/default_profile.png';
					}
					if($this->Players->save($data)){
						$laid = $this->Players->getLastInsertID();
						$mensaje = array();
						$mensaje['exito'] = 1;
						$eljugador = $this->Players->getPlayerByID($laid);
						$eljugador['Players']['password'] = 'ITS A MYSTERY';
						$mensaje = $eljugador;
						return $this->respondAsJson($mensaje, 200);
						exit();
					}else{
						return $this->respondAsJson(array(), 400);
						exit();
					}
				}
			}
		}
	}
	
	public function updateUser(){
		if($this->request->is('post')){
			$datos = $this->request->input('json_decode');
			if(isset($datos->userId)){
				$user = $this->Players->getPlayerByID($datos->userId);
				$user['Players']['password'] = 'ITS A MYSTERY';
				return $this->respondAsJson($user, 200);
			}else{
				return $this->respondAsJson(array(), 400);
				exit();
			}
		}elseif($this->request->is('options')){
			return $this->respondAsJson(array(), 206);
			exit();
		}else{
			return $this->respondAsJson(array(), 402);
			exit();
		}
	}
	
	public function editProfileField(){
		$this->autoRender = false;	
		if($this->request->is('post')){
			$datos = $this->request->input('json_decode');
			if(isset($datos->fieldname) && $datos->fieldname != ''){
				$field = $datos->fieldname;	
				if(isset($datos->value) && $datos->value != ''){
					$this->Players->id = $datos->user_id;
					if($this->Players->saveField($field, $datos->value)){
						return $this->respondAsJson(array('exito' => 1, 'new_field' => $datos->value), 200);
					}else{
						return $this->respondAsJson(array('exito' => 0, 'reason' => 'error'), 200);
					}
				}else{
					return $this->respondAsJson(array('exito' => 0, 'reason' => 'empty'), 200);
				}
			}else{
				return $this->respondAsJson(array('exito' => 0, 'reason' => 'no-field'), 200);
			}
		}else{
			return $this->respondAsJson(array(), 405);
		}
	}
	
	public function areYouTalkingToMe(){
		$this->autoRender = false;	
		if($this->request->is('post')){
			$datos = $this->request->input('json_decode');
			$challengeid = $datos->challengeId;
			//$challengeid = $this->request->query['challenge_id'];
			$sorted = array();
			if(isset($challengeid)){
				$desafio = $this->Challenge->read(null, $challengeid);
				$sorted['Challenge'] = $desafio['Challenge'];
				$desafiante = $this->Players->read(null, $desafio['Challenge']['sender_id']);
				$sorted['Challenge']['Challenger']['id']			= $desafiante['Players']['id'];
				$sorted['Challenge']['Challenger']['fullname']		= $desafiante['Players']['fullname'];
				$sorted['Challenge']['Challenger']['email']			= $desafiante['Players']['email'];
				$sorted['Challenge']['Challenger']['profile_pic']	= $desafiante['Players']['profile_pic'];
				if(!empty($desafio)){
					$preguntas = $this->StoredQuestion->find('all', array('recursive'=>-1, 'conditions' => array('challenge_id' => $challengeid)));		
					foreach($preguntas as $pregunta){
						$sorted['Challenge']['Questions'][] = $pregunta['StoredQuestion'];
					}
					return $this->respondAsJson($sorted, 200);
				}else{
					return $this->respondAsJson(array(), 400);	
				}
			}else{
				return $this->respondAsJson(array(), 400);
			}
		}else{
			return $this->respondAsJson(array(), 400);
		}
	}
	
	public function storeQuestion(){
		$datos = $this->request->input('json_decode');
		$playerid = $datos->user_id;
		$questionid = $datos->id_pregunta;
		$lapreg = $this->Players->StoredQuestion->find('first', array('conditions' => array(
																						'AND'=>
																							array(
																								'player_id' => $playerid,
																								'question_id' => $questionid,
                                                                                                'used' => 0)
																							)
																						)
																					);
		$totales = $this->Players->StoredQuestion->find('count', array('conditions' => array('AND'=>array('used'=> 0, 'player_id' => $playerid))));
		if($totales >= 10){
			$mensaje = array('limite'=> true, 'exito' => 0, 'existente' => false);
			return $this->respondAsJson($mensaje, 200);
		}else{
			if(count($lapreg) == 0){
				$insert = array();
				$insert['StoredQuestion']['question_id'] = $questionid;
				$insert['StoredQuestion']['player_id'] = $playerid;
				$insert['StoredQuestion']['date_stored'] = date('Y-m-d H:i:s');
				$this->Players->StoredQuestion->create();
				if($this->Players->StoredQuestion->save($insert)){
					$mensaje = array('exito' => 1, 'limite'=> false, 'existente' => false);
					return $this->respondAsJson($mensaje, 200);
				}else{
					$mensaje = array('exito' => 0, 'limite'=> false, 'existente' => false);
					return $this->respondAsJson($mensaje, 200);
				}
			}else{
				$mensaje = array('exito' => 0, 'limite'=> false, 'existente' => true);
				return $this->respondAsJson($mensaje, 200);
			}
		}
	}
	
	public function thisIsTheEnd(){
		if($this->request->is('post')){
			$datos = $this->request->input('json_decode');
			if(isset($datos->userid) && $datos->userid != ''){
				$userid		= $datos->userid;
				$reason		= $datos->reason;
				$wildcards	= $datos->wildcards;
				$category	= $datos->category;
				$usuario = $this->Players->find('first', array('conditions' => array('Players.id' => $userid)));
				switch ($reason) {
					case 'victory':
						$varpoints = ($wildcards == true) ? 100 : 150;
						$newround = 0;
						$newround  = $usuario['Players']['round_'.strtolower($category)] + 1;
						$newpoints = (int)$usuario['Players']['points_'.strtolower($category)] + (int)$varpoints;
						$this->Players->id = $userid;
						if($this->Players->saveField('round_'.strtolower($category), $newround) && $this->Players->saveField('points_'.strtolower($category), $newpoints)){
							$eljugador = $this->Players->getPlayerByID($userid);
							$eljugador['Players']['password'] = 'ITS A MYSTERY';
							return $this->respondAsJson(array('exito'=>1, 'msg' => 'Paso de ronda', 'jugador' => $eljugador), 200);
							exit();
						}
						break;
					case 'defeat':
						$this->Players->id = $userid;
						$newlives = ($usuario['Players']['lives'] <= 0) ? 0 : $usuario['Players']['lives'] - 1;
						if($this->Players->saveField('lives', $newlives)){
							$eljugador = $this->Players->getPlayerByID($userid);
							$eljugador['Players']['password'] = 'ITS A MYSTERY';	
							return $this->respondAsJson(array('exito'=>1, 'msg' => 'Fallo la ronda', 'jugador' => $eljugador), 200);
							exit();
						}
						break;
					default:
						return $this->respondAsJson(array('msg' => 'Sin Razón'), 400);
						exit();
						break;
				}
			}else{
				return $this->respondAsJson(array(), 400);
				exit();
			}
		}elseif($this->request->is('options')){
			return $this->respondAsJson(array('msg'=>'These are not the droids you`re looking for'), 206);
			exit();
		}else{
			return $this->respondAsJson(array(), 405);
			exit();	
		}
	}
	
	public function userProfile(){
		if(!$this->request->is('post')){
			$datos = $this->request->input('json_decode');
			if(isset($datos->user_id) && $datos->user_id != ''){
				$usuario = $this->Players->find('first', array('conditions' => array('Players.id' => $datos->user_id)));
				if(!empty($usuario)){
					$perfil = array();
					$perfil['Player'] = $usuario['Players'];
					$perfil['Player']['Notifications'] = $usuario['Notification'];
					$perfil['Player']['StoredQuestions'] = $usuario['StoredQuestion'];	
					return $this->respondAsJson(array(), 200);
					exit();
				}else{
					return $this->respondAsJson(array(), 400);
					exit();
				}
			}else{
				return $this->respondAsJson(array(), 400);
				exit();
			}
		}else{
			return $this->respondAsJson(array(), 405);
			exit();	
		}
	}

	public function sendResetPassword(){
		if(!$this->request->is('post')){
			if($this->request->is('options')){
				return $this->respondAsJson(array('mensaje' => 'Carry On'), 206);
				exit();	
			}else{
				return $this->respondAsJson(array(), 401);
				exit();	
			}
		}else{	
			$datos = $this->request->input('json_decode');
			if(isset($datos->email) && $datos->email != null){
				$email = $datos->email;
				$usuario = $this->Players->find('first', array('conditions' => array('Players.email' => $email)));
				if(!empty($usuario)){
					$token = sha1($email.date('d-m-Y H:i:s'));
					$this->Players->id = $usuario['Players']['id'];
					if($this->Players->saveField('token', $token)){
						$datos = array('email' => $email, 'token' => $token, 'url' => 'http://lagranprueba.preunab.cl/changePassword/?');	
						$subject = 'Se ha solicitado recuperación de contraseña';
						$respuesta = $this->_mailSend($email, $subject, $datos);
						if($respuesta == true){
							return $this->respondAsJson(array('exito' => 1, 'msg' => 'Se ha enviado a su correo las instrucciones para reestablecer la contraseña'), 200);
						}else{
							return $this->respondAsJson(array('la_respuesta'=>$respuesta, 'exito' => 0, 'msg' => 'No se pudo enviar el correo'), 400);
						}
					}else{
						return $this->respondAsJson(array('exito' => 0, 'msg' => 'No se pudo generar el token'), 400);
					}
				}else{
					return $this->respondAsJson(array('exito' => 0, 'msg' => 'No existe un usuario con esa dirección de correo'), 400);
				}
			}else{
				return $this->respondAsJson(array('exito' => 0, 'msg' => 'No se ingreso el email'), 400);
			}
		}
	}
	
	public function allQuestions(){
		$preguntas = $this->Questions->getApiAllQuestions();
		foreach($preguntas as $id=>$pregunta):
			$preguntas[$id]['Questions']['question'] = $this->cleanQuestion($pregunta['Questions']['question']);
			if($pregunta['Questions']['stage']>1):
				$stage = $pregunta['Questions']['stage'] - 1;
				$factor = 15 * $stage;
				$ronda_nueva = $pregunta['Questions']['round'] + $factor;
				$preguntas[$id]['Questions']['round'] = (string)$ronda_nueva;
			endif;
		endforeach;
		$ordenadas = array();
		foreach($preguntas as $id=>$pregunta):
			$opciones = array();
			$ordenadas[$id]['Question'] = $pregunta['Questions'];
			foreach($pregunta['options'] as $ct=>$opcion):
				$opciones[$ct] = $opcion['Options'];
			endforeach;
			$ordenadas[$id]['Question']['Options'] = $opciones;
		endforeach;
		$preguntas = $ordenadas;
		return $this->respondAsJson($preguntas, 200);
	}
	
	public function someQuestionsNotAllOfThem(){
		if($this->request->is('options')){
			return $this->respondAsJson(array('mensaje'=>'Carry on'), 206);
		}else{	
			$datos = $this->request->input('json_decode');
			$from = $datos->desde;
			if($from != null){
				$preguntas = $this->Questions->getOnlySomeQuestionsStartingFrom($from);
				if($preguntas !== false){
					foreach($preguntas as $id=>$pregunta):
						$preguntas[$id]['Questions']['question'] = $this->cleanQuestion($pregunta['Questions']['question']);
						if($pregunta['Questions']['stage']>1):
							$stage = $pregunta['Questions']['stage'] - 1;
							$factor = 15 * $stage;
							$ronda_nueva = $pregunta['Questions']['round'] + $factor;
							$preguntas[$id]['Questions']['round'] = (string)$ronda_nueva;
						endif;
					endforeach;
					$ordenadas = array();
					foreach($preguntas as $id=>$pregunta):
						$opciones = array();
						$ordenadas[$id]['Question'] = $pregunta['Questions'];
						foreach($pregunta['options'] as $ct=>$opcion):
							$opciones[$ct] = $opcion['Options'];
						endforeach;
						$ordenadas[$id]['Question']['Options'] = $opciones;
					endforeach;
					$preguntas = $ordenadas;
					return $this->respondAsJson($preguntas, 200);
				}else{
					return $this->respondAsJson(array(), 200);
				}
			}else{
				return $this->respondAsJson(array(), 400);
			}
		}
	}

	public function cleanQuestion($pregunta_html = null){
		$regex = '~<span[^>]+?style="[^"]*text-decoration: underline[^"]*"[^>]*>(.*?)</span>~';
		$pregunta_plana = preg_replace($regex, '<u>$1</u>', $pregunta_html);
		$pregunta_plana = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $pregunta_plana);
		$pregunta_plana = preg_replace('/class=".*?"/', '', $pregunta_plana);
		$pregunta_plana = strip_tags($pregunta_plana, '<ul><li><u><img><p><br><table><tr><td><th><thead><tbody>');
		$buscar = 'files/';
		$reemplazo = 'http://lagranprueba.preunab.cl/files/';
		$pregunta_plana = str_replace('/files/', 'files/', $pregunta_plana);
		$pregunta_plana = str_replace('http://lagranprueba.preunab.cl/', '', $pregunta_plana);
		$pregunta_plana = str_replace('http://lagranprueba.preunab.cl', '', $pregunta_plana);
		$pregunta_plana = str_replace($buscar, $reemplazo, $pregunta_plana);
		$pregunta_plana = str_replace("<P ><BR></P>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<p ><br></p>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<P><BR></P>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<p><br></p>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<p>&nbsp;</p>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<P>&nbsp;</P>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<p></p>", "", $pregunta_plana);
		$pregunta_plana = str_replace("<P></P>", "", $pregunta_plana);
		$pregunta_plana = str_replace("class=MsoNormal", "", $pregunta_plana);
		return $pregunta_plana;
	}
}