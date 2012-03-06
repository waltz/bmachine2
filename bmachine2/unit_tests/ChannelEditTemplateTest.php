<?php

// Make sure that PHP complains. Turn all error reporting on.
error_reporting(E_ALL);

$path = getcwd(); 
//$path = "http://127.0.0.1/~drew/bmachine2";
require_once($path . '/smarty/Smarty.class.php'); 
 
// Create a new Smarty instance. 
global $smarty; 
$smarty = new Smarty(); 
 
// Configure Smarty include paths. 
$smarty->template_dir = $path . '/themes/default/'; 
$smarty->compile_dir = $path . '/smarty/templates_c/'; 
$smarty->cache_dir = $path . '/smarty/cache/'; 
$smarty->config_dir = $path . '/smarty/configs/'; 

//include the template

//test data, from API
/** channel/ (ie channel/all) - same as front page - channel (id, title, description, modified, icon_url, website_url, tags (array of channel tags), videos (array of 10 most recent videos (id, title, title_url, modified, icon_url, website_url, release_date, runtime, adult, size, downloads, tags, channels))
**/

$smarty->assign('channel', array(
			'id' => '0', 
			'title' => 'Channel #1',
			'description' => 'I made this channel about funny videos. I am gonna post every week. What do you think?',
			'modified' => 'sept 1, 1997',
			'icon_url' => 'http://worcesterunited.com/files/channel_icon.jpg',
			'website_url' => '',
       			'tags' => array('funny','hott','notmine', 'publicdomain')
));
$smarty->assign('allvideos',
			//test video 1
			array(
				array('id' => '0',
				'title' => 'first video',
				'title_url' => 'http://mysite.com/OMG-awesome-video',
				'modified' => 'Aug, 28, 2007 @ 2pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl1.net',
		          	'release_date' => 'aug, 28, 2007', 
		          	'runtime' => '2h 30m', 
		          	'adult' => 'no',
		          	'size' => '200kb',  
		          	'downloads' => '312', 
          			'tags' => array('cool','awesome','internet', 'blog'),
				'channels' => array('channel1', 'channel2')
				),
			//test video 2
				array('id' => '1',
				'title' => 'second video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '2',
				'title' => 'third video',
				'title_url' => 'http://mysite.com/third-video',
				'modified' => 'Jan 3, 2003 @ 4:02pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/dancing.jpg',
          			'website_url' => 'http://websiteurl3.net',
		          	'release_date' => 'march 1, 2004', 
		          	'runtime' => '20s', 
		          	'adult' => 'no',
		          	'size' => '12mb',  
		          	'downloads' => '2', 
          			'tags' => array('funny', 'happy'),
				//'channels' => array('channel2')
				),
				array('id' => '3',
				'title' => 'fourth video',
				'title_url' => 'http://mysite.com/fourth-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '4',
				'title' => 'fifth video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '5',
				'title' => 'sixth video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '6',
				'title' => 'seventh video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '7',
				'title' => 'eighth video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				),
				array('id' => '8',
				'title' => 'ninth video',
				'title_url' => 'http://mysite.com/second-video',
				'modified' => 'Sept 1, 1997 @ 1pm',
				'icon_url' => 'http://localhost/~drew/bmachine2/singing.jpg',
          			'website_url' => 'http://websiteurl2.net',
		          	'release_date' => 'sept 1, 1997', 
		          	'runtime' => '1h 1m 30s', 
		          	'adult' => 'no',
		          	'size' => '14mb',  
		          	'downloads' => '2439', 
          			'tags' => array('cool','funny'),
				'channels' => array('channel2')
				)
));

$smarty->assign('settings', array(
				'name' => 'My BroadCast Machine Install',
				'description' => 'this is like the best BM install', 
				'open_reg' => 'yes',
				'reg_approval' => 'yes', 
				'bandwidth_limit' => 'yes', 
				'baseurl' => 'http://127.0.0.1/~drew/bmachine2/', 
				'iconurl' => 'http://worcesterunited.com/files/broadcast.jpg', 
				'donation_html' => 'Please <a href="#">donate</a>', 
				'donation_url' => 'http://paypal.com', 
				'donthideporn' => 'no', 
				));
$smarty->assign('user', array(
				'username' => 'testusername21', 
				'admin' => 'no',
				'banned' => 'no'
				));

$smarty->assign('pagination', array ('currentpage' => '3', 'totalpages' => 10));

$smarty->display('channel-edit.tpl')

?>
