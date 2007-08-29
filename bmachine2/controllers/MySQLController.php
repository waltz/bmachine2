<?php

//Include parent class
require_once 'SQLController.php';

class MySQLController extends SQLController
{
	
	var $hostname;			//DB hostname
	var $username;			//DB username
	var $password;			//DB user password
	var $database;			//DB name
	var $connection = false;	//Keeps track of the connection to disconnect

	// Copies database config values from the settings file.
	// Returns true on success and FALSE on failure.
	function configure() {
		// Include global db variables
		global $cf_hostname,  $cf_username, $cf_password, $cf_database;

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
			die(mysql_error()); //Change to alert
			return false;
		}

		if(!mysql_select_db($this->database)) {
                	die(mysql_error()); //Ditto
			return false;
                }

		return true;
	}

        // Generate an array based upon a result of a database query.
        // Returns an empty array on failure and a full array on success
        function getArray($result) {
                $array = array();
                if (mysql_num_rows($result) > 0) {
                        while($row = mysql_fetch_assoc($result)) {
                                array_push($array, $row);
                        }
                }
                return $array;
        }

	// Sends queries to the database.
	// Returns result of the query
	function query($query) {
		return mysql_query($query);
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
