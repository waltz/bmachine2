<?php

/*
	1.  Display welcome.
	2.	Detect settings.
	3.	Setup the database.
		a) MySQL/SQLite
		b) hostname
		c) username
		d) password
	4.	Create the admin user.
	5.	
*/	
	
class SetupController
{
	function SetupController()
	{
		if(file_exists('../settings.inc'))
		{
			$setupStatus = require('../settings.inc');
		
			if($setupStatus == 'Settings')
			{
				
			}
			elseif($setupStatus == 'Database')
			{
				
			}
			elseif($setupStatus == 'FirstUser')
			{
				
			}
			elseif($setupStatus == 'Done')
			{
				
			}
		}
		// $this->displayStartPage();
		// $this->detectEnvironment();
		// $this->setupDirectories();
		// $this->setupDatabase();
		// $this->setupUsers();
	}
	
	// Displays a welcome page. Let the user know something's going on.
	function displayStartPage()
	{
		$this->writeMessage("Thanks for installing Broadcast Machine!");
	}
	
	function writeMessage($message)
	{
		$this->writeHTMLHeader();
		echo($message . "<br/>");
		$this->writeHTMLFooter();
	}
	
	function writeHTMLHeader()
	{
		echo("<html><head><title>");
		echo("Broadcast Machine Setup");
		echo('</title><style type="text/css">');
		$this->writeStylesheet();
		echo('</head><body><div class="body">');
	}
	
	function writeHTMLfooter()
	{
		echo('</div></body></html>');
	}
	
	function writeStylesheet()
	{
		// CJ - Stylesheet should go here. Maybe it could work as an included file? (setup.css?)
	}
	
	// Discover what the current PHP environment is like, and write it to the config file.
	function detectEnvironment()
	{
		// Settings array.
		$settings;
		
		echo("Started environment detection...");

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
		if(function_exists('mb_strstr'))
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
		// CJ: Will 'apache_get_modules()' work on Apache 1 and 2?
		// CJ: The 'apache_get_modules
		if(!in_array('mod_rewrite', apache_get_modules()))
		{
			$settings['rewrite_avail'] = 'no';
		}
		else
		{
			$settings['rewrite_avail'] = 'yes';
		}
		
		// Write the settings file. (settings.inc)
		
		// Write the .htaccess file.
	}
	
	// Should be executed first!
	function setupDirectories()
	{
		file
	}
	
	// Executed second!
	function setupDatabase()
	{
		
	}
	
	// And third...
	function setupUsers()
	{
		
	}

}
