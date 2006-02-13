<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class SeedTest extends BMTestCase {

  var $first_run;
  
	function SeedTest() {
    error_log("SeedTest");
    $this->BMTestCase();
    $this->first_run = true;
  }

  function StartSeeder() {

    error_log("SeedTest/StartSeeder");
    setup_data_directories(false);

    global $settings;
    global $seeder;
    global $store;

    $settings['sharing_enable'] = 1;
    $store->saveSettings($settings);

		$result = $seeder->setup();

    error_log("here");
    if ( $this->first_run ) {
      $this->first_run = false;
      if ( $result == false ) {
        error_log("Couldn't setup seeder: " . $seeder->problem);
      }
      else {
        error_log("seeder setup worked");
      }
    }
  }
	
	function TestStopServerSharing() {

    error_log("SeedTest/TestStopServerSharing");
    $this->StartSeeder();

		global $seeder;

		if ( $seeder->enabled() ) {
      error_log("try and stop");
			$seeder->stop_seeding();
      error_log("try and stop - done");
		}
		else {
      error_log("Seeding not enabled, can't test it");
			print "Seeding not enabled, can't test it.<br>";
		}
	}

	function TestStartServerSharing() {

    error_log("SeedTest/TestStartServerSharing");

		global $seeder;
		if ( $seeder->enabled() ) {
			$seeder->setup();
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}
	}


	function TestStart() {

    error_log("SeedTest/TestStart");

    $this->StartSeeder();

		$this->Logout();
		$this->Login();

    global $store;
    
    //
    // publish a torrent so we have something to seed
    //

    // generate the hash
    $hash = $store->getAuthHash("unittest", hashpass("unittest", "unittest") );
    
    // now post our torrent to upload.php
    $url = get_base_url() . "upload.php";
    
    $post = array();
    $post["Username"] = "unittest";
    $post["Hash"] = $hash;
    
    $upload = array();
    $u1 = array();
    $u1["key"] = "Torrent";
    $u1["content"] = file_get_contents("tests/test.torrent");
    $u1["filename"] = "test.torrent";
    $u1["mimetype"] = "application/x-bittorrent";
    $upload[] = $u1;

    $this->post( $url, $post, $upload );
    $this->assertResponse("200", "SeedTest/TestStart: didn't get 200 response");		

    
    $file = array();
    $file['post_title'] = "unit test " . rand(0, 10000) . ": Torrent Upload";
    $file['post_desc'] = "description";
    $file['post_do_save'] = 1;
    $file['post_file_url'] = $hash;
    $file['post_mimetype'] = 'application/x-bittorrent';

    $publish_url = get_base_url() . "publish.php";
    $this->post( $publish_url, $file );


    global $torrents_dir;
    global $data_dir;
    
    $this->assertTrue( file_exists( $torrents_dir . '/test.torrent' ), "SeedTest/TestStart: torrent wasn't in torrent folder" );
    $this->assertTrue( file_exists( $data_dir . '/' . $hash ), "SeedTest/TestStart: torrent hash missing" );
    

		global $store;	
		global $seeder;
		if ( $seeder->enabled() ) {

			$files = $store->getAllFiles();

      //      print "<pre>";
      //print_r($files);
      //print "</pre>";
	
			foreach ($files as $filehash => $f) {
				if ( endsWith($f["URL"], ".torrent" ) ) {
					$url = $f["URL"];
					$torrentfile = local_filename($url);
	
          //          print "test seeding $torrentfile<br>";
					$seeder->spawn($torrentfile);
	
					// update the file entry
					$f['SharingEnabled'] = true;
					$store->store_file($f, $filehash);
				}
			}
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}
	}

	function TestPause() {

    error_log("SeedTest/TestPause");

    $this->StartSeeder();

		$this->Logout();
		$this->Login();

		global $store;	
		global $seeder;
		
		if ( $seeder->enabled() ) {
			$files = $store->getAllFiles();

			foreach ($files as $filehash => $f) {
				if ( endsWith($f["URL"], ".torrent" ) ) {
					$url = $f["URL"];
					$torrentfile = local_filename($url);
	
					$seeder->pause($torrentfile);
	
					// update the file entry
					$f['SharingEnabled'] = true;
					$store->store_file($f, $filehash);
				}
			}
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}

	}

	function TestStop() {

    error_log("SeedTest/TestStop");

    $this->StartSeeder();

		$this->Logout();
		$this->Login();

		global $store;	
		global $seeder;

		if ( $seeder->enabled() ) {
			$files = $store->getAllFiles();
	
			foreach ($files as $filehash => $f) {
				if ( endsWith($f["URL"], ".torrent" ) ) {
					$url = $f["URL"];
					$torrentfile = local_filename($url);
	
					$seeder->stop($torrentfile);
	
					// update the file entry
					$f['SharingEnabled'] = false;
					$store->store_file($f, $filehash);
				}
			}
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}
	}

	function TestAnnounceNoCompact() {

    error_log("SeedTest/TestAnnounceNoCompact");

		$announce_url = get_base_url() . "announce.php?info_hash=hhdhdhdhdhd";
		$this->get($announce_url);
		$this->assertWantedPattern("/This tracker requires new tracker protocol/", 
                               "SeedText/TestAnnounceNoCompact: no compact but announce worked");
	}


	function TestAnnounceBadHash() {

    error_log("SeedTest/TestAnnounceBadHash");

		$announce_url = get_base_url() . "announce.php?info_hash=hhdhdhdhdhd&compact=1";
		$this->get($announce_url);
		$this->assertWantedPattern("/Invalid info_hash/", "SeedText/TestAnnounceBadHash: expected announce to fail but it didn't");
	}

	function TestAnnounceUnAuthedHash() {

    error_log("SeedTest/TestAnnounceUnAuthedHash");

		$announce_url = get_base_url() . "announce.php?info_hash=01234567890123456789&compact=1";
		$this->get($announce_url);
		$this->assertWantedPattern("/This torrent is not authorized on this tracker/", "SeedText/TestAnnounceUnAuthedHash: expected announce to fail but it didn't");
	}

}


/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>