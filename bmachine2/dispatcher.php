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
	require_once('settings.inc');
}

// Include the controllers
require_once('controllers/DatabaseController.php');
require_once('controllers/AuthenticationController.php');
require_once('controllers/ChannelController.php');
require_once('controllers/VideoController.php');
require_once('controllers/TagController.php');
require_once('controllers/FrontPageController.php');
require_once('controllers/AlertController.php');

// See what URL we are being passed and parse it out.
$url = $_SERVER['REQUEST_URI'];
$url = strip_tags($url);
$parts = explode('/', $url);

foreach($parts as $part)
{
	$params[($i + 1)] = $part;
	$i++;
}
 
// Include the Smarty library.
$path = getcwd();
require_once($path . '/smarty/Smarty.class.php');

// Create a new Smarty instance.
global $smarty;
$smarty = new Smarty();

// Configure Smarty include paths.
$smarty->template_dir = $path . '/themes/default/';
$smarty->compile_dir = $path . '/smarty/templates_c/';
$smarty->cache_dir = $path . '/smarty/cache/';
$smarty->config_dir = $path . '/smarty/configs/';

// Instantiate the Database and Authentication controllers.
global $db;
$db = new DatabaseController();

global $auth;
$auth = new AuthenticationController();

global $alert;
$alert = new AlertController();

// Construct the '$params' array.


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
