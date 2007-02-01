<?php

require '../smarty/Smarty.class.php';

class VideoController
{
	// Constructor, retrieve function
	function VideoController($param_2)
	{
		
	}
	
	// Create
	function addVideo()
	{
				
	}

	// View a Video Page
	function viewVideo($id)
	{
		//This query gets all of the video metadata
		$video_query = "SELECT title, description, modified, icon, license_name, license_url, website_url, donation_url, release_date, length, adult, mime, fileurl, size, downloads FROM videos WHERE id=\'$id\';";
		//This query grabs all of the tags associated with the video
		$tag_query = "SELECT name FROM video_tags WHERE id=\'$id\';";
		//This query grabs the list of people involved with the video
		$credits_query = "SELECT name, role FROM video_credits WHERE id=\'$id;\'";
	}
	
	// Update
	function editVideo()
	{
		
	}
	
	// Delete
	function removeVideo()
	{
		
	}

}

?>
