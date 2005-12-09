<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class MySQLTest extends BMTestCase {

	var $prefix = null;

  function MySQLTest($p) {
		$this->prefix = $p;
//		mysql_attach($this->prefix);
		$this->BMTestCase();
  }

  /**
   * test the global setup function
   */
  function TestSetup() {
    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");
		global $store;
		$this->assertTrue(isset($store) && $store->type() == 'MySQL', "mysql didnt enable");
  }
	
  /**
   * test getting the type of datastore (we will need to test both mysql/flat at some point
   */
  function TestGetType() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

    global $store;
    $v = $store->type();
    $this->assertTrue(isset($v) && $v == "MySQL", "DataStoreTest/TestGetType - no type or not mysql");
  }
	/*
	function TestAddTorrentToTracker() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;
		global $settings;
		global $torrents_dir;

		$fname = "unittest" . rand(0, 10000) . ".torrent";

    $rawTorrent = file_get_contents( "tests/test.torrent" );
    $data = bdecode( $rawTorrent );

		$sql = "DELETE FROM " . $settings['mysql_prefix'] . "torrents 
						WHERE info_hash = '" . mysql_escape_string( $data["sha1"] ) . "'";
    mysql_query( $sql );

		$store->addTorrentToTracker( "tests/test.torrent", $fname );
		
		$sql = "SELECT raw_data FROM " . $settings['mysql_prefix'] . "torrents 
								WHERE filename='" . mysql_escape_string($fname) . "'";
    $result = mysql_query( $sql );

    $this->assertTrue( mysql_num_rows( $result ) > 0 , "mysql addTorrentToTracker failed" );
	}

	function TestDeleteTorrent() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;
		global $settings;
		global $torrents_dir;

		$sql = "SELECT filename FROM " . $settings['mysql_prefix'] . "torrents LIMIT 0,1";
    $result = mysql_query( $sql );
    $row = mysql_fetch_row( $result );
		
		$this->assertTrue( isset($row) && isset($row[0]) , "expected to find a torrent to delete but didn't");
		$store->deleteTorrent( $row[0] );
		$filename = $row[0];

    $result = mysql_query( $sql );
		$this->assertTrue( mysql_num_rows( $result ) <= 0, "mysql deleteTorrent failed" );

		$sql = "SELECT filename FROM " . $settings['mysql_prefix'] . "torrents LIMIT 0,1";
    $result = mysql_query( $sql );
    $row = mysql_fetch_row( $result );
		
		$this->assertTrue( !isset($row[0]) || $row[0] != $filename , "didn;t delete torrent");

	}*/


  /**
   * test the settings load/save functions
   */
  function TestSettings() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

    global $store;
    global $settings;

    $this->assertTrue( $store->layer->loadSettings() );
    $this->assertTrue( $settings, "DataStoreTest/TestSettings: Didn't load settings");
    $this->assertTrue( $store->saveSettings($settings), "DataStoreTest/TestSettings: Can't Save Settings" );
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