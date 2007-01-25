<?php

// Include the controllers
require_once "channel_cntrl.php"
require_once "video_cntrl.php"
require_once "tag_cntrl.php"

// Grab the parameters.
var get_parameters = $_GET[1];

// Parse out the parameters.
var param_1 = strtok($parameters, "/");
var param_2 = strtok("/");
var param_3 = strtok("/");

// If we only get the first parameter and no second parameter,
// we should assume that it's a channel name.
if(isset(param_1) && !isset(param_2)){
	new channel_cntrl(param_1);
}

// Call the video controller if we get a channel and a video.
if(isset(param_1) && isset(param_2)){
	new video_cntrl(param_2);
}

// If the first parameter is a video then the second is the name
// of the video.
else if((param_1 == "video") && isset(param_2)){
	new video_cntrl(param_2);
}

// If the first parameter is "tag" then the second must be the
// user specified tag.
else if((param_1 == "tag") && isset(param_2)){
	new tag_cntrl(param_2);
}

// If no parameters were sent, go to the default channel.
// This is also the catch-all if something goes wrong.
else(!isset(get_parameters)){
	new channel_cntrl();
}

?>
