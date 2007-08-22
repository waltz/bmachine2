<?php
// All shared functionality (BitTorrent, DB, etc) should be inherited from this class

//Include the appropriate database controller
require_once('../db/db_config.inc');
require_once($cf_dbengine.'Controller.php');

abstract class ApplicationController {
	var $db_controller;
	var $alert;

	public function __construct() {
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
        }
 
	public function add_alert($msg) {
		array_push($alert, $msg);
        }
}
?>
