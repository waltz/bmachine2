<?php

class DatabaseController
{
	var $database_type;			// 0 = No DB, 1 = MySQL, 2 = SQLite
	var $hostname = localhost;	// Hostname for MySQL databases.
	var $username;					// Username for MySQL.
	var $password;					// Password for MySQL.
	var $database;					// MySQL database name or SQLite filename.
	var $sqlite_handle;			// Holds the database handle for SQLite databases.	
	
	// Everything should be setup on instantiation.
	function DatabaseController()
	{
		$this->configure();
		$this->connect();
	}

	// Copies database config values from the settings file.
	// Returns 1 on success and FALSE on failure.
	function configure()
	{
		if((include "../db/db_config.inc") == 1)
		{
			$this->database_type = $cf_dbengine
			$this->hostname = $cf_hostname;
			$this->username = $cf_username;
			$this->password = $cf_password;
			$this->database = $cf_database;
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Starts a connection to the database.
	// Returns FALSE on failure
	function connect()
	{
		if($this->isMySQL())
		{
			return mysql_connect($this->hostname, $this->username, $this->password);
		}
		else if($this->isSQLite())
		{
			$this->sqlite_handle = sqlite_open($this->database);
			return $this->sqlite_handle;
		}
		else
		{
			return FALSE;
		}
	}

	// Sends queries to the database.
	// Stores the result for 'getArray()' before returning.
	// Returns FALSE on failure or a result on success.
	function query($query)
	{
		if($this->isMySQL())
		{
			$result = mysql_query($query);
			$this->last_result = $result;
			return $result;
		}
		else if($this->isSQLite())
		{
			$result = sqlite_query($query);
			$this->last_result = $result;
			return $result;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Generate an array based upon a result of a database query.
	// When called with no parameters, tries to use the last result.
	// Returns FALSE on failure or a result on success.
	function getArray($result = $this->last_result)
	{
		if($this->isMySQL())
		{
			return mysql_fetch_array($result);
		}
		else if($this->isSQLite())
		{
			return sqlite_fetch_array($result);
		}
		else
		{
			return FALSE;
		}
	}

	// Returns TRUE if MySQL, FALSE if not.
	function isMySQL()
	{
		if($this->database_type == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	// Returns TRUE if SQLite, FALSE if not.
	function isSQLite()
	{
		if($this->database_type == 2)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

?>
