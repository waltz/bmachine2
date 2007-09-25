<?php

include('ViewController.php');

class UserController extends ViewController{

        // Takes on an array of url parameters and calls the correct controller function
        // Called on instantiation
        function dispatch($params) {
          switch($params[0]) {
            case 'signup':
              $this->signup();
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
                case 'edit':
                  $this->edit($params[0]);
                  break;
                case 'activate':
                  $this->remove($params[0]);
                  break;
                case 'remove':
                  $this->remove($params[0]);
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

        function signup() {
		//If data is posted, create user in the db
                if(isset($_POST)) {
			//Needs: Error checking?
                        $this->db_controller->create("users", $_POST);
                        $this->display('user-unactivated.tpl');
                } else {
                        $this->display('user-add.tpl');
                }

        }

	function show($username) {
		$userArray = $this->db_controller->read('users', 'username="'.$username.'"');
		if (count($userArray) == 0) {
			$this->view->assign('alerts', "User $username not found");
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
			$this->db_controller->update('users', $_POST, 'username="'.$username.'"');
			$this->view->assign('alerts', 'User information was successfully edited');
                        $this->show($username);
		} else {
			//If data has not yet been posted, get user data and display edit template
			$userArray = $this->db_controller->read('users', 'username="'.$username.'"');
	                if (count($userArray) == 0) {
        	                $this->view->assign('alerts', "User $username not found");
                	        $this->index();
	                } else {
        	                $this->view->assign('user', $userArray[0]);
                	        $this->display('user-edit.tpl');
                	}

		}
	}

	function remove($username) {
		$this->db_controller->delete("users", 'username="'.$username.'"');
		$this->view->assign('alerts', 'User was successfully deleted');
		$this->index();
	}

	function login()
	{
		
	}
	
	// Kill any existing session.
	function logout()
	{
	
	}
}

?>
