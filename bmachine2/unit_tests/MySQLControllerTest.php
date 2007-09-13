<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/MySQLController.php';

//Require dbconfig file
require_once '../db/db_config.inc';

class MySQLControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function MySQLControllerTest()
	{
		$this->UnitTestCase('MySQLController Test Case');
	}
	
	// Tests instantiation, configure, connect, and query functions
	function testCRUD() {
		$controller = new MySQLController();

		//CREATE
		$data = array(
			"title"		=>	"Unit test video", 
			"description"	=>	"This is only a test",
			"icon_url"	=>	"http://blank.com/blank.gif",
			"website_url"	=>	"http://bm.com",
			"adult"		=>	"false",
			"mime"		=>	"avi",
			"file_url"	=>	"http://bm.com/video.avi"
		);
		$foo = $controller->create("videos", $data);
		$this->assertTrue($foo);

		//READ

		//Test read all:
		$videos = $controller->read("videos", "all");
		if (count($videos) > 0) {
			$foo = true;
		} else {
			$foo = false;
		}
		$this->assertTrue($foo);

		//Test read w/ condition:
		$videos = $controller->read("videos", 'title="Unit test video"');
                if (count($videos) > 0) {
                        $foo = true;
                } else {
                        $foo = false;
                }
                $this->assertTrue($foo);

		//UPDATE
		$data["icon_url"] = "test";
		$update = $controller->update("videos", $data, 'title="Unit test video"');
		$this->assertTrue($update);

		$vidarray = $controller->read("videos", 'title="Unit test video"');
		$video = $vidarray[0];
		$this->assertEqual($video["icon_url"], "test");
		
		//DELETE
		$foo = $controller->delete("videos", 'title="Unit test video"');
		$this->assertTrue($foo);
	}

	//This tests tests working with an empty query
	function testEmpty() {
		$controller = new MySQLController();
		$condition = 'title="vjlfhjklghskf"';
		$this->assertFalse($controller->read("videos", $condition));
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new MySQLControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
