<?php
// All shared functionality (BitTorrent, DB, etc) should be inherited from this class

// Include the appropriate database controller, if available.
if (isset($cf_dbengine))
	{require_once($baseDir . 'controllers/' . $cf_dbengine . 'Controller.php');}

// Include Smarty
require_once($baseDir . 'smarty/Smarty.class.php');

abstract class ViewController {
	var $db_controller;
	var $view;

        abstract function dispatch($params);
        abstract function index();

	public function __construct($params) {
		global $cf_dbengine;
		//Instantiate the DB connection		
		switch($cf_dbengine) {
			case 'MySQL':
				$this->db_controller = new MySQLController();
				break;
			case 'SQLite2':
				$this->db_controller = new SQLite2Controller();
				break;
		}			

		// Instantiate the templating engine
		global $baseDir;

		$this->view = new Smarty();
		// TODO: The templates folder should be dynamic.
		//echo($baseDir . 'themes/default/');
		$this->view->template_dir = $baseDir . 'themes/default/';
		$this->view->compile_dir = $baseDir . 'smarty/templates_c/';
		$this->view->cache_dir = $baseDir . 'smarty/cache/';

		//If $params is empty, call index function
		//Otherwise, call controller dispatcher
		if ($params[0] == '') {
			$this->index();
		} else {
			$this->dispatch($params);
		}
        }

	//Parses a URL string into it's database-safe counterpart
	//So far, only substitutes underscores for spaces
	public function parse($string) {
		return str_replace('_', ' ', $string);
	}

	//Displays a template unless a unit test flag is set
	function display($template) {
		global $bm_debug;
		if ($bm_debug != 'unittest') {
		  $this->view->display($template);
		}
	}

	// AUTHENTICATION FUNCTIONS //
	
	// Checks to see if user is logged in
	// Returns true if logged in, false if not
 	function isLoggedIn() {
                if (isset($_SESSION)) {
                        $userArray = $this->db_controller->read('users', 'username="'.$_SESSION['username'].'" and pass="'.$_SESSION['pass'].'"');
                        return (count($userArray) > 0) ? true : false;
                }
                return false;
	}

	// Checks to see if $username matches session data and is a valid user
	// Returns a boolean
	function isUser($username) {
		if (isset($_SESSION) && ($username == $_SESSION['username'])) {
			$userArray = $this->db_controller->read('users', 'username="'.$_SESSION['username'].'" and pass="'.$_SESSION['pass'].'"');
			return (count($userArray) > 0) ? true : false;

		}
		return false;
	}

	// Checks to see if user has administrative privileges
	// Returns true if logged in, false if not
	function isAdmin() {
		global $bm_debug;
		if ($bm_debug == "unittest") 
			{return true;}
		if (isset($_SESSION)) {
			$userArray = $this->db_controller->read('users', 'username="'.$_SESSION['username'].'" and pass="'.$_SESSION['pass'].'"');
			if (count($userArray) > 0) {
				$user = $userArray[0];
				return ($user['admin'] == 0) ? false : true;
			}
		} 
		return false;
	}

	function forbidden() {
		$this->view->assign('alerts', 'You do not have permission to access this page.');
		$this->index();
	}
}
?>
