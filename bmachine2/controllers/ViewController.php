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
	var $alerts;

        abstract function dispatch($params);
        abstract function index();

	public function __construct($params) {
		// Instantiate the templating engine
		global $baseDir;

		$this->view = new Smarty();
		// TODO: The templates folder should be dynamic.
		$this->view->template_dir = $baseDir . 'themes/default/';
		$this->view->compile_dir = $baseDir . 'smarty/templates_c/';
		$this->view->cache_dir = $baseDir . 'smarty/cache/';

		global $cf_dbengine;
		//Instantiate the DB connection		
		try {
			switch($cf_dbengine) {
				case 'MySQL':
					$this->db_controller = new MySQLController();
					break;
				case 'SQLite2':
					$this->db_controller = new SQLite2Controller();
					break;
			}			
		} catch (Exception $e) {
			//This catch needs to ignore the first two steps of setup
			if (isset($params[0]) && isset($params[1])) {
				if ($params[0] != 'setup' && $params[1] != 'cleanurls' && $params[1] != 'database') {
					$this->display('error-database.tpl');
					return;
				}
			} else {
				$this->display('error-database.tpl');
                                return;

			}
		}

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
	function display($template) 
	{
      	  global $bm_debug, $baseDir, $baseUri;
	
	  // If the unit test flag is on, don't display templates.
	  if($bm_debug == 'unittest') { return; }
	  
	  if(isset($_SESSION['username']))
	    {
	      $this->view->assign('currentUser', $_SESSION['username']);
	    }
	  $this->view->assign('baseDir', $baseDir);
	  $this->view->assign('baseUri', $baseUri);
	  $this->view->display($template);
	}

	// AUTHENTICATION FUNCTIONS //
	
	// Checks to see if user is logged in
	// Returns true if logged in, false if not
 	function isLoggedIn() {
                if (isset($_SESSION)) {
                        $userArray = $this->db_controller->read('users', 'username="'.$_SESSION['username'].'"');
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

	// See if the user is an admin.
	function isAdmin()
	{
		global $bm_debug;

		// If you're unit testing, you're always an admin.
       		if($bm_debug == "unittest") { return true; }
	
		// If the session has a username, see if they're an admin.
		if(isset($_SESSION['username']))
		  {
		    // Read the user's info from the database.
		    $userArray = $this->db_controller->read('users', 'username="' . $_SESSION['username'] . '"');
		
		    // If there were any results, see if any are admins.
		    if(count($userArray) > 0)
			  {
			    // Get the first user.
			    $user = $userArray[0];
			    
			    // Return true/false if they're an admin or not.
			    return ($user['admin'] == 0) ? false : true;
			  }
		  }
		
		// Otherwise, return false.
		return false;
	}

	function forbidden() {
		$this->alerts[] = 'You do not have permission to access this page.';
		$this->view->assign('alerts', $this->alerts);
		$this->index();
	}
}
?>
