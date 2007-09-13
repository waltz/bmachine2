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
		$tags = $video->db_controller->read("video_tags", 'id="'.$testvideo['id'].'"');
		$this->assertEqual(count($tags), 2);
		
		$video->db_controller->delete("videos", 'title="Unit test video"');	
		$video->db_controller->delete("videos", 'name="funny" or name="lol"');
	}

/*	function testShow() {
		$params = array();
		$params[0] = 'channelname';
		$video = new videoController($params);

		$params[1] = 'show';
		$video = new videoController($params);
	}

	function testEdit() {
                $params = array();
                $params[0] = 'channelname';
		$params[1] = 'edit';
                $video = new videoController($params);
	}

	function testRemove() {
                $params = array();
                $params[0] = 'channelname';
                $video = new videoController($params);
	}*/
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new VideoControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
