<?php

require '../smarty/Smarty.class.php';

class FrontPageController
{
        // Constructor, retrieve function
        function FrontPageController()
        {
		getChannels();
        }

        // Retrieve
        function getChannels()
        {
		$channels_query = 'SELECT id, title, description, modified, icon_url, donation_html, donation_url, website_url, license_name, license_url FROM channels SORT BY id ASCENDING;';
		$channel_tags_query = 'SELECT id, name FROM channel_tags SORT BY id ASCENDING;';

		$channels = $db->getArray($db->query($video_query);

		$tags = $db->getArray($db->query($video_query);

		//smaaaaaaarty
		$smarty->assign('channels', $channels);
		$smarty->display('frontpage.tpl');
        }
        
}

?>

