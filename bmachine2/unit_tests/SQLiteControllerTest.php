<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/SQLiteController.php';

//Require dbconfig file
require_once '../db/db_config.inc';

class SQLiteControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function SQLiteControllerTest()
	{
		$this->UnitTestCase('SQLiteController Test Case');
	}
	
	// Tests instantiation, configure, connect, and query functions
	function testQuery()
	{
		$controller = new SQLiteController();

		//Test a good query
		$query = "select * from channels";
		$foo = $controller->query($query);
		$this->assertTrue($foo);

		//Test a bad query
		//$query = "select gfjkghfl from fkgjfjkhg";
		//$foo = $controller->query($query);
	}

	function testDisconnect(){
		$controller = new SQLiteController();
		$this->assertTrue($controller->disconnect());
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new SQLiteControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
