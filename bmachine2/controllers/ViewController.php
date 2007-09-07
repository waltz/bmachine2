<?php
// All shared functionality (BitTorrent, DB, etc) should be inherited from this class

// Include the appropriate database controller
require_once('../db/db_config.inc');
require_once($cf_dbengine.'Controller.php');

// Include Smarty
require_once('../smarty/Smarty.class.php');

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
		$this->view = new Smarty();
		//Theme should be a preference variable
		echo "viewcontroller: ".getcwd()."<br />";
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

	//Functions to read and set settings:

	// Takes in a key and returns a value. Returns NULL if the key
	// doesn't exist.
	function getSetting($key)
	{
        	$handle = fopen("../settings.inc", "r");

	        while($setupdata = fscanf($handle, "%s\t%s\n")) {
	                list ($read_key, $read_value) = $setupdata;

        	        if($read_key == $key)
                		{$value = $read_value;}
        	}
        	fclose($handle);
	        return $value;
	}

	// Takes in a key and a value to be written to the file. Returns TRUE
	// if the values were written and FALSE if not. If the key already
	// exists, it's value is overwritten with the new value.
	function setSetting($key, $value)
	{
        	$handle = fopen('../settings.inc', 'at');

	        $pair = $key . "\t" . $value . "\n";

        	$status = fwrite($handle, $pair);

	        fclose($handle);

        	if($status = FALSE)
        		{return FALSE;}
	}

	
 	
	abstract function dispatch($params);

	abstract function index();


}
?>
