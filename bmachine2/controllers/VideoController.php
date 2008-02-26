<?php

require_once($baseDir . 'controllers/ViewController.php');

class VideoController extends ViewController
{
	// Takes on an array of url parameters and calls the correct controller functions
	// Called on instantiation
	function dispatch($params){
	  if(!isset($params[1])){ $params[1] = ''; }
	  if(!isset($params[2])){ $params[2] = ''; }

	  switch($params[1]){
	  case '':
	    $this->all();
	    break;
	  case 'add':
	    ($this->isAdmin()) ? $this->add() : $this->forbidden();
	    break;
	  case 'all':
	    $this->all();
	    break;
	  default:
	    switch($params[2]){
	    case '':
	      $this->show($this->parse($params[1]));
	      break;
	    case 'edit':
	      ($this->isAdmin()) ? $this->edit($this->parse($params[1])) : $this->forbidden();
	      break;
	    case 'remove':
	      ($this->isAdmin()) ? $this->remove($this->parse($params[1])) : $this->forbidden();
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
	function all(){
	  $videos = $this->db_controller->read("videos", "all");
	  $videos = $this->getMultiMetaData($videos);
	  $this->view->assign('videos', $videos);
	  $this->display('video-all.tpl');
	}
	
	// Add a video.
        function add()
	{
	  // If there's POST data, try to parse it.
	  if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	      // Basic validation.
	      if($_POST['title'] == '')
		{
		  $alerts[] = 'You forgot the title!';
		  $this->view->assign('alert', $alerts);
		  $this->display('video-add.tpl');
		}
	      else if($_POST['channels'] == '')
		{
		  $alerts[] = 'Choose a channel!';
		  $this->view->assign('alert', $alerts);
		  $this->display('video-add.tpl');
		}

	      // Build the video structure.
	      $video = array('title' => $_POST['title'],
			     'description' => $_POST['description'],
			     'icon_url' => $_POST['icon_url'],
			     'file_url' => $_POST['file_url']);

	      // Create the video.
	      $this->db_controller->create('videos', $video);

	      // Grab the Video ID.
	      $id = $this->getID($video['title']);

	      // Process and add tags.
	      if($_POST['tags'] != '')
		{
		  // Parse tags into an array.
		  $tags = explode(' ', $_POST['tags']);
		  
		  foreach($tags as $x)
		    {
		      $tag = array($id, $x);
		      $this->db_controller->create('video_tags', $tag);
		    }
		}

	      // Get publishing channel list
	      $channels = (isset($_POST['channels'])) ? $_POST['channels'] : array();
	    
	      // 'Publish' (Associate a video with a set of channels.
	      $this->publish($id, $channels);
	      
	      //unset($video['channels']);
	      //Get credits information
	      //$credits = (isset($_POST['credits'])) ? $_POST['credits'] : array();
	      //unset($video['credits']);
    	      // Insert credits
	      //foreach($credits as $x)
	      //{
	      //  $credit = array($id, $x['name'], $x['role']);
	      //  $this->db_controller->create("video_credits", $credit);
	      //}

	      $this->alerts[] = 'Video was created successfully!';
	      //$this->view->assign('alerts', $alerts);
	      $this->display('video-add.tpl');
	    } 
	  else 
	    {
	      // Push a list of available channels to the template.
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
		$this->addAlert('Video was removed successfully!');
      		$this->redirect('video/all');
	}
	
	// Edit a video.
	function edit($title){
	  // If we get new data, try to add it to the database.
	  if($_SERVER['REQUEST_METHOD'] == 'POST'){
	    $video_id = $this->getID($_POST['title']);
	    $condition = 'id="'.$video_id.'"';

	    // Parse the tags.
            $tags = explode(" ", $_POST['tags']);
            
	    // Grab all selected channels.
	    $channels = (isset($_POST['channels'])) ? $_POST['channels'] : array();
            
	    //$credits = (isset($_POST['credits'])) ? $_POST['credits'] : array();
            
	    // Build the video structure.
	    $video = array('id' => $video_id,
			   'title' => $_POST['title'],
			   'description' => $_POST['description']);
	  
	    // Update the video info.
	    $this->db_controller->update('videos', $video, $condition);
			
	    // Update tags.
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
			/*
			foreach ($credits as $credit) {
                                //Check if credit already exists
				$condition = 'video_id="'.$video_id.'" and name="'.$credit['name'].'" and role="'.$credit['role'].'"';
				$check = $this->db_controller->read("video_credits", $condition);
                                //If credit isn't in the database, add it
                                if (count($check) == 0) {
                                        $this->db_controller->create("video_credits", array($video_id, $credit['name'], $credit['role']));
                                }
                        }
			*/

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

			//$alerts[] = 'Video was edited successfully';
      			//$this->edit($_POST['title']);
			$this->redirect('../../video/all');
                } else {
			$condition = 'title="'.$title.'"';
			$vidarray = $this->db_controller->read("videos", $condition);
			
			if(count($vidarray) > 0){
			  $video = $vidarray[0];
			  $video = $this->getMetaData($video);
			  $this->view->assign('video', $video);
			  $channels = $this->db_controller->read('channels', 'all');
			  //print_r($video['channels']);
			  $this->view->assign('channels', $channels);
			  $this->display('video-edit.tpl');
			} else {
				$alerts[] = "Video $title not found";
                                $this->view->assign('alerts', $alerts);
                                $this->index();
			}
                }

	}

	function show($title){
		$condition = 'title="'.$title.'"';
		$vidarray = $this->db_controller->read("videos", $condition);
		if(count($vidarray) == 0){
			$alerts[] = "Video $title not found";
                        $this->view->assign('alerts', $alerts);
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
			$alerts[] = "Video $title not found";
                        $this->view->assign('alerts', $alerts);
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

	// Get meta data for an array of videos.
	private function getMultiMetaData($videos){
	  $newarray = array();
	  foreach($videos as $video){
	    $newarray[] = $this->getMetaData($video);
	  }
	  return $newarray;
	}   

	// Gets meta data (tags, credits, channels) for some video.
	private function getMetaData($video){
	  $condition = 'video_id="' . $video['id'] . '"';
          
	  // Get the tags.
	  $tags = $this->db_controller->read("video_tags", $condition);
	  $video['tags'] = $tags;

	  // Get the credits.
	  $credits = $this->db_controller->read("video_credits", $condition);
	  $video['credits'] = $credits;

	  // Get the channels.
          $condition .= ' order by publish_date desc';
        
	  $published = $this->db_controller->read("published", $condition);
	  $channels = array();

	  foreach($published as $x){
	    $condition = 'id="'.$x['channel_id'].'"';
	    $channel = $this->db_controller->read("channels", $condition);
       	    array_push($channels, $channel[0]);
	  }

	  $video['channels'] = $channels;			
	  
	  return $video;
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

	// Takes in a video ID and a channel id (or array of channel ids)
	// and inserts them into the database.
	private function publish($video_id, $channel_ids)
	{
	  if(is_array($channel_ids))
	    {
	      foreach($channel_ids as $channel_id)
		{
		  $publish = array("channel_id"	=> $channel_id,
				   "video_id"	=> $video_id);
		  $this->db_controller->create("published", $publish);
		}
	    }
	  else
	    {
	      $publish = array('channel_id' => $channel_ids,
			       'video_id'   => $video_id);
	      $this->db_controller->create('published', $publish);
	    }
	}
}

?>
