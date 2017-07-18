<?php
   
class OlympicQuestion extends AppModel {
        
    public $useDbConfig = 'stelios_prod';
    
    private $categories = array(
                                'MATH' => 'Matemáticas',
                                'HISTORY' => 'Historia / Sociales',
                                'SCIENCE' => 'Ciencias Naturales',
                                'CHEMISTRY' => 'Química',
                                'PHYSICS' => 'Física',
                                'BIOLOGY' => 'Biología',
                                'LANGUAGE' => 'Lenguaje y Comunicación'
                               );
    
    private $characterToCategories = array( 
                                            'pitagoras' => 'MATH',
                                            'bello' => 'LANGUAGE',
                                            'colon' => 'HISTORY',
                                            'einstein' => 'SCIENCE',
                                            'marie-curie' => 'CHEMISTRY',
                                            'newton' => 'PHYSICS',
                                            'darwin' => 'BIOLOGY',              
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
        )
    );
    public function typeToHumanFriendly($type) {
        
        $return = false;                                 
        
        if($type == 'MULTIPLE_CHOICE') { $return = 'Selección Multiple'; }
        if($type == 'SINGLE_CHOICE') { $return = 'Selección Simple'; }
        if($type == 'FIB') { $return = 'Complete el Espacio en Blanco'; }
        if($type == 'TF_SIMPLE') { $return = 'Verdadero / Falso'; }
        if($type == 'TF_MULTIPLE') { $return = 'Verdadero / Falso Multiple'; }
        if($type == 'OPTION_CHOICES') { $return = 'Elija la Opción'; }
        if($type == 'COMPLETE_BOX') { $return = 'Complete el Cuadro en Blanco'; }
        
        return $return;
    }
    
    public function categoryToHumanFriendly($category) {                                                
        
        if(isset($this->categories[$category])) {
            return $this->categories[$category];
        } else {
            return false;
        }
            
    }     

    public function characterToCategory($character) {                                                
        
        if(isset($this->characterToCategories[$character])) {
            return $this->characterToCategories[$character];
        } else {
            return false;
        }
            
    } 
    
    public function getAllCategories() {        
        return $this->categories;
    }
    
    
    public function getRoundQuestions($character) {
        App::import('Component', 'SessionComponent'); 
        App::import('Model','Players');
        App::import('Model','Options');
        $modelPlayers = new Players();
        $modelOptions = new Options();
        $category = isset($this->characterToCategories[$character]) ? $this->characterToCategories[$character] : false;        
        $playerInfo = $modelPlayers->getPlayerByID(SessionComponent::read('Session.Player.id'));    
        if(!empty($playerInfo) && $category) {
            if(!$playerInfo) {
                return false;
            } 
            $userRound = $playerInfo['Players']['round_' . strtolower($category)];
            if($userRound >= 16):
                if($userRound >= 31):
                    $userRound = $userRound - 30;
                    $userStage = 3;
                else:
                    $userRound = $userRound - 15;
                    $userStage = 2;
                endif;
            else:
                $userStage = 1;
            endif;
            $conditions = array(                
                'Questions.round'    => $userRound,
                'Questions.stage'    => $userStage,
                'Questions.category' => $category
            );              
            $roundQuestions =  $this->find('all', array('conditions' => $conditions, 'order' => 'RAND()', 'limit' => 10));            
            if(!$roundQuestions) {
                return false;
            }

            foreach($roundQuestions as &$question) {
                $question['Questions']['question'] = $this->cleanQuestion($question['Questions']['question']);
                $question['options'] = $modelOptions->find('all', array('conditions' => array('question_id' => $question['Questions']['id']), 'order' => 'RAND()'));  
            }
            return $roundQuestions;
        } else {
            return false;
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

    public function getApiQuestions($args = array()){
        App::import('Model','Players');
        App::import('Model','Options');
        $FBID     = $args['fbid'];
        $character = $args['character'];
        $modelPlayers = new Players();
        $modelOptions = new Options();
        
        $category = isset($this->characterToCategories[$character]) ? $this->characterToCategories[$character] : false;        
        $FBID     = $args['fbid'];
        
        if($FBID && $category) {
            
            $playerInfo = $modelPlayers->getPlayerByFBID($FBID);
            
            if(!$playerInfo) {
                return false;
            } 
            
            $userRound = $playerInfo['Players']['round_' . strtolower($category)];
            $userStage = $playerInfo['Players']['stage'];
            
            if($userRound >= 16):
                $userRound = 1;
                $userStage = 2;
            endif;
            $conditions = array(                
                'Questions.round'    => $userRound,
                'Questions.stage'    => $userStage,
                'Questions.category' => $category
            );              
            
            $roundQuestions =  $this->find('all', array('conditions' => $conditions, 'order' => 'RAND()', 'limit' => 10));            
            
            if(!$roundQuestions) {
                return false;
            }
            
            foreach($roundQuestions as &$question) {
                $question['options'] = $modelOptions->find('all', array('conditions' => array('question_id' => $question['Questions']['id']), 'order' => 'RAND()'));  
            }
                       
            return $roundQuestions;
            
        } else {
            return false;
        }
    }

    public function getChallengeQuestion($challenge = array()){
        if(!empty($challenge)){
            App::import('Model','Options');
            $modelOptions = new Options();
            $preguntas = array();
            $ct = 0;    
            foreach($challenge as $guardada){
                $preguntas[$ct] = $this->find('first', array('recursive' => -1, 'conditions' => array('Questions.id' => $guardada['StoredQuestion']['question_id'])));
                $preguntas[$ct]['Questions']['question'] = $this->cleanQuestion($preguntas[$ct]['Questions']['question']);
                $preguntas[$ct]['options'] = $modelOptions->find('all', array('conditions' => array('question_id' => $guardada['StoredQuestion']['question_id']), 'order' => 'RAND()'));
                $ct += 1;
            }
            return $preguntas;
        }else{
            return false;
        }
    }
    public function getApiAllQuestions(){
        App::import('Model','Players');
        App::import('Model','Options');
        $modelPlayers = new Players();
        $modelOptions = new Options();
        $allQuestions =  $this->find('all', array('fields' => array('Questions.id', 'Questions.question', 'Questions.type', 'Questions.round', 'Questions.stage', 'Questions.category', 'Questions.modified')));
        if(!$allQuestions) {
            return false;
        }
        foreach($allQuestions as &$question) {
            $question['Questions']['question'] = $question['Questions']['question'];    
            $question['options'] = $modelOptions->find('all', array('conditions' => array('question_id' => $question['Questions']['id'])));  
        }          
        return $allQuestions;
    
    }
    
    public function getOnlySomeQuestionsStartingFrom($from = null){
        App::import('Model','Players');
        App::import('Model','Options');
        $modelPlayers = new Players();
        $modelOptions = new Options();
        $allQuestions =  $this->find('all', array('conditions'=>array('Questions.modified >=' => $from),'fields' => array('Questions.id', 'Questions.question', 'Questions.type', 'Questions.round', 'Questions.stage', 'Questions.category', 'Questions.modified')));
        if(!$allQuestions) {
            return false;
        }
        foreach($allQuestions as &$question) {
            $question['Questions']['question'] = $this->cleanQuestion($question['Questions']['question']);
            $question['options'] = $modelOptions->find('all', array('conditions' => array('question_id' => $question['Questions']['id'])));  
        }          
        return $allQuestions;
    
    }
    
   
}

?>
