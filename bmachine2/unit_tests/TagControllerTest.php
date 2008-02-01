<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

//Initialize unit testing variables
$baseDir = "../";
$bm_debug = 'unittest';

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/TagController.php';

class TagControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function TagControllerTest()
	{
		$this->UnitTestCase('TagController Test Case');
	}
	
	// Should hit the index function
	function testIndex()
	{
		$params = array();
		$tag = new TagController($params);
		$this->assertNoErrors();
	}

        function testAll() {
                $params = array();
		$params[0] = 'tag';
                $params[1] = 'all';
                $tag = new TagController($params);
                $this->assertNoErrors();
        }
        function testTagName() {
                $params = array();
		$params[0] = 'tag';
                $params[1] = 'Unit';
                $tag = new TagController($params);

                $this->assertNoErrors();
        }

        function testShow() {
                $params = array();
                $params[0] = 'Unit';
                $params[1] = 'show';

                $tag = new TagController($params);

		$this->assertNoErrors();
        }
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new TagControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
