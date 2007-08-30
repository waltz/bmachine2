<?php

include('ViewController.php');

class UserController extends ViewController{
	function UserController($uri)
	{
		$this->dispatch($uri);
	}
	
	function dispatch($uri)
	{
		// /user/$username/edit
		if($uri[2] == 'edit')
		{
			$this->editUser($uri[2]);
		}
		elseif($uri[1] == 'add')
		{
			$this->addUser();
		}
		elseif($uri[2] == 'delete')
		{
			$this->removeUser($uri[3]);
		}
		/* No complex user creation and confirmation yet...
		elseif($uri[2] == 'confirm')
		{
			$this->confirmUser($uri[3])
		}
		*/
		else
		{
			$thise->view();
		}
	}

	// Main page, lists all of the users.
	function view()
	{
		if(isAdmin())
		{	
		}
		elseif(isUser())
		{
		}
		else
		{
			$this->view->assign('alert', array("It doesn't look like you're logged in!"));
		}
	}
	
	// Edit
	function editUser()
	{
		
	}
	
	function removeUser()
	{
		
	}
	
	function addUser()
	{
		// If the user is an admin, let them add a user.

		// If open registration is on, then guests can 'signup'. NOTE: Skip this for now.
	}

	// Authenticate and start the session.	
	function login()
	{
		// The login username and password should be in POSTDATA.
	}
	
	// Kill any existing session.
	function logout()
	{
	
	}

	/* Not yet...
	function confirmUser()
	{
		
	}
	*/
}

?>