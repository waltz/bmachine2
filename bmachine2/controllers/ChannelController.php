<?php

class ChannelController
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

                //Get tags and channels that a channel belongs to
                $channels = $this->getTags($channels);

                //$this->view->assign('allchannels', $channels);
                //$this->view->display('channel-all.tpl');
        }

        // If post, inserts a new channel into the database
        // If no post, brings up form for adding a new channel
        function add() {
                //If data is posted, insert channel into db
                if(isset($_POST['title'])) {

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
                        //Update the channel in the database
                        $this->view->assign('alerts', 'Channel was successfully edited');
                        $this->show($params[0]);
                } else {
                        $channel = $this->db_controller->read("channels", "title=$title");
                        //Get tags and channels info
                        $channel = $this->getTags($channel);
                        //$this->view->assign('channel', $channel);
                        //$this->view->display('channel-edit.tpl');
                }

        }


        function show($title) {
                $channel = $this->db_controller->read("channels", "title=$title");
                //Get tags and channels info
                $channel = $this->getTags($channel);
                //$view->assign('channel', $channel);
                //$view->display('channel-show.tpl');
        }

        // PRIVATE FUNCTIONS

        // Adds tags to an array of channels (or just one)
        // Returns a fresh array of channels
        private function getTags($channels) {
                foreach ($channels as &$channel) {
                        $id = $channel["id"];
                        $tags = $this->db_controller->read("channel_tags", "id = $id");
                        $channel['tags'] = $tags;
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
