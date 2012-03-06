<?php
//This unit test tests whatever DBMS is currently configured
// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';

// Include the appropriate database controller
require_once('../bm2_conf.php');
require_once('../controllers/' . $cf_dbengine . 'Controller.php');

class DBControllerTest extends UnitTestCase
{
	// The instantiator can set different parameters for the whole test.
	function DBControllerTest()
	{
		$this->UnitTestCase('DBController Test Case');
	}

        function selectController() {
                global $cf_dbengine;
                //Instantiate the DB connection
                switch($cf_dbengine) {
                        case 'MySQL':
                                return new MySQLController();
                                break;
                        case 'SQLite2':
                                return new SQLite2Controller();
                                break;
                        case 'SQLite3':
                                return new SQLite3Controller();
                                break;
                }

        }

	
	// Tests instantiation, configure, connect, and query functions
	function testCRUD() {
		$controller = $this->selectController();

		//CREATE

		// Create with associative arrays
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

		$videos = $controller->read("videos", 'title="Unit test video"');
		$this->assertEqual(count($videos), 1);
		
		//Create w/ numerical array
		$video = $videos[0];
		$creddata = array($video['id'], "testee", "tester");

		$foo = $controller->create("video_credits", $creddata);
		$creds = $controller->read("video_credits", 'name = "testee" and role = "tester"');
		$this->assertEqual(count($creds), 1);

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
		$foo = $controller->delete("video_credits", 'name = "testee" and role = "tester"');
		$creds = $controller->read("video_credits", 'name = "testee" and role = "tester"');
                $this->assertEqual(count($creds), 0);

		$foo = $controller->delete("videos", 'title="Unit test video"');
		$videos = $controller->read("videos", 'title="Unit test video"');
                $this->assertEqual(count($videos), 0);

	}

	//This tests tests working with an empty query
	function testEmpty() {
		$controller = $this->selectController();
		$condition = 'title="vjlfhjklghskf"';
		$this->assertFalse($controller->read("videos", $condition));
	}
}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new DBControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
