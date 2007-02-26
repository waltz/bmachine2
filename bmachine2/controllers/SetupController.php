<?php

class SetupController
{
	function SetupController()
	{
		$this->detectEnvironment();
		$this->setupDirectories();
		$this->setupDatabase();
		$this->setupUsers();
	}
	
	// Discover what the current PHP environment is like, and write it to the config file.
	function detectEnvironment()
	{
		// Settings array.
		$settings;
		
		// What's the current base URL?
		
		// Are magic quotes on?
		if(get_magic_qoutes_gpc())
		{
			$settings['magic_quotes_on'] = 'yes';
		}
		else
		{
			$settings['magic_quotes_on'] = 'no';
		}
		
		// Can we handle multi-byte strings?
		if(function_exists('mb_strstr')
		{
			$settings['mbstring_enabled'] = 'yes';
		}
		else
		{
			$settings['mbstring_enabled'] = 'no';
		}
		
		// Are HTTP uploads allowed?
		if(ini_get('file_uploads') == 'on')
		{
			$settings['http_uploads_enabled'] = 'yes';
		}
		else
		{
			$settings['http_uploads_enabled'] = 'no';
		}
			
		// What is the maximum file upload size?
		$settings['max_upload_size'] = ini_get('upload_max_filesize');
		
		// Do we have mod_rewrite?
		// Note: Will 'apache_get_modules()' work on Apache 1 and 2?
		if(!in_array('mod_rewrite', apache_get_modules()))
		{
			$settings['rewrite_avail'] = 'no';
		}
		
		// Write the settings file. (settings.inc)
		
		// Write the .htaccess file.
	}
	
	// Should be executed first!
	function setupDirectories()
	{
		
	}
	
	// Executed second!
	function setupDatabase()
	{
		
	}
	
	// And third...
	function setupUsers()
	{
		
	}
	
	// Write the .htaccess file.
	function writeRewrite()
	{
		// Open the file.
		// Write to the file.
		// Close the file.
	}

}
