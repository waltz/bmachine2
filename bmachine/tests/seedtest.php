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
    $this->BMTestCase();
    $this->first_run = true;
  }

  function StartSeeder() {

    setup_data_directories(false);

    global $settings;
    global $seeder;
    global $store;

    $settings['sharing_enable'] = 1;
    $store->saveSettings($settings);

		$result = $seeder->setup();

    if ( $this->first_run ) {
      $this->first_run = false;
      if ( $result == false ) {
        print "Couldn't setup seeder: " . $seeder->problem . "<br>";
      }
      else {
        print "seeder setup worked<br>";
      }
    }
  }
	
	function TestStopServerSharing() {

    $this->StartSeeder();

		global $seeder;
		
		if ( $seeder->enabled() ) {
			$seeder->stop_seeding();
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}
	}

	function TestStartServerSharing() {

		global $seeder;
		if ( $seeder->enabled() ) {
			$seeder->setup();
		}
		else {
			print "Seeding not enabled, can't test it.<br>";			
		}
	}


	function TestStart() {

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
		$announce_url = get_base_url() . "announce.php?info_hash=hhdhdhdhdhd";
		$this->get($announce_url);
		$this->assertWantedPattern("/This tracker requires new tracker protocol/", "SeedText/TestAnnounceNoCompact: no compact but announce worked");
	}


	function TestAnnounceBadHash() {
		$announce_url = get_base_url() . "announce.php?info_hash=hhdhdhdhdhd&compact=1";
		$this->get($announce_url);
		$this->assertWantedPattern("/Invalid info_hash/", "SeedText/TestAnnounceBadHash: expected announce to fail but it didn't");
	}

	function TestAnnounceUnAuthedHash() {
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