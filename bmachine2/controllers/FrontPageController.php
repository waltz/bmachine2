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
		//$smarty->assign('channels', $channels);
		
$smarty->assign('channels', 
	array(
		array(
			'id' => '0',
			'title' => 'First Channel',
			'description' => 'This is like the best channel ever!',
			'modified' => 'Dec 12, 2006',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag1','tag2','tag3')
		),
		array(
			'id' => '1',
			'title' => 'Second Channel',
			'description' => 'second channel second channel second channel',
			'modified' => 'Oct 11, 2005',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag4','tag5')
		),
		array(
			'id' => '2',
			'title' => 'Third Channel',
			'description' => '3rd 3rd 3rd',
			'modified' => 'Jul 3, 2006',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag6','tag7','tag8','tag9','tag10','tag11','tag12','tag7','tag8','tag9','tag10','tag11','tag12')
		)
	)
); 
		
		
		$smarty->display('frontpage.tpl');

        }
        
}

?>

