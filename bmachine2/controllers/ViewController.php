<?php
// All shared functionality (BitTorrent, DB, etc) should be inherited from this class

// Include the appropriate database controller
require_once($baseDir . 'db/db_config.inc');
require_once($baseDir . 'controllers/' . $cf_dbengine . 'Controller.php');

// Include Smarty
require_once($baseDir . 'smarty/Smarty.class.php');

abstract class ViewController {
	var $db_controller;
	var $view;

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
		$base_url = $this->getSetting('baseurl');

		$this->view = new Smarty();
		//Theme should be a preference variable
		$view->template_dir = $base_url.'/themes/default/';
		$view->compile_dir = $base_url.'/smarty/templates_c/';
		$view->cache_dir = $base_url.'/smarty/cache/';
		
		//If $params is empty, call index function
		//Otherwise, call controller dispatcher
		if ($params[0] == '') {
			$this->index();
		} else {
			$this->dispatch($params);
		}
        }



	//Displays a template unless a unit test flag is set
	function display($template) {
		global $bm_debug;
		if ($bm_debug != 'unittest') {
			$this->view->display($template);
		}
	}

	abstract function dispatch($params);

	abstract function index();


}
?>
