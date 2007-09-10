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

                //$this->view->assign('allchannels', $channels);
                //$this->view->display('channel-all.tpl');
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
			
			$foo = $db_controller->create("channels", $channel);

			//Insert tags into the database
			$id = getID($channel['title']);
			foreach ($tags as $x) {
				$tag = array(
					"id" => $id,
					"name" => $x
				);
				$this->db_controller->create("channel_tags", $tag);
			}
                } else {
                        $this->view->display('channel-add.tpl');
                }
        }

        // Removes a channel from the database
	function remove($title) {
                $id = getID($title);
                $condition = 'channel_id="'.$id.'"';

                //Delete all donations associated with a channel
                $this->delete("channel_donations", $condition);

                //Delete all licenses associated with a channel
                $this->delete("channel_licenses", $condition);
		
                //Delete all tags associated with a channel
                $condition = 'id="'.$id.'"';
		$this->delete("channel_tags", $condition);

                //Delete the channel itself
                $this->delete("channels", $condition);

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
			$channel_id = getID($channel['title']);

			 //Put the tag string into an array
                        $tags = explode(" ", $channel['tags']);
                        unset($channel['tags']);

			//Update tags
			$condition = 'id="'.channel_id.'"';
			$old_tags = $this->db_controller->read("channel_tags", $condition);
			
			// If tag is in the old array, but not in the new one, delete it
			foreach ($old_tags as $old_tag) {
				if (array_search($old_tag['name'], $tags) === FALSE) {
					$condition = 'id="'.$channel_id.'" and name="'.$old_tag['name'].'"';
					$this->db_controller->delete($channel_tags, $condition);
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

			//Update channel itself
			$condition = 'id="'.$channel_id.'"';
			$update = $this->db_controller->update("channels", $channel, $condition); 

                        $this->view->assign('alerts', 'Channel was successfully edited');
                        $this->show($params[0]);
                } else {
                        $channel = $this->db_controller->read("channels", "title=$title");
                        //Get tags and channels info
                        $channel = $this->getTagsandVideos($channel);
                        //$this->view->assign('channel', $channel);
                        //$this->view->display('channel-edit.tpl');
                }

        }


        function show($title) {
                $channel = $this->db_controller->read("channels", "title=$title");
                //Get tags and video info
                $channel = $this->getTagsandVideos($channel);
                //$view->assign('channel', $channel);
                //$view->display('channel-show.tpl');
        }

        // PRIVATE FUNCTIONS

        // Adds tags and videos to an array of channels (or just one)
        // Returns a fresh array of channels
        private function getTagsandVideos($channels) {
                foreach ($channels as &$channel) {
                        $id = $channel["id"];
                        $tags = $this->db_controller->read("channel_tags", "id = $id");

			// Add published videos to each channel
			$condition = 'channel_id="'.$channel['id'].'" limit 5 sort by publish_date desc';
			$published = $this->db_controller->read("published", $condition);
			$videos = array();
			foreach ($published as $x) {
				$video_id = $x['video_id'];
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
                $channel = $this->db_controller->read("channels", "title=$title");
                if (isset($channel['id'])) {
                        return $channel['id'];
                } else {
                        return false;
                }
        }


}

?>
