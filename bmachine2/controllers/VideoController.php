<?php

require_once($baseDir . 'controllers/ViewController.php');

class VideoController extends ViewController
{
	// Takes on an array of url parameters and calls the correct controller functions
	// Called on instantiation
	function dispatch($params) {
	  switch($params[0]) {
	    case 'add':
	      ($this->isAdmin()) ? $this->add() : $this->forbidden();
	      break;
	    case 'all':
	      $this->all();
	      break;
	    default:
		$params[0] = $this->parse($params[0]);
	      	switch($params[1]) {
	        case '':
		  $this->show($params[0]);
		  break;
		case 'show':
		  $this->show($params[0]);
		  break;
		case 'edit':
                  ($this->isAdmin()) ? $this->edit($params[0]) : $this->forbidden();
		  break;
		case 'remove':
                  ($this->isAdmin()) ? $this->remove($params[0]) : $this->forbidden();
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
		$videos = $this->getMetaData($videos);

		$this->view->assign('videos', $videos);
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

			//Get publishing channel list
			$channels = (isset($_POST['channels'])) ? $_POST['channels'] : array();
                        unset($video['channels']);

			//Get credits information
                        $credits = (isset($_POST['credits'])) ? $_POST['credits'] : array();
                        unset($video['credits']);

			$this->db_controller->create("videos", $video);

			//Insert tags into the database
                        $id = $this->getID($video['title']);
                        foreach ($tags as $x) {
                                $tag = array($id, $x);
                                $this->db_controller->create("video_tags", $tag);
                        }

			//Insert publishing data
			$this->publish($id, $channels);

			//Insert credits
			foreach ($credits as $x) {
				$credit = array($id, $x['name'], $x['role']);
				$this->db_controller->create("video_credits", $credit);
			}

			$this->view->assign('alerts', 'Video successfully created');
			$this->show($video['title']);
		} else {
			//Get list of available channels
			$channels = $this->db_controller->read('channels', 'all');
			$this->view->assign('channels', $channels);

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
		$this->db_controller->delete("video_credits", $condition);

		//Delete all tags associated with a video
		$this->db_controller->delete("video_tags", $condition);

		//Delete the video itself
		$condition = 'id="'.$id.'"';
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
                        $video_id = $this->getID($_POST['title']);
			$condition = 'id="'.$video_id.'"';

                         //Put the tag string into an array
                        $tags = explode(" ", $_POST['tags']);
                        unset($_POST['tags']);

                        $channels = (isset($_POST['channels'])) ? $_POST['channels'] : array();
                        unset($_POST['channels']);

			$credits = (isset($_POST['credits'])) ? $_POST['credits'] : array();
                        unset($_POST['credits']);


			//Update video 
			$this->db_controller->update('videos', $_POST, $condition);
			

			//Update tags
			$condition = 'video_id="'.$video_id.'"';
                        $old_tags = $this->db_controller->read("video_tags", $condition);
			
                        // If tag is in the old array, but not in the new one, delete it
                        foreach ($old_tags as $old_tag) {
                                if (array_search($old_tag['name'], $tags) === FALSE) {
                                        $condition = 'video_id="'.$video_id.'" and name="'.$old_tag['name'].'"';
                                        $this->db_controller->delete("video_tags", $condition);
                                }
                        }

                        foreach ($tags as $name) {
                                //Check if tag already exists
                                $condition = 'video_id="'.$video_id.'" and name="'.$name.'"';
                                $check = $this->db_controller->read("video_tags", $condition);
                                //If tag isn't in the database, add it
                                if (count($check) == 0) {
                                        $this->db_controller->create("video_tags", array($video_id, $name));
                                }
                        }

			// Update credits
			$old_credits = $this->db_controller->read('video_credits', 'video_id="'.$video_id.'"');
			//If credit is in the old array, but not the new one, delete it
			foreach ($old_credits as $old_credit) {
					unset($old_credit['video_id']);
					if (array_search($old_credit, $credits) === false) {
	                                        $condition = 'video_id="'.$video_id.'" and name="'.$old_credit['name'].'" and role="'.$old_credit['role'].'"';
        	                                $this->db_controller->delete("video_credits", $condition);
                                }
			}

			foreach ($credits as $credit) {
                                //Check if credit already exists
				$condition = 'video_id="'.$video_id.'" and name="'.$credit['name'].'" and role="'.$credit['role'].'"';
				$check = $this->db_controller->read("video_credits", $condition);
                                //If credit isn't in the database, add it
                                if (count($check) == 0) {
                                        $this->db_controller->create("video_credits", array($video_id, $credit['name'], $credit['role']));
                                }
                        }


                        //Update publishing information
			$condition = 'video_id="'.$video_id.'"';
                        $old_publish = $this->db_controller->read("published", $condition);
			// If channel used to be published, but isn't now, delete it
			foreach ($old_publish as $old_channel) {
				if (array_search($old_channel['channel_id'], $channels) === FALSE) {
                                        $condition = 'video_id="'.$video_id.'" and channel_id="'.$old_channel['channel_id'].'"';
                                        $this->db_controller->delete("published", $condition);
                                }

			}

                        foreach ($channels as $channel_id) {
                                //Check if publishing data already exists
                                $condition = 'video_id="'.$video_id.'" and channel_id="'.$channel_id.'"';
                                $check = $this->db_controller->read("published", $condition);
                                //If publishing data isn't in the database, add it
                                if (count($check) == 0) {
                                        $published = array(
                                                "video_id"    => $video_id,
                                                "channel_id"  => $channel_id
                                        );
                                        $this->db_controller->create("published", $published);
                                }
                        }

			$this->view->assign('alerts', 'Video was successfully edited');
			$this->show($title);
                } else {
			$condition = 'title="'.$title.'"';
			$vidarray = $this->db_controller->read("videos", $condition);
			
			if (count($vidarray) > 0) {
                                $video = $vidarray[0];

                                //Get tags and channels info
                                $video = $this->getMetaData($video);
                                $this->view->assign('video', $video);

				$channels = $this->db_controller->read('channels', 'all');
				$this->view->assign('channels', 'channels');

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
			$video = $this->getMetaData($video);
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

	// Adds tags, credits, and channels to an array of videos (or just one)
	// Returns a fresh array of videos
	private function getMetaData($videos) {
                foreach ($videos as &$video) {
			$condition = 'video_id="'.$video['id'].'"';
                	
			$tags = $this->db_controller->read("video_tags", $condition);
                        $video['tags'] = $tags;

			$credits = $this->db_controller->read("video_credits", $condition);
			$video['credits'] = $credits;

			// Add published channels to each video
                        $condition .= ' order by publish_date desc';
                        $published = $this->db_controller->read("published", $condition);
                        $channels = array();
                        foreach ($published as $x) {
                                $condition = 'id="'.$x['channel_id'].'"';
                                $channel = $this->db_controller->read("channels", $condition);
                                array_push($channels, $channel['title']);
                        }
			$video['channels'] = $channels;			
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

	//Takes a single video id and an array of channel ids and
	//inserts publishing associations into the database
	private function publish($video_id, $channel_ids) {
		foreach ($channel_ids as $channel_id) {
			$publish = array(
				"channel_id" 	=>	$channel_id,
				"video_id"	=>	$video_id
			);
			$this->db_controller->create("published", $publish);
		}
	}
}

?>
