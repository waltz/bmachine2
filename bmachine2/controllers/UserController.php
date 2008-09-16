<?php

require_once('ViewController.php');

class UserController extends ViewController{

        // Takes on an array of url parameters and calls the correct controller function
        // Called on instantiation
        function dispatch($params)
	{
          if(!isset($params[1])) { $params[1] = ''; }
	  if(!isset($params[2])) { $params[2] = ''; }

       	  switch($params[1])
	    {
	  case '':
	    $this->currentUser();
	    break;
            case 'signup':
              $this->signup();
              break;
            case 'login':
              $this->login();
              break;
            case 'logout':
              $this->logout();
              break;
            case 'all':
		($this->isAdmin()) ? $this->all() : $this->forbidden();
              break;
            default:
              switch($params[2]) {
                case '':
                  $this->show($params[1]);
                  break;
                case 'show':
                  $this->show($params[2]);
                  break;
                Case 'edit':
                  ($this->isAdmin() || $this->isUser($params[0])) ? $this->edit($params[0]) : $this->forbidden();
                  break;
                case 'activate':
                  $this->activate();
                  break;
                case 'remove':
		  ($this->isAdmin() || $this->isUser($params[0])) ? $this->remove($params[0]) : $this->forbidden();
                  break;
              }
              break;
          }
        }

        //Default function if controller is requested without any parameters
        function index() {
                $this->currentUser();
        }


	function all() {
		$users = $this->db_controller->read("users", "all");
		$this->view->assign('users', $users);
		$this->display('user-all.tpl');
	}

	// Display the profile of the current user.
	function currentUser()
	{
	  // If the user is logged in display the profile.
	  if(isset($_SESSION['username']))
	    {
	      $this->show($_SESSION['username']);
	    }
	    else
	      {
		$this->login();
	      }
	    }

	// Add new users.
        function signup() 
	{
	  // If there's POST data, verify and add the entry.
	  if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	      // TODO: Validate input.
	      // TODO: Check the password and the password confirm fields.

	      // Validate the input.
	      if($_POST['pass'] != $_POST['pass_conf'])
		{
		  $this->addAlert('Make sure the passwords match!');
		  
		  $this->display('user-signup.tpl');
		  exit;
		}

	      // Hash the password.
	      $_POST['pass'] = sha1($_POST['pass']);
	     
	      // Build the user data array.
	      $user = array('name' => $_POST['name'],
			    'username' => $_POST['username'],
			    'pass' => $_POST['pass'],
			    'email' => $_POST['email']);

	      // Add the new user to the database.
	      $this->db_controller->create("users", $user);

	      $this->addAlert("User successfully created! Thanks!");
	      

	      // Tell the user to activate their account.
	      $this->display('user-signup.tpl');
	    }
	  else
	    {
	      $this->display('user-signup.tpl');
	    }
        }

	function activate() {

	}

	function show($username) {
		$userArray = $this->db_controller->read('users', 'username="'.$username.'"');
		if (count($userArray) == 0) {
			$alerts[] = "User $username not found";
			
			$this->display('user-show.tpl');
		} else {
			$this->view->assign('user', $userArray[0]);
			$this->display('user-show.tpl');
		}
	}

	//Needs: Error-checking
	function edit($username) {
		// If new data has been posted, update database
		if(isset($_POST)) {
			//Hash password:
			$_POST['pass'] = sha1($_POST['pass']);

			$this->db_controller->update('users', $_POST, 'username="'.$username.'"');
			$alerts[] = 'User information was edited successfully';
			
                        $this->show($username);
		} else {
			//If data has not yet been posted, get user data and display edit template
			$userArray = $this->db_controller->read('users', 'username="'.$username.'"');
	                if (count($userArray) == 0) {
				$alerts[] = "User $username not found";
        	                
                	        $this->index();
	                } else {
				//Unset password
				$user = $userArray[0];
				unset($user['password']);

        	                $this->view->assign('user', $user);
                	        $this->display('user-edit.tpl');
                	}

		}
	}

	function remove($username) {
		$this->db_controller->delete("users", 'username="'.$username.'"');
		$alerts[] =  'User was successfully deleted';
		
		$this->index();
	}

	function login()
	{
	  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	      $_POST['pass'] = sha1($_POST['pass']);
	      $user = $this->db_controller->read("users", 'username="'.$_POST['username'].'" and pass="'.$_POST['pass'].'"');
			if (count($user) > 0) {
      				$_SESSION['username'] = $_POST['username'];
				
				$alerts = "You have been logged in. Welcome back!";
				
				$this->index();
			} else {
				$alerts[] = "Login failed: username or password is incorrect.";
				
				$this->display('user-login.tpl');
			}
			
		} else {
	    if(isset($_SESSION['username']))
	      {
		$alerts[] = "Hey there partner! You're already logged in!";
		
	      }

			$this->display('user-login.tpl');
		}
	}
	
	// Kill any existing session.
	function logout()
	{
	  // Resume/create a session.
	  //session_start();

	  // See if there is valid session to destroy.
	  if(isset($_SESSION['username']))
	    {
	      //echo($_SESSION['username']);
	      // Unset any session variables.
	      unset($_SESSION['username']);

	      // Destroy the session.
	      session_destroy();
	      
	      // Tell the user they've logged out.
	      $alerts[] = "You have been successfully logged out.";
	      
	      $this->view->display('user-login.tpl');
	      // TODO: This should redirect the user to a different URI.
	      //$this->index();
	    }
	  else
	    {
	      // There wasn't a session to destroy!
	      $alerts[] = "Noone to logout!";
	      
	      $this->display('user-login.tpl');
	      // TODO: This should redirect to a URI too...
	      //$this->index();
	    }
	}
}

?>
