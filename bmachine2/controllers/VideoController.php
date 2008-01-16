<?php

require_once('ApplicationController.php');

class VideoController extends ApplicationController
{
	// Takes on an array of url parameters and calls the correct controller functions
	// Called on instantiation
	function dispatch($params) {
	  switch($params[0]) {
	    case 'add':
	      $this->add();
	      break;
	    case 'all':
	      $this->all();
	      break;
	    default:
	      switch($params[1]) {
	        case '':
		  $this->show($params[0]);
		  break;
		case 'show':
		  $this->show($params[0]);
		  break;
		case 'edit':
		  $this->edit($params[0]);
		  break;
		case 'remove':
		  $this->remove($params[0]);
		  break;
	      }
	      break;
	  }
		
	}

	//Default function if controller is requested without any parameters
	function index() {
		$this->all();
	}

	// Shows all videos
	function all() {
		$query = "select * from videos;";
		$result = $this->db_controller->query($query);
		//Needs to get tags?
		$this->view->assign('allvideos', $result);
		$this->view->display('showallvideos.tpl');
	}
	
	// If post, inserts a new video into the database
	// If no post, brings up form for adding a new video
        function add() {

        }
	
	// Removes a video from the database
	function remove($name) {
		$query = "delete from videos where title = $name;";
		$result = $this->db_controller->query($query);
		//Add an alert and redirect to all videos?
	}
	
	// If post, updates video record in db
	// If no post, brings up an edit form
	function edit($name) {
	
	}

	function show($name) {
		$query = "select * from videos where title = $name;";
		$result = $this->db_controller->query($query);
		//There's no template for this yet...
		// $view->assign('video', $result);
		// $view->display('showvideo.tpl');
	}

	/*function VideoController($param)
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
	}*/

}

?>
