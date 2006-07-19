<?php

include "geturls.php";
$base = 'http://subscribe.getdemocracy.com/';
// HACK $base should be in some include file, but I don't have the time to 
// make it work right now

function getLink ($base, $urls) {
  
  $out = $base;
  $link = '?';
  $count = 1;

  foreach ($urls as $url) {
    $out .= $link.'url'.$count.'='.urlencode($url);
    $link = '&amp;';
    $count++;
  }
  return $out;
}

// Returns a link to the page that generates OPML for this list of URLs
function getSubscribeLink($urls) {
  global $base;
  $link = getLink ('opml.php', $urls);
  if(strpos(strtolower(getenv("HTTP_USER_AGENT")), 'safari') == FALSE) {
    return $link;
  } else {
    return "democracy:{$base}{$link}";
  }
}

function getInstallerLink($urls) {
  $base = 'installer.php';
  return getLink ($base, $urls);
}

$URLList = getURLs();
$SubscribeLink = getSubscribeLink($URLList);
$InstallerLink = getInstallerLink($URLList);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Democracy - Internet TV Platform - Free and Open Source</title>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="/stylesheets/main.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/ico" href="http://getdemocracy.com/favicon.ico" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://getdemocracy.com/news/feed" />

<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/scriptaculous.js" type="text/javascript"></script>
<script src="/js/effects.js" type="text/javascript"></script>
<script src="/js/mailinglist.js" type="text/javascript"></script>

	
</head>
	
	
<style>

#channel_list {
margin-top: 20px;
padding: 10px;
background-color: #f5f5f5;
}

#install_info {
padding-top: 15px;
}

#what_is {
clear: both;
margin-top: 12px;
padding: 8px;
border: 4px solid #ddffdd;
background-color: #f6fcf6;
color: #111;
height: 191px;
}

#what_is h4, #install_info h4 {
font-size: 18px;
margin: 8px 0px 5px 0;
padding: 0;
}

#screenshot {
float: left;
width: 280px;
}

#channel_list h3 {
color: #d00;
font-size: 18px;
border-bottom: none;
width: 230px;
float: left;
}

#channels {
float: right;
width: 500px;
padding-top: 3px;
}

</style>

	
</head>

<body>

<!--HEADER-->
	<div id="header">
	

	<div id="header-top">
		<h1><a href="http://getdemocracy.com"><span></span>Democracy: Internet TV</a></h1>

		<ul id="nav-main">
			<li><a href="http://getdemocracy.com/help">Help</a></li>
			<li><a href="http://getdemocracy.com/downloads">Downloads</a></li>
			<li><a href="http://getdemocracy.com/donate">Donate</a></li>

			<li><a href="http://getdemocracy.com/about">About</a></li>
			<li><a href="http://getdemocracy.com/news">Blog</a><a href="http://getdemocracy.com/news/feed" class="feed">&nbsp;</a></li>		
		</ul>
	</div>
	
	
		<ul id="nav-sub">
			<li id="nav-watch"><a href="http://getdemocracy.com/watch"></a></li>
			<li id="nav-make"><a href="http://getdemocracy.com/make"></a></li>
			<li id="nav-code"><a style="margin-right: 0;" href="http://getdemocracy.com/code"></a></li>
		</ul>

	
	</div>	<!--/HEADER-->	

<!--CONTENT BLOCK-->
<div id="content">
<div id="content-1col">	

<div id="channel_list">
	<h3>now subscribing to:</h3>
	<div id="channels">
		<?php foreach ($URLList as $url) {print "".htmlentities($url)."<br />";}?>
	</div>
	<br style="clear: both;" />
</div>




<div id="install_info">

<script language="JavaScript">
	<!--
function getfile(file, spawnpage)
{
  var browser = (window.navigator.userAgent.indexOf("SV1") != -1);
  window.open(file,'downloading','toolbar=0,location=no,directories=0,status=0, scrollbars=no,resizable=0,width=1,height=1,top=0,left=0');
  window.focus(); 
  location.href = spawnpage;
}

if (navigator.appVersion.indexOf("Win")!=-1)
		{
		document.write('<h4>If you don\'t have Democracy Player, download it now with the channels above included.</strong></h4><div style="padding-left: 230px; padding-top: 10px;"><div id="download-button"><a href="<?= $InstallerLink ?>">Version 0.8.4.1 for Windows</a></div><div id="download-versions">Other versions: <a href="http://getdemocracy.com/downloads">Mac OSX</a> - <a href="http://getdemocracy.com/downloads">Linux</a></div></div>');
		}
	else if (navigator.appVersion.indexOf("Mac")!=-1)
		{
		document.write('<h4>If you don\'t have Democracy Player, download it now:</h4><div style="padding-left: 230px; padding-top: 10px;"><div id="download-button"><a href="http://getdemocracy.com/downloads/osx.php">Version 0.8.4.1 for Mac OS X</a></div><div id="download-versions">Other versions: <a href="http://getdemocracy.com/downloads">Windows</a> - <a href="http://getdemocracy.com/downloads">Linux</a></div></div><h4>Then, click this link: <a href="<?= $SubscribeLink ?>">Subscribe</a></h4>');
		}
	else if (navigator.appVersion.indexOf("X11")!=-1)
		{
		document.write('<h4>If you don\'t have Democracy Player, download it now:</h4><div style="padding-left: 230px; padding-top: 10px;"><div id="download-button"><a href="http://getdemocracy.com/downloads/#linux">Version 0.8.4.1 for Linux</a></div><div id="download-versions">Other versions: <a href="http://getdemocracy.com/downloads">Mac OSX</a> - <a href="http://getdemocracy.com/downloads">Windows</a></div></div><h4>Then, click this link: <a href="<?= $SubscribeLink ?>">Subscribe</a></h4>');
		}
	else
		{	
		document.write('<h4>If you don\'t have Democracy Player, download it now with the channels above included.</strong></h4><div style="padding-left: 230px; padding-top: 10px;"><div id="download-button"><a href="javascript:getfile(\'http://ftp.osuosl.org/pub/pculture.org/democracy/win/Democracy-0.8.2.exe\', \'/downloads/windows.php\');">Version 0.8.2 for Windows</a></div><div id="download-versions">Other versions: <a href="http://getdemocracy.com/downloads">Mac OSX</a> - <a href="http://getdemocracy.com/downloads">Linux</a></div></div>');
		}
	//-->
</script>


<noscript>
        <h4>If you don't have Democracy Player, download it now:</h4>
        <div style="padding-top: 10px; align:center;">
	<strong>Version 0.8.5:</strong>
        <a href="http://www.getdemocracy.com/downloads/windows.php">Windows</a> | 
        <a href="http://www.getdemocracy.com/downloads/osx.php">Mac OSX</a> |
        <a href="http://www.getdemocracy.com/downloads/#linux">Linux</a>
        </div>
        <h4>Then, click this link: <a href="<?= $SubscribeLink ?>">Subscribe</a></h4>
</noscript>

</div>
</p>

<div id="what_is">

<div id="screenshot">

<img src="../images/apple-screen-intro.png" alt="Democracy Player">

</div>

<h4>What is Democracy Player?</h4>

<p>
Democracy Player is a free desktop application for watching internet TV.  You can subscribe to thousands of free internet TV channels, including any video podcast, video blog, or video RSS feed.
</p>

<p>
Features: easy to use, supports BitTorrent, watch fullscreen, free and open-source.  Democracy Player is developed by the Participatory Culture Foundation, a non-profit organization.
</p>

<p>
To learn more, <a href="http://www.getdemocracy.com">visit the Democracy homepage</a>.</p>

</div>

<?php
//Hack to bypass iframe on protocol based platforms
if (strpos($SubscribeLink,"democracy:")!==0) {

?>
<iframe src="<?php echo $SubscribeLink; ?>" style="display:none;"></iframe>
<?php
	
} else {

?>
<script language="JavaScript"><!--
document.location.href = "<?php echo $SubscribeLink; ?>";
--></script>
<?php
	
}

?>
<p style="clear: both; margin-top: 25px;">
<strong>1-click subscribe not working?</strong> If you already have Democracy Player, but it didn't open up and subscribe you to these channels when you came to this page, <a href="<?php echo $SubscribeLink; ?>">click here</a> to download the auto-subscribe file and then double-click it.
</p>


	<!--FOOTER-->
	<div id="footer">
	
	<ul id="footernav">
	
		
			<li>
			<a href="http://getdemocracy.com/watch">Watch TV</a>
			<ul>
				<li><a href="http://getdemocracy.com/downloads">Download Player</a></li>
				<li><a href="http://getdemocracy.com/walkthrough">Screenshots</a></li>
				<li><a href="http://getdemocracy.com/walkthrough">Walkthrough</a></li>
			</ul>
		</li>	
	
	
				<li><a href="http://getdemocracy.com/make">Make TV</a>
			<ul>
				<li><a href="http://www.getdemocracy.com/help/faq/index.php#05-02">FAQ - Channel Possibilities</a></li>				
				<li><a href="http://getdemocracy.com/broadcast">Broadcast Machine</a></li>
				<li><a href="http://getdemocracy.com/make/channel-guide">Make a Channel</a></li>
				<li><a href="http://channelguide.participatoryculture.org">Channel Guide</a></li>
				<li><a href="http://getdemocracy.com/make/channel_examples.php">Examples of channels</a></li>
			</ul>
		</li>	
	
		
		
			<li><a href="http://getdemocracy.com/code">Code</a>
			<ul>
			
			<li><a href="http://develop.participatoryculture.org/">Developer Center</a></li>
				<li><a href="https://develop.participatoryculture.org/projects/dtv/browser/trunk/tv/">Source Code</a></li>
				<li><a href="https://develop.participatoryculture.org/projects/dtv/report">Bug Tracker</a></li>
				<!-- <li><a href="http://getdemocracy.com/">Mailing Lists</a></li> -->
			</ul>
		</li>		
			
			
						
		<li><a href="http://getdemocracy.com/help/">Help and Forums</a>
			<ul>
				<!--<li><a href="http://getdemocracy.com/help">Viewer Help</a></li> -->
				<li><a href="http://getdemocracy.com/help/faq#viewers">Viewer FAQ</a></li>
				<!--<li><a href="http://getdemocracy.com/help">Creator Help</a></li> -->
				<li><a href="http://getdemocracy.com/help/faq#creators">Creator FAQ</a></li>
				<li><a href="http://forum.getdemocracy.com/">Discussion Forums</a></li>
			</ul>
		</li>	
		
	
				
							<li><a href="http://getdemocracy.com/about">About the Platform</a>
			<ul>
				<li><a href="http://getdemocracy.com/news">News / Blog</a></li>
				<li><a href="http://getdemocracy.com/press">Press</a></li>
				<li><a href="http://getdemocracy.com/contact">Contact</a></li>
				<li><a href="http://getdemocracy.com/store">Store</a></li>
				<li><a href="http://getdemocracy.com/jobs">Jobs</a></li>
				<li><a href="https://secure.democracyinaction.org/dia/organizations/pcf/shop/custom.jsp?donate_page_KEY=1283&t=Democracy.dwt">Donate</a></li>
			</ul>
		</li>		
		



	</ul>
	
	<div id="footer-meta">
		<p>The Democracy platform is a project of the <a href="http://www.participatoryculture.org">Participatory Culture Foundation</a><p>
	</div>
	
	</div>


</div> <!-- close container -->

</body>
