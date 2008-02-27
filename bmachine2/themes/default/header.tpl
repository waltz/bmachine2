{* Smarty *}

<!-- Start Header -->

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Broadcast Machine</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{$baseUri}themes/default/style.css" />
	<link rel="icon" href="{$baseUri}themes/default/favicon.png" type="image/gif" />

	{if $rss eq 'channel'}
	    <link rel="alternate" type="application/rss+xml" title="RSS"
	    	  href="{$baseUri}channel/{$channel.title|urlencode}/rss"/>
	{/if}
	{if $rss eq 'tag'}
	    <link rel="alternate" type="application/rss+xml" title="RSS"
	    	  href="{$baseUri}tag/{$tagName|urlencode}/rss"/>
	{/if}
	{if $rss eq 'video-all'}
	    <link rel="alternate" type="application/rss+xml" title="RSS"
	    	  href="{$baseUri}video/all/rss"/>
	{/if}

</head>

<body>
	<!-- Banner/logo -->
	<div id="head">
	     <h1 id="preview">{$siteName}</h1>
	</div>

	<!-- Navigation menu -->
	<div id="navigation-links">
		<a href="{$baseUri}">Home</a> | 
		<a href="{$baseUri}channel/all">Channels</a> |
		<a href="{$baseUri}video/all">Videos</a> |
		<a href="{$baseUri}tags/all">Tags</a> |
		<a href="{$baseUri}user/all">Users</a>
	</div>

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
	<div class="alerts">
		<ul>
		{foreach from=$alerts item=alert}
			<li>{$alert}</li> 
		{/foreach}
		</ul>
	</div>
	{/if}

<!-- End Header -->
