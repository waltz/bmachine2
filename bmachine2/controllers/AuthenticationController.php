<?php

class AuthenticationController
{
	// Session variables must be globals.
	global $authdata;
	
	function AuthenticationController()
	{
		// Need a new database connection.
		$db = new DatabaseController();
		
		// Start/resume the session.
		session_start();
	}
	
	// Log the user in.
	// Returns 0 on success, 1 for on user, 2 if it's bad password.
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
		if($user_array == FALSE))
		{
			return 1;
		}
		
		// See if the password is correct.
		if($user_array['pass'] == $pass_md5)
		{
			$auth_token = 
			session_register($auth_token);
		}
		else
		{
			return 2;
		}
	}
	
	// Is an action allowed?
	// Returns TRUE if allowed, FALSE if not.
	function isAllowed($action, $perm_level = "Admin")
	{
		// There should be a table that holds these values, and the user controller should allow them to be edited.
		$admin_actions(ViewChannel, AddChannel, EditChannel, AddVideo, EditVideo,  AddUser, EditUser);
		$user_actions(ViewChannel);
		
		if($perm_level == "Admin")
		{
			foreach($admin_actions as $admin_action)
			{
				if($admin_action == $action)
				{
					return TRUE;
				}
			}
		}
		elseif($perm_level == "")
		{
			foreach($admin_actions as $admin_action)
			{
				if($admin_action == $action)
				{
					return TRUE;
				}
			}
		}
	}
	
	// End a user's session.
	function logout()
	{
		// Unregisters any variables for this session.
		session_unset();
	}
	
}

?>