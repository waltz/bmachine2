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
	
	// Add a video to the database, or display a blank page for adding.
	function addVideo()
	{
		if(isset($_POST['video_name']) || isset($_POST['description']))
		{
			
			$query = "INSERT INTO videos(title, description, icon_url, license_name, license_url, website_url, donation_html, donation_url, release_date, runtime, adult, mime, fileurl, size) VALUES (\'$title\', \'$description\', \'$icon_url\', \'$license_name\', \'$license_url\', \'$website_url\', \'$donation_html\', \'$donation_url\', \'$release_date\', \'$runtime\', \'$adult\', \'$mime\', \'$fileurl\', \'$size\');"; 				
			$db->query($query);
		}
		else
		{
			$smarty->display('add.tpl');
		}
	}

    // Get video metadata
	function getVideo($id)
	{
		$db = new DatabaseController();
		$video_query = 'SELECT title, description, modified, icon_url, license_name, license_url, website_url, donation_url, adult, release_date, length, mime, fileurl, size, downloads FROM videos WHERE id="$id";';
		//$result = $db->getArray($db->query($video_query));
		//return $result;
		$db->disconnect();
	}

	// View a video's page.
	function viewVideo($id)
	{ 
		$video = $this->getVideo($id);
		
		// This query grabs all of the tags associated with the video.
		$tag_query = 'SELECT name FROM video_tags WHERE id="$id\";';
		//$video_tags = $db->getArray($db->query($tag_query));
 
		// This query grabs the list of people involved with the video
		$credits_query = 'SELECT name, role FROM video_credits WHERE id="$id;";';
		//$video_credits = $db->getArray($db->query($credits_query));
	}
	
	// Edit an existing video.
	function editVideo($id)
	{
		if(isset($_POST['video_name']) || isset($_POST['description']))
                {
                  	$update_query = ""; 
                        //$db->query($update_query);
                }
                else
                {
			$smarty->assign('video', $this->getVideo($id));
                        $smarty->display('editvideo.tpl');
		}
	}
	
	// Delete a video from the database.
	function removeVideo($id)
	{
		$delete_query = 'DELETE FROM videos WHERE id ="$id";';
		$db->query($delete_query) or die ("Video was not deleted");		
	}

	// Download a video directly.
	function downloadVideo()
	{	
		echo 'Thanks for downloading this video!';
	}

}

?>
