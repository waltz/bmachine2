<?php

//Include parent class
require_once 'DatabaseController.php';

class MySQLController extends DatabaseController
{
	
	var $hostname;			//DB hostname
	var $username;			//DB username
	var $password;			//DB user password
	var $database;			//DB name
	var $connection = false;	//Keeps track of the connection to disconnect

	//Instantiates, configures, and connects
	function MySQLController()
	{
		$this->configure();
		$this->connect();
	}

	// Copies database config values from the settings file.
	// Returns true on success and FALSE on failure.
	function configure() {
		include('../db/db_config.inc');

                $this->hostname = $cf_hostname;
                $this->username = $cf_username;
                $this->password = $cf_password;
                $this->database = $cf_database;
		return true;
	}
	
	// Starts a connection to the database.
	// Returns FALSE on failure
	function connect() {
		$this->connection = mysql_connect($this->hostname, $this->username, $this->password);
		if(!$this->connection) {
			die(mysql_error());
			return false;
		}

		if(!mysql_select_db($this->database)) {
                	die(mysql_error());
			return false;
                }

		return true;
	}

	// Sends queries to the database.
	// Stores the result for 'getArray()' before returning.
	// Returns FALSE on failure or a result on success.
	function query($query) {
		$result = mysql_query($query);
		return $result;
	}
	
	// Generate an array based upon a result of a database query.
	// Returns FALSE on failure or a result on success.
	function getArray($result) {
		$array = array();
		if (mysql_num_rows($result) > 0) {
                	while($row = mysql_fetch_assoc($result)) {
				array_push($array, $row);
                	}
		}
		return $array;		
	}
	
	//Disconnect from the database
	//Returns FALSE on failure
	function disconnect() {
		if(!mysql_close($this->connection)){
			return false;
		} else {
			return true;
		}
	}
}

?>
