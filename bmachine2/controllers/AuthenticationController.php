<?php

require_once('ApplicationController.php');

class AuthenticationController extends ApplicationController
{
	function AuthenticationController()
	{
		// Session variables must be globals.
		global $authdata;
		
		// Start/resume the session.
		session_start();
	}
	
	// Log the user in.
	// Returns 0 on success, 1 on non-existent user, 2 if it's bad password
	function login()
	{
		// Get the username and password from HTTP POST.
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Make an MD5 hash of the password.
		$pass_md5 = md5($password);
		
		// Grab any rows matching the username.
		$user_array = $db->getArray($db->query('SELECT * FROM users WHERE username="$username"'));
		
		// If the user array comes back empty, there isn't a user with that name.
		if($user_array == FALSE)
		{
			return 1;
		}
		
		// If the passwords match, set the username and permissions level.
		if($user_array['pass'] == $pass_md5)
		{
			/*
			$_SESSION['username'] = $username;
			$perm_level = $db->getArray($db->query("SELECT admin FROM users WHERE username='$username'"));
			if(
			
			$_SESSION['perm_level'] = 
			*/
		}
		else
		{
			return 2;
		}
		
		return 0;
	}
	
	function isAnon()
	{
		if(!isset($_SESSION['username']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function isUser()
	{
		global $db;
			
	}
		
	function isAdmin()
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
