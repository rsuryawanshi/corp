<?php
class router {
    /*
     * @the registry
     */

    private $registry;

    /*
     * @the controller path
     */
    private $path;
    private $args = array();
    public $file;
    public $controller;
    public $action;
	public $params = array();

	private $controller_list = array( 'user', 'dashboard', 'error404', 'index', 'static');

    function __construct( $registry ) {
        $this->registry = $registry;
    }

    function setPath($path) {

        /*  check if path i sa directory  */
        if( is_dir( $path ) == false) {
            throw new Exception( 'Invalid controller path: `' . $path . '`' );
        }
        /*  set the path  */
        $this->path = $path;
    }

    public function loader() {
        /*  check the route  */
        
    	$this->getController();
       
        /*  if the file is not there diaf */
        if( is_readable( $this->file ) == false ) {
            $this->file = $this->path . '/error404.php';
            $this->controller = 'error404';
            header( '/error404' );
            exit;
        }

        /*         * * include the controller ** */
        include $this->file;

        /*         * * a new controller class instance ** */
        $class = $this->controller . 'Controller';
        $controller = new $class( $this->registry );

		/*print '<pre>';
		print_R($this->registry);
		print '</pre>';
		exit(0);*/

        /*         * * check if the action is callable ** */
        if( is_callable( array( $controller, $this->action ) ) == false ) {
            $action = 'index';
        } else {
            $action = $this->action;
        }
        /*         * * run the action ** */
        $controller->$action();
    }

    /**
     *
     * @get the controller
     *
     * @access private
     *
     * @return void
     *
     */
    private function getController() {

    	$strRequestUrl = ( empty( $_GET['rt'] ) ) ? '' : $_GET['rt'];
	
        if( empty( $strRequestUrl ) ) {
            $route = 'index';
        } else {

        	$parts = explode( '/', $strRequestUrl );
        	var_dump( $parts );
        	if( in_array( $parts[0], $this->controller_list )  ) {
        		$this->controller 	= $parts[0];
        		$this->action 		= $parts[1];
        	}         		
        }	

        if( empty( $this->controller ) ) {
            $this->controller = 'index';
        }

        if( empty( $this->action ) ) {
            $this->action = 'index';
        }

        $this->registry->getcontroller = $this->controller;
        $this->file = $this->path . '/' . $this->controller . 'Controller.php';
    }
    
}

?>
