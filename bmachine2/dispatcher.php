<?php

// Include the controllers
require_once 'controllers/channel_ctl.php';
require_once 'controllers/video_ctl.php';
require_once 'controllers/tag_ctl.php';

// Grab the parameters.
var get_parameters = $_GET[1];

// Parse out the parameters.
var param_1 = strtok($parameters, '/');
var param_2 = strtok('/');
var param_3 = strtok('/');

// If the first parameter is a video then the second is the name
// of the video.
if(param_1 == 'video')
{
	new video_ctl(param_2);
}

// If the first parameter is 'tag' then the second must be the
// user specified tag.
else if(param_1 == 'tag')
{
	new tag_ctl(param_2);
}

// Delegate to the user controller if the first param is 'user'.
else if(param_1 == 'users')
{
	new users_ctl(param_2);
}

// Call the video controller if we get a channel and a video.
else if(isset(param_1) && isset(param_2)){
	new video_ctl(param_2);
}

// If we only get the first parameter and no second parameter,
// we should assume that it's a channel name.
else if(isset(param_1) && !isset(param_2)){
	new channel_ctl(param_1);
}

// If no parameters were sent, go to the default channel.
// This is also the catch-all if something goes wrong.
else(!isset(get_parameters)){
	new channel_ctl();
}

?>
