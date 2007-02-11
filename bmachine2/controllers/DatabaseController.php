<?php

require 'database_settings.inc';

class DatabaseController
{
	// Holds an integer that describes the database type.
	// 0 for no database configured, 1 for MySQL, and 2 for SQLite.
	var $database_type;
	
	// Read the database info from the settings file and connect to it.
	function DatabaseController($param_2)
	{
		// Detect which database we should be using.
		// If PHP is lower than version 5 then assume MySQL, else we need to
		// decide between SQLite and MySQL.
		
		get_loaded_extensions();
		
		if(phpversion() < 5){
			
		}
		elseif{
			
		}
		else{
			// No database modules detected!
		}
	}
	
	// See if a specific module is loaded.
	// Returns 1 if the module is loaded, 0 if not.
	function isModuleLoaded($module)
	{
		$loaded_modules = get_loaded_extensions();
		
		foreach($loaded_modules as $module_id => $module_name)
		{
			if($module_name == $module)
			{
				return 1;
			}
		}
		return 0;
	}
	
	// Query the database.
	function queryDatabase()
	{
		
	}

	// Connect to the database.
	function connectToDatabase()
	{
		
	}

	// Returns 1 if MySQL, 0 if not.
	function isMySQL()
	{
		if(this->$database_type == 1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	// Returns 2 if SQLite, 0 if not.
	function isSQLite()
	{
		if(this->$database_type == 2)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

?>
