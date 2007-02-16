<?php

require_once 'smarty/Smarty.class.php';

class FrontPageController
{
        // Constructor, retrieve function
        function FrontPageController()
        {
		$this->getChannels();
        }

        // Retrieve
        function getChannels()
        {
		$db = new DatabaseController();
		$channels_query = 'SELECT id, title, description, modified, icon_url, donation_html, donation_url, website_url, license_name, license_url FROM channels';
		$channel_tags_query = 'SELECT id, name FROM channel_tags;';

		$channels = $db->getArray($db->query($channels_query));
		$tags = $db->getArray($db->query($channel_tags_query));

		//Put the tags in the appropriate array
		/*foreach ($channels as $channel) 
		{
			foreach ($tags as $tag) {
				if ($tag["id"] == $channel["id"])
				{
					$channel["tags"][] = $tag["name"];
					//Uncomment this after we get unit tests:
					//unset($tags[$tag]);
				}
			}
		}*/

		$db->disconnect();

		//smaaaaaarty
		$smarty->assign('channels', $channels);


		$smarty->display('frontpage.tpl');

        }
        
}

?>

