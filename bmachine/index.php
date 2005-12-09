<?php
/**
 * Broadcast Machine index page
 * @package Broadcast Machine
 */

require_once("include.php");
require_once("theme.php");

global $settings;

if ($settings["DefaultChannel"] != "") {
  header('Location: ' . channel_link($settings["DefaultChannel"]) );
  exit;
}


$channels = $store->getAllChannels();
$files = $store->getAllFiles();


front_header("Channel List");

print("<div id=\"video_zone\">");

foreach ($channels as $channel) {
	if ( ! isset($channel["NotPublic"]) || ! $channel["NotPublic"] || valid_user() ) {
?>

<div class="video_section">
<h3 class="section_name"><a href="<?php echo channel_link($channel["ID"]); ?>"><?php echo $channel["Name"]; ?></a> 
<a href="rss.php?i=<?php echo $channel["ID"]; ?>"><img src="images/rss_button.gif" alt="rss feed" width="20" height="9" style="border: 0" /></a></h3>

<?php 
$channel_files = $channel["Files"];

if ( count($channel_files) > 0 ) {
?>
  <ul>
<?php

 usort($channel_files, "comp");
 $i=0;

	foreach ($channel_files as $file_arr) {
		$filehash = $file_arr[0];
		if ( isset($files[$filehash]) ) {
			$file = $files[$filehash];
		
			if ($file["Publishdate"] <= time()) {
				display_video($filehash, $file);
				$i++;
			}
		}
	
		if ($i == 3) {
		 break;
		}
	}
?>
</ul>
<?php
}
?>

<div class="spacer_left">&nbsp;</div>
<div class="channel_more">
<a href="<?php echo channel_link($channel["ID"]); ?>"><?php echo count($channel_files); ?> videos in this channel &gt;&gt;</a>
</div>

</div>

<?php
	} // if
} // foreach

print("</div>");

front_footer();

/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>