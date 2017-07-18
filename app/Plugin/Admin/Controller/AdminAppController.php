<?php

class AdminAppController extends AppController {
    
    public function beforeFilter() {
        
        //parent::beforeFilter();
        
        if(!$this->Session->read('loggedUser') && $this->name != 'Login') {                  
            $this->redirect('/admin/login');
        }                   
        
    }
    
	public function index() {		
        $this->set('activeTab', 'dashboard');
	}
    
	
    
}
?>
