<?php
/* temp
// Include the controllers
require_once('controllers/DatabaseController.php');
require_once('controllers/AuthenticationController.php');
require_once('controllers/ChannelController.php');
require_once('controllers/VideoController.php');
require_once('controllers/TagController.php');
require_once('controllers/FrontPageController.php');

// See what URL we are being passed and parse it out.
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);

$param_1 = $parts['2'];
$param_2 = $parts['3'];
$param_3 = $parts['4'];
*/ 
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


/* temp
// Instantiate the Database and Authentication controllers.
global $db;
$db = new DatabaseController();

global $auth;
$auth = new AuthenticationController();
*/
/*****************BEGIN SMARTY TEST DATA***********************/
$smarty->assign('settings', 
	array (
		'name' => 'my vlog site222',
		'description' => 'my site is awesome',
		'open_reg' => 'yes',
		'reg_approval' => 'yes',
		'bandwidth_limit' => '',
		'baseurl' => 'http://localhost/test/',
		'iconurl' => 'http://getdemocracy.com/logo.gif',
		'donation_html' => 'give me <b>money</b>',
		'donation_url' => 'http://donationurl.com',
		'donthideporn' => 'no'
	)
);
	
$smarty->assign('username', 'drew');
//at this point, userprivilege can be either 'admin' or 'notadmin'
//if I figure out booleans in smarty, it might be better to change
//this to be called 'isadmin' and it can be true or false 
$smarty->assign('userprivilege', 'admin');
$smarty->assign('loggedin', 'no');
$smarty->assign('maxuploadsize', '2'); //the max upload size for this server in Mb 
$smarty->assign('test', 'hello!');

$smarty->assign('videos',
			array(
				array('id' => '0',
					'title' => 'first video',
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
          	'tags' => array('tag1','tag2','tag3'),
          	'modified' => array(
          		'year' => '2007',
          		'month' => 'Jan',
          		'day' => '5',
          		'hour' => '19',
          		'minute' => '31',
          		'second' => '02'
          	),
          	'runtime' => array(
          		'hours' => '1',
          		'minutes' => '14',
          		'seconds' => '45'
          	),
          	'isexcerpt' => 'yes',
          	'isadult' => 'no',
          	'channels' => array('First Channel'),
          	'createdate' => array('year' => '2007',
          						'month' => 'Jan',
          						'day' => '5'
          	),
          	'thumbnailurl' => 'http://127.0.0.1/vegworcester-css/bm/thumbnails/7896fd19809694632effe6aefbf94b0b.jpg',
          	'url' => 'http://videourl.com'
          ),
				array('id' => '1',
					'title' => 'second video',
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
          	'tags' => array('tag3','tag4','tag5','tag6','tag7','tag8'),
          	'modified' => array(
          		'year' => '1999',
          		'month' => 'Dec',
          		'day' => '3',
          		'hour' => '5',
          		'minute' => '15',
          		'second' => '05'
          	),
          	'runtime' => array(
          		'hours' => '0',
          		'minutes' => '1',
          		'seconds' => '23'
          	),
          	'isexcerpt' => 'no',
          	'isadult' => 'yes',
          	'channels' => array('First Channel'),
          	'createdate' => array('year' => '1990',
          						'month' => 'Sep',
          						'day' => '9'
          	),
          	'thumbnailurl' => 'http://127.0.0.1/vegworcester-css/bm/thumbnails/7896fd19809694632effe6aefbf94b0b.jpg',
          	'url' => 'http://videourl.com'
          ),
				array('id' => '2',
					'title' => 'third video',
          		'creator' => 'yeah, man',
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
          	'tags' => array('tag9','tag10','tag11'),
          	'modified' => array(
          		'year' => '1999',
          		'month' => 'Dec',
          		'day' => '3',
          		'hour' => '02',
          		'minute' => '24',
          		'second' => '35'
          	),
          	'runtime' => array(
          		'hours' => '0',
          		'minutes' => '1',
          		'seconds' => '23'
          	),
          	'isexcerpt' => 'no',
          	'isadult' => 'yes',
          	'channels' => array('First Channel', 'Second Channel'),
          	'createdate' => array('year' => '1990',
          						'month' => 'Sep',
          						'day' => '9'
          	),
          	'thumbnailurl' => 'http://127.0.0.1/vegworcester-css/bm/thumbnails/7896fd19809694632effe6aefbf94b0b.jpg',
          	'url' => 'http://tester.org'
          ),
				array('id' => '3',
					'title' => ' video',
          		'creator' => 'yeah, man',
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
          	'tags' => array('tag9','tag10','tag11'),
          	'modified' => array(
          		'year' => '1999',
          		'month' => 'Dec',
          		'day' => '3',
          		'hour' => '02',
          		'minute' => '24',
          		'second' => '35'
          	),
          	'runtime' => array(
          		'hours' => '0',
          		'minutes' => '1',
          		'seconds' => '23'
          	),
          	'isexcerpt' => 'no',
          	'isadult' => 'yes',
          	'channels' => array('First Channel', 'Second Channel'),
          	'createdate' => array('year' => '1990',
          						'month' => 'Sep',
          						'day' => '9'
          	),
          	'thumbnailurl' => 'http://127.0.0.1/vegworcester-css/bm/thumbnails/7896fd19809694632effe6aefbf94b0b.jpg',
          	'url' => 'http://tester.org'
          )          
          
          
          ));
$smarty->assign('currentchannelid', '1');    
$smarty->assign('channels', 
	array(
		array(
			'id' => '0',
			'title' => 'First Channel',
			'description' => 'This is like the best channel ever!',
			'modified' => 'Dec 12, 2006',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag1','tag2','tag3')
		),
		array(
			'id' => '1',
			'title' => 'Second Channel',
			'description' => 'second channel second channel second channel',
			'modified' => 'Oct 11, 2005',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag4','tag5')
		),
		array(
			'id' => '2',
			'title' => 'Third Channel',
			'description' => '3rd 3rd 3rd',
			'modified' => 'Jul 3, 2006',
			'icon_url' => 'http://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Russian_icon_Instaplanet_Saint_Nicholas.JPG/300px-Russian_icon_Instaplanet_Saint_Nicholas.JPG',
			'donation_html' => "PLEASE gimme <a href='http://www.yeah.com'>money</a>. <b>OKAY?</b>",
			'donation_url' => 'http//website.w/donate.php',
			'website_url' => 'http://website.ws', 
			'license_name' => 'Attribution yeah yeah',
			'license_url' => 'http://license.com',
			'tags' => array('tag6','tag7','tag8','tag9','tag10','tag11','tag12','tag7','tag8','tag9','tag10','tag11','tag12')
		)
	)
); 

$smarty->display('video.tpl');

/*****************END SMARTY TEST DATA***********************/

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
	new FrontPageController();
}

?>
