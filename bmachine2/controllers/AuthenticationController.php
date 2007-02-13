<?php

require_once('DatabaseController.php');

class AuthenticationController
{
	function AuthenticationController()
	{
		// Start/resume the session.
		session_start();
	
		// Session variables must be globals.
		global $authdata;
		
		// Register common session variables.
		session_register($authdata);
	}
	
	// Log the user in.
	function login()
	{
			
	}
	
	// Is the user logged in?
	function isAllowed($action, $perm_level = "Admin")
	{
		
	}
	
	// End a user's session.
	function logout()
	{
		// Unregisters any variables for this session.
		session_unset();
	}
	
}

?>