<?php

Class userController Extends baseController {

    public $error_msg = '';

    public function index() {       
    }
	
    /**
     * Enter description here...
     *
     */
    public function login() {
    	$this->registry->template->title 	= "Login Page Title";
        $this->registry->template->desc 	= "Login Desc";
        $this->registry->template->keyword 	= "Login keyword";
        $this->registry->template->show('user/login');
    }

    /**
     * Enter description here...
     *
     */
    public function logout() {
    }

 
}

//end of User class controller
?>
