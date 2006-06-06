<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

include_once("publishing.php");

class RSSTest extends BMTestCase {

  function RSSTest() {
  }

  function TestGenerateRSS() {

    global $rss_dir;

    setup_data_directories(false);

    $this->BuildTestData();
    makeChannelRss($this->channel_id);
    $this->assertTrue(file_exists("$rss_dir/" . $this->channel_id . ".rss"), "Didn't generate " . $this->channel_id . ".rss" );
  }

  function TestValidateRSS() {
    //$this->ClearOldData();
    setup_data_directories(false);
    $this->BuildTestData();

    global $store;

    $rss_url = get_base_url() . "rss.php?i=" . $this->channel_id . "&amp;force=1";
    $test_url = "http://www.feedvalidator.org/check.cgi?url=" . $rss_url;

    $this->get($test_url);

    $content = $this->_browser->getContent();
    eregi("^(.*)(<[ \\n\\r\\t]*ul(>|[^>]*>))(.*)(<[ \\n\\r\\t]*/[ \\n\\r\\t]*ul(>|[^>]*>))(.*)$", $content, $errors);

    $details = $errors[4];
    $details = str_replace("&nbsp;", " ", $details);
    $details = str_replace("&gt;", ">", $details);
    $details = str_replace("&lt;", "<", $details);
    $this->assertWantedPattern('/Congratulations/i', $rss_url . $details );
  }

  /**
   * test our logic for if/when to rebuild rss
   */
  function TestRebuildingRSS() {

    global $store;

    $now = time();
    sleep(2);
    $this->BuildTestData();
    $this->assertTrue( $now < $store->getRSSPublishTime($this->channel_id), "rss wasn't rebuilt after new file added?");

    # re-publish and see if rss is rebuilt
    $file = $store->getFile($this->id);

    $now = time();
    sleep(2);
    publish_file($file);
    $this->assertTrue( $now < $store->getRSSPublishTime($this->channel_id), "rss wasn't rebuilt after file update?");    

    $now = time();
    sleep(2);
    $store->DeleteFile($this->id);
    $this->assertTrue( $now < $store->getRSSPublishTime($this->channel_id), "rss wasn't rebuilt after file delete?");
  }



  /*
  function TestRestrictedRSS() {

    $this->BuildTestData();

    global $store;
    $channels = $store->getAllChannels();
    
    foreach($channels as $channel) {

      if ( isset($channel["RequireLogin"]) && $channel["RequireLogin"] == true ) {
	$rss_url = get_base_url() . "rss.php?i=" . $channel["ID"] . "&amp;force=1";
	$headers = @bm_get_headers($rss_url);
	$this->assertTrue($headers[0] == "HTTP/1.1 401 Unauthorized", "Expected restricted RSS file, but it wasn't");
      }
    }
  }*/

}
?>