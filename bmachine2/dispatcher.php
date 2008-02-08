<?php

// Make sure that PHP complains. Turn all error reporting on.
error_reporting(E_ALL);

// Absolutely start a session. Before anything else. No matter what.
session_start();

//Include helpers
require_once('helpers/SaniHelper.php'); // Include the input sanitization helper.           
require_once('helpers/UtilityHelper.php'); // Some useful but lonely functions. 

// In case there aren't any settings yet...
if(!isset($baseDir)){ $baseDir = getcwd(); }
// Make sure there's  a trailing slash!
if(substr($baseDir, strlen($baseDir)-1, 1) != "/")
	{$baseDir = $baseDir . "/";}

// This is where the error checking happens, baby
// Also sets up correct uri array
if (!file_exists('.htaccess')) {
	//Bootstrap setup from step one
	$uri = array();
	$uri[0] = 'setup';
	$uri[1] = 'cleanurls';
} else {
	if (!file_exists('bm2_conf.php')) {
	        $uri = array();
	        $uri[0] = 'setup';
        	$uri[1] = 'database';
	} else {
		include('bm2_conf.php');
		// Grab the URI since we're all set up
		$uri = $_SERVER['REQUEST_URI'];	// Nab the current URI.
		if(strpos($uri, "index.php"))
			{$baseUri = $baseUri . "index.php";}
		$location = strpos($uri, $baseUri); // Figure out where the baseUri starts.
		if(!($location === false))
			{$uri = substr($uri, $location + strlen($baseUri)); }
		$uri = explode("/", $uri); // Translate the modified URI into an array of parameters.
		$uri = array_trim($uri);
	}
}

// Make sure special characters are escaped.
if (get_magic_quotes_gpc() == 0)
  {
    $_GET = array_addslashes($_GET);
    $_POST = array_addslashes($_POST);
    $_COOKIE = array_addslashes($_COOKIE);
  }

// Make sure special characters are escaped. 
if (get_magic_quotes_gpc() == 0) {
    $_GET = array_addslashes($_GET);
    $_POST = array_addslashes($_POST);
    $_COOKIE = array_addslashes($_COOKIE);
}

// Strip HTML tags from all input strings.
if(isset($_GET))
  {$_GET = array_strip_tags($_GET);}

if(isset($_POST))
  {$_POST = array_strip_tags($_POST);}

if(isset($_COOKIE))
  {$_COOKIE = array_strip_tags($_COOKIE);}

//Include the right ViewController
if (!isset($uri[0])) {$uri[0] = 'channel';} //Default value
require_once($baseDir.'controllers/'.ucwords($uri[0]).'Controller.php');

// The following switch block contains the main dispatcher logic.
switch ($uri[0]) {
  case 'setup':
      new SetupController($uri);
      break;
  case 'channel':
      new ChannelController($uri);
      break;
  case 'video':
      new VideoController($uri);
      break;
  case 'tag':
      New Tagcontroller($uri);
      break;
  case 'user':
      new UserController($uri);
      break;
  default:
      new ChannelController($uri);
      break;
}

?>
