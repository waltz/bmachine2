<?php

class VideoController
{
	function VideoController($param)
	{
		if($param == 'add')
		{
			$this->addVideo();
		}
		else if($param == 'edit')
		{
			$this->editVideo();
		}
		else if($param == 'remove')
		{
			$this->removeVideo();
		}
		else if($param == 'download')
		{
			$this->downloadVideo();
		}
		else
		{
			$this->viewVideo($param);
		}
	}
	
	// Add a video to the datbase or 
	function addVideo()
	{
		if(isset($_POST['video_name']) || isset($_POST['description']))
		{
			$add_query = "INSERT INTO videos(title, description, icon_url, license_name, license_url, website_url, donation_html, donation_url, release_date, runtime, adult, mime, fileurl, size) VALUES (\'$title\', \'$description\', \'$icon_url\', \'$license_name\', \'$license_url\', \'$website_url\', \'$donation_html\', \'$donation_url\', \'$release_date\', \'$runtime\', \'$adult\', \'$mime\', \'$fileurl\', \'$size\');"; 				
			$db->query($add_query);
		}
		else
		{
			$smarty->display('add.tpl');
		}
	}

    // Get video metadata
    function getVideo($id)
	{
		/*this doesn't work, please fix them before committing 		
		$video_query = "SELECT title, description, modified, icon_url, license_name, license_url, website_url, donation_url, adult, release_date, length, mime, fileurl, size, downloads FROM videos WHERE id=\'$id\';";
		return $db->getArray($db->query($video_query);
		*/
	}

	// View a video's page.
	function viewVideo($id)
	{
		// Get video.
		//fuction not defined 
		//$video = getVideo($id);
		
		/*  this doesn't work, please fix them before committing 		
		// This query grabs all of the tags associated with the video.
		//$tag_query = "SELECT name FROM video_tags WHERE id=\'$id\';";
		//$tags = $db->getArray($db->query($tag_query);
 
		// This query grabs the list of people involved with the video
		$credits_query = "SELECT name, role FROM video_credits WHERE id=\'$id;\';";
		$credits = $db->getArray($db->query($credits_query);
		*/
	}
	
	// Edit an existing video.
	function editVideo($id)
	{
		getVideo($id);
	}
	
	// Delete a video from the database.
	function removeVideo($id)
	{
		$delete_query = "DELETE FROM videos WHERE id =\'$id\';";
		$db->query($delete_query) or die ("Video was not added");		
	}

	// Download a video directly.
	function downloadVideo()
	{	
		echo 'Thanks for downloading this video!';
	}

}

?>
