<?php

//Include parent class
require_once 'DatabaseController.php';

class SQLiteController extends DatabaseController
{
	var $database;			//SQLite filename
	var $connection = false;	//Keeps track of the connection to disconnect

	// Copies database config values from the settings file.
	// Returns true on success and FALSE on failure.
	function configure() {
		global $cf_database;

		$this->database = $cf_database;
		return true;
	}
	
	// Starts a connection to the database.
	// Returns True on success
	function connect() {
		$this->connection = sqlite_open($this->database);
		return true;
	}


	// Sends queries to the database.
	// Stores the result for 'getArray()' before returning.
	// Returns FALSE on failure or a result on success.
	function query($query) {
		$result = sqlite_query($this->connection, $query);
		return $result;
	}
	
	// Generate an array based upon a result of a database query.
	// Returns empty array on failure or a full array on success.
	function getArray($result) {
		$array = array();
		while ($row = sqlite_fetch_array($result)) {
			array_push($array, $row);
		}
		return $array;
	}
	
	//Disconnect from the database
	//Returns True on success, FALSE on failure
	function disconnect() {
                if(!sqlite_close($this->connection)){
                        return false;
                } else {
                        return true;
                }
	}
}

?>
