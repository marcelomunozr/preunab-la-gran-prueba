<?php
App::uses('AppModel', 'Model');


class Players extends AppModel {
	 
    public $useTable = 'players_clean';
    public $recursive = -1;
        
    	
	public $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'StoredQuestion' => array(
			'className' => 'StoredQuestion',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Challenge' => array(
			'className' => 'Challenge',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AwardUser' => array(
            'className' => 'AwardUser',
            'foreignKey' => 'player_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
	);
    
	public function getStage($round = null){
		$stage = 1;	
		if($round != null){
			if($round < 16){
				$stage = 1;
			}elseif($round >= 16 && $round < 31){
				$stage = 2;
			}elseif($round >= 31 && $round < 46){
				$stage = 3;
			}else{
				$stage = 4;
			}
		}
		return $stage;
	}
		
    public function getPlayerByID($id) {                
        $results = $this->find('first', array('recursive' => -1,'conditions' => array('Players.id' => $id)));
        $FBID = $results['Players']['facebook_id'];
        if($results) {
            App::import('Model','Notification');
            App::import('Model','StoredQuestion');
            App::import('Model','City');
            $modelCity  = new City();
            $modelNotif = new Notification();
            $modelSq    = new StoredQuestion();
            $results['Players']['stage_language']   = $this->getStage($results['Players']['round_language']);
            $results['Players']['stage_history']    = $this->getStage($results['Players']['round_history']);
            $results['Players']['stage_math']       = $this->getStage($results['Players']['round_math']);
            $results['Players']['stage_science']    = $this->getStage($results['Players']['round_science']);
            $results['Players']['stage_chemistry']  = $this->getStage($results['Players']['round_chemistry']);
            $results['Players']['stage_physics']    = $this->getStage($results['Players']['round_physics']);
            $results['Players']['stage_biology']    = $this->getStage($results['Players']['round_biology']);
            $results['Players']['points'] = $results['Players']['points_history'] + $results['Players']['points_math'] + $results['Players']['points_science'] + $results['Players']['points_language'];
            $results['Players']['rank_global'] = $this->getRank($FBID);
            $results['Players']['rank_history'] = $this->getRank($FBID, 'history');
            $results['Players']['rank_math'] = $this->getRank($FBID, 'math');
            $results['Players']['rank_science'] = $this->getRank($FBID, 'science');
            $results['Players']['rank_chemistry'] = $this->getRank($FBID, 'chemistry');
            $results['Players']['rank_physics'] = $this->getRank($FBID, 'physics');
            $results['Players']['rank_biology'] = $this->getRank($FBID, 'biology');
            $results['Players']['rank_language'] = $this->getRank($FBID, 'language');
            $guardadas = $modelSq->find('all', array('recursive' => -1, 'conditions' => array('AND'=>array('StoredQuestion.player_id' => $results['Players']['id'], 'StoredQuestion.used' => false))));
            $results['Players']['Notifications'] = $modelNotif->find('count', array('recursive' => -1, 'conditions' => array('AND'=>array('Notification.player_id' => $results['Players']['id'], 'Notification.unread' => true))));
            foreach($guardadas as $guardada){
                $results['Players']['StoredQuestion'][] = $guardada['StoredQuestion'];
            }
            $results['Players']['City'] = $modelCity->read(null, $results['Players']['city_id']);
        }
       return $results;
    }

    public function getPlayerByFBID($FBID) {                
        $results = $this->find('first', array('recursive' => -1,'conditions' => array('facebook_id' => $FBID)));
        if($results) {
            App::import('Model','Notification');
            App::import('Model','StoredQuestion');
            App::import('Model','City');
            $modelCity  = new City();
            $modelNotif = new Notification();
            $modelSq    = new StoredQuestion();
            $results['Players']['stage_language']   = $this->getStage($results['Players']['round_language']);
            $results['Players']['stage_history']    = $this->getStage($results['Players']['round_history']);
            $results['Players']['stage_math']       = $this->getStage($results['Players']['round_math']);
            $results['Players']['stage_science']    = $this->getStage($results['Players']['round_science']);
            $results['Players']['stage_chemistry']  = $this->getStage($results['Players']['round_chemistry']);
            $results['Players']['stage_physics']    = $this->getStage($results['Players']['round_physics']);
            $results['Players']['stage_biology']    = $this->getStage($results['Players']['round_biology']);
            $results['Players']['points'] = $results['Players']['points_history'] + $results['Players']['points_math'] + $results['Players']['points_science'] + $results['Players']['points_language'];
            $results['Players']['rank_global'] = $this->getRank($FBID);
            $results['Players']['rank_history'] = $this->getRank($FBID, 'history');
            $results['Players']['rank_math'] = $this->getRank($FBID, 'math');
            $results['Players']['rank_science'] = $this->getRank($FBID, 'science');
            $results['Players']['rank_chemistry'] = $this->getRank($FBID, 'chemistry');
            $results['Players']['rank_physics'] = $this->getRank($FBID, 'physics');
            $results['Players']['rank_biology'] = $this->getRank($FBID, 'biology');
            $results['Players']['rank_language'] = $this->getRank($FBID, 'language');
            $guardadas = $modelSq->find('all', array('recursive' => -1, 'conditions' => array('AND'=>array('StoredQuestion.player_id' => $results['Players']['id'], 'StoredQuestion.used' => false))));
            $results['Players']['Notifications'] = $modelNotif->find('count', array('recursive' => -1, 'conditions' => array('AND'=>array('Notification.player_id' => $results['Players']['id'], 'Notification.unread' => true))));
            foreach($guardadas as $guardada){
                $results['Players']['StoredQuestion'][] = $guardada['StoredQuestion'];
            }
            $results['Players']['City'] = $modelCity->read(null, $results['Players']['city_id']);
        }
       return $results;
    }

    public function getPlayerByEmail($email) {                
        $results = $this->find('first', array('recursive' => -1, 'conditions' => array('email' => $email)));
        if($results) {
            $FBID = $results['Players']['facebook_id'];
            App::import('Model','Notification');
            App::import('Model','StoredQuestion');
            App::import('Model','City');
            $modelCity  = new City();
            $modelNotif = new Notification();
            $modelSq    = new StoredQuestion();
            $results['Players']['stage_language']   = $this->getStage($results['Players']['round_language']);
            $results['Players']['stage_history']    = $this->getStage($results['Players']['round_history']);
            $results['Players']['stage_math']       = $this->getStage($results['Players']['round_math']);
            $results['Players']['stage_science']    = $this->getStage($results['Players']['round_science']);
            $results['Players']['stage_chemistry']  = $this->getStage($results['Players']['round_chemistry']);
            $results['Players']['stage_physics']    = $this->getStage($results['Players']['round_physics']);
            $results['Players']['stage_biology']    = $this->getStage($results['Players']['round_biology']);
            $results['Players']['points']           = $results['Players']['points_history'] + $results['Players']['points_math'] + $results['Players']['points_science'] + $results['Players']['points_language'];
            $results['Players']['rank_global']      = $this->getRank($FBID);
            $results['Players']['rank_history']     = $this->getRank($FBID, 'history');
            $results['Players']['rank_math']        = $this->getRank($FBID, 'math');
            $results['Players']['rank_science']     = $this->getRank($FBID, 'science');
            $results['Players']['rank_chemistry']   = $this->getRank($FBID, 'chemistry');
            $results['Players']['rank_physics']     = $this->getRank($FBID, 'physics');
            $results['Players']['rank_biology']     = $this->getRank($FBID, 'biology');
            $results['Players']['rank_language']    = $this->getRank($FBID, 'language');
            $guardadas = $modelSq->find('all', array('recursive' => -1, 'conditions' => array('AND'=>array('StoredQuestion.player_id' => $results['Players']['id'], 'StoredQuestion.used' => false))));
            $results['Players']['Notifications']    = $modelNotif->find('count', array('recursive' => -1, 'conditions' => array('AND'=>array('Notification.player_id' => $results['Players']['id'], 'Notification.unread' => true))));
            foreach($guardadas as $guardada){
                $results['Players']['StoredQuestion'][] = $guardada['StoredQuestion'];
            }
            $results['Players']['City'] = $modelCity->read(null, $results['Players']['city_id']);
        }
       return $results;
    }
    private function getRank($FBID, $category = '') {
        $rank = 0;
        if(empty($category)) {                        
            $results = $this->find('all', array('fields' => array('(points_math + points_science + points_language + points_history) AS points', 'facebook_id'), 'order'=> 'points DESC'));                                   
        } else {            
            $results = $this->find('all', array('fields' => array('(points_'.  strtolower($category).') AS points', 'facebook_id'), 'order'=> 'points DESC'));                        
        }
        foreach($results as $i => $player) {            
            if($player['Players']['facebook_id'] == $FBID)  {
                $rank = $i + 1;
            }
        }                              
        return $rank;
    }
	
	private function addManyPoints($userid = null){
		if($userid != null){
			return true;
		}else{
			return false;
		}
	}
}
