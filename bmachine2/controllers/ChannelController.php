<?php


class ChannelController
{
	// Constructor, retrieve function
	function ChannelController($param_2)
	{
		echo 'hello';
	}
	
	// Create
	function addChannel()
	{
		$add_query = 'INSERT INTO channels(title, description, modified, icon_url) VALUES ($title, $description, $modified, $icon_url);';

	}

	// Retrieve
	function viewChannel($id)
	{
		$channel_query = 'SELECT id, title, description, modified, icon_url, donation_html, donation_url, website_url, license_name, license_url FROM channels where id="$id";';
		$channel = $db->getArray($db->query($channel_query));
	}
	
	// Update
	function editChannel($id)
	{
		echo 'hello';		
	}
	
	// Delete
	function removeChannel($id)
	{
		$delete_query = 'DELETE FROM channels WHERE id="$id";';
	}

}

?>
