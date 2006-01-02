<?php
/**
 * file publishing page 
 *
 * this page handles the creation of new files, editing old files, etc.  it has
 * logic to handle torrents, URLs, file uploads, and so on.
 * @package Broadcast Machine
 */

require_once("include.php");
require_once("theme.php");
require_once("publishing.php");



//
// don't let the user access this page if they don't have the permission to upload
//
requireUploadAccess();

$channels = $store->getAllChannels();

//
// we need to figure out if this is an admin user, or if it's not,
// is there an accessible channel to post to
//
if ( ! is_admin() ) {

	$has_usable_channel = false;

	foreach ($channels as $channel) {
		if ( $channel["OpenPublish"] ) {
			$has_usable_channel = true;
			break;
		}
	}

	if ( ! $has_usable_channel ) {
		bm_header();
?>
<div class="wrap">
Sorry, there are no publicly accessible channels for publishing content at this time.
</div>
<?php
		bm_footer();
		exit;
	}
}

//
// set up some defaults here
//
$filehash = "";
$file_url = "";
$title = "";
$desc = "";
$image = "http://";
$license_url = "";
$license_name = "";
$creator = "";
$rights = "";
$keywords = "";
$people_array = array();
$webpage = "";
$mimetype = "";

$publishday = date("j");
$publishmonth = date("n");
$publishyear = date("Y");
$publishhour = date("G");
$publishminute = date("i");

$createday = date("j");
$createmonth = date("n");
$createyear = date("Y");
$createhour = date("G");
$createminute = date("i");

$releaseday = "";
$releasemonth = -1;
$releaseyear = "";
$explicit = 0;
$excerpt = 0;
$runninghours = "";
$runningminutes = "";
$runningseconds = "";
$transcript_text = "";
$transcript_url = "";
$sharing_enabled = false;
$ignore_mime = 0;



//
// user is editing, let's grab the file info
//
if (isset($_GET["i"])) {
	$filehash = $_GET["i"];

//	$files = $store->getAllFiles();
//	$file = $files[$filehash];
	$file = $store->getFile($filehash);

	$file_url = $file['URL'];
	$title = $file['Title'];
	$desc = $file['Description'];
	$image = $file['Image'];
	$license_url = $file['LicenseURL'];
	$license_name = $file['LicenseName'];
	$creator = $file['Creator'];
	$rights = $file['Rights'];
	$keywords = implode("\n",$file['Keywords']);
	$people_array = $file['People'];
	$webpage = $file['Webpage'];
	$mimetype = $file['Mimetype'];
	$publishtime = $file['Publishdate'];
	$publishday = date("j",$publishtime);
	$publishmonth = date("n",$publishtime);
	$publishyear = date("Y",$publishtime);
	$publishhour = date("G",$publishtime);
	$publishminute = date("i",$publishtime);

	$createtime = $file['Created'];
	$createday = date("j",$createtime);
	$createmonth = date("n",$createtime);
	$createyear = date("Y",$createtime);
	$createhour = date("G",$createtime);
	$createminute = date("i",$createtime);

	$releaseday = $file['ReleaseDay'];
	$releasemonth = $file['ReleaseMonth'];
	$releaseyear = $file['ReleaseYear'];
	$explicit = $file['Explicit'];
	$excerpt = $file['Excerpt'];
	$runninghours = $file['RuntimeHours'];
	$runningminutes = $file['RuntimeMinutes'];
	$runningseconds = $file['RuntimeSeconds'];
	$transcript_url = $file['Transcript'];
	$transcript_text = "";
	
	if ( isset($file["donation_id"]) ) {
		$donation_id = $file["donation_id"];
	}

	if ( isset($file['SharingEnabled']) ) {
		$sharing_enabled = $file['SharingEnabled'];
	}
	else {
		$sharing_enabled = false;
	}

	if (stristr($transcript_url,get_base_url())) {
		$transcript_text = file_get_contents('text/' . $filehash . ".txt");
		$transcript_url = "";
	}

	// cjm - fixed a wicked typo here - donation_id was being set to the value of ignore_mime (08/18/2005)
	if ( isset($file["donation_id"]) ) {
		$donation_id = $file["donation_id"];
	}

	if ( isset($file["ignore_mime"]) ) {
		$ignore_mime = $file["ignore_mime"];
	}

	foreach ($channels as $channel ) {
		foreach ($channel["Files"] as $list) {
			if ($list[0] == $filehash) {
				$channelIDs[] = $channel["ID"];
			}
		}
	}

} 
else if ( isset($_POST["post_do_save"]) ) {

	$result = publish_file($_POST);

	if ( $result ) {
		session_write_close();
		header('Location: ' . get_base_url() . 'edit_videos.php' );
		exit;
	}
	else {
		global $errorstr;
		global $uploaded_file_url;


		if ( isset($_POST["post_file_url"]) ) {
			$file_url = $_POST["post_file_url"];
		}
		
		if ( $file_url == "" && isset($uploaded_file_url) ) {
			$file_url = $uploaded_file_url;
			$is_external = 0;
		}
		
		if ( isset($_POST["post_filehash"]) ) {
			$filehash = $_POST["post_filehash"];
		}
		else {
			$filehash = "";
		}

		if ($filehash == "") {
			$filehash = sha1($file_url);
		}

		$title = encode($_POST["post_title"]);
		$desc = encode($_POST["post_desc"]);
		
		if ( isset($_POST["post_image"]) ) {
			$image = $_POST["post_image"];
		}
		if ( isset($_POST["post_license_url"]) ) {
			$license_url = encode($_POST["post_license_url"]);
		}
		else {
			$license_url = "";
		}

		if ( isset($_POST["post_license_name"]) ) {
			$licenseName = encode($_POST["post_license_name"]);
		}
		else {
			$licenseName = "";
		}

		
		if ( isset($_POST["post_creator"]) ) {
			$creator = encode($_POST["post_creator"]);
		}
		else {
			$creator = "";		
		}

		
		if ( isset($_POST["post_rights"]) ) {
			$rights = encode($_POST["post_rights"]);
		}
		else {
			$rights = "";
		}

		if ( isset($_POST["post_keywords"]) ) {
			$keywords = explode("\n", $_POST["post_keywords"]);
		}
		else {
			$keywords = array();
		}

		if ( isset($_POST["post_people"]) ) {
			$people_array = explode("\n", $_POST["post_people"]);
		}
		else {
			$people_array = array();
		}


		if ( isset($_POST["post_webpage"]) ) {
			$webpage = linkencode($_POST["post_webpage"]);
		}
		else {
			$webpage = "";
		}
		
		if ( isset($_POST["post_mimetype"]) ) {
			$mimetype = $_POST["post_mimetype"];
		}
		else {
			$mimetype = "";
		}

		
		if ( isset($_POST["post_length_hours"]) ) {
			$runtime_hours = $_POST["post_length_hours"];		
		}
		else {
			$runtime_hours = "";
		}

		if ( isset($_POST["post_length_minutes"]) ) {
			$runtime_minutes = $_POST["post_length_minutes"];
		}
		else {
			$runtime_minutes = "";
		}

		if ( isset($_POST["post_length_seconds"]) ) {
			$runtime_seconds = $_POST["post_length_seconds"];
		}
		else {
			$runtime_seconds = "";
		}

		if ( isset($_POST["post_publish_month"]) &&
				isset($_POST["post_publish_day"])&&
				isset($_POST["post_publish_year"])&&
				isset($_POST["post_publish_hour"])&&
				isset($_POST["post_publish_minute"]) ) {
			$publish_date = strtotime(($_POST["post_publish_month"] + 1) . "/" . $_POST["post_publish_day"] . "/" . $_POST["post_publish_year"] . " " . $_POST["post_publish_hour"] . ":" . $_POST["post_publish_minute"]);
		}
		else {
			$publish_date = time();
		}
		
		if ( isset($_POST["post_release_year"]) ) {
			$release_year = $_POST["post_release_year"];
		}
		else {
			$release_year = "";
		}

		if ( isset($_POST["post_release_month"]) ) {
			$release_month = $_POST["post_release_month"];
		}
		else {
			$release_month = "";
		}

		if ( isset($_POST["post_release_day"]) ) {
			$release_day = $_POST["post_release_day"];
		}
		else {
			$release_day = "";
		}

		if ( isset($_POST["donation_id"]) ) {
			$donation_id = $_POST["donation_id"];
		}
		else {
//			$donation_id = 
		}

		if ( isset($_POST["post_channels"]) ) {
			$channelIDs = $_POST["post_channels"];
		}
		else {
			$channelIDs = array();
		}

		
		$sharing_enabled = isset($_POST["sharing_enabled"]);

		if ( isset($_POST["post_keywords"]) ) {
			$keywords = $_POST["post_keywords"];
		}
		else {
			$keywords = array();
		}

		if ( isset($_POST["post_people"]) ) {
			$people = $_POST["post_people"];
		}
		else {
			
		}

		if ( isset($_POST["post_transcript_url"]) ) {
			$transcript_url = $_POST["post_transcript_url"];
		}
		else {
			$transcript_url = "";
		}
	}

}

$months = array(
		"January", "February", "March", "April", "May", "June", 
		"July", "August", "September", "October", "November", "December");

bm_header();

?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var hash = '';
var torrent_name = '';
var upload_error = '';

var pollTimer;

function popUp(URL) {
	day = new Date();
	id = day.getTime();

	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=640,height=600');");

}

function start_polling() {
	if (hash == '') {
		pollTimer = setTimeout('start_polling()', 500);
	} 
	else {
		do_poll();
	}
}

function do_poll() {
	window.frames['poll'].location = 'poll.php?i=' + hash;

	if (torrent_name == "" && upload_error == "" ) {
		pollTimer = setTimeout('do_poll()',5000);
	} 
	else if ( upload_error != "" ) {
		document.getElementById('video_blurb').innerHTML = '<div style="color: #A00;">There was an error in the upload process:<br />' + upload_error + '</div>';
	}
	else {
		document.getElementById('video_blurb').innerHTML = '<div style="color: #A00;">Now sharing "' + torrent_name + '".<br /> <strong>You must keep the BM Helper window open for this file to remain available.</strong></div>';
	}
}


function upload() {
  
    if (hash != '') {
      hash = '';
      torrent_name = '';
      // dont hide the help text at this point (bug #1210035)
      //		document.getElementById('video_blurb').innerHTML = '';
    }

    window.frames['uploader'].location = 'trigger.php';
    pollTimer = setTimeout('start_polling()', 500 );
<?php
    // only display this server-sharing checkbox if server sharing is turned on
    global $settings;
    if ( isset($settings["sharing_enable"]) && $settings["sharing_enable"] == 1 ) {
      echo("document.getElementById('server_sharing').style.display = 'block';");
    }
?>

}



function isFull() {

	frm = document.getElementById('post');

	if (document.getElementById('people_table').rows.length > 2) {
		var do_add = true;

		for( i = 0; i < frm.post_people_name.length; i++ ) {

			if ( frm.post_people_name[i].value == '' || 
					frm.post_people_role[i].value == '' ) {
				do_add = false;
				break;
			}
		}

		if (do_add) {
			addPeople();
		}

	} 
	else {

		if (frm.post_people_name.value != '' && frm.post_people_role.value != '') {
			addPeople();
		}
	}

}

function clearPeople() {

	// this is the div that holds the table of people
	oDiv = document.getElementById('people_holder');

	// delete the inner table from the div
	oDiv.removeChild(oDiv.firstChild);
	
	// recreate the table
	oDiv.innerHTML = '<table cellpadding="2" cellspacing="0" border="0" id="people_table"><tr><td width="200">&nbsp;</td><td width="200">&nbsp;</td></tr></table>';

	// add the 1st blank back
//	addPeople();
}

function addPeople() {
	addPerson("", "");
}

function addPerson(name, role) {

	lyr = document.getElementById('people_table');

	var oNewRow = lyr.insertRow(-1);
	var oNewCell1 = document.createElement("td");
	var oNewCell2 = document.createElement("td");

	oNewRow.appendChild(oNewCell1);
	oNewRow.appendChild(oNewCell2);

	oNewCell1.innerHTML = '<input type="text" id="person" name="post_people_name" value="' + name + '" onKeyDown="isFull();"/>';
	oNewCell2.innerHTML = '<input type="text" id="person" name="post_people_role" value="' + role + '" onKeyDown="isFull();"/>';

}



function do_submit(frm) {

	var err = '';

	if (hash != '') {
		frm.post_file_url.value = hash;
		frm.post_mimetype.value = 'application/x-bittorrent';
	} 
	else if (
		(frm.post_file_url.value == '' || frm.post_file_url.value == 'http://') &&
		frm.post_file_upload.value == ''	) {
		err = 'Please enter a file location or upload a file';
	}
	
	if ( frm.post_title.value == '' ) {
		err = 'Please enter a title';
	}

	// clear out the values of the form widgets that aren't visible, so their data isn't stored as the file info
	if ( document.getElementById('upload_file').style.display == 'block' ) {
		document.getElementById('specify_url').value = '';
		frm.post_file_url.value = '';
		frm.post_use_upload.value = 1;
	}
	else if ( document.getElementById('specify_url').style.display == 'block' ) {
//		document.getElementById('upload_file').value = '';
		frm.post_use_upload.value = 0;
	}


	var channel_count = 0;

  for (i=0; i < document.post.length; i++) {
    if (document.post[i].name == 'post_channels[]') {
      if ( document.post[i].checked == true ) {
      			channel_count++;
      }
    }
  }

	//
	// cjm - ask the user if they want to select a channel before saving
	//	
	if ( channel_count == 0 ) {
		var channel_go = confirm("You haven't selected a channel - Would you like to continue anyway?");
		if ( channel_go == false ) {
			return false;
		}		
	}

	frm.post_people.value = '';

	if ( document.getElementById('people_table').rows.length > 2 ) {

		for( i=0; i < frm.post_people_name.length; i++ ) {
			if ( frm.post_people_name[i].value != '' && frm.post_people_role[i].value != '' ) {
				frm.post_people.value += frm.post_people_name[i].value + ':' + frm.post_people_role[i].value + '\n';
			}
		}

	} 
	else {
		frm.post_people.value = frm.post_people_name.value + ':' + frm.post_people_role.value;
	}

//	frm.post_channel_array.value = channel_array.join(',');

	if (err == '') {

		if ( document.getElementById('upload_file').style.display == 'block' ) {
			document.getElementById('progress_bar').style.display = 'block';
			document.getElementById('progress_bar2').style.display = 'block';
		}

		return true;
	} 

	alert(err);
	return false;
}

function submit_force() {
	frm = document.getElementById('post');
	frm.ignore_mime.value = 1;
	if ( do_submit(frm) ) {
		frm.submit();
	}
}

// End -->
</script>


<!-- BASIC PUBLISHING OPTIONS -->
<div class="wrap">
<!-- iso-8859-1 -->
<form name="post" action="publish.php" method="post" id="post" 
		onLoad="this.reset();" onSubmit="return do_submit(this);" enctype="multipart/form-data" 
		accept-charset="utf-8, iso-8859-1">

	<input type="hidden" name="ignore_mime" class="hidden" value="<?php echo $ignore_mime; ?>" />
	<input type="hidden" name="post_do_save" class="hidden" value="1" />
	<input type="hidden" name="post_use_upload" class="hidden" value="0" />

	<input type="hidden" name="post_mimetype" value="<?php echo $mimetype; ?>" class="hidden">
	<input type="hidden" name="post_people" class="hidden"/>
	<input type="hidden" name="post_filehash" class="hidden" value="<?php echo $filehash; ?>"/>
<?php
	if ( isset($is_external) ) {
?>
	<input type="hidden" name="is_external" class="hidden" value="<?php echo $is_external; ?>"/>
<?php
	}
?>

<?php
	global $actual_fname;
	if ( isset($actual_fname) ) {
?>
	<input type="hidden" name="actual_fname" class="hidden" value="<?php echo $actual_fname; ?>"/>
<?php
	}
?>

<div id="poststuff">

<div class="page_name">
   <h2>Publish</h2>
   <div class="help_pop_link">
      <a href="javascript:popUp('http://www.participatoryculture.org/
bm/help/publish_popup.php')">
<img src="images/help_button.gif" alt="help"/></a>
   </div>
</div>

<?php 

global $errorstr;
global $do_mime_check;

if ( isset($errorstr) ) {
	//
	// CJM - make this much more annoying somehow so that users see it
	//
	if ( $errorstr == "404" ) {
		$errorstr = "<div id=\"file_errors\"><strong>Error: Sorry, it looks like your file isn't at the URL you specified.  <a href='javascript:submit_force();'>Click here</a> to save the file anyway.</strong></div>";
	}
	else if ( $errorstr == "SIZE" ) {
		$errorstr = "<div id=\"file_errors\">
		<strong>Error:</strong> Your file was larger than the maximum allowed size of " . ini_get("upload_max_filesize") . "<br />
		Please try posting the file as a torrent or uploading it manually, then linking to it.		
		</div>";
	}
	else if ( $errorstr == "MIME" && $do_mime_check == true ) {
		$errorstr = build_mime_chooser();
	}

	print $errorstr;
}


if (1 || $file_url == "") {

	if ( $file_url == "" ) {
		$file_url = "http://";
	}
?>

<div class="section">
<fieldset id="video_file">
<!--
<img href="#" 
	onClick="upload(); return false;" 
	style="border: 0px solid black; vertical-align: bottom;" 
	src="images/post_torrent_button.gif" border=0 alt="Post a Torrent" />
-->
<a href="#" onClick="upload(); return false;">Post a Torrent</a>
<!-- javascript explanation - hide the form widget that's not in use here -->
&nbsp;<em>or</em>&nbsp;&nbsp;<a href="#" id="specify_upload_link"
		onClick="document.getElementById('upload_file').style.display = 'block'; document.getElementById('specify_url').style.display = 'none'; return false;">Upload File</a>&nbsp;&nbsp;
		<em>or</em>
&nbsp;&nbsp;<a href="#" id="specify_url_link" 
		onClick="document.getElementById('specify_url').style.display = 'block'; document.getElementById('upload_file').style.display = 'none'; return false;">Link to a File</a>
<div <?php if ( !isset($file_url) || is_local_file($file_url) || $file_url == "http://") { echo 'style="display:none;"'; } ?> id="specify_url">
Specify URL: <input type="text" name="post_file_url" size="60" value="<?php echo $file_url; ?>" />
</div>

<div style="display:none;" id="upload_file">
<input type="file" name="post_file_upload" value="Choose File" /><br />
<strong>Please Note:</strong> Uploading files with your browser can take several minutes or longer, 
depending on the file size.  The file upload will begin when you click "Publish".  Please be patient 
and do not touch the browser while your file is uploading.  Also be aware that servers sometimes have 
a limit on the maximum size of an uploaded file.  For files larger than 2 or 3 megabytes, we generally 
recommend either posting a torrent or using an FTP program and then linking to the file.<br />
The maximum upload size on this server is <strong><?php echo ini_get("upload_max_filesize"); ?></strong>
</div>
    </fieldset>

<div 
<?php 

global $seeder;

if ( 
		! $seeder->enabled() || ! is_local_torrent($file_url)
		) echo 'style="display:none;"' ?> id="server_sharing">
<fieldset>
	<input type=checkbox name="sharing_enabled" value="1" 
<?php 
	global $settings;
	if ( $sharing_enabled || ( isset($settings["sharing_auto"]) && $settings["sharing_auto"] == 1 ) ) echo " checked"; 
?> /> Enable server sharing for this file
</fieldset>
</div>


<fieldset id="video_blurb">
<?php
if ( is_local_torrent($file_url) ) {
		$torrentfile = local_filename($file_url);
?>

<div style="color: #A00;">Sharing "<?php echo $torrentfile; ?>".<br /> 
<strong>You must keep the BM Helper window open for this file to remain available.</strong></div>

<?php
}
else if ( is_local_file($file_url) ) {
	global $actual_fname;
	if ( isset($actual_fname) && $actual_fname != "" ) {
		$filename = encode($actual_fname);
	}
	else if ( isset($file['FileName']) ) {
		$filename = $file['FileName'];
	}
	else {
		$filename = local_filename($file_url);
	}
?>

<div style="color: #A00;">Uploaded "<?php echo $filename; ?>".<br /> </div>
<input type="hidden" name="actual_fname" value="<?php echo $filename; ?>" class="hidden">

<?php
}
else {
// onClick="window.frames['uploader'].location = 'download.php?type=exe'; return false;"
// onClick="window.frames['uploader'].location = 'http://www.blogtorrent.com/demo/BM%20Helper.dmg'; return false;"
?>
		To post a torrent, you need to download Broadcast Machine 
		Helper: <a href="download.php?type=exe">Windows</a> | 
		<a href="http://www.blogtorrent.com/demo/BM%20Helper.dmg">Mac</a>
<?php
      }
?>
	</fieldset>
</div>

<iframe width="0" height="0" frameborder="0" src="" name="uploader"></iframe>
<iframe width="0" height="0" frameborder="0" src="" name="poll"></iframe>

<?php

	} 
	else {

?>

<input type="hidden" name="post_file_url" value="<?php echo $file_url; ?>" class="hidden">

<?php
	}
?>

<div class="section">

<fieldset id="channel_selection">
      <legend>Publish to These Channels</legend>

      <ul>

<?php
	foreach ($channels as $channel) {

		if ( is_admin() || $channel["OpenPublish"] ) {

			print("<li>");
						
			print("<input type=checkbox name=\"post_channels[]\" value=\"" . $channel['ID'] . "\"");
			if ( isset($channelIDs) ) {
				foreach ( $channelIDs as $channel_id ) {
					if ( $channel_id == $channel["ID"] ) {
						print(" checked=\"true\"");
						break;
					}
				}
			}

			if ($file_url != "") {

				foreach ($channel["Files"] as $list) {
					if ($list[0] == $filehash) {
						print(" checked=\"true\"");
						break;
					}
				}

			}

			print(" /> ");

			// display channel icon if we have one
			if ( isset($channel["Icon"]) && $channel["Icon"] != "" ) {
				print "<img src=\"" . $channel["Icon"] . "\" width=16 />&nbsp;";
			}

			print( $channel['Name'] . "<br/>\n");
		}
	}
?>

	    </ul>
</fieldset>


<fieldset>
<div class="the_legend">Title: </div><br /><input type="text" name="post_title" size="38" value="<?php echo $title; ?>"/>
</fieldset>

<fieldset>
       <div class="the_legend">Description (optional):</div><br /><textarea rows="4" cols="38" name="post_desc"><?php echo $desc; ?></textarea>
</fieldset>

<fieldset><div class="the_legend">Thumbnail (optional): </div>
<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div style="display:none;" id="upload_image">
<input type="file" name="post_image_upload" value="Choose Image" />
</div>


<div id="specify_image" style="display:<?php

	if ($image == "" || $image == "http://") {
		echo "none";
	} else {
		echo "block";
	}

?>;" >

<input type="text" name="post_image" size="40" value="<?php echo $image; ?>"/>

</div>
</fieldset>

<fieldset><img src="images/cc_logo_17px.png" alt="CC logo" /> Creative Commons (optional): <input type="text" name="post_license_name" size="38" value="<?php echo $license_name; ?>" onFocus="this.blur();" autocomplete="off" class="blended"/><br/>

<a href="#" onClick="window.open('http://creativecommons.org/license/?partner=bmachine&exit_url=' + escape('<?php echo get_base_url(); ?>cc.php?license_url=[license_url]&license_name=[license_name]'),'cc_window','scrollbars=yes,status=no,directories=no,titlebar=no,menubar=no,location=no,toolbar=no,width=450,height=600'); return false;"><?php

	if ($license_url == "") {
		echo "Choose";
	} else {
		echo "Change";
	}

?> License</a>

<input type="hidden" name="post_license_url" value="<?php echo $license_url; ?>" class="hidden"/>

</fieldset>
</div>


<p class="publish_button" style="clear: both;">
<input id="publish_button" style="border: 0px solid black;" type="image" src="images/publish_button.gif" border=0 alt="Continue" />
</p>

<!--
<div style="display:none;" id="progress_bar">
<img src="images/upload.gif" width="32" height="32">
<big>Please Wait...</big>
</div>
-->

<div class="section optional">
<div class="section_header">Optional: Additional Information</div>

		<fieldset id="auto_fill">
		<legend>Auto Fill</legend>
		<div style="font-size: 12px; line-height: 15px;">Automatically fill in these information fields with info from a previously published video:</div>


<SCRIPT LANGUAGE="JavaScript">
<?php
	$files = $store->getAllFiles();
	if ( is_array($files) ) {
		echo build_auto_fill($files);
	}
?>
</script>
<?php
	if ( is_array($files) ) {
		echo build_auto_select($files);
	}
?>	
		</fieldset>

    <fieldset>
      <div class="the_legend">
			Creator (can be multiple or an organization)
			</div><br />
			<input type="text" name="post_creator" size="40" value="<?php echo $creator; ?>"/>
    </fieldset>

    <fieldset>
      <div class="the_legend">Associated Donation Setup:</div> 

<select name="donation_id">
<option value="">(none)</option>
<?php
	$donations = $store->getAllDonations();
	if ( is_array($donations) ) {
		foreach($donations as $id => $donation) {
			if ( isset($donation["title"]) && isset($donation["text"]) ) {
				print("<option value=" . $id);
				if (isset($donation_id) && $donation_id == $id) {
					print(" selected=\"true\"");
				}
				print(">" . $donation["title"] . "</option>");
			} // if
		} // foreach
	}
?>
</select>

    </fieldset>

    <fieldset>
      <div class="the_legend">Copyright Holder (if different than creator)</div>
			<br />
			<input type="text" name="post_rights" size="40" value="<?php echo $rights; ?>"/>
    </fieldset>

    <fieldset>
      <div class="the_legend">Keywords / Tags (1 per line)</div>
			<br/>
			<textarea name="post_keywords" rows="4" cols="38"><?php echo $keywords; ?></textarea>
    </fieldset>

<fieldset style="clear:both" id="postdiv">
       <div class="the_legend">People Involved</div>
<div id="people_header"><table cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td width="200"><font class="the_legend">Name</font></td>
		<td width="200"><font class="the_legend">Role</font></td>
	</tr>
	</table>
</div>

<div id="people_holder"><table cellpadding="2" cellspacing="0" border="0" id="people_table">
	<tr>
		<td width="200">&nbsp;</td>
		<td width="200">&nbsp;</td>
	</tr>

<?php
	foreach ($people_array as $people_row) {
		if ( isset( $people_row[0] ) && isset( $people_row[1] ) ) {
?>
	<tr>
		<td><input type="text" name="post_people_name" value="<?php echo $people_row[0]; ?>" onKeyDown="isFull();"/></td>
		<td><input type="text" name="post_people_role" value="<?php echo $people_row[1]; ?>" onKeyDown="isFull();"/></td>
	</tr>
<?php
		}
	}
?>
	<tr>
		<td><input type="text" name="post_people_name" value="" onKeyDown="isFull();"/></td>
		<td><input type="text" name="post_people_role" value="" onKeyDown="isFull();"/></td>
	</tr>
</table>
</div>
</fieldset>

<fieldset style="clear:both" id="postdiv">

<div class="the_legend">
<a href="#" onClick="document.getElementById('transcript_upload').style.display = 'none'; document.getElementById('transcript_url').style.display = 'none'; document.getElementById('transcript_text').style.display = 'block'; return false;" style="font-weight:normal;">Enter Transcript Text</a> <em>or</em> <a href="#" onClick="document.getElementById('transcript_text').style.display = 'none'; document.getElementById('transcript_url').style.display = 'none'; document.getElementById('transcript_upload').style.display = 'block'; return false;">Upload text file</a> <em>or</em> <a href="#" onClick="document.getElementById('transcript_upload').style.display = 'none'; document.getElementById('transcript_text').style.display = 'none'; document.getElementById('transcript_url').style.display = 'block'; return false;">Specify URL</a>
</div>

<div id="transcript_text"<?php
	if ($transcript_url != "") {
		print(" style=\"display:none;\"");
	}
?>>

<textarea rows="3" cols="40" name="post_transcript_text"><?php echo $transcript_text; ?></textarea>
</div>

<div id="transcript_upload" style="display:none;">
<input type="file" name="post_transcript_file"/>
</div>

<div id="transcript_url"<?php
	if ($transcript_url == "") {
		print(" style=\"display:none;\"");
	}
?>>

<input type="text" name="post_transcript_url" size="40" value="<?php echo $transcript_url; ?>"/>
</div>
</fieldset>

<fieldset>
  <div class="the_legend">Associated Webpage </div>
	<br />
	<input type="text" name="post_webpage" size="40" value="<?php echo $webpage; ?>"/>
</fieldset>


<fieldset>Release Date
<div class="input_sub">
Day: <select name="post_release_day">
	<option value=""></option>
<?php

	for ( $i=1; $i<=31; $i++ ) {
		print("<option value=" . $i);
		if ($i == $releaseday) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");
	}

?>
</select>

&nbsp;&nbsp;Month: <select name="post_release_month">
	<option value=""></option>

<?php

	for ( $i = 0; $i < count($months); $i++ ) {

		print("<option value=" . $i);
		if ($releasemonth != "" && $i == $releasemonth) {
			print(" selected=\"true\"");
		}
		print(">" . $months[$i] . "</option>");

	}

?>
</select>

&nbsp;&nbsp;Year: <input type="text" name="post_release_year" size="4" maxlength="5" value="<?php echo $releaseyear; ?>"/>

</div>
</fieldset>

<fieldset>
Play Length

<div class="input_sub">
Hours: <input type="text" name="post_length_hours" size="2" value="<?php echo $runninghours; ?>"/> Minutes: <select name="post_length_minutes">
	<option value=""></option>
<?php

	for ( $i=0; $i < 60; $i++ ) {

		$min = str_pad($i,2,'0',STR_PAD_LEFT);

		print("<option value=" . $min);
		if ($min == $runningminutes) {
			print(" selected=\"true\"");
		}
		print(">" . $min . "</option>");
	}

?>

</select> Seconds: <select name="post_length_seconds">

	<option value=""></option>

<?php

	for ( $i=0; $i < 60; $i++ ) {

		$sec = str_pad($i,2,'0',STR_PAD_LEFT);

		print("<option value=" . $sec);
		if ($sec == $runningseconds) {
			print(" selected=\"true\"");
		}
		print(">" . $sec . "</option>");
	}

?>

</select>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="post_is_excerpt"<?php if ($excerpt) {

	print(" checked=\"true\"");

}?>/> This is an excerpt of a longer piece.

</div>
</fieldset>


<fieldset><input type="checkbox" name="post_explicit"<?php if ($explicit) {
	print(" checked=\"true\"");
}?>> Contains explicit content (some search services filter based on this).
</fieldset>

<fieldset>
Create Date

<div class="input_sub">
Will be set to the timestamp of the first time that publish the file.  
<a href="#" onClick="document.getElementById('create_time').style.display = 'block'; return false;">Manually Edit Create Date</a>
</div>

<div id="create_time" style="display:none;">
<select name="post_create_day">
<?php
	for ( $i=1; $i<=31; $i++ ) {

		print("<option value=\"" . $i . "\"");
		if ($i == $createday) {
			print(" selected");
		}
		print(">" . $i . "</option>\n");

	}
?>
</select>

<select name="post_create_month">
<?php
	for ( $i=0; $i < count($months); $i++ ) {

		print("<option value=" . $i);
		if ($i == ($createmonth-1)) {
			print(" selected=\"true\"");
		}
		print(">" . $months[$i] . "</option>");
	}
?>
</select>

<select name="post_create_year">
<?php
	for( $i=2005; $i<2026; $i++ ) {

		print("<option value=" . $i);
		if ($i == $createyear) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");
	}
?>
</select> @

<select name="post_create_hour">
<?php
	for ($i=0; $i <= 23; $i++ ) {

		print("<option value=" . $i);
		if ($i == $createhour) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");
	}

?>
</select>:<select name="post_create_minute">

<?php
	for ( $i=0; $i < 60; $i++ ) {

		$min = str_pad($i,2,'0',STR_PAD_LEFT);

		print("<option value=" . $min);
		if ($min == $createminute) {
			print(" selected=\"true\"");
		}
		print(">" . $min . "</option>");
	}
?>
</select>
</div>
</fieldset>


<fieldset>
Timestamp

<div class="input_sub">
Will be set to the time that you press 'publish'. 
<a href="#" onClick="document.getElementById('publish_time').style.display = 'block'; return false;">Manually Edit Timestamp</a>
</div>

<div id="publish_time" style="display:none;">
<select name="post_publish_day">
<?php
	for ( $i=1; $i<=31; $i++ ) {

		print("<option value=" . $i);
		if ($i == $publishday) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");

	}
?>
</select>

<select name="post_publish_month">
<?php
	for ( $i=0; $i < count($months); $i++ ) {

		print("<option value=" . $i);
		if ($i == ($publishmonth-1)) {
			print(" selected=\"true\"");
		}
		print(">" . $months[$i] . "</option>");
	}
?>
</select>

<select name="post_publish_year">
<?php
	for( $i=2005; $i<2026; $i++ ) {

		print("<option value=" . $i);
		if ($i == $publishyear) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");
	}
?>
</select> @

<select name="post_publish_hour">
<?php
	for ($i=0; $i <= 23; $i++ ) {

		print("<option value=" . $i);
		if ($i == $publishhour) {
			print(" selected=\"true\"");
		}
		print(">" . $i . "</option>");
	}

?>
</select>:<select name="post_publish_minute">

<?php
	for ( $i=0; $i < 60; $i++ ) {

		$min = str_pad($i,2,'0',STR_PAD_LEFT);

		print("<option value=" . $min);
		if ($min == $publishminute) {
			print(" selected=\"true\"");
		}
		print(">" . $min . "</option>");
	}
?>
</select>

<!--
<input type="text" name="aa" value="2004" size="4" maxlength="5" /> @
<input type="text" name="hh" value="16" size="2" maxlength="2" /> :
<input type="text" name="mn" value="41" size="2" maxlength="2" /> :
<input type="text" name="ss" value="14" size="2" maxlength="2" />
-->

</div>
</fieldset>
</div>



<p class="publish_button" style="clear: both;">
<input style="border: 0px solid black;" type="image" src="images/publish_button.gif" border=0 alt="Continue" />
</p>


<!--
<div style="display:none;" id="progress_bar2">
<img src="images/upload.gif" width="32" height="32">
<big>Please Wait...</big>
</div>
-->

</div>
</form>
<?php
bm_footer();

function build_auto_select($files) {
	global $store;

	if ( is_array($files) && count($files) > 0 ) {
		$out = '<select name="videos" onChange="autofill(this.options[this.selectedIndex].value);" >';
		$out .= '<option value=""></option>';
		foreach($files as $filehash => $file) {
			$out .= '<option value="' . $filehash . '">' . $file["Title"] . '</option>';
		}
	
		$out .= '</select>';
		return $out;
	}
}
		
function build_auto_fill($files) {

	$js = '
	function autofill(id) {
		clearPeople();
		frm = document.getElementById("post");
	';

	foreach($files as $filehash => $file) {

		$js .= '
		if ( id == "' . $filehash . '") {
		';

		if ( isset($file["Creator"]) ) {
			$js .= 'frm.post_creator.value = "' . urlencode($file["Creator"]) . '";';
		}
		else {
			$js .= 'frm.post_creator.value = "";';		
		}

		if ( isset($file["donation_id"]) ) {
			$js .= 'frm.donation_id.value = "' . $file["donation_id"] . '";';
		}
		else {
			$js .= 'frm.donation_id.value = "";';		
		}

		if ( isset($file["Rights"]) ) {
			$js .= 'frm.post_rights.value = "' . urlencode($file["Rights"]) . '";';
		}
		else {
			$js .= 'frm.post_rights.value = "";';		
		}

		if ( isset($file["Keywords"]) ) {
			$js .= 'frm.post_keywords.value = "' . urlencode(join($file["Keywords"], ' ')) . '";';
		}
		else {
			$js .= 'frm.post_keywords.value = "";';		
		}

		if ( isset($file["Webpage"]) ) {
			$js .= 'frm.post_webpage.value = "' . $file["Webpage"] . '";';
		}
		else {
			$js .= 'frm.post_webpage.value = "";';		
		}

		if ( isset($file["Explicit"]) && $file["Explicit"] == 1 ) {
			$js .= 'frm.post_explicit.checked = true;';
		}
		else {
			$js .= 'frm.post_explicit.checked = false;';
		}


		$people_array = $file['People'];
		if ( count($people_array) > 0 ) {
			foreach ($people_array as $people_row) {
				if ( isset( $people_row[0] ) && isset( $people_row[1] ) && 
						$people_row[0] != "" && $people_row[1] != "" ) {
					$js .= "addPerson('" . trim($people_row[0]) . "', '" . trim($people_row[1]) . "');";
				}
			}
		}

		$js .= "addPeople();";		

		$js .= '}';
	
	}

	$js .= '}';
	return $js;

} // build_auto_fill

function build_mime_chooser() {

//	$out = "It looks like this file might not be usable in DTV.  If this isn't a problem for you, 
//		<a href='javascript:submit_force();'>click here</a> to save the file";


	$mime_value = "video/unknown";
	$mime_options = array();
	
	$mime_options["video/unknown"] = "Video";
	$mime_options["audio/unknown"] = "Audio";
	$mime_options["application/x-bittorrent"] = "Torrent";
	$mime_options["application/octet-stream"] = "Unknown";
	
	$out = "<strong>Broadcast Machine can't figure out what kind of file this is.  Please choose an option below.</strong>
<div id=\"mime_choosers\">
This file is a :<br>";

	foreach( $mime_options as $type => $text ) {

		$out .= "<input type=\"radio\" name=\"mime_chooser\" value=\"" . $type . "\"";
		if ( $mime_value == $type ) {
			$out .= " checked";
		}
		$out .= "> $text<br />";
	}
	$out .= "<input type=\"radio\" name=\"mime_chooser\" value=\"other\" /> Other: <input type=\"text\" name=\"mime_chooser_custom\" size=\"15\" value=\"\" /> <br />";
	$out .= "</div>";

	return $out;

}

/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>