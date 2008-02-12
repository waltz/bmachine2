{* Smarty *}

<!-- Start Header -->

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>{$settings.name} - Powered by Broadcast Machine</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{$baseUri}themes/default/style.css" />
</head>

<body>
	<!-- Banner/logo -->
	<div id="head">
	     <h1 id="preview">&nbsp;</h1>
	</div>

	<!-- Navigation menu -->
	<!--
	TODO: Add these navigation links.
	   * Home
	   * Channels
	   * Videos
	   * Tags
	-->

	<!-- User menu -->
	<div id="logged_in">
	{if $currentUser eq ""}
	    <a href="{$baseUri}user/login">Login</a> |
	    <a href="{$baseUri}user/signup">Signup</a>
	{else}
	   Hey {$currentUser}! |
	   <a href="{$baseUri}user/logout">Logout</a> |
	   <a href="{$baseUri}user/">Settings</a>
	{/if}
	</div>	 	

	<!-- Display all of the alerts. -->
	{if $alerts|@count gt 0}
	<div id="alerts">
		<ul>
		{foreach from=$alerts item=alert}
			<li>{$alert}</li> 
		{/foreach}
		</ul>
	</div>
	{/if}

<!-- End Header -->
