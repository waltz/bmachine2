<?php

// Include the Smarty library.
$path = getcwd();
require($path . '/smarty/Smarty.class.php');

// Create a new Smarty instance.
$smarty = new Smarty();

// Configure Smarty include paths.
$smarty->template_dir = $path . '/themes/default/';
$smarty->compile_dir = $path . '/smarty/templates_c/';
$smarty->cache_dir = $path . '/smarty/cache/';
$smarty->config_dir = $path . '/smarty/configs/';

// Include the controllers 
include 'controllers/DatabaseController.php';
include 'controllers/ChannelController.php';
include 'controllers/VideoController.php';
include 'controllers/TagController.php';
include 'controllers/FrontPageController.php';

// Grab the parameters.
//$parameters = $_GET['params'];
$navString = $_SERVER['REQUEST_URI'];
$parts = explode('/', $navString);

// Parse out the parameters.
//$param_1 = strtok($parameters, '/');
//$param_2 = strtok('/');
//$param_3 = strtok('/');
$param_1 = $parts['2'];
echo $param_1;
$param_2 = $parts['3'];
$param_3 = $parts['4'];

//Instantiate DatabaseController
$db = new DatabaseController();

// If the first parameter is a video then the second is the name
// of the video.
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
elseif(isset($param_1) && !isset($param_2))
{
	new ChannelController($param_1);
}

// If no parameters were sent, go to the all channel view.
// This is also the catch-all if something goes wrong.
else
{
	new FrontPageController();
}
new FrontPageController();
?>
