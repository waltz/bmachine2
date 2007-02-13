<?php

class VideoController
{
	// Constructor, retrieve function
	function VideoController($param_2)
	{
		
	}
	
	// Create
	function addVideo()
	{
		$add_query = "INSERT INTO videos(title, description, icon_url, license_name, license_url, website_url, donation_html, donation_url, release_date, runtime, adult, mime, fileurl, size) VALUES (\'$title\', \'$description\', \'$icon_url\', \'$license_name\', \'$license_url\', \'$website_url\', \'$donation_html\', \'$donation_url\', \'$release_date\', \'$runtime\', \'$adult\', \'$mime\', \'$fileurl\', \'$size\');"; 				
		$db->query($add_query) or die ("Video was not added");
	}

        // Get video metadata
        function getVideo($id) {
                $video_query = "SELECT title, description, modified, icon_url, license_name, license_url, website_url, donation_url, adult, release_date, length, mime, fileurl, size, downloads FROM videos WHERE id=\'$id\';";
		return $db->getArray($db->query($video_query);
        }

	// View a Video Page
	function viewVideo($id)
	{
		//Get video
		$video = getVideo($id);
		//This query grabs all of the tags associated with the video
		$tag_query = "SELECT name FROM video_tags WHERE id=\'$id\';";
		$tags = $db->getArray($db->query($tag_query);

		//This query grabs the list of people involved with the video
		$credits_query = "SELECT name, role FROM video_credits WHERE id=\'$id;\';";
		$credits = $db->getArray($db->query($credits_query);
	}
	
	// Update
	function editVideo($id)
	{
		getVideo($id);

	}
	
	// Delete
	function removeVideo($id)
	{
		$delete_query = "DELETE FROM videos WHERE id =\'$id\';";
		$db->query($delete_query) or die ("Video was not added");		
	}

	function downloadVideo()
	{
		

	}

}

?>
