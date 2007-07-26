<?php

//Include parent class
require_once 'DatabaseController.php';

class MySQLController extends DatabaseController
{
	//Instantiates, configures, and connects
	function MySQLController()
	{
		$this->configure();
		$this->connect();
	}

	// Copies database config values from the settings file.
	// Returns 1 on success and FALSE on failure.
	function configure() {
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
		return true;
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
