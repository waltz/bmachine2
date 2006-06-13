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

    $rss_url = get_base_url() . "rss.php?i=" . $this->channel_id . "&force=1";
    $test_url = "http://www.feedvalidator.org/check.cgi?url=" . $rss_url;

    error_log("get $test_url");
    $this->get($test_url);
    error_log("got it");

    $content = $this->_browser->getContent();
    error_log("got content");
    //eregi("^(.*)(<[ \\n\\r\\t]*ul(>|[^>]*>))(.*)(<[ \\n\\r\\t]*/[ \\n\\r\\t]*ul(>|[^>]*>))(.*)$", $content, $errors);
    error_log("parsed!");

    /*$details = $errors[4];
    $details = str_replace("&nbsp;", " ", $details);
    $details = str_replace("&gt;", ">", $details);
    $details = str_replace("&lt;", "<", $details);
    $this->assertWantedPattern('/Congratulations/i', $rss_url . $details );*/
    error_log("done");
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

    $this->Logout();
    $this->BuildTestData();

    global $store;
    $c = $store->getChannel($this->channel_id);
    $c["RequireLogin"] = true;
    $store->saveChannel($c);

    print_r( $store->getChannel($this->channel_id) );

    $rss_url = get_base_url() . "rss.php?i=" . $this->channel_id . "&force=1";
    $headers = @bm_get_headers($rss_url);
    $this->assertTrue( stristr($headers[0], "HTTP/1.1 401") !== false, "Expected restricted RSS file, but it wasn't");

    $this->authenticate('unittest', 'unittest');
    $this->get($rss_url);
    $this->assertResponse(200);
  }*/

}
?>