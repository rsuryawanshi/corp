<?php

Class indexController Extends baseController {

    /**
     * Enter description here...
     *
     */
    
    public function index() {    	
    	
    	$this->registry->template->title 	= "Page Title";
        $this->registry->template->desc 	= "Desc";
        $this->registry->template->keyword 	= "keyword";
        
        $this->registry->template->show('index');
        
    }

}

//end of index controller
?>
