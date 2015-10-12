<?php

Class error404Controller Extends baseController {

public function index() 
{
		header('HTTP/1.0 404 NOT FOUND');
        $this->registry->template->heading = 'This is the 404';
		$cssInclude[] = $this->registry->serverurl . 'min/?b=css&f=reset.css,estateStyleInternal.css';
       	$jsInclude[] = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js';

        $this->registry->template->css = $cssInclude;
        $this->registry->template->js = $jsInclude;
        $this->registry->template->title = 'This is the 404';
        $this->registry->template->no_follow = true;
        $this->registry->template->show('error404');
}


}
?>
