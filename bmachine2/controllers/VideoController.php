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
		case 'download':
		  $this->download($params[0]);
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
		$videos = $this->getTagsAndChannels($videos);

		$this->view->assign('allvideos', $videos);
		$this->display('video-all.tpl');
	}
	
	// If post, inserts a new video into the database
	// If no post, brings up form for adding a new video
        function add() {
		//If data is posted, insert video into db
		if(isset($_POST['title'])) {
			$video = $_POST;

			//Put the tag string into an array
                        $tags = explode(" ", $video['tags']);
                       	unset($video['tags']);

			$this->db_controller->create("videos", $video);

			//Insert tags into the database
                        $id = $this->getID($video['title']);
                        foreach ($tags as $x) {
                                $tag = array(
                                        "id" => $id,
                                        "name" => $x
                                );
                                $this->db_controller->create("video_tags", $tag);
                        }
		} else {
			$this->display('video-add.tpl');
		}
        }
	
	// Removes a video from the database
	function remove($title) {
		$id = $this->getID($title);
		$condition = 'video_id="'.$id.'"';

		//Delete all published associations with a video 
		$this->db_controller->delete("published", $condition);

		//Delete all donations associated with a video
		$this->db_controller->delete("video_donations", $condition);

		//Delete all licenses associated with a video
		$this->db_controller->delete("video_licenses", $condition);

		//Delete all credits associated with a video
		$condition = 'id="'.$id.'"';
		$this->db_controller->delete("video_credits", $condition);

		//Delete all tags associated with a video
		$this->db_controller->delete("video_tags", $condition);

		//Delete the video itself
		$this->db_controller->delete("videos", $condition);

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
			$video = $_POST;

                        $video_id = $this->getID($video['title']);
			$condition = 'id="'.$video_id.'"';

                         //Put the tag string into an array
                        $tags = explode(" ", $video['tags']);
                        unset($video['tags']);

			//Update video 
			$this->db_controller->update('videos', $video, $condition);

			//Update tags
                        $old_tags = $this->db_controller->read("video_tags", $condition);
			
                        // If tag is in the old array, but not in the new one, delete it
                        foreach ($old_tags as $old_tag) {
                                if (array_search($old_tag['name'], $tags) === FALSE) {
                                        $condition = 'id="'.$video_id.'" and name="'.$old_tag['name'].'"';
                                        $this->db_controller->delete("video_tags", $condition);
                                }
                        }


                        foreach ($tags as $name) {
                                //Check if tag already exists
                                $condition = 'id="'.$video_id.'" and name="'.$name.'"';
                                $check = $this->db_controller->read("video_tags", $condition);
                                //If tag isn't in the database, add it
                                if (count($check) == 0) {
                                        $tag = array(
                                                "id"    => $video_id,
                                                "name"  => $name
                                        );
                                        $this->db_controller->create("video_tags", $tag);
                                }
                        }

			$this->view->assign('alerts', 'Video was successfully edited');
			$this->show($params[0]);
                } else {
			$condition = 'title="'.$title.'"';
			$vidarray = $this->db_controller->read("videos", $condition);
			
			if (count($vidarray) > 0) {
                                $video = $vidarray[0];

                                //Get tags and channels info
                                $video = $this->getTagsAndChannels($video);
                                $this->view->assign('video', $video);
                                $this->display('video-edit.tpl');
			} else {
                                $this->view->assign('alerts', "Video $title not found");
                                $this->index();
			}
                }

	}

	function show($title) {
		$condition = 'title="'.$title.'"';
		$vidarray = $this->db_controller->read("videos", $condition);
		if (count($vidarray) == 0) {
			$this->view->assign('alerts', "Video $title not found");
			$this->index();
		} else {
			$video = $vidarray[0];

			//Get tags and channels info
			$video = $this->getTagsandChannels($video);
			$this->view->assign('video', $video);
			$this->display('video-show.tpl');
		}
	}

	// Increments the download count and then calls the template to serve up the file
	function download($title) {
                $condition = 'title="'.$title.'"';
                $vidarray = $this->db_controller->read("videos", $condition);
                if (count($vidarray) == 0) {
                        $this->view->assign('alerts', "Video $title not found");
                        $this->index();
                } else {
			//Update video
			$video = $vidarray[0];
			$video['downloads']++;
                        $this->db_controller->update('videos', $video, $condition);

                        $this->view->assign('video', $vidarray[0]);
                        $this->display('video-download.tpl');
                }

	}

	// PRIVATE FUNCTIONS

	// Adds tags and channels to an array of videos (or just one)
	// Returns a fresh array of videos
	private function getTagsAndChannels($videos) {
                foreach ($videos as &$video) {
			$condition = 'id="'.$video['id'].'"';
                	$tags = $this->db_controller->read("video_tags", $condition);

			// Add published channels to each video
                        $condition = 'video_id="'.$video['id'].'" order by publish_date desc';
                        $published = $this->db_controller->read("published", $condition);
                        $channels = array();
                        foreach ($published as $x) {
                                $condition = 'id="'.$x['channel_id'].'"';
                                $channel = $this->db_controller->read("channels", $condition);
                                array_push($channels, $channel['title']);
                        }
			$video['channels'] = $channels;
                        $video['tags'] = $tags;

                }
		unset($video);
		return $videos;
	}
	
	//Returns a video id based on its title
	//Returns false if title not found
	private function getID($title) {
		$condition = 'title="'.$title.'"';
		$x = $this->db_controller->read("videos", $condition);				
		if (count($x) > 0) {
			$video = $x[0];
			return $video['id'];
		} else {
			return false;
		}
	}
}

?>
