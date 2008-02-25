<?php

require_once('ViewController.php');

class ChannelController extends ViewController
{
 
        // Takes on an array of url parameters and calls the correct controller function
        // Called on instantiation
        function dispatch($params)
	{
	  // There has to be a better way to do this...

	  /*
	   * For some channel 'foo' we can expect the following parameters:
	   * 
	   * sample.com/channel/add
	   * sample.com/channel/
	   * sample.com/channel/all
	   * sample.com/channel/foo/remove
	   * sample.com/channel/foo/edit
	   * sample.com/channel/foo
	   *
	   */

	  // If the array parameters are unset, set them.
	  if(!isset($params[1])){ $params[1] = ''; }
	  if(!isset($params[2])){ $params[2] = ''; }

	  // Yuk...
	  switch($params[1]) {
	    case '':
	      $this->all();
	      break;
	    case 'all':
	      $this->all();
	      break;
	    case 'add':
	      ($this->isAdmin()) ? $this->add() : $this->forbidden();
	      break;
	    default:
	      $params[1] = $this->parse($params[1]);
	      switch($params[2]) {
		case 'edit':
		  ($this->isAdmin()) ? $this->edit($params[1]) : $this->forbidden();
		  break;
		case 'remove':
		  ($this->isAdmin()) ? $this->remove($params[1]) : $this->forbidden();
		  break;
		case 'rss':
		  $this->rss($params[1]);
                  break;
	        default:
		  $this->show($this->parse($params[1]));
		}
	    }
	}

	//Default function if controller is requested without any parameters
        function index() {
                $this->all();
        }

	// Shows all channels
        function all() {
	  $channels = $this->db_controller->read("channels", "all");
          $channels = $this->getTagsandVideos($channels);
	  $this->view->assign('channels', $channels);
	  $this->display('channel-all.tpl');
      	}

	// Add a new channel.
	function add() {
		// If there's POST data, see if it's a new channel.
	  	if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Input validation. Make sure there's a channel name.
		      	if($_POST['title'] == '') {
				$this->alerts[] = 'You forgot to name your channel!';

				//Should assign the rest of the post variables to smarty
				foreach ($_POST as $field => $value) {
					$this->view->assign($field, $value);
				}

				$this->display('channel-add.tpl');
				return;
			} else {
				//Put the tag string into an array, strip extraneous data
		                $tags = explode(" ", $_POST['tags']); 

        		        unset($_POST['tags']); 
				unset($_POST['submit']);

				// Create the channel.
				$id = $this->db_controller->create("channels", $_POST);

				foreach($tags as $tag) {
				
					// Build the tag structure.
				      	$builtTag = array($id, $tag);

				      	// Add the tag to the database.
				      	$this->db_controller->create("channel_tags", $builtTag);
				}
			}
	      	    
		      	// TODO: This should redirect to the newly created channel.
	      
		      	// Success!
		      	$this->alerts[] = "You've got a new channel!";
		      	$this->display('channel-add.tpl');
		      	$this->show($_POST['title']);
		} else {
		      // If there's no POST data, ask the user to add a channel.
		      $this->display('channel-add.tpl');
		}
        }

        // Removes a channel from the database
	function remove($title) {
                $id = $this->getID($title);
                $condition = 'channel_id="'.$id.'"';

		//Delete all published associations with a channel
		$this->db_controller->delete("published", $condition);

                //Delete all donations associated with a channel
                $this->db_controller->delete("channel_donations", $condition);

                //Delete all licenses associated with a channel
                $this->db_controller->delete("channel_licenses", $condition);
		
                //Delete all tags associated with a channel
		$this->db_controller->delete("channel_tags", $condition);

                //Delete the channel itself
                $condition = 'id="'.$id.'"';
                $this->db_controller->delete("channels", $condition);

                //Add an alert and redirect to index
		$this->alerts[] = 'Channel was successfully removed';
                $this->index();
        }
        
	 // If post, updates channel record in db
        // If no post, brings up an edit form
        function edit($title) {
                // If new data is posted, update database
                if(isset($_POST['title'])) {
			$channel = $_POST;
			$channel_id = $this->getID($channel['title']);
			$condition = 'id="'.$channel_id.'"';

			 //Put the tag string into an array
                        $tags = explode(" ", $channel['tags']);
                        unset($channel['tags']);

                        //Update channel
                        $update = $this->db_controller->update("channels", $channel, $condition);

			//Update tags
			$condition = 'channel_id="'.$channel_id.'"';
			$old_tags = $this->db_controller->read("channel_tags", $condition);
			
			// If tag is in the old array, but not in the new one, delete it
			foreach ($old_tags as $old_tag) {
				if (array_search($old_tag['name'], $tags) === FALSE) {
					$condition = 'channel_id="'.$channel_id.'" and name="'.$old_tag['name'].'"';
					$this->db_controller->delete("channel_tags", $condition);
				}
			}
			
			
			foreach ($tags as $name) {
				//Check if tag already exists
				$condition = 'channel_id="'.$channel_id.'" and name="'.$name.'"';
				$check = $this->db_controller->read("channel_tags", $condition);
				//If tag isn't in the database, add it
				if (count($check) == 0) {
					$this->db_controller->create("channel_tags", array($channel_id, $name));
				}
			}

			$this->alerts[] = "Channel has been successfully edited";
                        $this->show($_POST['title']);
                } else {
                        $condition = 'title="'.$title.'"';
                        $chanarray = $this->db_controller->read("channels", $condition);

                        if (count($chanarray) > 0) {
                                //Get tags and video info
                                $chanarray[0]['videos'] = $this->getVideos($chanarray[0]['id']);
				$chanarray[0]['tags'] = implode(" ", $this->getTags($chanarray[0]['id']));
                                $this->view->assign('channel', $chanarray[0]);
                                $this->display('channel-edit.tpl');
                        } else {
				$this->alerts[] = "Channel $title not found";
                                $this->index();
                        }
                }

        }


        function show($title) {
		$condition = 'title="'.$title.'"';
                $chanarray = $this->db_controller->read("channels", $condition);
		if (count($chanarray) == 0) {
			$this->alerts[] = "Channel $title not found";
                        $this->index();
                } else {
		  //$channel = $chanarray;
			//print_r($channel);
                        //Get tags and channels info
                        $chanarray = $this->getTagsandVideos($chanarray);
                        $this->view->assign('channel', $chanarray[0]);
                        $this->display('channel-show.tpl');
                }
        }

        function rss($title) {
                $condition = 'title="'.$title.'"';
                $chanarray = $this->db_controller->read("channels", $condition);
                if (count($chanarray) == 0) {
                        $this->alerts[] = "Channel $title not found";
                        $this->index();
                } else {
                  //$channel = $chanarray;
                        //print_r($channel);
                        //Get tags and channels info
                        $chanarray = $this->getTagsandVideos($chanarray);
                        $this->view->assign('channel', $chanarray[0]);
                        $this->display('channel-rss.tpl');
                }
        }



        // PRIVATE FUNCTIONS
 
        // Adds tags and videos to an array of channels
        // Returns a fresh array of channels
        private function getTagsandVideos($channels) {
                foreach ($channels as &$channel) {
			//Assign tag array and video array
                        $channel['tags'] = $this->getTags($channel['id']);
			$channel['videos'] = $this->getVideos($channel['id']);
                }
                unset($channel);
                return $channels;
        }

	// Gets all tags associated with a channel
	// Returns an array of tags
	private function getTags($id) {
			$condition = 'channel_id="'.$id.'"';
                        $get = $this->db_controller->read("channel_tags", $condition);
			//Put it into a nice array
			$tags = array();
			foreach ($get as $tag) {
				$tags[] = $tag['name'];
			}
			return $tags;
	}

	// Gets all videos associated with a channel
	// Returns an array of videos
	private function getVideos($id) {
			// Get a list of published videos
                        $condition = 'channel_id="'.$id.'" order by publish_date desc limit 0,5';
                        $published = $this->db_controller->read("published", $condition);

			// Push videos onto an array one by one
                        $videos = array();
                        foreach ($published as $x) {
                                $condition = 'id="'.$x['video_id'].'"';
                                $video = $this->db_controller->read("videos", $condition);
                                array_push($videos, $video[0]);
                        }

			return $videos;
	}

        //Returns a channel id based on its title
        //Returns false if title not found
        private function getID($title) {
		$condition = 'title="'.$title.'"';
                $x = $this->db_controller->read("channels", $condition);
                if (count($x) > 0) {
                        $channel = $x[0];
                        return $channel['id'];
                } else {
                        return false;
                }
        }


}

?>
