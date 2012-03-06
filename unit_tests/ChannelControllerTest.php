<?php

// The SimpleTest API is available at http://simpletest.com/api.
// It is a fairly complete list of the classes and assertions available.

//Initialize unit testing variables
$baseDir = "../";
$bm_debug = 'unittest';

// We need to include the unit testing framework and the message reporting framework.
require_once '../simpletest/unit_tester.php';
require_once '../simpletest/reporter.php';
require_once '../bm2_conf.php';
require_once '../controllers/ChannelController.php';

class ChannelControllerTest extends UnitTestCase
{
	var $id;

	// The instantiator can set different parameters for the whole test.
	function ChannelControllerTest()
	{
		$this->UnitTestCase('ChannelController Test Case');
	}
	
	// Should hit the index function
	function testIndex()
	{
		$params = array();
		$channel = new ChannelController($params);
		$this->assertTrue(true);
	}

        function testAll() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'all';
                $channel = new ChannelController($params);
                $this->assertTrue(true);
        }

        function testAdd() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'add';

		$_SERVER['REQUEST_METHOD'] = 'POST';
                $_POST = array(
                        "title"         =>      "Unit test channel",
                        "description"   =>      "This is only a test",
                        "icon_url"      =>      "http://blank.com/blank.gif",
			"website_url"	=>	"http://test.com",
                        "tags"          =>      "funny lol"
                );

                $channel = new channelController($params);

                $chanarray = $channel->db_controller->read("channels", 'title="Unit test channel"');
                $this->assertEqual(count($chanarray), 1);

                $testchannel = $chanarray[0];
		$this->id = $testchannel['id'];
                $condition = 'channel_id="'.$this->id.'"';
                $tags = $channel->db_controller->read("channel_tags", $condition);
                $this->assertEqual(count($tags), 2);
        }

        function testChannelName() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $channel = new ChannelController($params);

                $this->assertNoErrors();
        }

        function testShow() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $params[2] = 'show';

                $channel = new ChannelController($params);

		$this->assertNoErrors();
        }

        function testEditEmpty() {
                unset($_POST);
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $params[2] = 'edit';

                $channel = new channelController($params);

		$this->assertNoErrors();
        }

        function testEdit() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $params[2] = 'edit';

                $_POST = array(
			"id"		=>	$this->id,
                        "title"         =>      "Unit test channel",
                        "description"   =>      "This is only an edited test",
                        "icon_url"      =>      "http://blank.com/blank.gif",
			"website_url"   =>      "http://test.com",
                        "tags"          =>      "funny lol"
                );
		$channel = new channelController($params);

                $chanarray = $channel->db_controller->read("channels", 'title="Unit test channel"');
                $testchannel = $chanarray[0];
                $this->assertEqual($testchannel['description'], "This is only an edited test");
        }

        function testEditTags() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $params[2] = 'edit';

                $_POST = array(
			"id"		=>	$this->id,
                        "title"         =>      "Unit test channel",
                        "description"   =>      "This is only an edited test",
                        "icon_url"      =>      "http://blank.com/blank.gif",
			"website_url"   =>      "http://test.com",
                        "tags"          =>      "funny test"
                );

                $channel = new channelController($params);

                $chanarray = $channel->db_controller->read("channels", 'title="Unit test channel"');
                $testchannel = $chanarray[0];

                $condition = 'channel_id="'.$testchannel['id'].'"';
                $tags = $channel->db_controller->read("channel_tags", $condition);

                $tag = $tags[0];
                $this->assertEqual($tag['name'], "funny");

                $tag = $tags[1];
                $this->assertEqual($tag['name'], "test");
        }


        function testRemove() {
                $params = array();
		$params[0] = 'channel';
                $params[1] = 'Unit_test_channel';
                $params[2] = 'remove';

                $channel = new channelController($params);

                $chanarray = $channel->db_controller->read("channels", 'title="Unit test channel"');
                $testchannel = $chanarray[0];
                $this->assertEqual(count($chanarray), 0);
        }



}

// Instantiate the unit test class and tell it to display the results as HTML.
$test = new ChannelControllerTest();
$test->run(new HtmlReporter());

//$test->run(new TextReporter());

?>
