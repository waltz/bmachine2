<?php

global $data_dir;

class MYSqlStore extends FlatFileStore {

	/**
	 * return the type of datastore we are using
	 */
  function type() {
    return 'MySQL';
  }


	/**
	 * handle a bittorrent announce - mysql version
	 */ 
  function BTAnnounce( $info_hash, $event, $remote_addr, $port, $left, $numwant ) {
  	$this->error='';

    if ( strlen( $info_hash ) != 40 ) {
      $this->error='Invalid info hash';
      return null;
    }

    $peer_ip  =explode( '.', $remote_addr );
    $peer_ip  =pack( "C*", $peer_ip[0], $peer_ip[1], $peer_ip[2], $peer_ip[3] );
    $peer_port=pack( "n*", (int)$port );
    $seeder   =( $left == 0 ) ? '1' : '0';

    if ( !$this->torrentExists( $info_hash ) ) {
      $this->error='This torrent is not authorized on this tracker.';
      return null;
    }

    if ( $event == 'stopped' ) {
      mysql_query ( "DELETE FROM peers WHERE info_hash='" . mysql_escape_string(
										$info_hash ) . "' AND ip='"
		    . mysql_escape_string( $peer_ip ) . "' AND port='" . mysql_escape_string( $peer_port )
		    . "'" );
		}
    else {
      mysql_query ( "REPLACE INTO peers (info_hash,ip,port,seeder,time) VALUES ('"
		    . mysql_escape_string( $info_hash )
		    . "', '" . mysql_escape_string( $peer_ip )
		    . "','" . mysql_escape_string( $peer_port ) . "','" . mysql_escape_string( $seeder )
		    . "',NOW())" );
		}

    $peer_num = 0;


    mysql_query( "DELETE FROM peers WHERE time < DATE_SUB(NOW(), INTERVAL 600 SECOND)");

    $o = '';

    //Fill $o with a list of peers
    if ( $event == 'stopped' || $numwant === 0 ) {
      $o='';
    }
    else {
      $result=mysql_query( "SELECT CONCAT(ip,port) as out FROM peers WHERE info_hash='"
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
  }

	/**
	 * get the stats for the specified torrent from the db
	 */
  function getStat( $info_hash ) {

		// delete expired peers
    mysql_query( "DELETE FROM peers WHERE time < DATE_SUB(NOW(), INTERVAL 600 SECOND)");

		$query = mysql_query("SELECT COUNT(*) FROM peers WHERE info_hash='" . 
					mysql_escape_string($info_hash) . "'" );

    $row = mysql_fetch_array($query);
    $total = $row[0];

		$query = mysql_query("SELECT COUNT(*) FROM peers WHERE info_hash='" . 
					mysql_escape_string( $info_hash ) . "' AND seeder = 1" );

    $row = mysql_fetch_array($query);

    $complete = $row[0];
    $incomplete = $total - $complete;

    return array (
			"hash"           => $info_hash,
			"complete"   => $complete,
			"incomplete" => $incomplete
			);
  }

	/**
	 * get a list of torrents from the db
	 */
  function getTorrentList() {

    $list = array();
    $result = mysql_query( "SELECT filename from torrents" );

    while ( $row = mysql_fetch_array( $result ) ) {
      $list[]=$row[0];
    }

    return $list;
  }

	/**
	 * get the data for this torrent from the db
	 */
  function getRawTorrent( $torrent ) {
    $result = mysql_query( "SELECT raw_data FROM torrents WHERE filename='" . mysql_escape_string(
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
    $result =mysql_query( "SELECT COUNT(*) FROM torrents WHERE info_hash='" . mysql_escape_string(
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
			"SELECT ip, port, UNIX_TIMESTAMP(time) AS time,  if (seeder,'seeder','leecher') AS what FROM peers WHERE info_hash = '" . mysql_escape_string( $info_hash )
			. "'" );

    while ( $row=mysql_fetch_array( $result ) ) {
      $ip  = unpack( "C*", $row['ip'] );
      $ip  =$ip[1] . '.' . $ip[2] . '.' . $ip[3] . '.*';
      $port=join( '', unpack( "n*", $row['port'] ) );

      $peers[]=array
			(
			 "ip"       => $ip,
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

    mysql_query ( "INSERT INTO torrents (info_hash,filename,raw_data) VALUES ('" . mysql_escape_string( $data['sha1'] )
		  . "','" . mysql_escape_string( $torrent ) . "','" . mysql_escape_string( $rawTorrent )
		  . "')" );
  }

	/**
	 * delete the specified torrent
	 */
  function deleteTorrent( $torrent ) {

    $result = mysql_query( "SELECT info_hash FROM torrents WHERE filename='" . mysql_escape_string(
												 $torrent ) . "'" );

    if ( mysql_num_rows( $result ) > 0 ) {
      $row = mysql_fetch_row( $result );
      $info_hash=$row[0];

      mysql_query ( "DELETE FROM peers WHERE info_hash='" . mysql_escape_string(
										$info_hash ) . "'" );
      mysql_query ( "DELETE FROM torrents WHERE info_hash='" . mysql_escape_string(
										   $info_hash ) . "'" );
    }

    parent::deleteTorrent( $torrent );
  }

	/**
	 * setup our datastore object
	 */
  function setup() {

    global $settings;

    //We still need the flat file db set up to load the settings
    if ( !parent::setup() ) {
      return false;
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
        
        if ( !@mysql_selectdb( $settings['mysql_database'] ) )
          return false;
      }

      //We're connected to the database.

      //If we've used these settings before, we can be fairly certain
      //everything is OK
      if ( isset( $settings['mysql_verified'] ) && $settings['mysql_verified'] )
        return true;

      //We haven't used these settings. Check to see if tables exist
      if ( mysql_num_rows( mysql_query( "SHOW TABLES" ) ) )
        return true;
      else { //We need to create the tables

	//This is the main torrent table
	mysql_query ( "CREATE TABLE torrents (
  info_hash char(40) NOT NULL,
  filename varchar(255) NOT NULL,
  raw_data MEDIUMBLOB NOT NULL,
  UNIQUE INDEX (filename),
  PRIMARY KEY(info_hash));" );
	mysql_query ( "CREATE TABLE peers (
  info_hash char(40) NOT NULL,
  ip tinyblob NOT NULL,
  port tinyblob NOT NULL,
  seeder bool NOT NULL,
  time datetime NOT NULL,
  INDEX (time),
  PRIMARY KEY (info_hash,ip(4),port(2)));" );

				$this->addFlatFileTorrents();
				return mysql_num_rows( mysql_query( "SHOW TABLES" ) );
      }
    }


    return false;

  }

	/**
	 * add any flatfile torrents to the db
	 */
  function addFlatFileTorrents() {
    $oldTorrents=parent::getTorrentList();

    foreach ( $oldTorrents as $torrent ) {

      $raw = parent::getRawTorrent( $torrent );
			$tmp = bdecode($raw);
			$hash = $tmp["sha1"];
			
			$sql = "REPLACE INTO torrents (info_hash, filename,raw_data) VALUES ('"
		    . mysql_escape_string( $hash )
		    . "','" . mysql_escape_string( $torrent ) . "','" . mysql_escape_string( $raw )
		    . "')";

      mysql_query( $sql );
    }

  }

	/**
	 * generate a message to help with mysql setup
	 */
  function setupHelpMessage() {
    //FIXME: make this nicer
    return 'MySQL is not setup properly';
  }


}
?>