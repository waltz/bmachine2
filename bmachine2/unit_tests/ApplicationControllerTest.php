<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/ApplicationController.php';

// This is a dummy class used to test the ApplicationController
class TestApp extends ApplicationController {

	function index() {
		return true;
	}

	function dispatch($params) {
		return true;
	}
}

class ApplicationControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function ApplicationControllerTest()
	{
		$this->UnitTestCase('ApplicationController Test Case');
	}
	
	// Tests instantiation
	function testInstantiation()
	{
		$params = array();
		$foo = new TestApp($params);
		$this->assertTrue($foo);			
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new ApplicationControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
