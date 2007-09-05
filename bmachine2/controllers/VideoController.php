<?php

require_once('ViewController.php');

class VideoController extends ViewController
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
		$videos = $this->db_controller->read("videos", "all");

		//Get tags and channels that a video belongs to
		$videos = $this->getTags($videos);

		//$this->view->assign('allvideos', $videos);
		//$this->view->display('video-all.tpl');
	}
	
	// If post, inserts a new video into the database
	// If no post, brings up form for adding a new video
        function add() {
		//If data is posted, insert video into db
		if(isset($_POST['title'])) {

		} else {
			$this->view->display('video-add.tpl');
		}
        }
	
	// Removes a video from the database
	function remove($title) {
		$id = getID($title);
		$condition = 'video_id="'.$id.'"';

		//Delete all donations associated with a video
		$this->delete("video_donations", $condition);

		//Delete all licenses associated with a video
		$this->delete("video_licenses", $condition);

		//Delete all credits associated with a video
		$condition = 'id="'.$id.'"';
		$this->delete("video_credits", $condition);

		//Delete all tags associated with a video
		$this->delete("video_tags", $condition);

		//Delete the video itself
		$this->delete("videos", $condition);

		//Add an alert and redirect to index
		$this->view->assign('alerts', 'Video was successfully removed');
		$this->index();
	}
	
	// If post, updates video record in db
	// If no post, brings up an edit form
	function edit($title) {
		// If new data is posted, update database
		if(isset($_POST['title']))
                {
			//Update the video in the database
			$this->view->assign('alerts', 'Video was successfully edited');
			$this->show($params[0]);
                } else {
			$video = $this->db_controller->read("videos", "title=$title");
	                //Get tags and channels info
        	        $video = $this->getTags($video);
			//$this->view->assign('video', $video);
			//$this->view->display('video-edit.tpl');
                }

	}

	function show($title) {
		$video = $this->db_controller->read("videos", "title=$title");
		//Get tags and channels info
		$video = $this->getTags($video);
		//$view->assign('video', $video);
		//$view->display('video-show.tpl');
	}

	// PRIVATE FUNCTIONS

	// Adds tags to an array of videos (or just one)
	// Returns a fresh array of videos
	private function getTags($videos) {
                foreach ($videos as &$video) {
                	$id = $video["id"];
                	$tags = $this->db_controller->read("video_tags", "id = $id");
                        $video['tags'] = $tags;
                }
		unset($video);
		return $videos;
	}
	
	//Returns a video id based on its title
	//Returns false if title not found
	private function getID($title) {
		$video = $this->db_controller->read("videos", "title=$title");
		if (isset($video['id'])) {
			return $video['id'];
		} else {
			return false;
		}
	}
}

?>
