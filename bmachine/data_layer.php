<?php
class BEncodedDataLayer {

  var $_handles;
  var $_hooks;
  
  function BEncodedDataLayer() {
    $this->_handles = array();
    $this->_hooks = array();
  }
  
  function type() {
    return "flat file";
  }
  
  function init() {
    return true;
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

    error_reporting ( $old_error_level );

    return $this->loadSettings();
  }

  /**
   * lock the requested resource
   */
  function lockResource($file) {

    if ( isset($this->_handles[$file]) ) {
      return $this->_handles[$file];
    }

    $old_error_level = error_reporting ( 0 );
    
    global $data_dir;
    $handle = fopen("$data_dir/$file", "a+b");		
    
    error_reporting ( $old_error_level );

    if ( isset($handle) && $handle != false ) {
      flock( $handle, LOCK_EX );
      $this->_handles[$file] = $handle;
      //error_log("lock $file - $handle");
      return $handle;
    }
    
    return false;
  }
  
  function unlockResource($file) {
    if ( isset($this->_handles[$file]) ) {
      //error_log("unlock $file - " . $this->_handles[$file] );
      fflush($this->_handles[$file]);
      fclose($this->_handles[$file]);
      unset($this->_handles[$file]);
      clearstatcache();
    }
  }
  
  /**
   * get a single item from the specified file
   * returns the item if it exists, null otherwise
   */
  function getOne($file, $id, $handle = null) {
	//error_log("getOne $file $id $handle");
    if ( $handle == null ) {
      $data = $this->getAll($file);
    }
    else {
      $data = $this->getAllLock($file, $handle, true);
    }

    if ( isset($data[$id]) ) {
	//error_log("found it");
      return $data[$id];
    }
    
    return null;	
  }

  function getAll($file) {
    $handle = null;
    return $this->getAllLock($file, $handle, false);
  }
	
  /**
   * get all data from the specified file.
   */
  function getAllLock($file, &$handle, $get_lock = true ) {
    
    global $data_dir;
    
    if ( $handle == null ) {
      $handle = $this->lockResource($file);
    }

    if ( $handle == false ) {
      global $errorstr;
      $errorstr = "Couldn't open $file";
      return false;
    }
    
    if ( $get_lock == true ) {
      $hold_lock = true;
      //error_log("hold lock on $file");
    }
    else {
      //error_log("Don't hold lock on $file");
      $hold_lock = false;
    }
    
    fseek( $handle, 0 );
    
    $contents = "";
    while ( !feof( $handle ) ) {
      $contents .= fread( $handle, 8192 );
    }
    
    if ( $hold_lock == false ) {
      //error_log("unlocking handle for $file");
      $this->unlockResource($file);
    }
    
		if ( $contents == "" ) {
			$contents = array();
		}
		else {
	    $contents = bdecode( $contents );
		}
    
    $hooks = $this->getHooks($file, "get");
    if ( $hooks != null ) {		
      foreach($contents as $key => $row) {
	/*foreach ( $hooks as $h ) {
	  $h( $row[$key] );
	}*/
	$hooks($row[$key]);
      }
    }
    
    //error_log("loaded $file: " . count($contents) . " items");
    return $contents;
  }	
  
  /**
   * save a single item to the specified file, using $hash as the id
   */
  function saveOne($file, $data, $hash, $handle = null) {
    
    if ( $handle == null ) {
      $handle = $this->lockResource($file);
      $hold_lock = false;
    }
    else {
      $hold_lock = true;
    }
    
    if ( !$handle ) {
      return false;
    }
        
    $all = $this->getAllLock($file, $handle);
    $all[$hash] = $data;
    
    $result = $this->saveAll($file, $all, $handle);	
    
    if ( $hold_lock == false ) {
      $this->unlockResource($file);
    }
    
    $hooks = $this->getHooks($file, "save");
    
    if ( $hooks != null ) {
      foreach ( $hooks as $h ) {
	$h( $all[$hash] );
      }
    }
    
    return $result;
  }
  
	/**
	 * save the data to the specified file, using the handle if provided
	 */
	function saveAll($file, $data, $handle = null) {

    global $errorstr;

		//error_log("saveAll: $file $handle - " . count($data) . " items");
		if ( $handle == null ) {
			$handle = $this->lockResource($file);
			$hold_lock = false;
		}
		else {
			$hold_lock = true;
		}

    if ( ! $handle ) {
      $errorstr = "Couldn't open $data_dir/$file!";
			//error_log($errorstr);
      return false;
    }
    
    fseek($handle,0);
    ftruncate($handle,0);
    fseek($handle,0);
    fwrite($handle,bencode($data));

		// make sure the file is flushed out to the filesystem
		fflush($handle);

		if ( $hold_lock == false ) {
			$this->unlockResource($file);
		}
		
		// make sure we aren't holding onto a cached copy
		clearstatcache();

		$hooks = $this->getHooks($file, "save");

		if ( $hooks != null ) {
			foreach($data as $key => $row) {
				foreach ( $hooks as $h ) {
					$h($out[ $row[$key] ]);
				}
			}
		}

    return true;
	}
	
	function deleteOne($file, $hash, $handle = null) {
//error_log("deleteOne $file $hash");	
		if ( $handle == null ) {
			$handle = $this->lockResource($file);
			$hold_lock = false;
		}
		else {
			$hold_lock = true;
		}

		if ( !$handle ) {
			return false;
		}
//error_log("get pre-delete hooks");
		$hooks = $this->getHooks($file, "pre-delete");

		if ( $hooks != null ) {
			$hooks($hash, $handle);
		}

//error_log("done calling pre-delete hooks");

		$all = $this->getAllLock($file, $handle, true);
		unset($all[$hash]);
//error_log("done with unset");
		$result = $this->saveAll($file, $all, $handle);	
//error_log("done with save");	
		$hooks = $this->getHooks($file, "post-delete");

		if ( $hooks != null ) {
//			foreach ( $hooks as $h ) {
			$hooks($hash);
	//		}
		}

		if ( $hold_lock == false ) {
			$this->unlockResource($file);
		}
		
		return true;
	}
	
	function getHooks($file, $when = "get") {
		if ( isset($this->_hooks[$file]) && isset($this->_hooks[$file][$when]) ) {
			return $this->_hooks[$file][$when];
		}
		return null;
	}
	
	function registerHook($file, $when, $fn) {
		$this->_hooks[$file][$when] = $fn;
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
   * load settings file
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

} // class BEncodedDataLayer
?>