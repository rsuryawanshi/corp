<?php 
if( false == defined( 'SITE_PATH' ) ) {    
    define( 'SITE_PATH', 				str_replace( '\\', '/', dirname( __FILE__ ) . '/' ) );
    define( 'SITE_PATH_INCLUDE',    	SITE_PATH . 'includes/' );
    define( 'SITE_PATH_APPLICATION', 	SITE_PATH . 'application/' );
    define( 'SITE_PATH_CONTROLLER', 	SITE_PATH . 'controller/' );
    define( 'SITE_PATH_MODEL', 			SITE_PATH . 'model/' );
    define( 'SITE_PATH_VIEWS',     		SITE_PATH . 'views/' );
    define( 'SITE_PATH_UTIL',     		SITE_PATH . 'util/' );
    define( 'SITE_PATH_PUBLIC',     	SITE_PATH . 'public/' );
    
	define( 'SITE_ENVIRONMENT',       	'development' );
    
    if( SITE_ENVIRONMENT == 'development' ) {     	
    	define( 'SITE_DOMAIN',       	'http://corp.hltup.lcl/' );
    	define( 'SITE_COOKIE_DOMAIN',   'corp.hltup.lcl' );
    } else {
    	define( 'SITE_DOMAIN',       	'http://corp.hltup.com/' );
    	define( 'SITE_COOKIE_DOMAIN',   'corp.hltup.com' );
    }
}
?>