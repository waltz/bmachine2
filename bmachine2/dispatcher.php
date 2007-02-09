<?php

//Setup smarty
//set absolute server path. this is the current directory
$path = getcwd();


//include the smarty library
require($path . '/smarty/Smarty.class.php');

//create a new instance
$smarty = new Smarty();

//set up all the correct paths
$smarty->template_dir = $path . '/themes/default/';
$smarty->compile_dir = $path . '/smarty/templates_c/';
$smarty->cache_dir = $path . '/smarty/cache';
$smarty->config_dir = $path . '/smarty/configs';

//assign any smarty variables and function
//THESE ARE JUST TEST VALUES, these will need to come for the DB

//required for header.tpl
$smarty->assign('title', 'Broadcast Machine'); 
$smarty->assign('username', 'drew');
//at this point, userprivilege can be either 'admin' or 'notadmin'
//if I figure out booleans in smarty, it might be better to change
//this to be called 'isadmin' and it can be true or false 
$smarty->assign('userprivilege', 'admin');
$smarty->assign('loggedin', 'no');
$smarty->assign('allchannels',
			array('first channel', 'second channel', 'third channel'));
$smarty->assign('maxuploadsize', '2'); //the max upload size for this server in Mb
$smarty->assign('allvideos',
			array('first video', 'second video', 'third video'));

//Display template
$smarty->display('javascripts.inc');
$smarty->display('header.tpl'); 
$smarty->display('add.tpl');


// Add Smarty to the PHP include path.
//set_include_path(get_include_path() . ':smarty');

// Include the controllers
require_once ('controllers/channel_ctl.php');
require_once ('controllers/video_ctl.php');
require_once ('controllers/tag_ctl.php');

// Grab the parameters.
$get_params = $_GET['params'];

// Parse out the parameters.
$param_1 = strtok($parameters, '/');
$param_2 = strtok('/');
$param_3 = strtok('/');

// If the first parameter is a video then the second is the name
// of the video.
if($param_1 == 'video')
{
	new video_ctl($param_2);
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

// If no parameters were sent, go to the default channel.
// This is also the catch-all if something goes wrong.
else
{
	new ChannelController();
}

?>
