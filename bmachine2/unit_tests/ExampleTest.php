<?php

// Christian Bryan (christianbryan@gmail.com)
// July 24, 2007

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';

// Don't forget to require the file that holds the functions you're gonna be testing.
//require_once 'foo.php';

// Create a class and extend 'UnitTestCase'.
class ExampleTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function ExampleTest()
	{
		// This sets the title.
		$this->UnitTestCase('Example SimpleTest Unit Test');
	}
	
	// All test functions in the suite must begin with the string 'test'.
	function testFoo()
	{
		$this->assertTrue(TRUE);
	}
	
	function testBar()
	{
		$this->assertFalse(FALSE);
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new ExampleTest();
$test->run(new HtmlReporter());
// If you want to see output to the command line, use the TextReporter instead.
//$test->run(new TextReporter());
?>