<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

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
	function ViewControllerTest()
	{
		$this->UnitTestCase('ViewController Test Case');
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
$test = new ViewControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
