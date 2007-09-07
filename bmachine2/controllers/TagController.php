<?php

require_once('ViewController.php');

class TagController extends ViewController
{
        // Takes on an array of url parameters and calls the correct controller function
        // Called on instantiation
        function dispatch($params) {
          switch($params[0]) {
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

	// Shows all tags
        function all() {
                $tags = $this->db_controller->read("channel_tags", "all");

                //Get videos and channels that are tagged with each tag
                $tags = $this->getChannels($tags);
		$tags = $this->getVideos($tags);

                //$this->view->assign('alltags', $tags);
                //$this->view->display('tag-all.tpl');
        }

        // Removes all tags with $name from the database
	function remove($name) {
		$condition = 'name="'.$name.'"';

		//Delete all channel tags
		$this->delete("channel_tags", $condition);

		//Delete all video tags
		$this->delete("video_tags", $condition);

                //Add an alert and redirect to index
                $this->view->assign('alerts', 'Tag was successfully removed from all videos and channels');
                $this->index();
        }

        function show($name) {

        }

        // PRIVATE FUNCTIONS

        // Adds tags to an array of channels (or just one)
        // Returns a fresh array of channels
        private function getChannels($tags) {
                foreach ($tags as &$tag) {
                        $name = $tag["name"];
			//Get channel names somehow
			$channels = null;
                        $tags['channels'] = $channels;
                }
                unset($tag);
                return $tags;
        }

	private function getVideos($tags) {

	}

}

?>
