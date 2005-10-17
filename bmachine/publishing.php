<?php
/**
 * library of publishing-related functions
 *
 * pretty much exclusively called from publish.php
 * @package Broadcast Machine
 */


require_once("include.php");
require_once("mime.php");

/**
 * generate a unique filename for the given directory and base file name - we use
 * this to make sure that thumbnails and other uploaded files are always unique, and
 * don't get overwritten.
 */
function unique_file_name( $basedir, $basename ) {

	$ext = ereg_replace("^.+\\.([^.]+)$", "\\1", $basename );
	$hashedname = md5($basename . rand() ) . "." . $ext;

	while ( file_exists($basedir . "/" . $hashedname ) ) {
		$hashedname = md5($basename . rand() ) . "." . $ext;
	}

	return $hashedname;
}

/**
 * determine if this file is a valid mimetype
 *
 * we're not really doing anything with this right now
 */
function is_valid_mimetype($type = "text/html") {

	global $do_mime_check;
	
	if ( $do_mime_check != true ) {
		return true;
	}

	if ( beginsWith($type, "video/") ||
		beginsWith($type, "audio/") ||
		$type == "application/x-bittorrent" ) {
		return true;
	}

	return false;
}

/**
 * publish a file from POST input
 */
function publish_file($file) {
	
	//
	// if the user doesn't have upload access, then stop right here
	//
	requireUploadAccess();

	global $store;
	global $errorstr;
	global $perm_level;

	if ( isset($file["post_file_url"])) {
		$file_url = $file["post_file_url"];
		
		// if the is_external flag was passed along, use that value - this will happen when the user uploads
		// a file which needs a MIME specified - we want to treat that as an uploaded file, not an external URL
		if ( isset($file["is_external"]) ) {
			$is_external = $file["is_external"];
		}
		else {
			$is_external = true;
		}
	}
	else {
		$file_url = "";
		$is_external = false;
	}
	
	$title = encode($file["post_title"]);
	$desc = encode($file["post_desc"]);

	if ( isset($file["post_image"])) {
		$image = $file["post_image"];
	}
	else {
		$image = "";
	}

	if ( isset($file["post_license_url"])) {
		$license_url = $file["post_license_url"];
	}
	else {
		$license_url = "";
	}

	if ( isset($file["post_license_name"])) {
		$licenseName = $file["post_license_name"];
	}
	else {
		$licenseName = "";
	}

	if ( isset($file["post_creator"])) {
		$creator = $file["post_creator"];
	}
	else {
		$creator = "";
	}

	if ( isset($file["post_rights"])) {
		$rights = $file["post_rights"];
	}
	else {
		$rights = "";
	}

	if ( isset($file["post_keywords"])) {
		$temp_keywords = explode("\n", $_POST["post_keywords"]);
//		$temp_keywords = $file["post_keywords"];
	}
	else {
		$temp_keywords = "";
	}

	if ( isset($file["post_webpage"])) {
		$webpage = $file["post_webpage"];
	}
	else {
		$webpage = "";
	}

	if ( isset($file["post_mimetype"])) {
		$mimetype = $file["post_mimetype"];
	}
	else {
		$mimetype = "";
	}

	if ( isset($file["post_length_hours"])) {
		$runtime_hours = $file["post_length_hours"];
	}
	else {
		$runtime_hours = "";
	}

	if ( isset($file["post_length_minutes"])) {
		$runtime_minutes = $file["post_length_minutes"];
	}
	else {
		$runtime_minutes = "";
	}

	if ( isset($file["post_length_seconds"])) {
		$runtime_seconds = $file["post_length_seconds"];
	}
	else {
		$runtime_seconds = "";
	}

	if ( isset($file["post_people"]) ) {
		$people_array = explode("\n", $file["post_people"]);
	}

	if( isset($file["post_publish_month"]) && 
			isset($file["post_publish_day"]) && 
			isset($file["post_publish_year"]) && 
			isset($file["post_publish_hour"]) && 
			isset($file["post_publish_minute"])) {
		$publish_date = strtotime(($file["post_publish_month"] + 1) . "/" . $file["post_publish_day"] . "/" . $file["post_publish_year"] . " " . $file["post_publish_hour"] . ":" . $file["post_publish_minute"]);
	}
	else {
		$publish_date = time();
	}
	
	if( isset($file["post_create_month"]) && 
			isset($file["post_create_day"]) && 
			isset($file["post_create_year"]) && 
			isset($file["post_create_hour"]) && 
			isset($file["post_create_minute"])) {
		$create_date = strtotime(($file["post_create_month"] + 1) . "/" . $file["post_create_day"] . "/" . $file["post_create_year"] . " " . $file["post_create_hour"] . ":" . $file["post_create_minute"]);
	}
	else {
		$create_date = time();
	}

	//	$publish_date = strtotime(($file["post_publish_month"] + 1) . "/" . $file["post_publish_day"] . "/" . $file["post_publish_year"] . " " . $file["post_publish_hour"] . ":" . $file["post_publish_minute"]);	

	if ( isset($file["donation_id"])) {
		$donation_id = $file["donation_id"];
	}
	else {
		$donation_id = "";
	}


	// paranoia check here - make sure we always have a good time value
	if ( $publish_date <= 0 ) {
		$publish_date = time();
	}

	if ( isset($file["post_release_year"])) {
		$release_year = $file["post_release_year"];
	}
	else {
		$release_year = "";
	}

	if ( isset($file["post_release_month"])) {
		$release_month = $file["post_release_month"];
	}
	else {
		$release_month = "";
	}

	if ( isset($file["post_release_day"])) {
		$release_day = $file["post_release_day"];
	}
	else {
		$release_day = "";
	}

	if ( isset($file["post_channels"]) ) {
		$channelIDs = $file["post_channels"];
	}
	else {
		$channelIDs = array();
	}


	if ( isset($file["ignore_mime"])) {
		$ignore_mime = $file["ignore_mime"];
	}
	else {
		$ignore_mime = "";
	}

	if ( $ignore_mime == 1 && isset($mimetype) && $mimetype != "" ) {
		$got_mime_type = true;
	}
	else {
		$got_mime_type = false;
	}
		
	// if this is a torrent posted with the helper, then we'll have a hash already
	if ( isset($file["post_filehash"])) {
		$filehash = $file["post_filehash"];
	}
	else {
		$filehash  = "";
	}

	//
	// generate the hash which will be used to identify this file
	//
	if ($filehash == "") {
		// add a little random seed to our hash generation - this will typically allow
		// publishing the same URL/file twice, which seems like a good thing, and will
		// also eliminate the incredibly unlikely possibility that two files produce the
		// same hash
		$seed = "";
		for ($i = 1; $i <= 10; $i++) {
			$seed .= substr('0123456789abcdef', rand(0,15), 1);
		}
		$filehash = sha1($file_url . $seed);
	}

	if ( isset($file["post_mimetype"]) && $file["post_mimetype"] == "application/x-bittorrent" ) {
		$got_mime_type = true;
		$mimetype = "application/x-bittorrent";
	}

	//
	// this is set if the user is uploading a file using http upload
	//
	else if (isset($_FILES["post_file_upload"]) && $_FILES["post_file_upload"]["size"] > 0 && $file["post_use_upload"] == 1 ) {

		if (!file_exists('torrents')) {
			mkdir("torrents",$perm_level);
		}

		// hold onto the actual name of the file
		global $actual_fname;
		$actual_fname = $_FILES['post_file_upload']['name'];

		// use a hashed name so we never overwrite anything
//		$fname = unique_file_name("torrents", $_FILES['post_file_upload']['name']);
		$ext = ereg_replace("^.+\\.([^.]+)$", "\\1", $actual_fname );
		$fname = $filehash;
		if ( $ext != "" ) {
			$fname .= "." . $ext;
		}
				
		if (
			move_uploaded_file(
				$_FILES['post_file_upload']['tmp_name'], 
				"torrents/" . $fname ) ) {

			chmod("torrents/" . $fname, $perm_level);
			$file_url = get_base_url() . "torrents/" . $fname;
		}

		if ( isset($_FILES["post_file_upload"]["type"]) && 
				$_FILES["post_file_upload"]["type"] != "" && 
				is_valid_mimetype($_FILES["post_file_upload"]["type"]) ) {
			$mimetype = $_FILES["post_file_upload"]["type"];
			$got_mime_type = true;
		}
		else if ( $ignore_mime == 0 ) {
			$mimetype = @mime_content_type("torrents/" . $fname);

			if ( $mimetype ) {
				$got_mime_type = true;
				
				if ( $mimetype == "text/html" ) {
					$mimetype = "application/octet-stream";
				}
			}
		}

	}

	if ( $mimetype == "" && $ignore_mime == 1 ) {
		$mimetype = get_mime_from_extension($file_url);
		$got_mime_type = true;
	}

	//
	// if we've got a URL here, let's try and figure out the content-type
	//
	if ( $got_mime_type == false ) {

		if ( isset($_POST["mime_chooser"]) ) {
			$mimetype = $_POST["mime_chooser"];
			$ignore_mime = 1;
		}
		else if ( isset($_POST["mime_chooser_custom"]) && $_POST["mime_chooser_custom"] != "" ) {
			$mimetype = $_POST["mime_chooser_custom"];
			$ignore_mime = 1;		
		}
		else {
			$errstr = "";
			
			// encode the link in case it has spaces or other weird characters in it
			$mimetype = get_content_type(linkencode($file_url), $errstr);
	
			// we got an error, set our global error variable and exit out
			if ( $errstr ) {
				global $errorstr;
				$errorstr = $errstr;
				return false;
			}
		}
	}

	// check to see if this is a valid mime - if not we'll report the problem to the user
	// and give them a chance to ignore it or choose a different file
	if ( ! is_valid_mimetype($mimetype) && 	! ( isset($ignore_mime) && $ignore_mime == 1 ) ) {
	
		global $errorstr;
		$errorstr = "MIME";
		
		// if this was an uploaded file, we need to specify it's current URL, so we don't have to force the
		// user to start over
		if (isset($_FILES["post_file_upload"]) && $_FILES["post_file_upload"]["size"] > 0 ) {
			global $uploaded_file_url;
			$uploaded_file_url = get_base_url() . "torrents/" . $fname;
		}
		
		return false;
	
	}


	//
	// we'll share this file if the checkbox was checked, and it happens to be
	// a local torrent file
	//
	$sharing_enabled = isset($file["sharing_enabled"]) &&
							(
								(isset($filehash) && $filehash != "") ||
								(isset($file["post_file_url"]) && is_local_torrent($file["post_file_url"]))
							);


	global $publish_dir;

	if ( ! file_exists($publish_dir) ) {
		mkdir($publish_dir, $perm_level);
	}
	
	if ( isset($channelIDs) && count($channelIDs) > 0 ) {
		foreach ($channelIDs as $channelID) {
			if(!file_exists("$publish_dir/" . $channelID)) {
				mkdir("$publish_dir/" . $channelID, $perm_level);
			}
		
//			$handle = fopen("$publish_dir/" . $channelID . "/" . $publish_date, "a+b");
			$handle = fopen("$publish_dir/" . $channelID . "/" . time(), "a+b");
			fclose($handle);
		}
	}	
	
	$explicit = 0;
	
	if (isset($file["post_explicit"])) {
		$explicit = 1;
	}
	
	$excerpt = 0;
	
	if (isset($file["post_is_excerpt"])) {
		$excerpt = 1;
	}


	if ( isset($file['post_transcript_url']) ) {
		$transcript_url = $file["post_transcript_url"];
	}
	else {
		$transcript_url = "";
	}

	global $text_dir;

	if (isset($_FILES["post_transcript_file"]) && $_FILES["post_transcript_file"]["size"] > 0) {
		if (!file_exists($text_dir)) {
			mkdir($text_dir,$perm_level);
		}

		if (move_uploaded_file($_FILES['post_transcript_file']['tmp_name'], "$text_dir/" . $filehash . ".txt")) {
			chmod("$text_dir/" . $filehash, 0644);
			$transcript_url = get_base_url() . "$text_dir/" . $filehash . ".txt";
		}
	}


	if (isset($file["post_transcript_text"]) && $file["post_transcript_text"] != "" ) {
		if (!file_exists('text')) {
			mkdir("text");
		}
	
		$handle = fopen($text_dir . '/' . $filehash . '.txt', "a+b");
		fseek($handle,0);
		flock($handle,LOCK_EX);
		ftruncate($handle,0);
		fseek($handle,0);
		fwrite($handle,$file["post_transcript_text"]);
		fclose($handle);
	
		$transcript_url = get_base_url() . "$text_dir/" . $filehash . ".txt";
	}
	
	//
	// handle any thumbnail that the user posted
	//

	global $thumbs_dir;

	if (isset($_FILES["post_image_upload"])) {
		if (!file_exists($thumbs_dir)) {
			mkdir($thumbs_dir, $perm_level);
		}

		$hashedname = unique_file_name($thumbs_dir, $_FILES['post_image_upload']['name']);	

		if (
			move_uploaded_file(
				$_FILES['post_image_upload']['tmp_name'], 
				"$thumbs_dir/" . $hashedname ) ) {
	
			chmod("$thumbs_dir/" . $hashedname, 0644);
			$image = get_base_url() . "$thumbs_dir/" . $hashedname;
		}
	
	}

	//
	// parse keywords
	//
	$keywords = array();
	
	foreach ($temp_keywords as $words) {
		if (trim($words) != '') {
			$keywords[] = encode(trim($words));
		}
	}
	
	//
	// parse people
	//
	$people = array();
	
	foreach ($people_array as $people_row) {
		if (trim($people_row) != '') {
			$people[] = explode(":", encode($people_row));
		}
	}
	
	
	if ($image == "http://") {
		$image = '';
	}

	//
	// lets figure out if we have a local file or a remote URL here.
	// if it's a file, then we will also check and see if it's a torrent
	//	
	global $data_dir;
	global $torrents_dir;
	if ( file_exists("$data_dir/" . $file_url ) ) {

		// data/$file_url will contain the name of the torrent
// cjm - use binary mode?
//		$handle = fopen('data/' . $file_url, "r+");
		$handle = fopen($data_dir . '/' . $file_url, "r+");
		if ( $handle ) {
			$torrent = fread($handle, 1024);
			fclose($handle);
			$file_url = get_base_url() . $torrents_dir . '/' . $torrent;
		}
	}

	//
	// create a new file entry, load in our data, and save it
	//
	$newcontent = $store->getAllFiles();

	// grab our old donation_id - if it was set, then we'll unset it if needed
	if ( isset($newcontent[$filehash]) && isset($newcontent[$filehash]['donation_id']) ) {
		$old_donation_id = $newcontent[$filehash]['donation_id'];
	}
	else {
		$old_donation_id = "";
	}
	
	// keep track of if this is a posted URL, or a torrent/uploaded file.  posted URLs
	// will have slightly different logic - we won't check to see if they are files
	// under the control of Broadcast Machine
	if ( ! isset($newcontent[$filehash]) && isset($is_external) ) {	
		$newcontent[$filehash]["External"] = $is_external ? 1 : 0;
	}


	// cjm - started adding this to the actual data - 8/7/2005
	$newcontent[$filehash]['ID'] = $filehash;

	$newcontent[$filehash]['URL'] = $file_url;
	global $actual_fname;
	
	if ( isset($actual_fname) && $actual_fname != "" ) {
		$newcontent[$filehash]['FileName'] = encode($actual_fname);	
	}
	else if ( isset($file['actual_fname']) && $file['actual_fname'] != "" ) {
		$newcontent[$filehash]['FileName'] = encode($file['actual_fname']);
	}
		
	$newcontent[$filehash]['Title'] = $title;
	$newcontent[$filehash]['Description'] = $desc;
	$newcontent[$filehash]['Image'] = $image;
	$newcontent[$filehash]['LicenseURL'] = $license_url;
	$newcontent[$filehash]['LicenseName'] = $licenseName;
	$newcontent[$filehash]['Creator'] = $creator;
	$newcontent[$filehash]['Rights'] = $rights;
	$newcontent[$filehash]['Keywords'] = $keywords;
	$newcontent[$filehash]['People'] = $people;
	$newcontent[$filehash]['Webpage'] = $webpage;
	$newcontent[$filehash]['Mimetype'] = trim($mimetype);
	$newcontent[$filehash]['RuntimeHours'] = $runtime_hours;
	$newcontent[$filehash]['RuntimeMinutes'] = $runtime_minutes;
	$newcontent[$filehash]['RuntimeSeconds'] = $runtime_seconds;
	$newcontent[$filehash]['Publishdate'] = $publish_date;
	$newcontent[$filehash]['ReleaseYear'] = $release_year;
	$newcontent[$filehash]['ReleaseMonth'] = $release_month;
	$newcontent[$filehash]['ReleaseDay'] = $release_day;
	$newcontent[$filehash]['Transcript'] = $transcript_url;
	$newcontent[$filehash]['Explicit'] = $explicit;
	$newcontent[$filehash]['Excerpt'] = $excerpt;
	$newcontent[$filehash]['donation_id'] = $donation_id;
	$newcontent[$filehash]['Created'] = $create_date;

	// we'll only do this mime check the first time we try and save a file,
	// so force it to be set after that
	$newcontent[$filehash]['ignore_mime'] = 1;
	
	$newcontent[$filehash]['SharingEnabled'] = $sharing_enabled;

	if (!isset($newcontent[$filehash]['Publisher'])) {
		if (isset($_SESSION['user']['Name'])) {
			$newcontent[$filehash]['Publisher'] = $_SESSION['user']['Name'];
		}
	}

	$store->store_files($newcontent);

	//
	// add to the donation setup, if it exists
	//
	if ( $old_donation_id != "" ) {
		$store->removeFileFromDonation($filehash, $old_donation_id);
	}
	
	if ( $donation_id != "" ) {
		$store->addFileToDonation($filehash, $donation_id);
	}


	//
	// write out any channel info
	//
	$channels = $store->getAllChannels();

	foreach ($channels as $channel) {
		if (is_admin() || $channel["OpenPublish"]) {
			$keys = array_keys($channel['Files']);

			//
			// first, unset any channels that this was published to
			//
			foreach ($keys as $key) {
				$file = $channel['Files'][$key];
				if ($file[0] == $filehash) {
					unset($channel['Files'][$key]);
				}
			}
	

			if ( isset($channelIDs) && count($channelIDs) > 0 &&
				in_array($channel['ID'], $channelIDs) ) {

				$sections = array_keys($channel['Sections']);
	
				foreach ($sections as $section) {
					$keys = array_keys($channel['Sections'][$section]['Files']);
	
					foreach ($keys as $key) {
						$file = $channel['Sections'][$section]['Files'][$key];
						if ($file == $filehash) {
							unset($channel['Sections'][$section]['Files'][$key]);
						}
					}
				}
			}
	
			$channels[$channel['ID']] = $channel;

		}
	}

	$store->store_channels($channels);
	$channels = $store->getAllChannels();


	if ( isset($channelIDs) && count($channelIDs) > 0 ) {
		foreach ($channelIDs as $channelID) {
		
			if ($channelID != '') {
				if (is_admin() || $channels[$channelID]["OpenPublish"]) {
					$channels[$channelID]["Files"][] = array($filehash, $publish_date);
				}
			}
		}
		
		$store->store_channels($channels);
	
		//
		// generate new RSS feeds for any channels we just re-published
		//
		$channels = $store->getAllChannels();
		foreach ($channelIDs as $channelID) {
			makeChannelRss($channelID);
		}
	}

	global $seeder;
	global $settings;

	//
	// if this is a torrent, and we're configured to share all torrents, then
	// start sharing it
	//
	if ( 
		// is a local torrent
		is_local_torrent($file_url) && 

		// sharing is turned on
		isset($settings['sharing_enable']) && $settings['sharing_enable'] == 1 &&

		(
			// it's shared - OR - 
			$sharing_enabled == true ||

			// global sharing is on		
			(isset($settings['sharing_auto']) && $settings['sharing_auto'] == 1)
		)
	) {
		$torrentfile = local_filename($file_url);
		$seeder->spawn($torrentfile);
	}

	return true;
}
?>