<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

//Initialize unit testing variables
$baseDir = "../";
$bm_debug = 'unittest';

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../controllers/VideoController.php';

class VideoControllerTest extends UnitTestCase
{
	var $channel_id;
	var $video_id;

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

		 //Add a dummy channel to the database, assigns channel id for other tests
                $channel = array(
                        "title"         =>      "Unit test channel",
                        "description"   =>      "This is only a test",
                        "icon_url"      =>      "http://blank.com/blank.gif",
                );

                $video->db_controller->create("channels", $channel);
                $chanArray = $video->db_controller->read("channels", 'title="Unit test channel"');
                $channel = $chanArray[0];
                $this->channel_id = $channel['id'];

 		$this->assertNoErrors();
	}

	function testAll() {
		$params = array();
		$params[0] = 'all';
		$video = new videoController($params);
		$this->assertNoErrors();
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
			"tags"		=>	"funny lol",
			"channels"	=>	array($this->channel_id),
			"credits"	=>	array(array("name" => "john doe", "role" => "director"))
		);

		$video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$this->assertEqual(count($vidarray), 1);
		
		$testvideo = $vidarray[0];
		$this->video_id = $testvideo['id'];
		$condition = 'video_id="'.$this->video_id.'"';
		$tags = $video->db_controller->read("video_tags", $condition);
		$this->assertEqual(count($tags), 2);

		$published = $video->db_controller->read("published", $condition.' and channel_id="'.$this->channel_id.'"');
                $this->assertEqual(count($published), 1);

		$credits = $video->db_controller->read("video_credits", $condition);
		$this->assertEqual(count($credits), 1);
	}

	function testVideoName() {
		$params = array();
		$params[0] = 'Unit test video';
		$video = new VideoController($params);

		$this->assertNoErrors();
	}

	function testShow() {
                $params = array();
                $params[0] = 'Unit test video';
                $params[1] = 'show';

                $video = new videoController($params);

                $this->assertNoErrors();
	}

	function testEditEmpty() {
		unset($_POST);
		$params = array();
		$params[0] = 'Unit test video';
		$params[1] = 'edit';

		$video = new videoController($params);

		$this->assertNoErrors();
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
                        "tags"          =>      "funny lol",
			"channels"      =>      array($this->channel_id),
			"credits"       =>      array(array("name" => "john doe", "role" => "director"))
                );

                $video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$testvideo = $vidarray[0];
                $this->assertEqual($testvideo['description'], "This is only an edited test");
	}

	function testEditMetaData() {
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
                        "tags"          =>      "funny test",
			"channels"	=>	array(),
			"credits"       =>      array(
							array("name" => "jane doe", "role" => "director"),
							array("name" => "tony jones", "role" => "producer")
						)
                );

		$video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
                $testvideo = $vidarray[0];

                $condition = 'video_id="'.$this->video_id.'"';
                $tags = $video->db_controller->read("video_tags", $condition);

		$tag = $tags[0];
		$this->assertEqual($tag['name'], "funny");

		$tag = $tags[1];
                $this->assertEqual($tag['name'], "test");

		$published = $video->db_controller->read("published", $condition);
                $this->assertEqual(count($published), 0);

		$credits = $video->db_controller->read("video_credits", $condition);
                $this->assertEqual(count($credits), 2);
		$this->assertFalse(array_search(array("name" => "john doe", "role" => "director"), $credits));
	}

	function testDownload() {
                $params = array();
                $params[0] = 'Unit test video';
                $params[1] = 'download';

		$video = new videoController($params);

                $vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
                $testvideo = $vidarray[0];

		$this->assertEqual($testvideo['downloads'], 1);

	}

	function testRemove() {
                $params = array();
                $params[0] = 'Unit test video';
		$params[1] = 'remove';

                $video = new videoController($params);

		$vidarray = $video->db_controller->read("videos", 'title="Unit test video"');
		$this->assertEqual(count($vidarray), 0);		

		$published = $video->db_controller->read("published", 'video_id="'.$this->video_id.'"');
                $this->assertEqual(count($published), 0);

		$credits = $video->db_controller->read("video_credits", 'video_id="'.$this->video_id.'"');
                $this->assertEqual(count($credits), 0);


		//Destroy test channel
		$video->db_controller->delete("channels", 'title="Unit test channel"');
		$chanArray = $video->db_controller->read("channels", 'title="Unit test channel"');
		$this->assertEqual(count($chanArray), 0);
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new VideoControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
