<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

include_once("publishing.php");

class RSSTest extends BMTestCase {

  var $channel_id;

  function RSSTest() {
  }

  function BuildTestData() {


    //$this->ClearOldData();
    setup_data_directories(false);

    global $store;
    global $rss_dir;

    $this->Login();

    global $store;
    $channel_id = $store->addNewChannel( "Junky Channel" );
    print "CREATED CHANNEL: $channel_id\n";
    $store->unlockAll();
    clearstatcache();

    $file = array();
    set_file_defaults($file);

    $file['URL'] = "http://lovelylittlegirls.com/z/fluvial-origine_des_femmes.mp3";
    $file['Title'] = "RSS File & Junk Test";
    $encodedtext = file_get_contents("tests/utf8demo.txt"); // file_get_contents("tests/frenchtext.txt") . 
    $file['Description'] = "URL desc & general notes\n" . $encodedtext;
    $file['donation_id'] = 1;
    $file['People'] = array(
			    0 => "colin:did stuff & had fun",
			    1 => "colin2:did other stuff & slept a lot",
    );
    $file['Keywords'] = array(
			      0 => 'kw1',
			      1 => 'kw2');
    
    $file['post_channels'] = array($channel_id);

    publish_file($file);
    $this->channel_id = $channel_id;

  }

  function TestGenerateRSS() {

    global $rss_dir;

    //$this->ClearOldData();
    setup_data_directories(false);

    $this->BuildTestData();

    //$rss_url = get_base_url() . "rss.php?i=" . $this->channel_id . "&amp;force=1";
    //$test_url = "http://www.feedvalidator.org/check.cgi?url=" . $rss_url;
    
    //$this->get($test_url);
    //$this->assertWantedPattern('/Congratulations/i', $rss_url);

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