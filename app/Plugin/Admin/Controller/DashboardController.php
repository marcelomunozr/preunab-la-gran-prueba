<?php

class DashboardController extends AdminAppController {       
     
    public function beforeFilter() {        
        parent::beforeFilter();                
        $this->set('activeTab', 'dashboard');           
    }    
    
	public function index() {		
       
	}
        
}

?>
