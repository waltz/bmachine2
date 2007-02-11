<?php

class AuthenticationController
{
	function AuthenticationController()
	{
		// Start/resume the session.
		session_start();
		
		
	}
	
	// Is the user logged in?
	function isUserAuthenticated()
	{
		
	}
	
	function isSesionActive()
	{
		
	}
	
	// Start a user's session.
	function setSession()
	{
		
	}
	
	// End a user's session.
	function logout()
	{
		session_destroy();
	}
	
}

?>