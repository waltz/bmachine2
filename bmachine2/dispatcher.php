<?php

// Make sure that PHP complains. Turn all error reporting on.
error_reporting(E_ALL);

// Make sure that Broadcast Machine is installed.
// If not, start the setup controller.
if(!file_exists('settings.inc'))
{
	require_once('controllers/SetupController.php');
	new SetupController();
	exit();
}
else
{
	if(require_once('settings.inc') != "Done")
	{
		require_once('controllers/SetupController.php');
		new SetupController();
	}
}

// Include the controllers
require_once('controllers/ChannelController.php');
require_once('controllers/VideoController.php');
require_once('controllers/TagController.php');
require_once('controllers/FrontPageController.php');

/*
	Clean URI's:
	http://sample.com/video/foo_bar
	$parts = {video, foo_bar}

	Dirty URI's:
	http://sample.com/index.php/video/foo_bar
	$parts = {index.php, video, foo_bar}
*/

$url = $_SERVER['REQUEST_URI'];	/* Nab the current URI. */
$url = strip_tags($url);	/* Strip any HTML out. */
$parts = explode('/', $url);	/* Put the URI into an array. */

// If we have 'dirty' URI's, then we should strip out the index value.
if($parts[0] == 'index.php')
{
	$newparts;

	for(int i = 0; i < sizeof($parts); i++)
	{
		$newparts[i] = $parts[i + 1];
	}

	$parts = $newparts;
}

// The following if/else block contains the main dispatcher logic.

// If the first parameter is a video then the second is the name of the video.
if($param_1 == 'video')
{	
	new VideoController($param_2);
}

// If the first parameter is 'tag' then the second must be the
// user specified tag.
elseif($param_1 == 'tag')
{
	new TagController($param_2);
}

// Delegate to the user controller if the first param is 'user'.
elseif($param_1 == 'users')
{
	new UserController($param_2);
}

// Call the video controller if we get a channel and a video.
elseif(isset($param_1) && isset($param_2))
{
	new VideoController($param_2);
}

// If we only get the first parameter and no second parameter,
// we should assume that it's a channel name.
elseif($param_1 != '' && $param_2 == '')
{
	new ChannelController($param_1);
}

// If no parameters were sent, go to the all channel view.
// This is also the catch-all if something goes wrong.
else
{
	$err->emitError('Yikes!');
	//new FrontPageController();
}

?>
