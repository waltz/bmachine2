<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', 'simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'web_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class DataStoreTest extends BMTestCase {

  function DataStoreTest($email) {

		if ( $email != "" ) {
			$this->email = $email;
		}
		else {
			$this->email = "fake@fake.net";
		}
  }


  /**
   * test the global setup function
   */
  function TestSetup() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

    global $data_dir;
    global $torrents_dir;

    $this->assertTrue(file_exists($data_dir));
    $this->assertTrue(file_exists($torrents_dir));
  }

  /**
   * test getting the type of datastore (we will need to test both mysql/flat at some point
   */
  function TestGetType() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

    global $store;
    $v = $store->type();
    $this->assertTrue(isset($v), "DataStoreTest/TestGetType - no type");
  }

  /**
   * test the settings load/save functions
   */
  function TestSettings() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		$this->Login();

    global $store;
    global $settings;

    $this->assertTrue( $store->loadSettings() );
    $this->assertTrue( $settings, "DataStoreTest/TestSettings: Didn't load settings");
    $this->assertTrue( $store->saveSettings($settings), "DataStoreTest/TestSettings: Can't Save Settings" );
  }

	/**
	 * test the users load/save functions
	 */
  function TestUsers() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");
    
    global $settings;
    global $store;

    $users = $store->getAllUsers();
    if ( isset($users["unittest"]) ) {
      $this->assertTrue($store->deleteUser("unittest"), "couldn't delete user");
	    $users = $store->getAllUsers();
      $this->assertTrue(!isset($users["unittest"]), "deleted user, but they still exist");
    }

	
    $settings['AllowRegistration'] = true;
    $this->assertTrue( $store->addNewUser( "unittest",  "unittest", $this->email, true, false, $error ), $error);

    $this->assertTrue( $store->deleteUser("unittest") );
		$users = $store->getAllUsers();
		$this->assertTrue(!isset($users["unittest"]));
  }

	/**
	 * test our login form
	 */
  function TestLogin() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");
    
    global $settings;
    global $store;

    $settings['AllowRegistration'] = true;
    $settings['RequireRegAuth'] = false;
    $this->assertTrue( $store->addNewUser( "unittest",  "unittest", $this->email, true, false, $error ), $error);

    $login_url = get_base_url() . "login.php";
    $this->get($login_url);

    $this->setField("username", "unittest");
    $this->setField("password", "unittest");
    $this->clickSubmit("Login >>");

    $this->get( get_base_url() . "admin.php" );
  }


	/**
	 * test our user-loading function
	 */
  function TestGetUsers() {
    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

    global $store;
    $this->assertTrue( is_array($store->getAllUsers())  );
  }
  

	/**
	 * test our save-one function
	 */
	function TestSaveOne() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;
		$files = $store->getAll("tmpfiles");

		for ( $i = 0; $i < 5; $i++ ) {
			$count = count($files);
			
			$tmpfile["ID"] = rand(0, 100000);
			$tmpfile["rand"] = rand(0, 100000);
			
			$store->saveOne("tmpfiles", $tmpfile, $tmpfile["ID"] );

      //      clearstatcache();
			$files = $store->getAll("tmpfiles");
			$this->assertTrue( $count + 1 == count($files), "saveOne didn't work" );
		}
		
	}
	
	/**
	 * test our save-all function
	 */
	function TestSaveAll() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;
		$files = $store->getAll("tmpfiles");

		for ( $i = 0; $i < 5; $i++ ) {
			$count = count($files);
			
			$tmpfile["ID"] = rand(0, 100000);
			$tmpfile["rand"] = rand(0, 100000);
			
			$files[$tmpfile["ID"]] = $tmpfile;
			$store->saveAll("tmpfiles", $files );
	
			$files = $store->getAll("tmpfiles");
			$this->assertTrue( $count + 1 == count($files), "saveAll didn't work" );
		}
	
	}
	
	
	/**
	 * test our get-one function
	 */
	function TestGetOne() {

    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");

		global $store;

		$tmpfile["ID"] = rand(0, 100000);
		$tmpfile["rand"] = rand(0, 100000);			
		$store->saveOne("tmpfiles", $tmpfile, $tmpfile["ID"] );

		$tmpfile2 = $store->getOne("tmpfiles", $tmpfile["ID"]);		
		
		$this->assertTrue( $tmpfile["ID"] == $tmpfile2["ID"] && $tmpfile["rand"] == $tmpfile["rand"],
				"getOne didn't work" );
	}

	/**
	 * test our get-all function
	 */
	function TestGetAll() {
		global $store;
		$files = $store->getAll("tmpfiles");

		for ( $i = 0; $i < 5; $i++ ) {
			$count = count($files);
			
			$tmpfile["ID"] = rand(0, 100000);
			$tmpfile["rand"] = rand(0, 100000);
			
			$files[$tmpfile["ID"]] = $tmpfile;
			$store->saveAll("tmpfiles", $files );
		}
		
		$count = count($files);

		$files2 = $store->getAll("tmpfiles");
		$this->assertTrue( $count  == count($files2), "DataStoreTest/TestGetAll getAll/saveAll counts don't match" );
		$this->assertTrue( $files == $files2, "DataStoreTest/TestGetAll getAll/saveAll data doesnt match" );
	}

	function TestDeleteChannel() {
		global $store;
		
		$channels = $store->getAllChannels();
		
		foreach ( $channels as $c ) {
			if ( $c["Name"] == "unit test channel" ||
				$c["Name"] == "unit test - open to publishing" ||
				$c["Name"] == "unit test - require login to view" ) {

				$count = count( $store->getAllChannels() );

				$store->DeleteChannel($c['ID']);
				$this->assertTrue( count($store->getAllChannels()) + 1 == $count, "DataStoreTest/TestDeleteChannel: didnt delete channel: " . $c["Name"] );
			}
		}	
	}


	function TestDeleteFile() {

		global $store;	
		$files = $store->getAllFiles();
		
		foreach ($files as $filehash => $f) {
			if ( beginsWith($f["Title"], "unit test" ) ) {
				$count = count($store->getAllFiles());
				$store->DeleteFile($filehash);
				$this->assertTrue( count($store->getAllFiles()) + 1 == $count, "DataStoreTest/TestDeleteFile: didnt delete file" . $f["Title"] );
			}
		}
	
	}

  function TestGetAllDonations() {
		global $store;
		$store->getAllDonations();
  }
/*
  function TestGetDonation() {
		global $store;
		$store->getDonation();
  }*/

  function TestSaveDonations() {

		global $store;

		$donations = $store->getAllDonations();
	
		// we don't encode this because the user can enter in html if they want, but we will do
		// some formatting on display, and we'll make sure it's UTF-8 happy for now
		$donation_text = "random donation text " . rand(0, 10000);
		$donation_email = "email" . rand(0, 10000) . "@foo.net";
		$donation_title = "random donation title " . rand(0, 10000);
		$donationhash = md5( rand() );
		
		$donations[$donationhash]["text"] = $donation_text;	
		$donations[$donationhash]["email"] = $donation_email;	
		$donations[$donationhash]["title"] = $donation_title;	

		$store->saveDonations($donations);

		$donations = 	$store->getAllDonations();
		$this->assertTrue( isset($donations[$donationhash]), "DataStoreTest/TestSaveDonations: save didn't work");
  }
/*
	function TestRemoveFileFromDonation() {
		global $store;	
		$store->removeFileFromDonation($id, $donation_id);
	}*/
	
	function TestAddNewChannel() {
		global $store;

    $channel_id = $store->addNewChannel( "Junky Channel" );
		$channel = $store->getChannel($channel_id);
		
		$this->assertTrue( isset($channel), "DataStoreTest/TestAddNewChannel: couldn't load channel" );
		$this->assertTrue( $channel['ID'] == $channel_id && $channel["Name"] == "Junky Channel", "DataStoreTest/TestAddNewChannel: couldn't load channel" );
	}
	
	function TestStoreChannel() {
		global $store;

    $channel_id = $store->addNewChannel( "Junky Channel: TestStoreChannel" );
		$channel = $store->getChannel($channel_id);

		$this->assertTrue( isset($channel), "DataStoreTest/TestStoreChannel: couldn't load channel" );
		
		$channel['Name'] = "TestStoreChannel" . rand(0, 10000);
		$store->store_channel($channel);

		$channel2 = $store->getChannel($channel_id);

		$this->assertTrue( $channel["Name"] == $channel2["Name"], "DataStoreTest/TestStoreChannel: getChannel didn't return expected data" );	
		$this->assertTrue( $channel['ID'] == $channel2['ID'] && $channel2['ID'] == $channel_id, "DataStoreTest/TestStoreChannel: channel IDs don't match" );	
	}
	
	function TestStoreChannels() {
		global $store;

    $channel_id = $store->addNewChannel( "Junky Channel: TestStoreChannel" );
		$channels = $store->getAllChannels();
		
		$channel = $channels[$channel_id];
		$this->assertTrue( isset($channel), "DataStoreTest/TestStoreChannel: couldn't load channel" );
		
		$channel['Name'] = "TestStoreChannel" . rand(0, 10000);
		$channels[$channel_id] = $channel;
		$store->store_channels($channels);

		$channel2 = $store->getChannel($channel_id);

		$this->assertTrue( $channel["Name"] == $channel2["Name"], "DataStoreTest/TestStoreChannel: getChannel didn't return expected data" );	
	}

	function TestDeleteUser() {
	
    $this->assertTrue(setup_data_directories(false), "Couldn't setup data dirs");
    
    global $settings;
    global $store;

    $users = $store->getAllUsers();

    if ( isset($users["unittest"]) ) {
      $this->assertTrue($store->deleteUser("unittest"), "DataStoreTest/TestDeleteUser: couldn't delete pre-existing user");
	    $users = $store->getAllUsers();
      $this->assertTrue(!isset($users["unittest"]), "DataStoreTest/TestDeleteUser: deleted user, but they still exist");
    }
	
    $settings['AllowRegistration'] = true;
    $this->assertTrue( $store->addNewUser( "unittest",  "unittest", $this->email, true, false, $error ), $error);

    $this->assertTrue( $store->deleteUser("unittest"), "DataStoreTest/TestDeleteUser: couldn't delete user" );
		$users = $store->getAllUsers();
		$this->assertTrue(!isset($users["unittest"]), "DataStoreTest/TestDeleteUser: deleted user, but they still exist (2)");
	}

	function TestAddNewUser() {
		global $store;
		$username = "unittest" . rand(0, 10000);
		$password = $username;
		$email = "$username@foo.net";
		
		$this->assertTrue( $store->addNewUser($username, $password, $email, true, false, $error), "DataStoreTest/TestAddNewUser: couldn't add user: $error" );
	
	}
	
	function TestAuthUser() {
    global $store;
		global $settings;
		
		$oldsetting = $settings['RequireRegAuth'];

		$settings['RequireRegAuth'] = true;
		$_SESSION['user'] = '';

		$username = "unittest" . rand(0, 10000);
		$password = $username;
		$email = "$username@foo.net";
		
		$this->assertTrue( $store->addNewUser($username, $password, $email, true, false, $error), "DataStoreTest/TestAuthUser: couldn't add user" );
		
	  $hashlink = sha1( $username . $password . $email );
    $this->assertTrue( $store->authNewUser( $hashlink, $username), "DataStoreTest/TestAuthUser: couldn't auth user" );	
	}
	
	/*
	function TestChangePassword() {

	}*/
	
	function TestRenameUser() {
		global $store;
		global $settings;

		$settings['RequireRegAuth'] = false;

		$username = "unittest" . rand(0, 10000);
		$password = $username;
		$email = "$username@foo.net";
		
		$this->assertTrue( $store->addNewUser($username, $password, $email, true, false, $error), "DataStoreTest/TestAuthUser: couldn't add user" );
		$hashlink = sha1( $username . $password . $email );		
		$store->authNewUser( $hashlink, $username );

		$users = $store->getAllUsers();
		$this->assertTrue( isset($users[$username]), "DataStoreTest/TestAuthUser: couldn't add user (2)" );

		$username2 = "unittest" . rand(0, 10000);
		$store->renameUser($username, $username2);
			
		$users = $store->getAllUsers();
		$this->assertTrue( !isset($users[$username]) && isset($users[$username2]), "DataStoreTest/TestRenameUser: couldn't rename user" );

	}


	function TestUpdateUser() {
		global $store;

		$username = "unittest" . rand(0, 10000);
		$password = $username;
		$email = "$username@foo.net";
		
		$this->assertTrue( $store->addNewUser($username, $password, $email,true, false, $error), "DataStoreTest/TestUpdateUser: couldn't add user" );

		$newemail = "new$username@foo.net";
		$newhash = "newhash";
		
		$user = $store->getUser($username);
		
		$store->updateUser( $username, $newhash, $newemail, false, false, false);
		
		$newuser = $store->getUser($username);
		
		$this->assertTrue($newuser['Email'] == $newemail, "DataStoreTest/TestUpdateUser: email didn't update");
		$this->assertTrue($newuser['Hash'] == $newhash, "DataStoreTest/TestUpdateUser: hash didn't update");
		
	}

	function PublishTorrent() {
		global $torrents_dir;
		if ( !file_exists( $torrents_dir . "/test.torrent" ) ) {
			copy("tests/test.torrent", $torrent_dir . "/test.torrent");
		}


		$file['Title'] = "torrent test " . rand(0, 10000);
		$file['Description'] = "torrent test description";

	}
	


	function TestChannelContainsFile() {
	
	}
	
	
	
/*	
	function TestBTAnnounce() {
	
	}
	
	function TestGetStat() {
	
	}
	
	function TestGetHashFromTorrent() {
	
	}
	
	function TestGetTorrentFromHash() {
	
	}
	
	function TestGetTorrentList() {
	
	
	}
	
	function TestGetTorrent() {
	
	}
	
	function TestSaveTorrent() {
	
	}
	
		
	function TestGetTorrentDate() {
	
	}

	
	function TestTorrentExists() {
	
	}

	
	function TestGetTorrentDetails() {
	
	}
	
		
	function TestGetAuthHash() {
	
	}
		
	function TestIsValidAuthHash() {
	
	}
	
			
	function TestDropAuthHash() {
	
	}
	
			
	function TestClearAuthHashes() {
	
	}
	
			
	function TestSettingsExist() {
	
	}
	
			
	function TestAddTorrentToTracker() {
	
	}

	function TestDeleteTorrent() {
	
	}

*/

}


/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>