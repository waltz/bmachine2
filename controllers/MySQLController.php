<?php

//Include parent class
require_once($baseDir . 'controllers/SQLController.php');

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
			return false;
		}

		if(!mysql_select_db($this->database)) {
			return false;
                }

		return true;
	}

        // Generate an array based upon a result of a database query.
        // Returns an empty array on failure and a full array on success
        function getArray($result) {
	  if($result == null){ return null; }
	  $array = array();
		if (mysql_num_rows($result)> 0) {
			$array = array();
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

        // Builds and executes a query from an external file
        // Returns true or false
        function load($file) {
		$f = fopen($file, 'r');
		if ($f) {
			while (!feof($f)) {
				$query = stream_get_line($f, 1000000, ";").';';
				$this->query($query);
			}
			fclose($f);
			return true;
		}
        }

	//Returns ID generated from previous insert operation, called by create
	//Works only on AUTO_INCREMENT values
	function getID() {
		return mysql_insert_id();
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
