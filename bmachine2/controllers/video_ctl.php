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
	}

	// View a Video Page
	function viewVideo($id)
	{
		//This query gets all of the video metadata
		$video_query = "SELECT title, description, modified, icon_url, license_name, license_url, website_url, donation_url, adult, release_date, length, mime, fileurl, size, downloads FROM videos WHERE id=\'$id\';";
		//This query grabs all of the tags associated with the video
		$tag_query = "SELECT name FROM video_tags WHERE id=\'$id\';";
		//This query grabs the list of people involved with the video
		$credits_query = "SELECT name, role FROM video_credits WHERE id=\'$id;\';";
	}
	
	// Update
	function editVideo()
	{
		//This query gets all of the video metadata
                $video_query = "SELECT title, description, modified, icon_url, license_name, license_url, website_url, donation_url, adult, release_date, length, mime, fileurl, size, downloads FROM videos WHERE id=\'$id\';";

	}
	
	// Delete
	function removeVideo($id)
	{
		$delete_query = "DELETE FROM videos WHERE id =\'$id\';";
	}

	function downloadVideo()
	{
		

	}

}

?>
