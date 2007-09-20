<?php

require_once('ViewController.php');

class ChannelController extends ViewController
{
        // Takes on an array of url parameters and calls the correct controller function
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

	// Shows all channels
        function all() {
                $channels = $this->db_controller->read("channels", "all");

                //Get tags and videos that a channel has
                $channels = $this->getTagsandVideos($channels);

                $this->view->assign('allchannels', $channels);
                $this->display('channel-all.tpl');
        }

        // If post, inserts a new channel into the database
        // If no post, brings up form for adding a new channel
        function add() {
                //If data is posted, insert channel into db
                if(isset($_POST['title'])) {
			$channel = $_POST;

			//Put the tag string into an array
			$tags = explode(" ", $channel['tags']);
			unset($channel['tags']);
			
			$this->db_controller->create("channels", $channel);

			//Insert tags into the database
			$id = $this->getID($channel['title']);
			foreach ($tags as $x) {
				$tag = array(
					"id" => $id,
					"name" => $x
				);
				$this->db_controller->create("channel_tags", $tag);
			}
                } else {
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
		
                //Delete all credits associated with a channel
                $condition = 'id="'.$id.'"';
                $this->db_controller->delete("channel_credits", $condition);

                //Delete all tags associated with a channel
		$this->db_controller->delete("channel_tags", $condition);

                //Delete the channel itself
                $this->db_controller->delete("channels", $condition);

                //Add an alert and redirect to index
                $this->view->assign('alerts', 'Channel was successfully removed');
                $this->index();
        }
        
	 // If post, updates channel record in db
        // If no post, brings up an edit form
        function edit($title) {
                // If new data is posted, update database
                if(isset($_POST['title']))
                {
			$channel = $_POST;
			$channel_id = $this->getID($channel['title']);
			$condition = 'id="'.$channel_id.'"';

			 //Put the tag string into an array
                        $tags = explode(" ", $channel['tags']);
                        unset($channel['tags']);

                        //Update channel
                        $update = $this->db_controller->update("channels", $channel, $condition);

			//Update tags
			$old_tags = $this->db_controller->read("channel_tags", $condition);
			
			// If tag is in the old array, but not in the new one, delete it
			foreach ($old_tags as $old_tag) {
				if (array_search($old_tag['name'], $tags) === FALSE) {
					$condition = 'id="'.$channel_id.'" and name="'.$old_tag['name'].'"';
					$this->db_controller->delete("channel_tags", $condition);
				}
			}
			
			
			foreach ($tags as $name) {
				//Check if tag already exists
				$condition = 'id="'.$channel_id.'" and name="'.$name.'"';
				$check = $this->db_controller->read("channel_tags", $condition);
				//If tag isn't in the database, add it
				if (count($check) == 0) {
					$tag = array(
						"id" 	=> $channel_id,
						"name" 	=> $name
					);
					$this->db_controller->create("channel_tags", $tag);
				}
			}

                        $this->view->assign('alerts', 'Channel was successfully edited');
                        $this->show($params[0]);
                } else {
                        $condition = 'title="'.$title.'"';
                        $chanarray = $this->db_controller->read("channels", $condition);

                        if (count($chanarray) > 0) {
                                $channel = $chanarray[0];

                                //Get tags and video info
                                $channel = $this->getTagsAndVideos($channel);
                                $this->view->assign('channel', $channel);
                                $this->display('channel-edit.tpl');
                        } else {
                                $this->view->assign('alerts', "Channel $title not found");
                                $this->index();
                        }
                }

        }


        function show($title) {
		$condition = 'title="'.$title.'"';
                $chanarray = $this->db_controller->read("channels", $condition);
		if (count($chanarray) == 0) {
                        $this->view->assign('alerts', "Channel $title not found");
                        $this->index();
                } else {
                        $channel = $chanarray[0];

                        //Get tags and channels info
                        $channel = $this->getTagsandVideos($channel);
                        $this->view->assign('channel', $channel);
                        $this->display('channel-show.tpl');
                }
        }

        // PRIVATE FUNCTIONS

        // Adds tags and videos to an array of channels (or just one)
        // Returns a fresh array of channels
        private function getTagsandVideos($channels) {
                foreach ($channels as &$channel) {
			$condition = 'id="'.$channel["id"].'"';
                        $tags = $this->db_controller->read("channel_tags", $condition);

			// Add published videos to each channel
			$condition = 'channel_id="'.$channel['id'].'" order by publish_date desc limit 0,5';
			$published = $this->db_controller->read("published", $condition);

			$videos = array();
			foreach ($published as $x) {
				$condition = 'id="'.$x['video_id'].'"';
				$video = $this->db_controller->read("videos", $condition);
				array_push($videos, $video);
			}

			//Assign tag array and video array
                        $channel['tags'] = $tags;
			$channel['videos'] = $videos;
                }
                unset($channel);
                return $channels;
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
