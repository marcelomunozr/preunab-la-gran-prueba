<?php

class QuestionsController extends AdminAppController {
    
    public $uses = array('Questions', 'Options');

    public function beforeFilter() {        
        parent::beforeFilter();                
        $this->set('activeTab', 'questions');           
    } 
    
	public function index($category = 0, $round = 1) {		

        if(!$round && !$category) {
            $conditions = array();
        } else {            
            if($round) { $conditions[] = 'round = '.$round; }            
            if($category) { $conditions[] = 'category = "'.  strtoupper($category).'"'; }           
        }
        
        $allQuestions = $this->Questions->find('all', array('conditions' => $conditions)) ;
        
        if(!empty($allQuestions)) {
            foreach($allQuestions as &$question) {

                $question['Questions']['category']  = $this->Questions->categoryToHumanFriendly($question['Questions']['category']);
                $question['Questions']['humanType'] = $this->Questions->typeToHumanFriendly($question['Questions']['type']);
                
                $questions[] = $question;
            }
        } else {
            $questions = $allQuestions;
        }
                
        $questionCategories = $this->Questions->getAllCategories();
        
        $this->set('questionCategories', $questionCategories);
        $this->set('questions', $questions);
        $this->set('selectedCategory', $category);
        $this->set('selectedCategoryHuman', $this->Questions->categoryToHumanFriendly(strtoupper($category)));
        $this->set('selectedRound', $round);                
	}
    
	public function edit($type, $id = 0) {		
               
        
        $humanType          = $this->Questions->typeToHumanFriendly(strtoupper($type));
        $questionCategories = $this->Questions->getAllCategories();
                    
        if(!$humanType) {
            die();
        }
        
        $this->set('type', $type);
        $this->set('humanType', $humanType);
        $this->set('questionCategories', $questionCategories);
        
        if ($this->request->is('post')) {
                                    
            $this->Session->setFlash('Se guardo la pregunta correctamente!', 'default', array('class' => 'alert alert-success'));
            
            $data = $this->request->data;
                        
            if($data['id'] != 0) {
                $this->Questions->id = $data['id'];                  
            }            
            
            $saveQuestions['Questions']['question'] = $data['question_html'];
            $saveQuestions['Questions']['stage']    = $data['stage'];
            $saveQuestions['Questions']['category'] = $data['category'];
            $saveQuestions['Questions']['round']    = $data['round'];
            $saveQuestions['Questions']['points']   = $data['points'];
            $saveQuestions['Questions']['time']     = $data['time'];
            $saveQuestions['Questions']['type']     = strtoupper($type);
                       
            $this->Questions->save($saveQuestions);      
            
            if($type == 'multiple_choice') { $this->saveMultipleChoice($data); }            
            if($type == 'fib') { $this->saveFIB($data); }            
            if($type == 'tf_simple') { $this->saveTFSimple($data); }            
            if($type == 'tf_multiple') { $this->saveTFMultiple($data); }            
            if($type == 'option_choices') { $this->saveOptionChoices($data); }            
            if($type == 'complete_box') { $this->saveCompleteBox($data); }            
            
            $this->redirect('/admin/questions/edit/'.$type.'/'.$this->Questions->id);
     
        } else {
            
            $this->set('referer', Controller::referer());
            
            if($id != 0) {
                      
                $saveQuestions  = $this->Questions->findAllById($id);
                $saveOptions    = $this->Options->findAllByQuestion_id($id);
                
                foreach($saveOptions as $option) {
                    $saveOptionsAll['Options'][] = $option;
                }                
                
                $this->set('title', 'Editar Pregunta');
                $this->set('postData', array_merge($saveQuestions[0], $saveOptionsAll));
            } else {
                $this->set('title', 'Nueva Pregunta');
            }
        }
	}
    
    private function saveMultipleChoice($data) {

        if(isset($data['option'])) {
                
            $i = 1;

            $this->Options->deleteAll(array('question_id' => $this->Questions->id));

            foreach($data['option'] as $k => $v) {   

                $this->Options->create();

                $saveOptions['Options']['option']      = $data['option'][$k];
                $saveOptions['Options']['is_correct']  = isset($data['correct'][$k]) ? 1 : 0;
                $saveOptions['Options']['order']       = $i;
                $saveOptions['Options']['question_id'] = $this->Questions->id;;

                $this->Options->save($saveOptions);

                $i++;
            }         
        }         
    }
    
    private function saveFIB($data) {
        
        if(isset($data['option'])) {
            
            $this->Options->deleteAll(array('question_id' => $this->Questions->id));

            foreach($data['option'] as $k => $v) {   

                $this->Options->create();

                $saveOptions['Options']['option']      = $data['option'][$k];
                $saveOptions['Options']['is_correct']  = 1;
                $saveOptions['Options']['order']       = 0;
                $saveOptions['Options']['question_id'] = $this->Questions->id;;

                $this->Options->save($saveOptions);
                
            }         
        }      
        
        if(isset($data['extra_option'])) {                            
            foreach($data['extra_option'] as $k => $v) {   

                $this->Options->create();

                $saveOptions['Options']['option']      = $data['extra_option'][$k];
                $saveOptions['Options']['is_correct']  = 0;
                $saveOptions['Options']['order']       = 0;
                $saveOptions['Options']['question_id'] = $this->Questions->id;;

                $this->Options->save($saveOptions);

            }         
        }         
    }
    
    private function saveTFSimple($data) {
        
        if(isset($data['option'])) {
                
            $this->Options->deleteAll(array('question_id' => $this->Questions->id));

            $this->Options->create();

            $saveOptions['Options']['option']      = $data['option'];
            $saveOptions['Options']['is_correct']  = 1;
            $saveOptions['Options']['order']       = 0;
            $saveOptions['Options']['question_id'] = $this->Questions->id;;

            $this->Options->save($saveOptions);
                    
        }         
    }
    
    private function saveTFMultiple($data) {
        
        if(isset($data['option'])) {
                
            $i = 1;

            $this->Options->deleteAll(array('question_id' => $this->Questions->id));

            foreach($data['option'] as $k => $v) {   

                $this->Options->create();

                $saveOptions['Options']['option']      = $data['option'][$k];
                $saveOptions['Options']['is_correct']  = $data['correct'][$k] == 'T' ? 1 : 0;
                $saveOptions['Options']['order']       = $i;
                $saveOptions['Options']['question_id'] = $this->Questions->id;;                

                $this->Options->save($saveOptions);

                $i++;
            }         
        }         
    }    
    
    private function saveOptionChoices($data) {               
        
        if(isset($data['phrase'])) {
            
            $this->Options->deleteAll(array('question_id' => $this->Questions->id));
                       
            foreach($data['phrase'] as $pk => $pv) {   

                $this->Options->create();
                
                $extra = array();
                
                foreach($data['option'] as $k => $v) {   
                    echo $data['correct'][$pk] . ' -----> ' . $v.'<br>';
                    if($data['correct'][$pk] == $v) {
                        $extra[] = array('OK' => $data['option'][$k]);                 
                    } else {
                        $extra[] = array('NOT_OK' => $data['option'][$k]);                 
                    }                                 
                }   
                            
                $saveOptions['Options']['option']      = $data['phrase'][$pk];
                $saveOptions['Options']['is_correct']  = 0;
                $saveOptions['Options']['order']       = 0;
                $saveOptions['Options']['extra']       = json_encode($extra);
                $saveOptions['Options']['question_id'] = $this->Questions->id;;
                
                $this->Options->save($saveOptions);
                
            }         
        }      
        
    }    
    private function saveCompleteBox($data) {               
        
        if(isset($data['box'])) {
            
            $this->Options->deleteAll(array('question_id' => $this->Questions->id));
                       
            foreach($data['box'] as $pk => $pv) {   

                $this->Options->create();
                
                $extra = array();
                
                foreach($data['option'] as $k => $v) {   
                    echo $data['correct'][$pk] . ' -----> ' . $v.'<br>';
                    if($data['correct'][$pk] == $v) {
                        $extra[] = array('OK' => $data['option'][$k]);                 
                    } else {
                        $extra[] = array('NOT_OK' => $data['option'][$k]);                 
                    }                                 
                }   
                            
                $saveOptions['Options']['option']      = $data['box'][$pk];
                $saveOptions['Options']['is_correct']  = 0;
                $saveOptions['Options']['order']       = 0;
                $saveOptions['Options']['extra']       = json_encode($extra);
                $saveOptions['Options']['question_id'] = $this->Questions->id;;
                
                $this->Options->save($saveOptions);
                
            }         
        }      
        
    } 
    
    public function saveImage() {
        
        $this->layout     = 'ajax';      
        $this->autoRender = false;
       
        $name        = time() . rand(1, 1000);
        $ext         = explode('.',$_FILES['file']['name']);
        $filename    = $name.'.'.$ext[1];
        $destination = APP . 'webroot' .  DS . 'files'. DS .$filename;
        $location    =  $_FILES["file"]["tmp_name"];
          
       move_uploaded_file($location,$destination);
        
       echo '/files/'.$filename;

    }
    
    public function preview($questionID) {
        
        $this->layout     = 'ajax';      
        
        $question  = $this->Questions->findAllById($questionID);
        $options    = $this->Options->findAllByQuestion_id($questionID);
        
        $this->set('question', $question);
        $this->set('options', $options);

    }
    
    public function delete($questionID) {
        
        $this->layout     = 'ajax';  
        $this->autoRender = false;

        $this->Questions->delete($questionID);
        $this->Options->deleteAll(array('question_id' => $questionID));
    }
}

?>