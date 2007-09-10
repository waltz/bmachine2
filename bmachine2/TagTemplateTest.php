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
/** tag/ (ie tag) - tags (array of all tag names, both channel and video tags, and tag count) || settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, , donation_html, donation_url, donthideporn) user (username, admin, banned)

**/

$smarty->assign('tags', array (
				array('name' => 'coolness', 'count' => '1'),
				array('name' => 'notmine', 'count' => '3'),
				array('name' => 'public', 'count' => '1'),
				array('name' => 'hott', 'count' => '5')
			)
);

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

$smarty->display('tag.tpl')

?>
