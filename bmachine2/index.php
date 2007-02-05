<?php

// Simple, just includes the dispatcher.
//include('dispatcher.php');

//set absolute server path. this is the current directory
$path = getcwd();
//echo 'current path: ' . $path;


//Setup smarty

//include the smarty library
require($path . '/smarty/Smarty.class.php');

//create a new instance
$smarty = new Smarty();

//set up all the correct paths
$smarty->template_dir = $path . '/themes/';
$smarty->compile_dir = $path . '/smarty/templates_c/';
$smarty->cache_dir = $path . '/smarty/cache';
$smarty->config_dir = $path . '/smarty/configs';

//assign any smarty variables and function
$smarty->assign('name', 'Ned');

//Display template
$smarty->display('a.tpl');


?>
