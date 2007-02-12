		// Detect which database we should be using.
		// If PHP is lower than version 5 then assume MySQL, else we need to
		// decide between SQLite and MySQL.
		
		get_loaded_extensions();
		
		if(phpversion() < 5)
		{
			
		}
		elseif
		{
			
		}
		else{
			// No database modules detected!
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
