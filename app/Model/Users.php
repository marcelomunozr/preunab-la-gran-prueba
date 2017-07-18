<?php

class Users extends Model {
    
    public function login($email, $password) {
        
        $result = $this->find('first', 
                array('conditions' => array(
                    'email' => $email,
                    'password' => $password
                ))
        );       
        
        return $result;
        
    }
    
}
