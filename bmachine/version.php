<?php
include_once("include.php");
include_once("xml.php");

function get_datastore_version() {
  global $data_dir;

  // 20 is the first version of the app that uses this xml file
  if ( ! file_exists( "$data_dir/version.xml") ) {
    return 20;
  }
  $xml = file_get_contents("$data_dir/version.xml");
  $data = XML_unserialize($xml);
  
  if ( !isset($data["datastore"]["version"]) ) {
    return 20;
  }
  
  return $data["datastore"]["version"];
}

function set_datastore_version($v) {

  //error_log("set datastore version to $v");

  global $data_dir;
  $data["datastore"]["version"] = $v;
  $xml = XML_serialize($data);
  
  $f = fopen("$data_dir/version.xml", 'wb');
  
  flock( $f, LOCK_EX );
  ftruncate($f, 0);
  fwrite($f, $xml);

 // //error_log($xml);
  
  // make sure the file is flushed out to the filesystem
  fflush($f);
  
  flock( $f, LOCK_UN );
  fclose($f);

  clearstatcache();
}

function get_upgrade_scripts($from, $to) {

	if ( ! isset($from) ) {
		$from = get_datastore_version();	
	}

	if ( ! isset($to) ) {
		$to = get_version();		
	}

	$xml = file_get_contents("upgrades.xml");
	$data = XML_unserialize($xml);
//	print_r($data["upgrades"]);

	global $store;

	foreach( $data as $x ) {
		$a = $x["script"];
//		print "Version: " . $a["version"] . "<br>";
//		print "Type: " . $a["type"] . "<br>";

		if ( $store->type() == "MySQL" && $a["type"] == "mysql" && $a["version"] > get_datastore_version() ) {
			$sql = str_replace("__", $store->prefix, $a["action"]);
			print "Action: $sql<br>\n";
		    mysql_query ($sql);
		}
	}

}
?>