<?php

class SetupController
{
	function SetupController($params)
	{
		$this->detectEnvironment();
		$this->setupDirectories();
		$this->setupDatabase();
		$this->setupUsers();
	}
	
	// Discover what the current PHP environment is like, and write it to the config file.
	function detectEnvironment()
	{
		// What's the current base URL?
		
		// Are magic quotes on?
		
		// Write the settings file.
		
		// Write the .htaccess file.
	}
	
	// Should be executed first!
	function setupDiretories()
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
