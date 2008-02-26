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
	public $alerts = array();

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
			if ($bm_debug != "setup") {
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
	function display($template){
	  global
	    $bm_debug, 
	    $siteDomain, 
	    $baseDir, 
	    $baseUri, 
	    $site_name, 
	    $site_description, 
	    $site_iconurl;

	  // If the unit test flag is on, don't display templates.
	  if($bm_debug == 'unittest') { return; }
	  
	  // If there's a session, set the current username.
	  if(isset($_SESSION['username'])){
	    $this->view->assign('currentUser', $_SESSION['username']);
	  }

	  // Pass some useful info to the templates.
	  $this->view->assign('isAdmin', $this->isAdmin());
	  $this->view->assign('baseDir', $baseDir);
	  $this->view->assign('baseUri', $baseUri);
	  $this->view->assign('siteDomain', $siteDomain);
	  $this->view->assign('site_name', $site_name);
	  $this->view->assign('site_description', $site_description);
	  $this->view->assign('site_iconurl', $site_iconurl);
	  $this->view->assign('alerts', $this->getAlerts());
	  
	  // Finally, render the template.
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
	function isAdmin(){
	  global $bm_debug;

	  // If you're unit testing, you're always an admin.
	  if($bm_debug == "unittest") { return true; }

	  // If the session has a username, see if they're an admin.
	  if(isset($_SESSION['username'])){
	    // Read the user's info from the database.
	    $userArray = $this->db_controller->read('users', 'username="' . $_SESSION['username'] . '"');
		
	    // If there were any results, see if any are admins.
	    if(count($userArray) > 0){
	      $user = $userArray[0];
	      return ($user['admin'] == 0) ? false : true;
	    }
	  } else {
	    return false;
	  }
    	}

	function forbidden() {
	  $this->addAlert("You don't have permission to access that page!");
	  $this->redirect('');
	}

	// Takes in a string and adds it to the alerts array.
	function addAlert($alertString) {
	  $this->alerts[] = $alertString;
	}

	// Returns an array of all currently available alerts.
	function getAlerts() {
	  // Get any alerts stored as cookies.
      	  if(isset($_SESSION['alerts'])) {
	    $this->alerts = array_merge($this->alerts, unserialize($_SESSION['alerts']));
	    $_SESSION['alerts'] = null;
	  }

	  return $this->alerts;
	}

	// Consumes a string and redirects the user to that URI.
	function redirect($location) {
	  // Make sure alerts survive the redirect.
	  $storedAlerts = serialize($this->getAlerts());
	  $_SESSION['alerts'] = $storedAlerts;
	 
	  global $baseUri;

	  // Send the redirection headers.
      	  header('Location: ' . $baseUri . $location, TRUE, 303);
	  //echo($baseUri . $location);
	  // Stop program execution/output.
	  exit;
	}
}
?>
