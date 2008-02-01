<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

//Initialize unit testing variables
$baseDir = "../";
$bm_debug = 'unittest';

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/UserController.php';

class UserControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function UserControllerTest()
	{
		$this->UnitTestCase('UserController Test Case');
	}
	
	// Should hit the index function
	function testIndex()
	{
		$params = array();
		$user = new UserController($params);
		$this->assertNoErrors();
	}

	function testAll() {
		$params = array();
		$params[0] = 'user'; 
		$params[1] = 'all';
		$user = new UserController($params);
		$this->assertNoErrors();
	}

	function testSignup() {
		$params = array();
		$params[0] = 'user'; 
		$params[1] = 'signup';

                $_POST = array(                        
			"username"      =>      "UnitTestUser",                        
			"name"   	=>      "Joe Tester",                        
			"pass"          =>      "blah",                   
			"email"         =>      "tester@bm.com",         
			"admin"		=>	"false"
		);

		$user = new UserController($params);

		$userArray = $user->db_controller->read('users', 'username="UnitTestUser"');
		$this->assertEqual(count($userArray), 1);
	}

	function testUserName() {
		$params = array();
		$params[0] = 'user'; 
		$params[1] = 'UnitTestUser';
		$User = new UserController($params);

		$this->assertNoErrors();
	}

	function testShow() {
                $params = array();
                $params[0] = 'UnitTestUser';
                $params[1] = 'show';

                $user = new UserController($params);

                $this->assertNoErrors();
	}

	function testEditEmpty() {
		unset($_POST);
		$params = array();
		$params[0] = 'UnitTestUser';
		$params[1] = 'edit';

		$user = new UserController($params);

		$this->assertNoErrors();
	}

	function testEdit() {
                $params = array();
                $params[0] = 'UnitTestUser';
		$params[1] = 'edit';

		$_POST = array(
                        "username"      =>      "UnitTestUser",
                        "name"          =>      "Sally Tester",
                        "pass"          =>      "blah",
                        "email"         =>      "tester@bm.com",
                        "admin"         =>      "false"
                );

                $user = new UserController($params);

		$userarray = $user->db_controller->read("users", 'username="UnitTestUser"');
		$testUser = $userarray[0];
                $this->assertEqual($testUser['name'], "Sally Tester");
	}

	function testActivate() {

	}

	function testLoginNoPost() {
		$params = array();
		$params[0] = 'user'; 
		$params[1] = 'login';

		$user = new UserController($params);
		$this->assertNoErrors();
	}

	function testLogin() {
                $params = array();
		$params[0] = 'user'; 
                $params[1] = 'login';

                $_POST = array(
                        "username"      =>      "UnitTestUser",
                        "pass"          =>      "blah",
                );
                
		$user = new UserController($params);
                $this->assertNoErrors();
		$this->assertEqual($_SESSION['username'], "UnitTestUser");
		$this->assertEqual($_SESSION['pass'], sha1("blah"));
        }


	function testLogout() {
                $params = array();
		$params[0] = 'user'; 
                $params[1] = 'logout';
                $user = new UserController($params);

		$this->assertNoErrors();
	}

	function testRemove() {
                $params = array();
                $params[0] = 'UnitTestUser';
		$params[1] = 'remove';

                $user = new UserController($params);

		$userarray = $user->db_controller->read("users", 'username="UnitTestUser"');
		$this->assertEqual(count($userarray), 0);		
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new UserControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
