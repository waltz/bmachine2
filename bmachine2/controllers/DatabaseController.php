<?php

abstract class DatabaseController
{
	//Configures and connects to Db on instantiation
	function __construct() {
		$this->configure();
                if ($this->connect() === false) 
			{throw new Exception('Could not connect to database.');}
	}

        // Closes connection on destruct
        function __destruct() {
                $this->disconnect();
        }

	// Copies database config values from the settings file.
	// Returns 1 on success and FALSE on failure.
	abstract function configure();
	
	// Starts a connection to the database.
	// Returns FALSE on failure
	abstract function connect();

	// Sends queries to the database.
	// Stores the result for 'getArray()' before returning.
	// Returns FALSE on failure or a result on success.
	abstract function query($query);
	
	// Generate an array based upon a result of a database query.
	// When called with no parameters, tries to use the last result.
	// Returns FALSE on failure or a result on success.
	abstract function getArray($result);
	
	//Disconnect from the database
	//Returns FALSE on failure
	abstract function disconnect();	

	//Standard API for CRUD operations:
	abstract function create($table, $data);

	abstract function read($table, $condition);
	
	abstract function update($table, $data, $condition);

	abstract function delete($table, $condition);
}

?>
