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
		$videoTags = $this->db_controller->read('video_tags', 'all');
		$channelTags = $this->db_controller->read('channel_tags', 'all');

		$this->view->assign('videoTags', $videoTags);
		$this->view->assign('channelTags', $channelTags); 
        }

        function show($name) {
		$condition = 'name="'.$name.'"';
		
		//Get arrays of channel and video ids with that tag
		$channelTags = $this->db_controller->read("channel_tags", $condition);
                $videoTags = $this->db_controller->read("video_tags", $condition);

		//Get videos and channels that are associated with each tag
                $channelTags = $this->getChannels($channelTags);
                $videoTags = $this->getVideos($videoTags);

                $this->view->assign('channelTags', $channelTags);
                $this->view->assign('videoTags', $videoTags);
                $this->display('tag-show.tpl');
        }

        // PRIVATE FUNCTIONS
        private function getChannels($tags) {
		$channels = array();
                foreach ($tags as &$tag) {
			$chanArray = $this->db_controller->read("channels", 'id="'.$tag['id'].'"');
			array_push($channels, $chanArray[0]);
                }
                unset($tag);
		$tags['channels'] = $channels;
                return $tags;
        }

	private function getVideos($tags) {
		$videos = array();
                foreach ($tags as &$tag) {
			$vidArray =  $this->db_controller->read("videos", 'id="'.$tag['id'].'"');
                        array_push($videos, $vidArray[0]);
                }
                unset($tag);
		$tags['videos'] = $videos;
                return $tags;

	}
}

?>
