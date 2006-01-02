<?php

/**
 * channel display page
 *
 * this page handles the frontend display of the files within a channel
 * @package Broadcast Machine
 */

require_once("include.php");
require_once("theme.php");

$channels = $store->getAllChannels();
$files = $store->getAllFiles();

//
// don't show anything here if we don't have a channel to display
//
if (isset($_GET['i'])) {
  $channel = $channels[$_GET['i']];
  $channelID = $_GET['i'];

  // check and see if this channel requires the user to login before displaying anything
  if ( isset($channel['RequireLogin']) && $channel['RequireLogin'] == true ) {
    requireUserAccess(true);
  }

	// if the user has an external LibraryURL, send them to that page here
	if ( isset($channel['LibraryURL']) && 
		! strstr($channel['LibraryURL'], get_base_url() . "library.php?i=" . $channelID) ) {

			header("Location: " . $channel['LibraryURL']);
			exit;
	}
} 
else {
  header('Location: ' . get_base_url() . 'index.php');
  exit;
}


$channel_files = $channel["Files"];

// sort our files
usort($channel_files, "comp");


front_header($channel["Name"],$channelID,$channel["CSSURL"], get_base_url() . "rss.php?i=" . $_GET["i"]);

if ($channel['Options']['Keywords'] == "1") {
  if (isset($_GET['kw'])) {
?>

<div id="show_all"><a href="<?php print channel_link($channelID); ?>">Show All Videos</a></div>
<?php
   }
?>

<div id="tags_list">
<div id="tags_title">Tags:</div>

<!-- show up 8 most popular tags -->
<?php

   $keywords = array();

  foreach ($channel_files as $filehash) {
    
    if ($filehash[1] <= time()) {

      foreach ($files[$filehash[0]]["Keywords"] as $words) {

        if ( is_array($words) ) {
          $words = $words[0];
        }
				if (!array_key_exists($words,$keywords)) {	  
					$keywords[$words] = 0;
				}

				$keywords[$words]++;

      } // foreach

    } // if

  } // foreach

  arsort($keywords);
  reset($keywords);

  $i = 0;

	if ( count($keywords) > 0 ) {
		print "<ul>\n";

		foreach ($keywords as $words => $count) {
			print("<li><a href=\"library.php?i=" . $channelID . "&amp;kw=" . urlencode($words) . "\">" . $words . "</a> (" . $count . ")</li> ");
			$i++;
		
			if ($i == 8) {
				break;
			}
		}
		print "</ul>\n";
	}
?>


<div class="spacer">&nbsp;</div>

</div> <!-- tags list -->

<?php
}
?>

<div id="video_zone">
<?php
  if (isset($_GET['kw'])) {
?>

    <div class="video_section">
    <h3 class="section_name">Files Matching &quot;<?php echo $_GET['kw']; ?>&quot;</h3>
<?php 
if ( count($channel_files) > 0 ) {
	print "<ul>\n";

	foreach ($channel_files as $filehash) {

		$filehash = $filehash[0];
		$file = $files[$filehash];

		foreach ($file["Keywords"] as $words) {
			if ($words == $_GET['kw']) {
				display_video($filehash, $file);
			}
		}

	}
	print "</ul>\n";
}
?>
		
<div class="spacer_left">&nbsp;</div>

</div>

<?php

  } 
  else {

		foreach ($channel['Sections'] as $section) {
		
			if (count($section["Files"]) > 0) {
				print("
				<div class=\"video_section\">
					<h3 class=\"section_name\">" . $section["Name"] . "</h3>
					<ul>");
		
				foreach ($section["Files"] as $filehash) {
					display_video($filehash, $files[$filehash]);
				}
		
				print("</ul>
					<div class=\"spacer_left\">&nbsp;</div></div>");
			}
		
		}


		if ( count($channel_files) > 0 ) {
			print("
	<div class=\"video_section\">
	<h3 class=\"section_name\">All Files</h3>
	<ul>
				");
	
			foreach ($channel_files as $filehash) {
				display_video($filehash[0], $files[$filehash[0]]);
			}
	
			print("
	</ul>
	<div class=\"spacer_left\">&nbsp;</div>
	</div>
			");
		}
  }

print("</div>");

front_footer($channelID);

/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>