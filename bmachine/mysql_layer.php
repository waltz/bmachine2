<?php
require_once("include.php");
require_once("version.php");

global $data_dir;

class MySQLDataLayer extends BEncodedDataLayer {

  /** a prefix which will be added to table names to prevent potential conflicts with other apps */
  var $prefix = '';
  var $good_setup = false;

  /**
   * setup our datastore object
   */
  function setup() {

    global $settings;

    //We still need the flat file db set up to load the settings
    if ( !parent::setup() ) {
      return false;
    }

    if ( isset( $settings['mysql_prefix'] ) && strlen( $settings['mysql_prefix']) ) {
      $this->prefix = $settings['mysql_prefix'];
    }

    if ( isset( $settings['mysql_database'] ) && strlen( $settings['mysql_database'] ) && 
	 isset( $settings['mysql_host'] ) && strlen( $settings['mysql_host'] ) &&
	 isset( $settings['mysql_username'] ) && strlen( $settings['mysql_username'] ) && 
	 isset( $settings['mysql_password'] )
	 && @mysql_pconnect(
			    $settings['mysql_host'],
			    $settings['mysql_username'],
			    $settings['mysql_password'] ) ) {


      //We can connect to the server. try to connect to the database
      if ( !@mysql_selectdb( $settings['mysql_database'] ) ) {

	//If we can't connect to the database, try to create it
	@mysql_query ( "CREATE DATABASE IF NOT EXISTS " . $settings['mysql_database'] );

	// we weren't able to create the database, so back to the flat-file store
	if ( !@mysql_selectdb( $settings['mysql_database'] ) ) {
	  return false;
	}
      }

      $this->good_setup = true;
      return true;
    }

    return false;
  }
	
  function init() {

    global $data_dir;
    if ( !file_exists($data_dir . "/version.xml") || get_datastore_version() != get_version() ) {

      //error_log("init - create tables");
      $m = new MySQLLoader();
    
      if ( ! $this->tableExists("peers") ) {
//				//error_log("create peers");
				mysql_query( $this->getTableDef("peers") );
      }
      
      if ( ! $this->tableExists("torrents") ) {
//				//error_log("create torrents");
				mysql_query( $this->getTableDef("torrents") );
				$m->addFlatFileTorrents();
      }
      
      if ( ! $this->tableExists("newusers") ) {
//				//error_log("create newusers/users");
				mysql_query( $this->getTableDef("newusers") );
				mysql_query( $this->getTableDef("users") );
				$m->addFlatFileUsers();
      }
      
      if ( ! $this->tableExists("channels") ) {
//				//error_log("create channels");
				mysql_query( $this->getTableDef("channels") );
				mysql_query( $this->getTableDef("channel_options") );
				mysql_query( $this->getTableDef("channel_files") );
				mysql_query( $this->getTableDef("channel_sections") );
				mysql_query( $this->getTableDef("section_files") );				
				$m->addFlatFileChannels();
      }
      
      if ( ! $this->tableExists("files") ) {
	//			//error_log("create files");
				mysql_query( $this->getTableDef("files") );
				mysql_query( $this->getTableDef("file_people") );
				mysql_query( $this->getTableDef("file_keywords") );
				$m->addFlatFileFiles();
      }
      
      if ( ! $this->tableExists("donations") ) {
//				//error_log("create donations");
				mysql_query( $this->getTableDef("donations") );
				mysql_query( $this->getTableDef("donation_files") );
				$m->addFlatFileDonations();
      }

      set_datastore_version( get_version() );
    }

    return true;
  }
  
  /**
   * return the type of datastore we are using
   */
  function type() {
    return 'MySQL';
  }
  
  /**
   * lock the requested resource
   */
  function lockResource($file) {
    if ( isset($this->_handles[$file]) ) {
      return $this->_handles[$file];
    }
    
    $result = @mysql_query( "LOCK TABLES " . $this->prefix . $file . " WRITE");
    
    $handle = 1;
    $this->_handles[$file] = $handle;
    return $handle;
  }
  
  function unlockResource($file) {
    if ( isset($this->_handles[$file]) ) {
      $result = @mysql_query("UNLOCK TABLES");
      unset($this->_handles[$file]);
    }
  }
  
  
  function getAll($file) {
    $handle = 0;
    return $this->getAllLock($file, $handle, false);
  }
  
  function getByKey($file, $id, $key = null) {
    $qarr = $this->getTableQueries($file);
    $query = $qarr["select"];
    //		$data = $this->prepareForMySQL($query);
    $sql = str_replace("%key", $id, $query);
    

    //    if ( $file == "users" ) {
    //      print "$sql<br>";
    //    }

    $result = mysql_query( $sql );
    $hooks = $this->getHooks($file, "get");
    $out = array();

    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
      // handle any hooks that have been defined for this content-type
      if ( $hooks != null ) {
	if ( $key == null ) {
	  $out[] = $hooks($row);
	}
	else {
	  $out[ $row[$key] ] = $hooks($row);
	}
      }
      else {
	if ( $key == null ) {
	  $out[] = $row;
	}
	else {
	  $out[ $row[$key] ] = $row;
	}
	//		print_r($out);
      }
    }

    return $out;	
  }
  
  function getAllLock($file, &$handle, $get_lock = true ) {
    
    //		if ( $get_lock == true ) {
    //			print "$file - start<br>";
    //		}
    $key = $this->getTableKey($file);
    
    if ( $key == null || $this->good_setup == false ) {
      return parent::getAll($file, $handle);
    }
    
    $queries = $this->getTableQueries($file);
    //print "*** " . $queries["all"] . "<br>";
    $result = mysql_query( $queries["all"] );
    
    $hooks = $this->getHooks($file, "get");
    
    $out = array();

    print (mysql_error());

    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
      // handle any hooks that have been defined for this content-type
      if ( $hooks != null ) {
	if ( $key == null ) {
	  $out[] = $hooks($row);
	}
	else {
	  $out[ $row[$key] ] = $hooks($row);
	}
      }
      else {
	if ( $key == null ) {
	  $out[] = $row;
	}
	else {
	  $out[ $row[$key] ] = $row;
	}
      }
    }
    
    if ( $get_lock == true ) {
      $handle = 1;
    }
    
    //		if ( $get_lock == true ) {
    //			print "$file - done<br>";
    //		}
    return $out;
  }
  
  function getOne($file, $id, $handle = null) {
    $data = $this->getByKey($file, $id /*, $handle */);

    if ( isset($data[0]) ) {
      return $data[0];
    }


    return $data;
  }

  /**
   * save a single item to the specified file, using $hash as the id
   */
  function saveOne($file, $data, $hash, $handle = null) {
    
    $key = $this->getTableKey($file);
    
    if ( $key == null || $this->good_setup == false ) {
      return parent::saveOne($file, $data, $hash);
    }
    
    if ( $handle == null ) {
      $handle = $this->lockResource($file);
      $hold_lock = false;
    }
    else {
      $hold_lock = true;
    }
    
    $queries = $this->getTableQueries($file);
    $query =  $queries["insert"];
    
    if ( !isset($data[$key]) ) {
      $data[$key] = $hash;
    }

    $hooks = $this->getHooks($file, "pre-save");
    
    if ( $hooks != null ) {
      $hooks($data);
    }
    
    $tmp = $this->prepareForMySQL($data);
    $sql = str_replace("%vals", $tmp, $query);
    
    $result = mysql_query( $sql );
    if ( $result == false ) {
      return false;
    }
    
    if ( $hold_lock == false ) {
      $this->unlockResource($file);
    }
    
    $hooks = $this->getHooks($file, "save");
    
    if ( $hooks != null ) {
      $hooks($data);
    }
    
    return true;
  }
  
  /**
   * save the data to the specified file, using the handle if provided
   */
  function saveAll($file, $data, $handle = null) {
    $key = $this->getTableKey($file);
    
    if ( $key == null || $this->good_setup == false ) {
      return parent::saveAll($file, $data, $handle);
    }
    
    foreach($data as $hash => $val) {
      if ( $this->saveOne($file, $val, $hash, $handle) == false ) {
	return false;
      }
    }
    
    return true;
  }
  
  function deleteOne($file, $hash, $handle = null) {
    $key = $this->getTableKey($file);
    
    if ( $key == null || $this->good_setup == false ) {
      return parent::deleteOne($file, $hash, $handle);
    }
    
    if ( $handle == null ) {
      $hold_lock = false;
    }
    else {
      $hold_lock = true;
    }
    
    
    $hooks = $this->getHooks($file, "pre-delete");
    
    if ( $hooks != null ) {
      $hooks($hash);
    }
    
    $qarr = $this->getTableQueries($file);
    $sql = $qarr["delete"];
    $sql = str_replace("%key", $hash, $sql);
    $result = mysql_query( $sql );
    $hooks = $this->getHooks($file, "post-delete");
    
    if ( $hooks != null ) {
      $hooks($hash);
    }
    
    if ( $hold_lock == false ) {
      $this->unlockResource($file);
    }
    
    return true;
  }
  

  /**
   * determine if the specified table exists
   * @return true/false
   */
  function tableExists($name) {
    
    $result = @mysql_query( "DESC " . $this->prefix . $name );
    if ( $result && mysql_num_rows($result) > 0 ) {
      return true;
    }
    
    return false;
  }

  /**
   * take an array and turn it into a string of name/value pairs,
   * escaped so that it can be used in a SQL query
   * @return string
   */
  function prepareForMySQL($arr) {
    $tmp = array();
    foreach( $arr as $key => $val ) {
      if ( ! is_array($val) ) {
	$tmp[] = $key . " = '" . mysql_escape_string($val) . "'";
      }
    }
    
    $out = join( $tmp, "," );
    return $out;
  }
  
  /**
   * return the table creation script for the given data type
   */
  function getTableDef($name) {
    switch($name) {
    case "torrents":
      $sql = "CREATE TABLE " . $this->prefix . "torrents (
					info_hash char(40) NOT NULL,
					filename varchar(255) NOT NULL,
					raw_data MEDIUMBLOB NOT NULL,
					UNIQUE INDEX (filename),
					PRIMARY KEY(info_hash));";
      break;
    case "peers":
      $sql = "CREATE TABLE " . $this->prefix . "peers (
					info_hash char(40) NOT NULL,
					ip tinyblob NOT NULL,
					port tinyblob NOT NULL,
					seeder bool NOT NULL,
					time datetime NOT NULL,
					INDEX (time),
					PRIMARY KEY (info_hash,ip(4),port(2)));";
      break;
    case "channels":
      $sql = "CREATE TABLE " . $this->prefix . "channels (
					CSSURL varchar(250) NOT NULL,
					Created INT NOT NULL,
					Description TEXT NULL,
					ID INT NOT NULL,
					Icon varchar(250) NOT NULL,
					LibraryURL varchar(250) NOT NULL,
					Name varchar(250) NOT NULL,
					OpenPublish TINYINT NOT NULL DEFAULT 0,
					RequireLogin TINYINT NOT NULL DEFAULT 0,
					NotPublic TINYINT NOT NULL DEFAULT 0,
					Publisher varchar(250) NOT NULL,
					WebURL varchar(250) NOT NULL,
					PRIMARY KEY (ID)
					);";
      break;
    case "channel_options":
      $sql = "CREATE TABLE " . $this->prefix . "channel_options (
					ID INT NOT NULL,
					Creator TINYINT NOT NULL DEFAULT 0,
					Description TINYINT NOT NULL DEFAULT 0,
					Filesize TINYINT NOT NULL DEFAULT 0,
					Keywords TINYINT NOT NULL DEFAULT 0,
					Length TINYINT NOT NULL DEFAULT 0,
					Published TINYINT NOT NULL DEFAULT 0,
					Thumbnail TINYINT NOT NULL DEFAULT 0,
					Title TINYINT NOT NULL DEFAULT 0,
					Torrent TINYINT NOT NULL DEFAULT 0,
					URL TINYINT NOT NULL DEFAULT 0,
					PRIMARY KEY (ID) )";
      break;
    case "channel_files":
      $sql = "CREATE TABLE " . $this->prefix . "channel_files (
					channel_id INT NOT NULL,
					hash char(40) not null,
					thetime int not null,
					PRIMARY KEY (channel_id, hash) )";
      break;
    case "channel_sections":
      $sql = "CREATE TABLE " . $this->prefix . "channel_sections (
					channel_id INT NOT NULL,
					Name varchar(250),
					PRIMARY KEY (channel_id, name) )";
      break;
    case "section_files":
      $sql = "CREATE TABLE " . $this->prefix . "section_files (
					channel_id INT NOT NULL,
					Name varchar(250) not null,
					hash char(40) NOT NULL,
					PRIMARY KEY (channel_id, name, hash) )";
      break;
    case "files";
    $sql = "CREATE TABLE " . $this->prefix . "files (
					ID char(40) not null,
					Created INT NOT NULL,
					FileName varchar(250) not null,
					Creator varchar(250) not null,
					Description text not null,
					Excerpt int not null default 0,
					Explicit int not null default 0,
					External int not null default 0,
					Image varchar(250) null,
					LicenseName varchar(50) null,
					LicenseURL varchar(250) null,
					Mimetype varchar(50) not null,
					Publishdate int not null,
					Publisher varchar(250) null,
					ReleaseDay int not null,
					ReleaseMonth int not null,
					ReleaseYear int not null,
					Rights varchar(250) null,
					RuntimeHours int null,
					RuntimeMinutes int null,
					RuntimeSeconds int null,
					SharingEnabled tinyint not null default 0,
					Title varchar(250) null,
					Transcript varchar(250) null,
					URL varchar(250) not null,
					Webpage varchar(250) null,
					donation_id int null,
					ignore_mime tinyint not null default 0,
					PRIMARY KEY(ID));";
    break;
    case "file_people":
      $sql = "CREATE TABLE " . $this->prefix . "file_people (
					ID char(40) NOT NULL,
					name varchar(50),
					role varchar(50),
					PRIMARY KEY (ID, name, role) )";
      break;
    case "file_keywords":
      $sql = "CREATE TABLE " . $this->prefix . "file_keywords (
					ID char(40) NOT NULL,
					word varchar(50),
					PRIMARY KEY (ID, word) )";
      break;
    case "users":
      $sql = "CREATE TABLE " . $this->prefix . "users (
					Username varchar(250) NOT NULL,
					Name varchar(250) NOT NULL,
					Hash char(40) NOT NULL,
					Email varchar(250) NOT NULL,
					IsAdmin TINYINT NOT NULL DEFAULT 0,
					IsPending TINYINT NOT NULL DEFAULT 0,
					Created INT NOT NULL,
					PRIMARY KEY (Name));";
      break;
    case "newusers":
      $sql = "CREATE TABLE " . $this->prefix . "newusers (
					filehash char(40) NOT NULL,
					Hash char(40) NOT NULL,
					Email varchar(250) NOT NULL,
					IsAdmin TINYINT NOT NULL DEFAULT 0,
					Created INT NOT NULL,
					PRIMARY KEY (filehash));";
      break;
    case "donations":
      $sql = "CREATE TABLE " . $this->prefix . "donations (
					id char(40) NOT NULL,
					email varchar(250) NOT NULL,
					title varchar(250) NOT NULL,
					text TEXT NOT NULL,
					PRIMARY KEY (id));";
      break;
    case "donation_files":
      $sql = "CREATE TABLE " . $this->prefix . "donation_files (
					id char(40) NOT NULL,
					hash char(40) NOT NULL,
					PRIMARY KEY (id, hash));";
      break;
    }

    if ( isset($sql) ) {	
      return $sql;
    }
    else {
      return false;
    }
  }

  /**
   * return a list of queries for the given table.  TODO - store this in a file
   * of some sort.
   */	
  function getTableQueries($name) {
    switch ($name) {
    case "torrents":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "torrents",
		   "select" => "SELECT * FROM " . $this->prefix . "torrents WHERE info_hash='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "torrents WHERE info_hash='%key'",
		   "insert" => "INSERT INTO " . $this->prefix . "torrents SET %vals",
		   "update" => "UPDATE " . $this->prefix . "torrents SET %vals WHERE info_hash='%key'"
		   );
      break;
    case "newusers":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "newusers",
		   "select" => "SELECT * FROM " . $this->prefix . "newusers WHERE filehash='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "newusers WHERE filehash='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "newusers SET %vals",
		   "update" => "UPDATE " . $this->prefix . "newusers SET %vals WHERE filehash='%key'"
		   );
      break;
    case "users":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "users",
		   "select" => "SELECT * FROM " . $this->prefix . "users WHERE Username='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "users WHERE Username='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "users SET %vals",
		   "update" => "UPDATE " . $this->prefix . "users SET %vals WHERE Username='%key'"
		   );
      break;
    case "channels":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "channels",
		   "select" => "SELECT * FROM " . $this->prefix . "channels WHERE ID='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "channels WHERE ID='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "channels SET %vals",
		   "update" => "UPDATE " . $this->prefix . "channels SET %vals WHERE ID='%key'"
		   );
      break;
    case "channel_files":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "channel_files",
		   "select" => "SELECT * FROM " . $this->prefix . "channel_files WHERE channel_id='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "channel_files WHERE channel_id='%key'",
		   "delete_by_file" => "DELETE FROM " . $this->prefix . "channel_files WHERE hash='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "channel_files SET %vals",
		   "update" => "UPDATE " . $this->prefix . "channel_files SET %vals WHERE channel_id='%key'"
		   );
      break;
    case "channel_options":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "channel_options",
		   "select" => "SELECT * FROM " . $this->prefix . "channel_options WHERE ID='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "channel_options WHERE ID='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "channel_options SET %vals",
		   "update" => "UPDATE " . $this->prefix . "channel_options SET %vals WHERE ID='%key'"
		   );
      break;
    case "channel_sections":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "channel_sections",
		   "select" => "SELECT * FROM " . $this->prefix . "channel_sections WHERE channel_id='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "channel_sections WHERE channel_id='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "channel_sections SET %vals",
		   "update" => "UPDATE " . $this->prefix . "channel_sections SET %vals WHERE channel_id='%key'"
		   );
      break;
    case "section_files":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "section_files",
		   "select" => "SELECT * FROM " . $this->prefix . "section_files WHERE channel_id='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "section_files WHERE channel_id='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "section_files SET %vals",
		   "update" => "UPDATE " . $this->prefix . "section_files SET %vals WHERE channel_id='%key'"
		   );
      break;
    case "files":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "files",
		   "select" => "SELECT * FROM " . $this->prefix . "files WHERE ID='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "files WHERE ID='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "files SET %vals",
		   "update" => "UPDATE " . $this->prefix . "files SET %vals WHERE ID='%key'"
		   );
      break;
    case "file_keywords":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "file_keywords",
		   "select" => "SELECT * FROM " . $this->prefix . "file_keywords WHERE ID='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "file_keywords WHERE ID='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "file_keywords SET %vals",
		   "update" => "UPDATE " . $this->prefix . "file_keywords SET %vals WHERE ID='%key'"
		   );
      break;
    case "file_people":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "file_people",
		   "select" => "SELECT * FROM " . $this->prefix . "file_people WHERE ID='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "file_people WHERE ID='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "file_people SET %vals",
		   "update" => "UPDATE " . $this->prefix . "file_people SET %vals WHERE ID='%key'"
		   );
      break;
    case "donations":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "donations",
		   "select" => "SELECT * FROM " . $this->prefix . "donations WHERE id='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "donations WHERE id='%key'",
		   "insert" => "REPLACE INTO " . $this->prefix . "donations SET %vals",
		   "update" => "UPDATE " . $this->prefix . "donations SET %vals WHERE id='%key'"
		   );
      break;
    case "donation_files":
      return array(
		   "all" => "SELECT * FROM " . $this->prefix . "donation_files",
		   "select" => "SELECT * FROM " . $this->prefix . "donation_files WHERE id='%key'",
		   "delete" => "DELETE FROM " . $this->prefix . "donation_files WHERE id='%key'",
		   "delete_file" => "DELETE FROM " . $this->prefix . "donation_files WHERE id='%key' AND hash='%hash'",
		   "insert" => "REPLACE INTO " . $this->prefix . "donation_files SET %vals",
		   "update" => "UPDATE " . $this->prefix . "donation_files SET %vals WHERE id='%key'"
		   );
      break;
    default:
      return array();
    }
    
  }


  /**
   * return the key for the specified table
   */
  function getTableKey($name) {
    switch ($name) {
    case "torrents":
      return "info_hash";
      break;
    case "newusers":
      return "filehash";
      break;
    case "users":
      return "Username";
      break;
    case "channels":
      return "ID";
      break;
    case "files":
      return "ID";
      break;
    case "donations":
      return "id";
      break;
    default:
      return null;
    }
  }
	
  /*
   function _DeleteFile($id) {
   $qarr = $this->getTableQueries("channel_files");
   $sql = $qarr["delete_by_file"];
   $sql = str_replace("%key", $id, $sql);
   $result = mysql_query( $sql );
    
   $qarr = $this->getTableQueries("file_keywords");
   $sql = $qarr["delete"];
   $sql = str_replace("%key", $id, $sql);
   $result = mysql_query( $sql );
    
   $qarr = $this->getTableQueries("file_people");
   $sql = $qarr["delete"];
   $sql = str_replace("%key", $id, $sql);
   $result = mysql_query( $sql );
    
   $qarr = $this->getTableQueries("files");
   $sql = $qarr["delete"];
   $sql = str_replace("%key", $id, $sql);
   $result = mysql_query( $sql );
   }  

   function DeleteChannel($id) {
   $channel = $this->getChannel($id);
    
   // figure out the sections and delete the section_files
   $sql = "DELETE FROM " . $this->prefix . "section_files WHERE channel_id = '$id'";
   mysql_query( $sql );
    
   $qarr = $this->getTableQueries("channels");
   $query = $qarr["delete"];
    
   $sql = str_replace("%key", $id, $query);
   mysql_query( $sql );
    
   $qarr = $this->getTableQueries("channel_files");
   $query = $qarr["delete"];

   $sql = str_replace("%key", $id, $query);
   mysql_query( $sql );

   $qarr = $this->getTableQueries("channel_options");
   $query = $qarr["delete"];

   $sql = str_replace("%key", $id, $query);
   mysql_query( $sql );

   $qarr = $this->getTableQueries("channel_sections");
   $query = $qarr["delete"];

   $sql = str_replace("%key", $id, $query);
   mysql_query( $sql );
		
   return true;

   }
	
   function getChannel($id) {
   $tmp = $this->getAllChannels();
   return $tmp[$id];
   }
  */
	
  /**
   * remove a file from the channel
   */
  /*  function removeFileFromChannel($channel, $key) {
    $sql = "REPLACE INTO " . $this->prefix . "donation_files SET id = '$donation_id', hash = '$id'";
    mysql_query( $sql );			
  }

  function removeFileFromChannelSection($channel, $section, $key) {
    $sql = "DELETE FROM " . $this->prefix . "section_files WHERE channel_id='" . $channel['ID'] . "' 
							AND Name = '" . mysql_escape_string($section) . "' 
							AND hash = '" . $key . "'";
    $result = mysql_query( $sql );
    }*/
  
  
  /**
   * get an array of all of our donation links
   * @returns array of donation links
   */
  /*  function getAllDonations() {
    $tmp = $this->getAll("donations");
    
    $qarr = $this->getTableQueries("donation_files");
    $donation_sql = $qarr["select"];
    
    foreach($tmp as $d) {
      $sql = str_replace("%key", $d["id"], $donation_sql);
      $result = mysql_query( $sql );
      $tmp[ $d["id"] ]["Files"] = array();
      
      while ( $row = mysql_fetch_array( $result ) ) {
	$tmp[ $d["id"] ]["Files"][$row["hash"]] = 1;
      }	
      
    }
    return $tmp;
  }
  */
  
  /**
   * get the given donation by id
   * @returns array of donation data
   */
  /*  function getDonation($id) {
    $tmp = $this->getOne("donations", $id);

    $qarr = $this->getTableQueries("donation_files");
    $donation_sql = $qarr["select"];

    $sql = str_replace("%key", $c["ID"], $donation_sql);
    $result = mysql_query( $sql );
    
    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
      foreach($row as $val) {
	$tmp["Files"][$val["hash"]] = 1;
      }
    }	
    
    return $tmp;
  }

  function saveDonations( $donations ) {
    foreach($donations as $id => $d ) {
      $this->saveOne("donations", $d, $id);
      foreach($d["Files"] as $f) {
	$sql = "REPLACE INTO " . $this->prefix . "donation_files SET id = '$id', hash = '$f'";
	mysql_query( $sql );			
      }
    }
  }

  function addFileToDonation($id, $donation_id) {
    $sql = "REPLACE INTO " . $this->prefix . "donation_files SET id = '$donation_id', hash = '$id'";
    mysql_query( $sql );			
  }

  function removeFileFromDonation($id, $donation_id) {
    $sql = "DELETE FROM " . $this->prefix . "donation_files WHERE hash = '$id' and id = '$donation_id'";
    mysql_query( $sql );
    return true;
  }

	
  function deleteDonation($id) {
  $qarr = $this->getTableQueries("donation_files");
  $donation_sql = $qarr["delete"];
  $sql = str_replace("%key", $id, $donation_sql);
  $result = mysql_query( $sql );
  //print $sql . "<br>";
  
  $qarr = $this->getTableQueries("donations");
  $donation_sql = $qarr["delete"];
  $sql = str_replace("%key", $id, $donation_sql);
  $result = mysql_query( $sql );		
  
  //		print $sql . "<br>";
  //exit;
  }
  */

  /**
   * store a single channel
   */
  /*
  function saveChannel($channel) {
    
    // store channel data
    $this->saveOne("channels", $channel, $channel["ID"]);
    
    // store channel files
    foreach( $channel["Files"] as $f ) {
      $sql = "REPLACE INTO " . $this->prefix . "channel_files 
				SET channel_id = " . $channel["ID"] . ", 
				hash = '" . mysql_escape_string($f["0"]) . "', 
				thetime = '" . mysql_escape_string($f["1"]) . "'";
      mysql_query( $sql );
    }
    
    // store options
    $this->saveOne("channel_options", $channel["Options"], $channel["ID"]);
    
    $qarr = $this->getTableQueries("channel_sections");
    $query = $qarr["insert"];
    
    $qarr = $this->getTableQueries("section_files");
    $sf_sql = $qarr["insert"];
    
    // store sections
    foreach( $channel["Sections"] as $s ) {
      $data = "channel_id = '" . $channel["ID"] . "', 
				Name = '" . mysql_escape_string($s["Name"]) . "'";
      $sql = str_replace("%vals", $data, $query);
      mysql_query( $sql );
      
      // store section files
      foreach($s["Files"] as $f) {
	$data = "channel_id = '" . $channel["ID"] . "', 
					Name = '" . mysql_escape_string($s["Name"]) . "', 
					hash = '" . mysql_escape_string($f) . "'";
	
	$sql = str_replace("%vals", $data, $sf_sql);
	mysql_query( $sql );
      }
    }	
    
    return true;
  }
  */

  /**
   * store our channel data
   * @returns true
   */
  /*  function saveChannels($channels) {
		foreach($channels as $c) {
			$this->saveChannel($c);
		}
    return true;
    }*/
	
  /**
   * delete a user
   * @returns true on success, false on failure
   */
  /*  function deleteUser( $username ) {
		$qarr = $this->getTableQueries("users");
		$query = $qarr["delete"];
		$sql = str_replace("%key", $username, $query);
		if ( mysql_query( $sql ) == false ) {
			return false;
		}
		
		return true;
	}
  */

  /**
   * handle a bittorrent announce - mysql version
   */ 
  /*function BTAnnounce( $info_hash, $event, $remote_addr, $port, $left, $numwant ) {
    $this->error = '';
    
    if ( strlen( $info_hash ) != 40 ) {
      $this->error = 'Invalid info hash';
      return null;
    }
    
    $peer_ip  =explode( '.', $remote_addr );
    $peer_ip  =pack( "C*", $peer_ip[0], $peer_ip[1], $peer_ip[2], $peer_ip[3] );
    $peer_port=pack( "n*", (int)$port );
    $seeder   =( $left == 0 ) ? '1' : '0';

    if ( !$this->torrentExists( $info_hash ) ) {
      $this->error = 'This torrent is not authorized on this tracker.';
      return null;
    }

    if ( $event == 'stopped' ) {
      mysql_query ( "DELETE FROM " . $this->prefix . "peers WHERE info_hash='" . mysql_escape_string(
										$info_hash ) . "' AND ip='"
		    . mysql_escape_string( $peer_ip ) . "' AND port='" . mysql_escape_string( $peer_port )
		    . "'" );
		}
    else {
      mysql_query ( "REPLACE INTO " . $this->prefix . "peers (info_hash,ip,port,seeder,time) VALUES ('"
		    . mysql_escape_string( $info_hash )
		    . "', '" . mysql_escape_string( $peer_ip )
		    . "','" . mysql_escape_string( $peer_port ) . "','" . mysql_escape_string( $seeder )
		    . "',NOW())" );
		}

    $peer_num = 0;


    mysql_query( "DELETE FROM " . $this->prefix . "peers WHERE time < DATE_SUB(NOW(), INTERVAL 600 SECOND)");

    $o = '';

    //Fill $o with a list of peers
    if ( $event == 'stopped' || $numwant === 0 ) {
      $o='';
    }
    else {
      $result=mysql_query( "SELECT CONCAT(ip,port) as out FROM " . $this->prefix . "peers WHERE info_hash='"
			   . mysql_escape_string( $info_hash )
			   . "' ORDER BY RAND() LIMIT 50" );

      while ( $row=mysql_fetch_array( $result ) ) {
				$peer_num++;
				$o .= $row[0];
      }
    }


    if ($peer_num <= 3) {
      $interval = '30';
		}
    else {
      $interval = '300';
		}

    return 'd8:intervali'.$interval.'e5:peers' . strlen( $o ) . ':' . $o . 'e';
    }*/

	/**
	 * get the stats for the specified torrent from the db
	 */
  function getStat( $info_hash ) {

    // delete expired peers
    mysql_query( "DELETE FROM " . $this->prefix . "peers WHERE time < DATE_SUB(NOW(), INTERVAL 600 SECOND)");
    
    $query = mysql_query("SELECT COUNT(*) FROM " . $this->prefix . "peers WHERE info_hash='" . 
			 mysql_escape_string($info_hash) . "'" );
    
    $row = mysql_fetch_array($query);
    $total = $row[0];
    
    $query = mysql_query("SELECT COUNT(*) FROM " . $this->prefix . "peers WHERE info_hash='" . 
			 mysql_escape_string( $info_hash ) . "' AND seeder = 1" );
    
    $row = mysql_fetch_array($query);
    
    $complete = $row[0];
    $incomplete = $total - $complete;
    
    return array (
		  "hash"		 => $info_hash,
		  "complete"   => $complete,
		  "incomplete" => $incomplete
		  );
  }
  
  /**
   * get a list of torrents from the db
   */
  function getTorrentList() {

    $list = array();
    $result = mysql_query( "SELECT filename from " . $this->prefix . "torrents" );

    while ( $row = mysql_fetch_array( $result ) ) {
      $list[]=$row[0];
    }

    return $list;
  }

	/**
	 * get the data for this torrent from the db
	 */
  function getRawTorrent( $torrent ) {
    $result = mysql_query( "SELECT raw_data FROM " . $this->prefix . "torrents WHERE filename='" . mysql_escape_string(
												$torrent ) . "'" );

    if ( mysql_num_rows( $result ) > 0 ) {
      $row=mysql_fetch_row( $result );
      return $row[0];
    }

    return null;
  }

	/**
	 * determine if this torrent exists in the db or not
	 */
  function torrentExists( $info_hash ) {
    $result =mysql_query( "SELECT COUNT(*) FROM " . $this->prefix . "torrents WHERE info_hash='" . mysql_escape_string(
												  $info_hash ) . "'" );
    $row=mysql_fetch_row( $result );
    return $row[0] > 0;
  }

	/**
	 * get the details for this torrent from the db
	 */
  function getTorrentDetails( $info_hash ) {
    $peers=array();

    $now   =time();
    $result=mysql_query(
			"SELECT ip, port, UNIX_TIMESTAMP(time) AS time,	 if (seeder,'seeder','leecher') AS what FROM " . $this->prefix . "peers WHERE info_hash = '" . mysql_escape_string( $info_hash )
			. "'" );

    while ( $row=mysql_fetch_array( $result ) ) {
      $ip  = unpack( "C*", $row['ip'] );
      $ip  =$ip[1] . '.' . $ip[2] . '.' . $ip[3] . '.*';
      $port=join( '', unpack( "n*", $row['port'] ) );

      $peers[]=array
			(
			 "ip"	    => $ip,
			 "what" => $row['what'],
			 "port" => $port,
			 "time" => number_format( (int)( ( $now - $row['time'] ) / 60 ) )
			 );

    } // while

    return $peers;
  }


	/**
	 * add the specified torrent file to the db
	 */
  function addTorrentToTracker( $tmpfile, $torrent ) {
    $rawTorrent = file_get_contents( $tmpfile );

    //Store the torrent on the filesystem, so if MySQL goes down, we
    //can keep on tracking
    parent::addTorrentToTracker( $tmpfile, $torrent );
    $data = bdecode( $rawTorrent );

		$sql = "INSERT INTO " . $this->prefix . "torrents (info_hash, filename, raw_data) 
									VALUES (
										'" . mysql_escape_string( $data['sha1'] ) . "',
										'" . mysql_escape_string( $torrent ) . "',
										'" . mysql_escape_string( $rawTorrent ) . "')";
		
    mysql_query ( $sql );
  }

  /**
   * generate a message to help with mysql setup
   */
  function setupHelpMessage() {
    //FIXME: make this nicer
    return 'MySQL is not setup properly';
  }
}


class MySQLLoader {

  var $flat;

  function MySQLLoader() {
    $this->flat = new DataStore(true);
  }

  /**
   * add any flatfile torrents to the db
   */
  function addFlatFileTorrents() {
    global $store;
    $oldTorrents = $this->flat->getTorrentList();
    
    foreach ( $oldTorrents as $torrent ) {
      
      $raw = $store->getRawTorrent( $torrent );
      $tmp = bdecode($raw);
      $hash = $tmp["sha1"];
      
      $sql = "REPLACE INTO " . $store->layer->prefix . "torrents (info_hash, filename,raw_data) VALUES ('"
	. mysql_escape_string( $hash )
	. "','" . mysql_escape_string( $torrent ) . "','" . mysql_escape_string( $raw )
	. "')";
      
      mysql_query( $sql );
    }
  }
		
  function addFlatFileUsers() {
    global $store;
    
    $newusers = $this->flat->layer->getAll("newusers");
    $qarr = $store->layer->getTableQueries("newusers");
    $query = $qarr["insert"];
    
    foreach ( $newusers as $u ) {
      $data = $store->layer->prepareForMySQL($u);
      $sql = str_replace("%vals", $data, $query);
      mysql_query( $sql );
    }	
    
    $users = $this->flat->layer->getAll("users");
    $qarr = $store->layer->getTableQueries("users");
    $query = $qarr["insert"];
    //		print_r($users);
    
    foreach ( $users as $u ) {
      $data = $store->layer->prepareForMySQL($u);
      $sql = str_replace("%vals", $data, $query);
      mysql_query( $sql );
    }	
    
    mysql_query("UPDATE " . $store->layer->prefix . "users SET Username = Name WHERE Username IS NULL OR Username = ''");
    mysql_query("UPDATE " . $store->layer->prefix . "users SET Name = Username WHERE Name IS NULL OR Name = ''");
  }
  
  
  function addFlatFileChannels() {
    global $store;
    
    $channels = $this->flat->layer->getAll("channels");
    $qarr = $store->layer->getTableQueries("channels");
    $query = $qarr["insert"];
    
    $qarr = $store->layer->getTableQueries("channel_options");
    $option_sql = $qarr["insert"];
    
    foreach ( $channels as $c ) {
      
      $data = $store->layer->prepareForMySQL($c);
      
      $sql = str_replace("%vals", $data, $query);
      mysql_query( $sql );
      
      // options
      // desc is a reserved word in SQL, so lets not be using that
      if ( isset($c["Options"]["Desc"]) ) {
	$c["Options"]["Description"] = $c["Options"]["Desc"];
	unset($c["Options"]["Desc"]);
      }
      
      $c["Options"]["ID"] = $c["ID"];
      $data = $store->layer->prepareForMySQL($c["Options"]);
      
      $sql = str_replace("%vals", $data, $option_sql);
      mysql_query( $sql );
      
      // files
      foreach( $c["Files"] as $f ) {
	$sql = "REPLACE INTO " . $store->layer->prefix . "channel_files 
								SET channel_id = " . $c["ID"] . ", 
								hash = '" . mysql_escape_string($f["0"]) . "', 
								thetime = '" . mysql_escape_string($f["1"]) . "'";
	mysql_query( $sql );
      }
      
      // sections
      foreach( $c["Sections"] as $s ) {
	$sql = "REPLACE INTO " . $store->layer->prefix . "channel_sections 
								SET channel_id = " . $c["ID"] . ", 
								Name = '" . mysql_escape_string($s["Name"]) . "'";
	mysql_query( $sql );
	
	foreach( $s["Files"] as $sf ) {
	  $sql = "REPLACE INTO " . $store->layer->prefix . "section_files 
									SET channel_id = " . $c["ID"] . ", 
									Name = '" . mysql_escape_string($s["Name"]) . "',
									hash = '" . mysql_escape_string($sf) . "'";
	  mysql_query( $sql );
	}
      }
    }	
    
  }
  
  function addFlatFileFiles() {
		global $store;
		
		$files = $this->flat->layer->getAll("files");
		
		$qarr = $store->layer->getTableQueries("files");
		$query = $qarr["insert"];
		
		$qarr = $store->layer->getTableQueries("file_people");
		$people_sql = $qarr["insert"];
		
		$qarr = $store->layer->getTableQueries("file_keywords");
		$kw_sql = $qarr["insert"];
		
		foreach ( $files as $f ) {
		
			// desc is a reserved word in SQL, so lets not be using that
			if ( isset($f["Desc"]) ) {
				$f["Description"] = $f["Desc"];
				unset($f["Desc"]);
			}
		
			$data = $store->layer->prepareForMySQL($f);
			
			$sql = str_replace("%vals", $data, $query);
			mysql_query( $sql );
			
			foreach($f["People"] as $p) {
				$tmp["Name"] = trim($p[0]);
				$tmp["Role"] = trim($p[1]);
				$tmp["ID"] = $f["ID"];
			
				if ( $tmp["Name"] != "" ) {
					$data = $store->layer->prepareForMySQL($tmp);
					$sql = str_replace("%vals", $data, $people_sql);
					mysql_query( $sql );
				}
			}
		
			foreach($f["Keywords"] as $kw) {
				$kw = trim($kw);
				$sql = "REPLACE INTO " . $store->layer->prefix . "file_keywords (ID, word) 
								VALUES ('" . mysql_escape_string($f["ID"]) . "', 
								'" . mysql_escape_string($kw) . "')";
				mysql_query( $sql );
			}
		
		}	

  } // addFlatFileFiles
  
  function addFlatFileDonations() {
    global $store;
    
    $donations = $this->flat->layer->getAll("donations");
    //		print_r($store);
    $qarr = $store->layer->getTableQueries("donations");
    $query = $qarr["insert"];
    
    foreach ( $donations as $id => $d ) {
      $d["id"] = $id;
      $data = $store->layer->prepareForMySQL($d);
      $sql = str_replace("%vals", $data, $query);
      mysql_query( $sql );
      
      foreach($d["Files"] as $f) {
				$sql = "REPLACE INTO " . $store->layer->prefix . "donation_files SET id = '$id', hash = '$f'";
				mysql_query( $sql );
      }
    }	
  }
}
?>