<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/VideoController.php';

$bm_debug = 'unittest';

class VideoControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function VideoControllerTest()
	{
		$this->UnitTestCase('VideoController Test Case');
	}
	
	// Should hit the index function
	function testIndex()
	{
		$params = array();
		$video = new videoController($params);
		$this->assertTrue(true);
	}

	function testAll() {
		$params = array();
		$params[0] = 'all';
		$video = new videoController($params);
		$this->assertTrue(true);
	}

	function testAdd() {
		$params = array();
		$params[0] = 'add';

                $_POST = array(                        
			"title"         =>      "Unit test video",                        
			"description"   =>      "This is only a test",                        
			"icon_url"      =>      "http://blank.com/blank.gif",                        
			"website_url"   =>      "http://bm.com",                        
			"adult"         =>      "false",                   
			"mime"          =>      "avi",         
			"file_url"      =>      "http://bm.com/video.avi",
			"tags"		=>	"funny lol"
		);

		$video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$this->assertEqual(count($vidarray), 1);
		
		$testvideo = $vidarray[0];
		$condition = 'id="'.$testvideo['id'].'"';
		$tags = $video->db_controller->read("video_tags", $condition);
		$this->assertEqual(count($tags), 2);
	}

	function testVideoName() {
		$params = array();
		$params[0] = 'Unit test video';
		$video = new VideoController($params);

		$this->assertTrue(true);
	}

	function testShow() {
                $params = array();
                $params[0] = 'Unit test video';
                $params[1] = 'show';

                $video = new videoController($params);

                $this->assertTrue(true);

	}

	function testEditEmpty() {
		unset($_POST);
		$params = array();
		$params[0] = 'Unit test video54545';
		$params[1] = 'edit';

		$video = new videoController($params);

		$this->assertTrue(true);
	}

	function testEdit() {
                $params = array();
                $params[0] = 'Unit test video';
		$params[1] = 'edit';

		$_POST = array(
                        "title"         =>      "Unit test video",
                        "description"   =>      "This is only an edited test",
                        "icon_url"      =>      "http://blank.com/blank.gif",
                        "website_url"   =>      "http://bm.com",
                        "adult"         =>      "false",
                        "mime"          =>      "avi",
                        "file_url"      =>      "http://bm.com/video.avi",
                        "tags"          =>      "funny lol"
                );

                $video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$testvid = $vidarray[0];
                $this->assertEqual($testvid['description'], "This is only an edited test");

	}

	function testEditTags() {

	}

	function testRemove() {
                $params = array();
                $params[0] = 'Unit test video';
		$params[1] = 'remove';

                $video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$testvideo = $vidarray[0];
		$this->assertEqual(count($vidarray), 0);		
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new VideoControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
