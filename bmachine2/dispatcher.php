<?php

// Include the Smarty library.
require(getcwd() . '/smarty/Smarty.class.php');

// Create a new Smarty instance.
$smarty = new Smarty();

//set up all the correct paths
$smarty->template_dir = $path . '/themes/default/';
$smarty->compile_dir = $path . '/smarty/templates_c/';
$smarty->cache_dir = $path . '/smarty/cache';
$smarty->config_dir = $path . '/smarty/configs';

//assign any smarty variables and function
//THESE ARE JUST TEST VALUES, these will need to come for the DB

//required for header.tpl
$smarty->assign('title', 'My Video Blog'); 
$smarty->assign('username', 'drew');
//at this point, userprivilege can be either 'admin' or 'notadmin'
//if I figure out booleans in smarty, it might be better to change
//this to be called 'isadmin' and it can be true or false 
$smarty->assign('userprivilege', 'admin');
$smarty->assign('loggedin', 'no');
$smarty->assign('allchannels',
			array('first channel', 'second channel', 'third channel'));
$smarty->assign('maxuploadsize', '2'); //the max upload size for this server in Mb 
$smarty->assign('test', 'hello!');

$smarty->assign('allvideos',
			array(
				array('id' => '0',
					'name' => 'first video',
          		'creator' => 'xdrewxcorex',
          		'copyrightholder' => 'drew wilson', 
          		'keywords' => array('cool','awesome','internet', 'blog'),
          		'peopleinvolved' => array(
          			array(
          				'name' => 'drew',
               		'role' => 'captian of video capture'
             		),
             		array(
              			'name' => 'greg',
                  	'role' => 'senior vice chairman'
             		),
               	array(
               		'name' => 'cj', 
               		'role' => 'director'
               	)
            	),
          	'webpage' => 'http://www.yeahd00d.com',
          	'releasedate' => array(
          		'year' => '2007',
          		'month' => 'Jan',
          		'day' => '5'
          	),
          	'playlength' => array(
          		'hours' => '1',
          		'minutes' => '14',
          		'seconds' => '45'
          	),
          	'isexcerpt' => 'yes',
          	'isadult' => 'no',
          	'createdate' => array('year' => '2007',
          						'month' => 'Jan',
          						'day' => '5'
          	)
          ),
				array('id' => '1',
					'name' => 'second video',
          		'creator' => 'boner',
          		'copyrightholder' => 'boner mcgee', 
          		'keywords' => array('2keyword1','2keyword2','2keyword3'),
          		'peopleinvolved' => array(
          			array(
          				'name' => 'Cpt John',
               		'role' => 'senior admin'
             		),
             		array(
              			'name' => 'cody',
                  	'role' => 'asst'
             		)
            	),
          	'webpage' => 'http://www.video2.com',
          	'releasedate' => array(
          		'year' => '1999',
          		'month' => 'Dec',
          		'day' => '3'
          	),
          	'playlength' => array(
          		'hours' => '0',
          		'minutes' => '1',
          		'seconds' => '23'
          	),
          	'isexcerpt' => 'no',
          	'isadult' => 'yes',
          	'createdate' => array('year' => '1990',
          						'month' => 'Sep',
          						'day' => '9'
          	)
          )          
          ));




//Display template
$smarty->display('javascripts.inc');
$smarty->display('header.tpl'); 
//$smarty->display('add.tpl');
$smarty->display('addchannel.tpl');

// Include the controllers
require_once('controllers/channel_ctl.php');
require_once('controllers/video_ctl.php');
require_once('controllers/tag_ctl.php');

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
