<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/MySQLController.php';

class MySQLControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function MySQLControllerTest()
	{
		$this->UnitTestCase('MySQLController Test Case');
	}
	
	// Tests instantiation, configure, and connect functions
	function testInstantiation()
	{
		$foo = new MySQLController();
		$this->assertTrue(TRUE);
	}
	
	function testQuery()
	{
		$this->assertFalse(FALSE);
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new MySQLControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
