{* Smarty *}
{*
This smarty template requires the following smarty variables:
title - the title of the website
username
userprivilege - either 'admin' or not set  
loggedin - boolean, yes or no
*}

<!-- BEGIN HEADER -->

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>{$title} - Powered by Broadcast Machine</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="pub_css.css"/>
	<link rel="stylesheet" type="text/css" href="themes/default/style.css"/>
	</head>
	<body>

	<div id="head">
	<h1 id="preview">&nbsp;</h1>
	</div>

	{* Check to see if the user is logged in.*}	
	{if $loggedin eq 'yes'}
	<div id="logged_in">	
	<a href="index.php">View Front Page &gt;&gt;</a> | <strong><a href="user_edit.php?i={$username}">{$username}</a></strong> - <a href="login.php?logout=1">logout</a>
	</div>
		{* Check if user has admin rights *}
	 	{if $userprivilege eq 'admin'}
		<div id="adminmenu">
		<div id="inner_nav">
			<a href="admin.php">Dashboard</a>
			<a href="publish.php">Publish</a>
			<a href="edit_videos.php">Files</a><a href="channels.php">Channels</a>
			<a href="donations.php">Donations</a>
			<a href="settings.php">Settings</a>
			<a href="users.php">Users</a><a href="http://www.participatoryculture.org/bm/help/" target="_blank"  style="color: #B55;">Help</a>
		</div>
		</div>
		{/if}
	{else}
	<div id="logged_in">
		<a href="index.php">Login</a> | <a href="">Signup</a>
	</div>	 	
 	{/if}

<!-- END HEADER -->
