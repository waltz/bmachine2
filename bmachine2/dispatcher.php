<?php

// Make sure that PHP complains. Turn all error reporting on.
error_reporting(E_ALL);

// Include the configuration.
include('bm2.conf');

require_once('helpers/SaniHelper.php'); // Include the input sanitization helper.
require_once('helpers/UtilityHelper.php'); // Some useful but lonely functions.

// Make sure special characters are escaped.
if(get_magic_quotes_gpc() == 0)
  {
    $_GET = array_addslashes($_GET);
    $_POST = array_addslashes($_POST);
    $_COOKIE = array_addslashes($_COOKIE);
  }

// Strip HTML tags from all input strings.
if(isset($_GET))
  {
    $_GET = array_strip_tags($_GET);
  }

if(isset($_POST))
  {
    $_POST = array_strip_tags($_POST);
  }

if(isset($_COOKIE))
  {
    $_COOKIE = array_strip_tags($_COOKIE);
  }

// Include a helper for reading/writing settings pairs.
require_once('helpers/SettingsHelper.php');

// Set the base directory and URI globals.
global $baseDir;
$baseDir = getSetting("baseDir");
global $baseURI;
$baseDir = getSetting("baseURI");

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
    new SetupController(NULL);
    exit();
  }


/*
 else if(getSetting("SetupStatus") != "Complete")
   {
    
     new SetupController(NULL);
     exit();
   }
*/

//echo(getSetting("SetupStatus"));

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
	Test Cases:

	Given: http://sample.com/video/foo/bar
	Returns: video,foo,bar
	
	http://sample.com/index.php/video/foo/
	video, foo

	http://sample.com/index.php
	(void)
	
	http://sample.com/index.php/
	(void)
*/

$uri = $_SERVER['REQUEST_URI'];	// Nab the current URI.

if(strpos($uri, "index.php"))
{
    $baseUri = $baseUri . "index.php";
}

//echo("uri: " . $uri . "<br>"); // Debug.
//echo("baseUri: " . $baseUri . "<br>"); // Debug.

$location = strpos($uri, $baseUri); // Figure out where the baseUri starts.

//echo("location: " . $location . "<br>"); // Debug.

if(!($location === false))
{
  //echo("Found the substring.<br>"); // Debug.
  $uri = substr($uri, $location + strlen($baseUri));  
}

//echo("Final uri: " . $uri . "<br>"); // Debug.

$uri = explode("/", $uri); // Translate the modified URI into an array of parameters.
$uri = array_trim($uri);

//print_r($uri); echo("<br>"); exit; // Debug.

// The following if/else block contains the main dispatcher logic.

// For the setup controller...
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

// Defaults to the Channel controller.
else
{
  new ChannelController($uri);
}

?>
