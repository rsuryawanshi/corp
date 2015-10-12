<?php


 ob_start();

 require_once( '../config.php' );

 /*** include the init.php file ***/
 include SITE_PATH_INCLUDE . 'init.php';
 
 /*** load the router ***/
 $registry->router = new router($registry);

 /*** set the controller path ***/
 $registry->router->setPath( SITE_PATH_CONTROLLER );

 /*** load up the template ***/
 $registry->template = new template( $registry );

 /*** load the controller ***/
 $registry->router->loader();

?>
