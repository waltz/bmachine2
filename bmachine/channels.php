<?php
/**
 * Channel Display page
 * @package Broadcast Machine
 */

require_once("include.php");
require_once("theme.php");

if (!is_admin()) {
	header('Location: ' . get_base_url() . 'index.php');
	exit;
}

$channels = $store->getAllChannels();
bm_header();
?>



<SCRIPT LANGUAGE="JavaScript">
<!-- Idea by:  Nic Wolfe (Nic@TimelapseProductions.com) -->
<!-- Web URL:  http://fineline.xs.mw -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=600');");
}
// End -->
</script>

<div class="wrap">
<div class="page_name">
   <h2>Channels</h2>
   <div class="help_pop_link">
      <a href="javascript:popUp('http://www.participatoryculture.org/
bm/help/channels_popup.php')">
<img src="images/help_button.gif" alt="help"/></a>
   </div>
</div>


<?php



	foreach($channels as $channel) {

?>

<div class="channel_display">

	 <div class="channel_logo"><img src="<?php

	 	if ($channel['Icon'] == '') {

	 		echo "t.gif";

	 	} else {

	 		echo $channel['Icon'];

	 	}

	 ?>" width="16"/></div>

	 <div class="channel_name"><?php echo $channel['Name']; ?></div><?php

	 	if ($channel['Publisher'] != "") {

	 		print(" <div class=\"channel_publisher_name\">by " . $channel['Publisher'] . "</div>");

	 	}

	 ?>

	 <div class="channel_description"><?php echo $channel["Description"]; ?></div>


	<!-- 1225115 formatting change -->
	 <div class="channel_url"><a href="rss.php?i=<?php echo $channel["ID"]; ?>">Subscription Link</a> - <a href="<?php echo $channel["LibraryURL"];  ?>">Channel Front Page</a>

	 <div class="channel_stats"><?php if ( isset($channel["Files"]) ) { echo count($channel["Files"]); } else { echo "0"; } ?> Files</div>

	 <div class="edit_channel"><a href="create_channel.php?i=<?php echo $channel["ID"];  ?>">Edit Channel Settings</a>

	 <?php

	 	if (strstr($channel['LibraryURL'], get_base_url() . "library.php?i=" . $channel["ID"])) {

	 ?>

		 	| <a href="edit_channel.php?i=<?php echo $channel["ID"];  ?>">Edit Library Display</a>

	<?php

		}

	?> | <a href="delete.php?t=c&amp;i=<?php echo $channel["ID"];  ?>" onClick="return confirm('Are you sure you want to delete this channel?');">Delete Channel</a></div>

</div>



<div class="spacer">&nbsp;</div>



<?php

	}

?>



<Br /><Br />

<a href="create_channel.php"><img src="images/create_channel_button.gif" border="0" alt="CREATE A NEW CHANNEL" /></a>

<?php

	bm_footer();


/*
 * Local variables:
 * tab-width: 2
 * c-basic-offset: 2
 * indent-tabs-mode: nil
 * End:
 */

?>