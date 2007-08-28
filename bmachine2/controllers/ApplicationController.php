<?php
// All shared functionality (BitTorrent, DB, etc) should be inherited from this class

// Include the appropriate database controller
require_once('../db/db_config.inc');
require_once($cf_dbengine.'Controller.php');

// Include Smarty
require_once('../smarty/Smarty.class.php');

abstract class ApplicationController {
	var $db_controller;
	var $view;
	var $alert;

	public function __construct($params) {
		global $cf_dbengine;
		//Instantiate the DB connection		
		switch($cf_dbengine) {
			case 'MySQL':
				$this->db_controller = new MySQLController();
				break;
			case 'SQLite':
				$this->db_controller = new SQLiteController();
				break;
		}			

		// Instantiate the templating engine
		$this->view = new Smarty();
		//Theme should be a preference variable
		$view->template_dir = '../themes/default/';
		$view->compile_dir = '../smarty/templates_c/';
		$view->cache_dir = '../smarty/cache/';
		
		//If $params is empty, call index function
		//Otherwise, call controller dispatcher
		if ($params[0] == '') {
			$this->index();
		} else {
			$this->dispatch($params);
		}
        }
 
	public function add_alert($msg) {
		array_push($alert, $msg);
        }
	
	abstract function index();

	abstract function dispatch($params);

}
?>
