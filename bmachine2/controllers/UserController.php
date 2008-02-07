<?php

require_once('ViewController.php');

class UserController extends ViewController{

        // Takes on an array of url parameters and calls the correct controller function
        // Called on instantiation
        function dispatch($params) {
	  // This is a hack. Yikes. 
          if (!isset($params[1])) {$params[1] = '';}
	  switch($params[1]) {
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
              $this->all();
              break;
            default:
              switch($params[1]) {
                case '':
                  $this->show($params[0]);
                  break;
                case 'show':
                  $this->show($params[0]);
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
                $this->all();
        }


	function all() {
		$users = $this->db_controller->read("users", "all");
		$this->view->assign('users', $users);
		$this->display('user-all.tpl');
	}

	// Add new users.
        function signup() 
	{
	  // If there's POST data, verify and add the entry.
	  if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	      // TODO: Validate input.
 
	      // Hash the password.
	      $_POST['pass'] = sha1($_POST['pass']);
	      print_r($_POST);

	      // Build the user data array.
	      $user = array('name' => $_POST['name'],
			    'username' => $_POST['username'],
			    'pass' => $_POST['pass'],
			    'email' => $_POST['email']);

	      // Add the new user to the database.
	      $this->db_controller->create("users", $user);

	      // Tell the user to activate their account.
	      //$this->display('user-unactivated.tpl');
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
			$this->view->assign('alerts', $alerts);
			$this->index();
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
			$this->view->assign('alerts', $alerts);
                        $this->show($username);
		} else {
			//If data has not yet been posted, get user data and display edit template
			$userArray = $this->db_controller->read('users', 'username="'.$username.'"');
	                if (count($userArray) == 0) {
				$alerts[] = "User $username not found";
        	                $this->view->assign('alerts', $alerts);
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
		$this->view->assign('alerts', $alerts);
		$this->index();
	}

	function login()
	{
	  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	      $_POST['pass'] = sha1($_POST['pass']);
	      $user = $this->db_controller->read("users", 'username="'.$_POST['username'].'" and pass="'.$_POST['pass'].'"');
			if (count($user) > 0) {
				session_start();
				$_SESSION['pass'] = $_POST['pass'];
				$_SESSION['username'] = $_POST['username'];

				$alerts = "You have been logged in. Welcome back!";
				$this->view->assign('alerts', $alerts);
				$this->index();
			} else {
				$alerts[] = "Login failed: username or password is incorrect.";
				$this->view->assign('alerts', $alerts);
				$this->display('user-login.tpl');
			}
			
		} else {
			$alerts[] = "Please log in.";
			$this->view->assign('alerts', $alerts);
			$this->display('user-login.tpl');
		}
	}
	
	// Kill any existing session.
	function logout()
	{
		$_SESSION = array();
		session_destroy();	
		$alerts[] = "You have been successfully logged out.";
		$this->view->assign('alerts', $alerts);
		$this->index();
	}
}

?>
