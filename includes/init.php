<?php

 /*** include the controller class ***/
 include SITE_PATH_APPLICATION . 'controller_base.class.php';

 /*** include the registry class ***/
 include SITE_PATH_APPLICATION . 'registry.class.php';

 /*** include the router class ***/
 include SITE_PATH_APPLICATION . 'router.class.php';

 /*** include the template class ***/
 include SITE_PATH_APPLICATION . 'template.class.php';

 /*** auto load model classes ***/
function __autoload($class_name) {
	
    $filename = strtolower($class_name) . '.class.php';
    
    $file = SITE_PATH_MODEL . $filename;

    if (file_exists($file) == false) {
        return false;
    }
    
  	include ($file);
}

 /*** a new registry object ***/
 $registry = new registry;

 /*** create the database registry object ***/
 //$registry->db = db::getInstance();

  $registry->serverurl 		= SITE_DOMAIN;
  $registry->cookiedomain 	= SITE_COOKIE_DOMAIN;

?>
