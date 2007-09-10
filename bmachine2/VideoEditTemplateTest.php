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
/** video/video-name (ie video/video-name/view) - id, title, title_url, description, modified, icon_url, website_url, release_date, runtime, adult, mime, size, downloads, donation_html, donation_url, license_name, license_url, credits (array of names and roles), tags, channels (array of title and titel_url) settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, , donation_html, donation_url, donthideporn) user (username, admin, banned)
**/

$smarty->assign('video',
			//a test video
			array('id' => '0',
				'title' => 'This isthe first video I ever published. isn\'t it awesome',
				'title_url' => 'http://mysite.com/OMG-awesome-video',
				'description' => 'This is like the best video ever, you won\'t believe how awesome it is. Check out the ending. It\'s the best part.',
				'modified' => 'Aug, 28, 2007 @ 2pm',
				'icon_url' => 'http://worcesterunited.com/files/singing.jpg',
          			'website_url' => 'http://websiteurl1.net',
		          	'release_date' => 'aug, 28, 2007', 
		          	'runtime' => '2h 30m', 
		          	'adult' => 'yes',
		          	'mime' => 'MIME TYPE HERE',
		          	'size' => '200kb',  
		          	'downloads' => '2', 
		          	'donation_html' => 'Like this video? <a href="#">DONATE</a>', 
		          	'donation_url' => 'http://paypal.com', 
		          	'license_name' => 'GPL', 
		          	'license_url' => 'http://www.gnu.org/copyleft/gpl.html', 
				'credits' => array (
					array(
						'name' => 'Stephen Speilberg',
						'role' => 'Director',
					), 
					array(
						'name' => 'John Feldman',
						'role' => 'Singer',
					), 
					array(
						'name' => 'Emma Goldman',
						'role' => 'Actress',
					), 
					array(
						'name' => 'Emma Goldman',
						'role' => 'Actress',
					), 
					array(
						'name' => 'Emma Goldman',
						'role' => 'Actress',
					), 
					array(
						'name' => 'Emma Goldman',
						'role' => 'Actress',
					), 
					array(
						'name' => 'Emma Goldman',
						'role' => 'Actress',
					)
				),
          			'tags' => array('cool','awesome','internet', 'blog'),
				'channels' => array('channel1', 'channel15', 'channel13')
			)

);
$smarty->assign('settings', array(
				'name' => 'My BroadCast Machine Install',
				'description' => 'this is like the best BM install', 
				'open_reg' => 'yes',
				'reg_approval' => 'yes', 
				'bandwidth_limit' => 'yes', 
				'baseurl' => 'http://127.0.0.1/~drew/bmachine2/', 
				'icon_url' => 'http://worcesterunited.com/files/broadcast.jpg', 
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
$smarty->assign('allchannels', array('channel1', 'channel2', 'channel3', 'channel4', 'channel5', 'channel6', 'channel7', 'channel8', 'channel9', 'channel10', 'channel11', 'channel12', 'channel13', 'channel14', 'channel15'));

$smarty->display('video-edit.tpl')
//$smarty->display('video-single.tpl')

?>
