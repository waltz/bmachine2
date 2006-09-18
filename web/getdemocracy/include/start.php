<?php 

include ("base.php"); 
include ("version.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Democracy - Internet TV Platform - Free and Open Source</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="<?= $base ?>/stylesheets/main.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="http://getdemocracy.com/stylesheets/bar.css" type="text/css" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $base ?>/news/feed">
	</head>

	<body>
		<div id="banner_wrap">
		 <ul id="banner">
		 <li class="banner_link"><a id="pcf" href="http://www.participatoryculture.org/"><span>Contact</span></a></li>
		 <li class="banner_link"><a id="publicize" href="http://www.publicizevideofeed.com"><span>Related</span></a></li>
		 <li class="banner_link"><a id="channelchannel" href="http://thechannelchannel.tv/"><span>Channel Channel</span></a></li>
		 <li class="banner_link"><a id="videobomb" href="http://www.videobomb.com/"><span>Video Bomb</span></a></li>
		 <li class="activesite"><a id="getdemocracy" href="http://www.getdemocracy.com/"><span>Get Democracy</span></a></li>
		 <li id="banner_logo"><a href="http://www.getdemocracy.com/"><span>Democracy Internet TV</span></a></li>
		 </ul>
		</div>
		<br class="clearer" />
		<div id="header">
			<div id="header-top">
				<h1><a href="<?= $base ?>/">Democracy - Internet TV Platform - Free and Open Source</a></h1>
				<ul id="nav-main">
					<li><a href="<?= $base ?>/downloads/">Downloads</a></li>
					<li><a href="http://forum.getdemocracy.com">Forums</a></li>
					<li><a href="<?= $base ?>/donate/">Donate</a></li>
					<li><a href="<?= $base ?>/help/">Help</a></li>
					<li><a href="<?= $base ?>/about/">About</a></li>
					<li><a href="<?= $base ?>/news/">Blog</a><a href="<?= $base ?>/news/feed/"><img src='<?= $base ?>/images/feed-white.gif' border="0" /></a></li>
				</ul>
			</div>
			<ul id="nav-sub">
				<li id="nav-watch"><a href="<?= $base ?>/watch/">Watch TV - Get Democracy player and explore internet TV</a></li>
				<li id="nav-make"><a href="<?= $base ?>/make/">Make TV - Turn your videos into an Internet TV channel</a></li>
				<li id="nav-code"><a href="<?= $base ?>/code/">Code - Get under the hood. 100% open-source, GPL</a></li>
			</ul>
		</div>
