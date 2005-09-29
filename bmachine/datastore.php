<?php 
        
/** datastore.php
 * classes for handling storing/accessing data
 * This file is part of BlogTorrent http://www.blogtorrent.com/
 * nassar 'at' downhillbattle 'dot' org
 * Licensed under the terms of the GNU GPL 
 * 
 * Stores data in a flat file database
 * Tracker info is stored in binary format using 7 bytes per client
 * in the following format:
 * [Seeder: 1 bit][Time: 7bits][IP: 4 bytes][Port: 2 bytes]
 * 
 * User info is stored in a bencoded file
 * @package Broadcast Machine
 */

require_once( "zipfile.php" );

global $data_dir;
global $thumbs_dir;
global $torrents_dir;
global $publish_dir;
global $rss_dir;
global $text_dir;

class FlatFileStore {

  var $error;
  //	var $cache;

  /**
   * return the type of file store object
   * @returns type of object as a string
   */
  function type() {
    return 'flat file';
  }


	/**
	 * get a single item from the specified file
	 * returns the item if it exists, null otherwise
	 */
	function getOne($file, $id) {
    $data = $this->getAll($file);
		if ( isset($data[$id]) ) {
	    return $data[$id];
		}
		
		return null;	
	}

	/**
	 * get all of the data from the specified file
	 */
	function getAll($file) {
		return $this->getAllLock($file, false, $junk);
	}

	/**
	 * get all data from the specified file.  set a lock if requested, and return
	 * a handle to the file
	 */
	function getAllLock($file, $hold_lock = true, &$h ) {

		//error_log("getAllLock: $file - $hold_lock");

    global $data_dir;

		$handle = fopen("$data_dir/$file", "a+b");
		
		flock( $handle, LOCK_EX );
		fseek( $handle, 0 );
	
		$contents = "";
		while ( !feof( $handle ) ) {
			$contents .= fread( $handle, 8192 );
		}

		if ( $hold_lock == false ) {
			fclose($handle);
		}
		else {
			$h = $handle;
		}
    
		//error_log("getAllLock: $file - $hold_lock - done");
    return bdecode( $contents );
	}	
	
	/**
	 * save a single item to the specified file, using $hash as the id
	 */
	function saveOne($file, $data, $hash) {
		$all = $this->getAllLock($file, true, $h);
		if ( !$h ) {
			return false;
		}

		$all[$hash] = $data;
		return $this->saveAll($file, $all, $h);	
	}
	
	/**
	 * save the data to the specified file, using the handle if provided
	 */
	function saveAll($file, $data, $handle = null) {

		//error_log("saveAll: $file");

    global $errorstr;
    global $data_dir;
    
		if ( $handle == null ) {
			$old_error_level = error_reporting(0);
			$handle = fopen( "$data_dir/$file", "a+b");
			error_reporting($old_error_level);
		}
    
    if ( ! $handle ) {
      $errorstr = "Couldn't open $data_dir/$file!";
      return false;
    }
    
    fseek($handle,0);
    flock($handle, LOCK_EX);
    ftruncate($handle,0);
    fseek($handle,0);
    fwrite($handle,bencode($data));

		// make sure the file is flushed out to the filesystem
		fflush($handle);
    fclose($handle);
		
		// make sure we aren't holding onto a cached copy
		clearstatcache();
    
		//error_log("saveAll: $file - done");
    return true;
	}


  /**
   * return the type of file store object
   * @returns true on success, false on failure
   */
  function loadSettings() {

    global $settings;

    $contents = '';

    if ( !$this->settingsExist() ) {
      $settings = array	(
                         'AllowRegistration'         => false,
                         'RequireRegApproval'    => false,
                         'RequireRegAuth'        => true,
                         'UploadRegRequired'     => true,
                         'DownloadRegRequired'   => false,
                         'DefaultChannel'        => '',
                         'HasOpenChannels'       => false,
                         'sharing_enable'        => false,
                         'sharing_auto'          => false,
                         'sharing_python'        => '',
                         'sharing_actual_python' => ''
                         );
      
    }
    else {
      global $data_dir;
      $handle=fopen( $data_dir . '/settings', "rb" );
      flock( $handle, LOCK_EX );

      while ( !feof( $handle ) ) {
        $contents .= fread( $handle, 8192 );
      }
      
      $settings = bdecode( $contents );
      
      //Early beta's didn't have these settings
      if ( !isset( $settings['sharing_enable'] ) )
        $settings['sharing_enable']=false;
      
      if ( !isset( $settings['sharing_auto'] ) )
        $settings['sharing_auto']=true;
      
      if ( !isset( $settings['sharing_python'] ) )
        $settings['sharing_python']='';
      
      if ( !isset( $settings['sharing_actual_python'] ) )
        $settings['sharing_actual_python']='';
      
			fflush ($handle);
      fclose ( $handle );
			clearstatcache();
    }
    
    return true;
  }


  /**
   * Saves settings to config file
   * @returns true on success, false on failure
   */
  function saveSettings( $newsettings ) {

    global $settings;

// cjm - removing calls to is_admin - the datastore should solely handle loading and storing data,
// not making determinations about what sort of user is logged in - let the frontend or a security layer handle that (08/15/2005)
//    if ( !is_admin() ) {
//      return false;
//    }

    global $data_dir;

    $handle = fopen(  $data_dir . '/settings', "a+b" );
    flock( $handle, LOCK_EX );
    fseek( $handle, 0 );
    ftruncate( $handle, 0 );

    $settings  = $newsettings;
    fwrite( $handle, bencode( $settings ) );

		fflush ($handle);
		fclose ( $handle );
		clearstatcache();

    return true;
  }

  /**
   * get all of our files
   * @returns array of files
   */
  function getAllFiles() {
		return $this->getAll("files");
  }

  /**
   * given a hash, return its file
   * @returns array of channels
   */
  function getFile( $hash ) {
		return $this->getOne("files", $hash);
  }



	/**
	 * delete the specified file
	 * @returns true if successful, false on error and sets global $errstr
	 */
	function DeleteFile($id) {

		$file = $this->getFile($id);
		
		if ( !isset($file) ) {
			return true;
		}

		$url = $file["URL"];
		$owner = isset($file["Publisher"]) ? $file["Publisher"] : "";

		// if this is a local torrent, then lets make sure we turn off sharing
		if ( is_local_file($file["URL"]) ) {
	
			$filename = local_filename($url);
	
			if ($filename != "") {
				if ( is_local_torrent($file["URL"]) ) {
					global $seeder;
					
					// stop the seeder process and delete any files
					// related to the torrent
					$seeder->stop($filename, true);
					$this->deleteTorrent($filename);
				}
	
				if ( file_exists("torrents/" . $filename) ) {
					unlink_file("torrents/" . $filename);
				}
			}
		} // if is_local_file

		// remove this file from any donations	
		if ( isset($file['donation_id']) ) {
			$donation_id = $file['donation_id'];
			$this->removeFileFromDonation($id, $donation_id);
		}
	
		//
		// delete the file
		//
		$files = $this->getAllLock("files", true, $handle);

		if ( !isset($handle) || !$handle ) {
			global $errstr;
			$errstr = "Error opening the 'files' file!";
			return false;		
		}

		unset($files[$id]);
		$this->saveAll("files", $files, $handle);
	
		//
		// update our channels data
		//
		$channels = $this->getAllChannels();
		
		// keep track of which RSS feeds need to be updated
		$update_rss = array();
	
		foreach ($channels as $channel) {
			$keys = array_keys($channel['Files']);
	
			foreach ($keys as $key) {
				$file = $channel['Files'][$key];
				if ($file[0] == $id) {
					$update_rss[] = $channel['ID'];
					unset($channel['Files'][$key]);
				}
			}
	
			if (is_array($channel['Sections'])) {
				$sections = array_keys($channel['Sections']);
	
				foreach ($sections as $section) {
					if (is_array($section['Files'])) {
						$keys = array_keys($section['Files']);
						foreach ($keys as $key) {
							$file = $channel['Files'][$key];
							if ($file == $id) {
								unset($channel['Sections'][$section]['Files'][$key]);
							}
						}
					}
				}
			}
	
			$channels[$channel['ID']] = $channel;
		}
	
		// write the channel data
		$this->store_channels($channels);
	
		foreach ($update_rss as $channelID) {
			makeChannelRss($channelID);
		}

		return true;
	
	} // DeleteFile

	/**
	 * delete the specified channel
	 */
	function DeleteChannel($id) {

		$channels = $this->getAllLock("channels", true, $handle);

		if ( !isset($handle) || !$handle ) {
			global $errstr;
			$errstr = "Error opening the channels file!";
			return false;		
		}
		
		
		unset($channels[$id]);
		$this->saveAll("channels", $channels, $handle);

		return true;
	}
	
  /**
   * get an array of all of our channels
   * @returns array of channels
   */
  function getAllChannels() {
		return $this->getAll("channels");
  }

	/**
	 * return the data for the specified channel
	 */	
	function getChannel($id) {
		return $this->getOne("channels", $id);
	}

  /**
   * get an array of all of our donation links
   * @returns array of donation links
   */
  function getAllDonations() {
		return $this->getAll("donations");
  }

  /**
   * get the given donation by id
   * @returns array of donation data
   */
  function getDonation($id) {
		return $this->getOne("donations", $id);
  }

  /**
   * remove the specified file from the given donation setup
   */
	function removeFileFromDonation($id, $donation_id) {
		$donations = $this->getAllLock("donations", true, $handle);
		if ( isset($donations[$donation_id]) && isset($donations[$donation_id]['Files'][$id]) ) {
			unset($donations[$donation_id]['Files'][$id]);
		}
		$this->saveAll("donations", $donations, $handle);
	}
	
  /**
   * add the specified file to the given donation setup
   */
	function addFileToDonation($id, $donation_id) {
		$donations = $this->getAllLock("donations", true, $handle);
	
		if ( $donation_id != "" && isset($donations[$donation_id]) ) {
			$donations[$donation_id]['Files'][$id] = 1;	
			$this->saveAll("donations", $donations, $handle);

		}
		
	}

  /**
   * get an array of user data
   * @returns user data
   */
  function getAllUsers() {
//		return $this->getAll("users");
	
		$usertmp = $this->getAll("users");

		$idx = 1;
		if ( isset($usertmp) && is_array($usertmp) ) {
			foreach ($usertmp as $person) {
	
				if ( !isset($person['Name']) || $person['Name'] == "" ) {
					$person['Name'] = "unknown" . $idx;
					$idx++;
				}
				else {
					$users[$person['Name']] = $person;
				}
			}
		}	
				
		//
		// if we had some screwy user data, then let's rewrite the file so it doesn't happen again
		//
		if ( $idx > 1 ) {
			$this->saveAll("users", $users);
		}

		if ( !isset($users) ) {
			return array();
		}

		return $users;
		
  }

  /**
   * get a user
   * @returns array of userdata
   */
  function getUser($username) {
		return $this->getOne("users", $username);
  }

  /**
   * Saves our donations data
   * @returns true on success, false on failure
   */
  function saveDonations( $donations ) {
		$this->saveAll("donations", $donations);
    return true;
  }

  /**
   * add a new channel to our data files
   * @returns id of the new channel on success, false on failure
   */
  function addNewChannel( $channelname, $description = "",	$icon = "", $publisher = "", 
                          $weburl = "", $libraryurl = "", $files = "", $cssurl = "", $openChannel = "" ) {

		$lastID = 0;
		$newchannels = $this->getAllLock("channels", true, $handle);

		if ( ! isset($handle) ) {
			global $errstr;
			$errstr = "Couldn't load channels data";
			return false;		
		}

    foreach ( $newchannels as $channel ) {
      if ( $channel['ID'] > $lastID ) {
        $lastID = $channel['ID'];
      }
    }

    $lastID++;

    if ( $lastID == "" ) {
      $lastID = 1;
    }

    if ( $libraryurl == "" ) {
      $libraryurl = get_base_url() . "library.php?i=" . $lastID;
    }

    if ( $icon == "http://" ) {
      $icon = "";
    }

    if ( $cssurl == '' ) {
      $cssurl = "default.css";
    }

    $newchannels[$lastID]['ID']=$lastID;
    $newchannels[$lastID]['Name']=$channelname;
    $newchannels[$lastID]['Description']=$description;
    $newchannels[$lastID]['Icon']=$icon;
    $newchannels[$lastID]['Publisher']=$publisher;
    $newchannels[$lastID]['WebURL']=$weburl;
    $newchannels[$lastID]['LibraryURL']=$libraryurl;

    $newchannels[$lastID]['Files']=array();
    $newchannels[$lastID]['Options']=array();

    $newchannels[$lastID]['Options']['Thumbnail']=true;
    $newchannels[$lastID]['Options']['Title']    =true;
    $newchannels[$lastID]['Options']['Creator']  =false;
    $newchannels[$lastID]['Options']['Desc']     =false;
    $newchannels[$lastID]['Options']['Length']   =false;
    $newchannels[$lastID]['Options']['Published']=false;
    $newchannels[$lastID]['Options']['Torrent']  =false;
    $newchannels[$lastID]['Options']['URL']      =false;
    $newchannels[$lastID]['Options']['Filesize'] =false;
    $newchannels[$lastID]['Options']['Keywords'] =true;
    $newchannels[$lastID]['CSSURL']              =$cssurl;

    $newchannels[$lastID]['Sections']=array();
    $newchannels[$lastID]['Sections']['Featured']=array();
    $newchannels[$lastID]['Sections']['Featured']['Name']='Featured';
    $newchannels[$lastID]['Sections']['Featured']['Files']=array();
    $newchannels[$lastID]['OpenPublish']=$openChannel;
    $newchannels[$lastID]['Created']    =time();
		
		$this->saveAll("channels", $newchannels, $handle);

    return $lastID;
  }

	/**
	 * store a single channel
	 */
	function store_channel($channel) {
		$this->saveOne("channels", $channel, $channel["ID"]);
	}

  /**
   * store our channel data
   * @returns true
   */
  function store_channels($channels) {
    $this->saveAll("channels", $channels);
    return true;
  }
 
  /**
   * given an array of files, write it to the filesystem
   */
  function store_files($newcontent) {
		$this->saveAll("files", $newcontent);
  }

	/**
	 * store the data for a single file
	 */
  function store_file($newcontent, $id = "") {

		if ( $id == "" ) {
			$id = $newcontent["ID"];
		}

		$this->saveOne("files", $newcontent, $id);
  }

  /**
   * delete a user
   * @returns true on success, false on failure
   */
  function deleteUser( $username ) {
		global $data_dir;
		$users = $this->getAllLock("users", true, $handle2);

		if ( count($users) <= 0 ) {
			return true;
		}

    unset ( $users[$username] );
		$this->saveAll("users", $users, $handle2);

    return true;
  }



  /**
   * add a new user
   * @returns true on success, false on failure
   */
  function addNewUser( $username, $password, $email, $isAdmin = false, $isFront = false, &$error) {
    global $settings;
    global $data_dir;

    $contents = '';
    $username = trim(strtolower( $username ));

		if ( $username == "" ) {
      $error = "Please specify a username";
      return false;		
		}
		
    $users = $this->getAllUsers();

    if ( isset( $users[$username] ) ) {
      $error = "That username already exists";
      return false;
    }

    foreach ( $users as $user ) {
      if ( isset($user['Email']) && $email == $user['Email'] ) {
        $error = "A user with that email address is already registered";
        return false;
      }
    }

		// if there aren't any users, this person becomes admin by default,
		// and we don't require authorization
		if ( count($users) == 0 ) {
			$settings['RequireRegAuth'] = false;
			$isAdmin = true;
		}

		$newusers = $this->getAllLock("newusers", true, $handle);

		if ( !isset($handle) ) {
			global $errstr;
			if ( isset($errstr) ) {
				$error = $errstr;
			}
			return false;
		}

    $hashlink = $this->userHash( $username, $password, $email );
    $filehash = sha1( $username . $hashlink );
    $newusers[$filehash]['Hash']   =hashpass( $username, $password );
    $newusers[$filehash]['Email']  =$email;
    $newusers[$filehash]['IsAdmin'] = $isAdmin;
    $newusers[$filehash]['Created']=time();

		$result = $this->saveAll("newusers", $newusers, $handle);
		
		
		// some sort of error, so stop processing
		if ( $result == false ) {
			global $errstr;
			if ( isset($errstr) ) {
				$error = $errstr;
			}
			return false;
		}

    $qs_app = "";

    if ( $isFront ) {
      $qs_app="&f=1";
    }



    if ( $settings['RequireRegAuth'] && count($users) > 0 && !is_admin() ) {

			// cjm - obviously we shouldn't be doing this, but while i'm running the unit tests
			// 100x a day i'm turning off email generation
			global $RUNNING_UNIT_TESTS;
			if ( ! ( isset($RUNNING_UNIT_TESTS) && $RUNNING_UNIT_TESTS == true ) ) {

				mail( $email,
				"New Account on " . site_title(),
				"Click below to activate your account:\n" . get_base_url() . "login.php?hash="
				. $hashlink . "&username=" . urlencode( $username ) . $qs_app );
			}
    }

		return true;
  }

	/**
	 * generate a user hash and return it
	 * @returns string
	 */
	function userHash( $username, $password, $email ) {
		$username = trim(strtolower( $username ));
		return sha1($username . $password . $email);
	}

  /**
   * authorize a user for access to the website
   * @returns true on success, false on failure
   */
  function authNewUser( $hashlink, $username ) {
	
    global $settings;
    global $data_dir;	
	
    $contents = '';
    $success = false;
	
    $username = trim(strtolower( $username ));
    $filehash = sha1( $username . $hashlink );
		
		$newusers = $this->getAllLock("newusers", true, $handle);

		if ( !isset($handle) || $handle == "" ) {
			global $errstr;
			$errstr = "Error: Couldn't open newusers file";
			return false;
		}

    if ( isset( $newusers[$filehash] ) ) {
      $users = $this->getAllLock("users", true, $handle2);
			
			if ( !isset($handle2) || $handle2 == "" ) {
				global $errstr;
				$errstr = "Error: Couldn't open users file";
				fclose($handle);
				return false;
			}
	
      if ( isset( $users[$username] ) ) {
				global $errstr;
				$errstr = "Error: User $username missing";
        return false;
      }

			if ( isset($users) && is_array($users) ) {
				foreach ( $users as $user ) {
					if ( $newusers[$filehash]['Email'] == $user['Email'] ) {
						return false;
					}
				}
			}
	
      $isAdmin = false;
	
      if ( count($users) == 0 || $newusers[$filehash]['IsAdmin'] ) {
        $isAdmin = true;
      }
	
      $pending = false;
	
      if ( !$isAdmin && $settings['RequireRegApproval'] && !is_admin() ) {
        $pending = true;
      }

      $users[$username]['Hash']     =$newusers[$filehash]['Hash'];
      $users[$username]['Name']     =$username;
      $users[$username]['Email']    =$newusers[$filehash]['Email'];
      $users[$username]['IsAdmin']  =$isAdmin;
      $users[$username]['IsPending']=$pending;
      $users[$username]['Created']  =$newusers[$filehash]['Created'];
      $users[$username]['Username'] = $username;
		
			$this->saveAll("users", $users, $handle2);

      unset ( $newusers[$filehash] );
      $success = true;
    }
		else {
			global $errstr;
			$errstr = "Error: Invalid Hash";
			return false;
		}

		$this->saveAll("newusers", $newusers, $handle);
		
    return $success;
  }

  /**
   * rename a user
   *
   * NOTE - make sure this doesn't screw up any of our other data
   * @returns true on success, false on failure
   */
  function renameUser( $oldname, $newname ) {

    $users = $this->getAllLock("users", true, $handle);

		if ( isset($users[$oldname]) ) {
				
			$users[$newname] = $users[$oldname];

			$users[$newname]['Name'] = $newname;
			$users[$newname]['Username'] = $newname;

			$this->saveAll("users", $users, $handle);
	
			$this->deleteUser($oldname);
			
			return true;
		}
		
		return false;
  }



  /**
   * update user data
   *
   * NOTE - make sure this doesn't screw up any of our other data
   * @returns true on success, false on failure
   */
  function updateUser( $username, $hash, $email, $canAdmin = false, $isPending = true ) {

    $contents = '';
    global $data_dir;
	
    $users = $this->getAllLock("users", true, $handle);

    $users[$username]['Hash']     =$hash;
    $users[$username]['Email']    =$email;
    $users[$username]['IsAdmin']  =$canAdmin;
    $users[$username]['IsPending']=$isPending;

		$this->saveAll("users", $users, $handle);
  }


  /**
   * perform a BitTorrent announce
	 *
	 * this gets called periodically from a BT client to update the server on its status
   * @returns data to be passed back to the client or NULL on error
   */
	function BTAnnounce( $info_hash, $event, $remote_addr, $port, $left, $numwant ) {

		$this->error = '';

		// make sure this is a valid hash
		if ( strlen( $info_hash ) != 40 ) {
			$this->error = 'Invalid info hash';
			return null;
		}

		// make sure the torrent actually exists
		global $data_dir;

		// see if this torrent should be server-shared, and if so, make sure it is running
		$torrentfile = $this->getTorrentFromHash($info_hash);

		if ( !file_exists( $data_dir . '/' . $info_hash ) ) {
			$this->error = 'This torrent is not authorized on this tracker.';
			return null;
		}

		
		global $seeder;
		
		$stats = $this->getStat($info_hash);

		if ( $seeder->enabled() && 
				isset($stats["process id"]) &&
				! file_exists("$data_dir/" . $torrenthash . ".paused") ) {

			// check to see if the pid exists
			// if not, clear it out and restart
			if ( ! is_process_running($stats["process id"]) ) {
				$seeder->spawn($torrentfile);
			}
		}


		// figure out the IP/port of the client
		$peer_ip  = explode( '.', $remote_addr );
		$peer_ip  = pack( "C*", $peer_ip[0], $peer_ip[1], $peer_ip[2], $peer_ip[3] );
		$peer_port = pack( "n*", (int)$port );

		// Generate a number 0-127 based on the minute - this is a bit
		// hackish to say the least, and maybe we should fix in the future
		$time = intval( ( time() % 7680 ) / 60 );
		$int_time = $time;

		// If this is a seeder, set the high bit
		if ( $left == 0 ) {
			$time += 128;
		}

		$time = pack( "C", $time );

		$handle=fopen( $data_dir . '/' . $info_hash, "rb+" );
		flock( $handle, LOCK_EX );
		$peer_num = intval( filesize( 'data/' . $info_hash ) / 7 );

		if ( $peer_num > 0 ) {
			$data = fread( $handle, $peer_num * 7 );
		}
		else {
			$data='';
		}

		$peer = array();
		$updated = false;

		//Update the peer
		for ( $i=0; $i < $peer_num; $i++ ) {

			if ( ( $peer_ip . $peer_port ) == substr( $data, $i * 7 + 1, 6 ) ) {

				$updated = true;


				if ( $event != 'stopped' ) {
					$peer[] = $time . $peer_ip . $peer_port;
				}
			} 
			else {

				$peer_seed = join( '', unpack( "C", substr( $data, $i * 7, 1 ) ) );
		
				if ( $peer_seed >= 128 ) {
					$peer_time = $peer_seed - 128;
				}
				else {
					$peer_time = $peer_seed;
				}

				$diff = $int_time - $peer_time;
        if ($diff < 0) // Check for loop around
          $diff += 128;

				// we've heard from the peer in the last 10 minutes, so don't
				// delete them
				if ( $diff < 10 ) {
					$peer[] = substr( $data, $i * 7, 7 );
				}
			}
		}

		// If we don't already have this peer in that database, add it
		if ( $updated == false ) {
			$peer[] = $time . $peer_ip . $peer_port;
		}

		// the number of peers left standing is simply the number of elements in the peer array
		$peer_num = count($peer);

		rewind ( $handle );
		ftruncate( $handle, 0 );
		fwrite( $handle, join( '', $peer ), $peer_num * 7 );
		flock( $handle, LOCK_UN );
		fflush ($handle);
		fclose ( $handle );
		clearstatcache();

		$o='';

		// Fill $o with a list of peers
		if ( $event == 'stopped' || $numwant === 0 ) {
			$o='';
		}
		else {
			if ( $peer_num > 50 ) {
				$key = array_rand( $peer, 50 );

				foreach ( $key as $val ) {
					$o .= substr( $peer[$val], 1, 6 );
				}
			}
			else {
				for ( $i=0; $i < $peer_num; $i++ ) {
					$o .= substr( $peer[$i], 1, 6 );
				}
			}
		}

    if ($peer_num <= 3)
      $interval = '30';
    else
      $interval = '300';

		return 'd8:intervali'.$interval.'e5:peers' . strlen( $o ) . ':' . $o . 'e';
	}


	/**
	 * get the stats for the given torrent
	 * @return array of stats
	 */
  function getStat( $info_hash ) {

		$complete = 0;
		$incomplete = 0;
		
		global $data_dir;

		$time = intval( ( time() % 7680 ) / 60 );
		$int_time = $time;


		if ( file_exists($data_dir . '/' . $info_hash) ) {

			$handle = fopen(  $data_dir . '/' . $info_hash, "rb" );
			flock( $handle, LOCK_EX );
	
			$size = filesize(  $data_dir . '/' . $info_hash );
			
			if ( $size > 0 ) {
				$x=fread( $handle, $size );
				flock( $handle, LOCK_UN );
				fclose ( $handle );
				$no_peers = intval( strlen( $x ) / 7 );

				for ( $j=0; $j < $no_peers; $j++ ) {
					$t_peer_seed = join( '', unpack( "C", substr( $x, $j * 7, 1 ) ) );
			
					if ( $t_peer_seed >= 128 ) {
            $peer_time = $t_peer_seed - 128;
					}
					else {
            $peer_time = $t_peer_seed;
					}

          $diff = $int_time - $peer_time;
          if ($diff < 0) // Check for loop around
            $diff += 128;

          // we've heard from the peer in the last 10 minutes, so count it
          if ( $diff < 10 ) {
						if ($t_peer_seed == $peer_time)
              $incomplete++;
            else
              $complete++;
          }

				} // for
			} // if ( size > 0 )
		}	
			
		return array (
			"hash"           => $info_hash,
			"complete"   => $complete,
			"incomplete" => $incomplete
		);
	}
		
	/**
	 * figure out what the hash is for the given filename
	 */
	function getHashFromTorrent( $filename ) {
		$tmp = $this->getTorrent( $filename );
		return $tmp["sha1"];
	}

	/** 
	 * given a torrent's hash, figure out what torrent it is
	 */
	function getTorrentFromHash($hash) {

		$torrents = $this->getTorrentList();
		
		foreach($torrents as $t) {
				$tmp = $this->getTorrent( $t );
				if ( isset($tmp["info"]["name"]) && $hash == $tmp["sha1"] ) {
					return $tmp["info"]["name"];
				}
		}
		
		return null;
	}

	/**
	 * get a list of torrents that are currently in the system
	 */
	function getTorrentList() {
		$list = array();
		$times = array();
		global $torrents_dir;
		
		$handle = opendir( $torrents_dir );
		while ( false !== ( $torrentfile=readdir( $handle )) ) {
			if ( $torrentfile != '.' && 
					$torrentfile != '..' && 
					$torrentfile != '.htaccess' && 
					endsWith($torrentfile, ".torrent") ) {
				$list[] = $torrentfile;
				$times[] = $this->getTorrentDate( $torrentfile );
			} // if
		} // while
		
		if ( count( $list ) > 0 ) {
			array_multisort( $times, SORT_DESC, $list );
		}
		
		return $list;
  }

	/**
	 * get the torrent data for the specified file
	 */
  function getTorrent( $filename ) {
    return bdecode( $this->getRawTorrent( $filename ) );
  }
	
	/**
	 * save a torrent to the filesystem
	 */
	function saveTorrent( $filename, $data ) {
		global $torrents_dir;
    
		$handle = fopen( "$torrents_dir/$filename", "a+b");
     
    fseek($handle,0);
    flock($handle, LOCK_EX);
    ftruncate($handle,0);
    fseek($handle,0);
    fwrite($handle,bencode($data));
    fclose($handle);		
	}


	/**
	 * get the raw torrent file
	 */
  function getRawTorrent( $filename ) {
    global $torrents_dir;

		if ( file_exists( $torrents_dir . "/" . $filename ) ) {
	    return file_get_contents( $torrents_dir . "/" . $filename );
		}
		
		return "";
  }

	/** 
	 * figure out the creation date of the torrent
	 */
  function getTorrentDate( $filename ) {
    global $torrents_dir;
    return filectime( $torrents_dir . '/' . $filename );
  }

	/**
	 * does the specified torrent exist?
	 */
  function torrentExists( $info_hash ) {
    global $data_dir;
    return file_exists(  $data_dir . '/' . $info_hash );
  }

  /**
   * load a list of peers from the filesystem, for the given hash.  if prune is true,
   * peers that we haven't heard from in 30 minutes get removed from the list
   *
   * @returns list of peers for a torrent
   */
  function getTorrentDetails( $info_hash, $prune = true ) {

    $peers = array();
    global $data_dir;
    
    $handle=fopen(  $data_dir . '/' . $info_hash, "rb+" );
    flock( $handle, LOCK_EX );
    
    if ( filesize(  $data_dir . '/' . $info_hash ) > 0 ) {
      $x = fread( $handle, filesize(  $data_dir . '/' . $info_hash ) );
    }
    else {
      $x='';
    }

    flock( $handle, LOCK_UN );
    fclose ( $handle );
    $no_peers = intval( strlen( $x ) / 7 );
    
    for ( $j=0; $j < $no_peers; $j++ ) {
      $ip         = unpack( "C*", substr( $x, $j * 7 + 1, 4 ) );
      
      // cjm - get whole ip instead of just 3/4
      $ip         =$ip[1] . '.' . $ip[2] . '.' . $ip[3] . '.' . $ip[4];
      //			$ip         =$ip[1] . '.' . $ip[2] . '.' . $ip[3] . '.*';
      $port       =join( '', unpack( "n*", substr( $x, $j * 7 + 5, 2 ) ) );
      $t_peer_seed=join( '', unpack( "C", substr( $x, $j * 7, 1 ) ) );
      
      if ( $t_peer_seed >= 128 ) {
        $what      ='seeder';
        $t_time = $t_peer_seed - 128;
      }
      else {
        $what      ='leecher';
        $t_time = $t_peer_seed;
      }
      
      // figure out the current time
      $time = intval( ( time() % 7680 ) / 60 );
	
      // we've heard from this peer in 30 minutes or less, so add them to the list
      if ( $prune == false || $time - $t_time <= 30 ) {
			
        $peers[] = array(
                         "ip"       => $ip,
                         "what" => $what,
                         "port" => $port,
                         "time" => number_format( $time - $t_time )
                         );
      }

    }

    return $peers;
  }

	/**
	 * determine if the given hash is a valid one for posting torrent
	 * @returns true/false
	 */
  function isValidAuthHash( $username, $hash ) {

    global $data_dir;

		if ( file_exists( $data_dir . '/hash' ) ) {
			$hashes = bdecode( file_get_contents(  $data_dir . '/hash' ) );
			return ( isset( $hashes[sha1( $username . $hash )] ) && 
							( $hashes[sha1( $username . $hash )] > ( time() - 3600 ) ) 
							);
		}
		
		return false;
  }

	/**
	 * generate a hash for the given user/password-hash.  will be sent along with a torrent being posted
	 *
	 * note - we also cleanup old hashes in this function
	 */
  function getAuthHash( $username, $passhash ) {

    global $data_dir;

    $contents = '';

    $handle = fopen(  $data_dir . '/hash', "ab+" );
    fseek( $handle, 0 );
    flock( $handle, LOCK_EX );

    while ( !feof( $handle ) ) {
      $contents .= fread( $handle, 8192 );
    }

    $hashes = bdecode( $contents );

    if ( ! is_array( $hashes ) )
      $hashes = array();

    $hash = md5( $username . microtime() . rand() . $passhash );
    $hashes[sha1( $username . $hash )]=time();

	  $this->clearOldAuthHashes($hashes);

    ftruncate( $handle, 0 );
    fseek( $handle, 0 );
    fwrite( $handle, bencode( $hashes ) );

    fclose ( $handle );
    return $hash;
  }

	/**
	 * drop a auth hash which has been used to post a torrent, and write some info about the torrent
	 * into a file using the hash as the filename.
	 *
	 * note - we also cleanup old hashes in this function
	 */
  function dropAuthHash( $username, $hash, $torrent ) {
    $contents  = '';

    global $data_dir;

		// create a file containing the hash and write the torrent name to it so
		// we can link them up later
    $handle = fopen(  $data_dir . '/' . $hash, "wb+" );
    fwrite( $handle, $torrent );
    fclose ( $handle );

		// remove the hash from our list of auth hashes
    $handle = fopen(  $data_dir . '/hash', "a+b" );
    fseek( $handle, 0 );
    flock( $handle, LOCK_EX );

    while ( !feof( $handle ) ) {
      $contents .= fread( $handle, 8192 );
    }

    $hashes = bdecode( $contents );
    unset ( $hashes[sha1( $username . $hash )] );

		// clear out any stale hashes while we're at it
    $this->clearOldAuthHashes( $hashes );

    ftruncate( $handle, 0 );
    fseek( $handle, 0 );
    fwrite( $handle, bencode( $hashes ) );
    fclose ( $handle );
  }


	/**
	 * iterate through an array of auth hashes and clear out any that are more than
	 * an hour old
	 */ 
  function clearOldAuthHashes( &$hashes ) {

    $now = time();

    foreach ( $hashes as $hash => $stamp ) {
      if ( $stamp < $now - 3600 ) //Hash was created more than 1 hour ago
        unset ( $hashes[$hash] );
    }
  }


  /**
   * check whether our settings exist or not
   * @returns true/false
   */
  function settingsExist() {
    global $data_dir;
    return file_exists(  $data_dir . '/settings' ) && filesize($data_dir . '/settings') > 0 ;
  }


  /**
   * Sends the location of this feed to BlogTorrent.com periodically
   * @deprecated not in use?
   */
  function phoneHome() {
    global $settings;
    global $data_dir;

    //Phone home if settings have been saved, the box is checked, and we
    //haven't phoned home in a week
    if ( $this->settingsExist() && $settings['Ping'] ) {
      if ( file_exists(  $data_dir . '/phonelock' ) ) {
        $stat    =stat(  $data_dir . '/phonelock' );
        $doit=$stat[9] < ( time() - 604800 ); //9 is mtime
      }
      else {
        $doit = true;
      }
			
      if ( $doit ) {
        $handle = fopen(  $data_dir . '/phonelock', 'wb' );
        fclose ( $handle );
        file_get_contents ( 'http://www.blogtorrent.com/register.php?server='
                            . htmlspecialchars( get_base_url() )
                            . 'rss.php&version=' . get_version());
      }
			
      return $doit;
    }
  }


  /**
   * add a torrent to the tracker
   */
  function addTorrentToTracker( $tmpfile, $torrent ) {
    global $seeder;
    global $settings;
    global $perm_level;

    global $data_dir;
    global $torrents_dir;

    if ( !file_exists( $torrents_dir . '/' . $torrent ) ) {

      move_uploaded_file( $tmpfile, $torrents_dir . '/' . $torrent );
      chmod($torrents_dir . '/' . $torrent, 0777);

      $info_hash=$this->getHashFromTorrent( $torrent );

      if ( !file_exists(  $data_dir . '/' . $info_hash ) ) {
        $handle = fopen(  $data_dir . '/' . $info_hash, "wb" );
        fclose ( $handle );
      }
    }

    if ( $seeder->enabled() && $settings["sharing_auto"] ) {
      $seeder->spawn( $torrent );
    }
  }



	/**
	 * determine if the given file is actually published to the given channel.  this prevents
	 * hackers from doing simple tricks like changing the channel ID to get to a file which shouldn't
	 * be publicly available
	 */
	function channelContainsFile($filehash, &$channel) {
		$channel_files = $channel["Files"];
	 	foreach($channel_files as $cf) {
			if ( $cf[0] == $filehash ) {
				return true;
			}
		}
		
		return false;
	}

	/**
	 * delete the given torrent from the filesystem
	 */	
  function deleteTorrent( $torrent ) {
    global $seeder;

    if ( $seeder->enabled() ) {
      $seeder->stop( $torrent );
		}

    global $data_dir;
    global $torrents_dir;

    $file = $this->getHashFromTorrent( $torrent );
		if ( file_exists("$torrents_dir/$torrent") ) {
	    unlink_file ( "$torrents_dir/$torrent" );
		}
		
		if ( file_exists("$data_dir/$file") ) {
	    unlink_file ( "$data_dir/$file" );
		}
  }


  /**
	 * Converts a zipfile into a serialized PHP object
   * Normally, we ship Broadcast Machine Helper with a serialized object containing
   * the Mac client, but if it's not there, we can make it on the fly
   * using this function
   */
  function createZipObject( $zipfile ) {
    $zipobj     =new zipfile();
    $origzip = @zip_open( $zipfile );

    if ( $origzip ) {
      while ( $entry=zip_read( $origzip ) ) {
        $name = zip_entry_name( $entry );
        $size =zip_entry_filesize( $entry );
        
        if ( $size == 0 )
          $zipobj->add_dir( $name );
        else {
          zip_entry_open( $origzip, $entry );
          $data=zip_entry_read( $entry, $size );
          zip_entry_close ( $entry );
          $zipobj->add_file( $data, $name, 9 );
        }
      }
      
      return serialize( $zipobj );
    }
    else {
      return null;
    }
  }

  /**
   * display a message to help the user do whatever is required to setup BM
   */
  function setupHelpMessage() {
    $output = <<<EOD
      <div class="wrap">
      <h2 class="page_name">One Final Step...</h2>
      <div class="section">

      <p>You need to create the data directories for Broadcast Machine.</p>
      <p><em>Once you've completed these steps, reload this page to continue.</em></p>

<div class="section_header">If you use graphical FTP</div>

<p>Create folders in your Broadcast Machine directory named "torrents", "data", "publish", "thumbnails" and "text".  
Then select each folder, view its permissions, and make sure all the checkboxes (readable, writable, 
executable) are checked.</p>

<div class="section_header">If you use command line FTP</div>

<p>Log in and type the following:</p>
<pre>
EOD;
#'

	$output.="cd " . preg_replace( '|^(.*[\\/]).*$|', '\\1', $_SERVER['SCRIPT_FILENAME'] );
	$output	.=<<<EOD

mkdir data
mkdir torrents
mkdir publish
mkdir text
mkdir thumbnails
chmod 777 data
chmod 777 torrents
chmod 777 publish
chmod 777 text
chmod 777 thumbnails
</pre>

<p><em>Once you've completed these steps, reload this page to continue.</em></p>
<div class="section_header">If you want Broadcast Machine to do it for you:</div>
<p>Specify your FTP username and password here, and Broadcast Machine will FTP into your server, 
create the directories and set the permissions for you. You need to know the 'root' address for 
your Broadcast Machine FTP address, which could be something like "public_html/bm/" or "httdocs/bm"
</p>
<p>This might take a few minutes, please be patient.</p>

<form method="POST" action="set_perms.php">
     username: <input type="text" name="username" size="10" /><br />
     password: <input type="password" name="password" size="10" /><br />
     ftp root: <input type="text" name="ftproot" size="50" /><br />
     <input type="submit" value="Set Perms" />
</form>

<br />
<p>Note: giving the directories "777" permissions will allow anyone on the server to full access those directories. If you share a server with others, they may be able to tamper with you Broadcast Machine data files if you use these settings. There may be other settings more appropriate for your server. <b>Please, contact your system administrator if you have any questions about permissions.</b></p>

</div>
</div>
EOD;
#'
    print $output;
  }

  function setupHelperMessage() {

		$dest = preg_replace( '|^(.*[\\/]).*$|', '\\1', $_SERVER['SCRIPT_FILENAME'] );

    $output = <<<EOD
      <div class="wrap">
      <h2 class="page_name">One Final Step...</h2>
      <div class="section">

      <p>You are missing the Broadcast Machine upload helper.</p>
      <p><em>Once you've completed these steps, reload this page to continue.</em></p>

<div class="section_header">Uploading the Helper Files</div>

<p>Please upload the files 'nsisinstaller.exe' and 'macclient.obj' to the $dest directory of your webserver</p>
EOD;
#'
    print $output;

  }


  /**
   * setup BM - create directories, set permissions, write a couple of .htaccess files
   * @returns true if successful, false if not
   */
  function setup() {

    global $perm_level;
    global $data_dir;
    global $torrents_dir;

    $old_error_level = error_reporting ( 0 );

    if ( !file_exists($data_dir) ) {
      if ( !mkdir( $data_dir, $perm_level ) ) {
        return false;
      }
    }

    if ( !file_exists($torrents_dir) ) {
      if ( !mkdir( $torrents_dir, $perm_level ) ) {
        return false;
      }
    }

    if ( !is_writable( $data_dir ) || !is_writable( $torrents_dir ) ) {
      return false;
    }

    if ( !file_exists(  $data_dir . '/.htaccess' ) ) {
      $file=fopen(  $data_dir . '/.htaccess', 'wb' );
      fwrite( $file, "deny from all\n" );
      fclose ( $file );
    }

    if ( !file_exists( $torrents_dir . '/.htaccess' ) ) {
      $file=fopen( $torrents_dir . '/.htaccess', 'wb' );
      fwrite( $file, "deny from all\n" );
      fclose ( $file );
    }

    if ( !file_exists( $data_dir . '/channels') || count($this->getAllChannels()) <= 0  ) {
      $this->addNewChannel( "First Channel" );
    }

    error_reporting ( $old_error_level );

    return $this->loadSettings();
  }


	/**
	 * try and setup our Mac/PC helper files, and return true/false according to our success
	 */
	function setupHelpers() {
    global $data_dir;

    if ( ( !file_exists( 'macclient.obj' )) && ( !file_exists(  $data_dir . '/macclient.obj' )) ) {
      $data = $this->createZipObject(
				   preg_replace( '|^(.*[\\/]).*$|', '\\1',
						 $_SERVER['SCRIPT_FILENAME'] ) . 'BlogTorrentMac.zip' );

      if ( is_null( $data ) ) {
 				return false;
			}
				
      $file = fopen(  $data_dir . '/macclient.obj', 'wb' );
      fwrite( $file, $data );
      fclose ( $file );
    }

    if ( ( !file_exists( 'nsisinstaller.exe' )) && ( !file_exists(  $data_dir . '/nsisinstaller.exe' )) ) {
			return false;		
		}

		return true;
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