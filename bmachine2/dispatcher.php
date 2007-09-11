<?php

// Make sure that PHP complains. Turn all error reporting on.
error_reporting(E_ALL);

// Include functions to read/write settings.
//require_once('SettingsHelper.php');

// Set the base directory and URI globals.
//global $baseDir = getSetting("baseDir");
//global $baseURI = getSetting("baseURI");

global $baseDir;

// In case there aren't any settings yet...
if(!isset($baseDir))
  {
    $baseDir = getcwd();
  }

// Make sure there's  a trailing slash!
$baseDir = $baseDir . "/";

// Include the controllers
require_once($baseDir . 'controllers/SetupController.php');
require_once($baseDir . 'controllers/ChannelController.php');
require_once($baseDir . 'controllers/VideoController.php');
require_once($baseDir . 'controllers/TagController.php');
//require_once($baseDir . 'controllers/FrontPageController.php');
require_once($baseDir . 'controllers/ViewController.php');

// Make sure that Broadcast Machine is installed.
// If not, start the setup controller.
if(!file_exists('settings.inc'))
  {
    new SetupController();
    exit();
  }

// Something needs to be done about magic quotes...
if(getSetting("MagicQuotesGPC"))
  {
    // Fix magic quotes!
  }

if(getSetting("MagicQuotesRuntime"))
  {
    // Again... fix 'em.
  }

/*
	Clean URI's:
	http://sample.com/video/foo_bar
	$parts = {video, foo_bar}

	Dirty URI's:
	http://sample.com/index.php/video/foo_bar
	$parts = {index.php, video, foo_bar}
*/

$uri = $_SERVER['REQUEST_URI'];	/* Nab the current URI. */
$uri = strip_tags($uri);	/* Strip any HTML out. */
$uri = explode('/', $uri);	/* Put the URI into an array. */

// If we have 'dirty' URI's, then we should strip out the index value.
if($uri[0] == 'index.php')
{
	$new_uri;

	for($i = 0; $i < sizeof($uri); $i++)
	{
		$new_uri[$i] = $uri[$i + 1];
	}

	$uri = $new_uri;
}

// The following if/else block contains the main dispatcher logic.

if($uri[0] == 'setup')
{
  new SetupController($uri);
 }
// If the first parameter is a video then the second is the name of the video.
if($uri[0] == 'video')
{	
	new VideoController($uri);
}

// If the first parameter is 'tag' then the second must be the
// user specified tag.
elseif($uri[0] == 'tag')
{
	new TagController($uri);
}

// Delegate to the user controller if the first param is 'user'.
elseif($uri[0] == 'users')
{
	new UserController($uri);
}

// Call the video controller if we get a channel and a video.
/*elseif(isset($param_1) && isset($param_2))
{
	new VideoController($uri);
	}

// If we only get the first parameter and no second parameter,
// we should assume that it's a channel name.
elseif($param_1 != '' && $param_2 == '')
{
	new ChannelController($param_1);
}
*/
// If no parameters were sent, go to the all channel view.
// This is also the catch-all if something goes wrong.
else
{
	$err->emitError('Yikes!');
	//new FrontPageController();
}

?>
