<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/ChannelController.php';

class ChannelControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function ChannelControllerTest()
	{
		$this->UnitTestCase('ChannelController Test Case');
	}
	
	// Should hit the index function
	function testIndex()
	{
		$params = array();
		$Channel = new ChannelController($params);
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new ChannelControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
