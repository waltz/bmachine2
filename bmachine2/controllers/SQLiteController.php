<?php

//Include parent class
require_once 'DatabaseController.php';

class SQLiteController extends DatabaseController
{
	
	var $hostname;			//DB hostname
	var $username;			//DB username
	var $password;			//DB user password
	var $database;			//SQLite filename
	var $sqlite_handle;		//DB Handle
	var $connection = false;	//Keeps track of the connection to disconnect

	// Copies database config values from the settings file.
	// Returns true on success and FALSE on failure.
	function configure() {
		include('../db/db_config.inc');
		//Configure
		return true;
	}
	
	// Starts a connection to the database.
	// Returns FALSE on failure
	function connect() {
		return true;
	}


	// Sends queries to the database.
	// Stores the result for 'getArray()' before returning.
	// Returns FALSE on failure or a result on success.
	function query($query) {
		$result = true;
		return $result;
	}
	
	// Generate an array based upon a result of a database query.
	// When called with no parameters, tries to use the last result.
	// Returns FALSE on failure or a result on success.
	function getArray($result) {
		$result = null;
		return result;
	}
	
	//Disconnect from the database
	//Returns FALSE on failure
	function disconnect() {
		return true;
	}
}

?>
