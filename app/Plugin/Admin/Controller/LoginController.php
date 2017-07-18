<?php

class LoginController extends AdminAppController {
    
    public $uses = array('Users');
     
    public function index() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $loggedUser = $this->Users->login($this->data['email'], $this->data['password']);
            if ($loggedUser) {
                //$this->Session->write('loggedUser', $loggedUser);
                CakeSession::write('loggedUser', $loggedUser);
                $this->redirect('/admin/dashboard');
            } else {
                $this->Session->delete('loggedUser');                
            }
        }
    }
    
	public function out() {        
        $this->Session->delete('loggedUser');
        $this->redirect('/admin/login');        
    }    
}

?>
