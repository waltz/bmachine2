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
                $channelTags = $this->db_controller->read("channel_tags", "all");
		$videoTags = $this->db_controller->read("video_tags", "all");

                //Get videos and channels that are associated with each tag
                $channelTags = $this->getChannels($channelTags);
		$videoTags = $this->getVideos($videoTags);

		$this->view->assign('channelTags', $channelTags);
                $this->view->assign('videoTags', $videoTags);
                $this->display('tag-all.tpl');
        }

        function show($name) {

        }

        // PRIVATE FUNCTIONS
        private function getChannels($tags) {
                foreach ($tags as &$tag) {
                        $name = $tag["name"];
			
			//Get channel names somehow
			$channels = null;
                        
			$tag['channels'] = $channels;
                }
                unset($tag);
                return $tags;
        }

	private function getVideos($tags) {
                foreach ($tags as &$tag) {
                        $name = $tag["name"];

                        //Get video names somehow
			$condition = 'id="'.$tag['id'].'"';

                        $tag['video'] = $videos;
                }
                unset($tag);
                return $tags;

	}
}

?>
