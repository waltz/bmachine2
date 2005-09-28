<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class RSSTest extends WebTestCase {

	function RSSTest() {
	}

	function TestGenerateRSS() {

		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");
	
		global $store;
		global $rss_dir;

		$channels = $store->getAllChannels();
	
		foreach($channels as $channel) {
		
			makeChannelRss($channel["ID"]);
			$this->assertTrue(file_exists("$rss_dir/" . $channel["ID"] . ".rss"), "Didn't generate " . $channel["ID"] . ".rss" );			
		}
	}

	function TestValidateRSS() {

		$this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;
		$channels = $store->getAllChannels();

		foreach($channels as $channel) {
			$rss_url = get_base_url() . "rss.php?i=" . $channel["ID"];
			$test_url = "http://www.feedvalidator.org/check.cgi?url=" . urlencode($rss_url);

			$this->get($test_url);
			$this->assertWantedPattern('/Congratulations/i', $rss_url);

		}
	}
}
?>