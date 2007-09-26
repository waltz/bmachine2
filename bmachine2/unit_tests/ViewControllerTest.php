<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

//Initialize unit testing variables
$baseDir = "../";

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/ViewController.php';

// This is a dummy class used to test the ViewController
class TestApp extends ViewController {

	function index() {
		return true;
	}

	function dispatch($params) {
		return true;
	}
}

class ViewControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function ViewControllerTest() {
		$this->UnitTestCase('ViewController Test Case');
	}
	
	// Tests instantiation
	function testInstantiation() {
		$params = array();
		$foo = new TestApp($params);
		$this->assertNoErrors();			
	}

	function testNotUser() {
		//Start new session
		session_start();
                $_SESSION['pass'] = sha1("unittest");
                $_SESSION['username'] = "UnitTester";
		
                $params = array();
                $foo = new TestApp($params);
                $this->assertNoErrors();
		$this->assertFalse($foo->isLoggedIn());
		$this->assertFalse($foo->isUser("UnitTester"));
		$this->assertFalse($foo->isAdmin());

		//Destroy Session
		$_SESSION = array();
                session_destroy();
	}

	function testUser() {
		//Insert user into database
                $user = array(
                        "username"      =>      "UnitTestUser",
                        "name"          =>      "Joe Tester",
                        "pass"          =>      sha1("blah"),
                        "email"         =>      "tester@bm.com",
                        "admin"         =>      true
                );

		//Start new session
                session_start();
                $_SESSION['pass'] = sha1("blah");
                $_SESSION['username'] = "UnitTestUser";

		$params = array();
                $foo = new TestApp($params);
		$foo->db_controller->create("users", $user);

                $this->assertNoErrors();
		$this->assertTrue($foo->isLoggedIn());
		$this->assertTrue($foo->isUser("UnitTestUser"));
		$this->assertFalse($foo->isUser("flsgjhh"));
		$this->assertTrue($foo->isAdmin());
		
		$foo->db_controller->delete("users", 'username="UnitTestUser"');

                //Destroy Session
                $_SESSION = array();
                session_destroy();

	}

}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new ViewControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
