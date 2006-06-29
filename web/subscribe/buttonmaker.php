<?php

// I hate PHP
if (get_magic_quotes_gpc()) {
   $_GET    = array_map('stripslashes', $_GET);
}

// Returns an array of URLs passed on the command line
// Should either be in the form http://thisserver/thisdir/url or
// http://thisserver/thisdir/?url1=url1&url2=url2&url3=url3
function getURLList() {
  $base = '/subscribe-test2/';
  $url = substr($_SERVER['REQUEST_URI'],strlen($base));
  if ($url[0] != '?') {
    return array($url);
  } else {
    $urls = array();
    $count = 1;
    while (isset($_GET['url'.$count])) {
      $urls[] = $_GET['url'.$count];
      $count++;
    }
    return $urls;
  }
}

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
  $base = '/subscribe-test2/opml.php';
  return getLink ($base, $urls);
}

function getInstallerLink($urls) {
  $base = '/subscribe-test2/installer.php';
  return getLink ($base, $urls);
}

$URLList = getURLList();
$SubscribeLink = getSubscribeLink($URLList);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Democracy - Internet TV Platform - Free and Open Source</title>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="/css/layout.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/ico" href="http://getdemocracy.com/favicon.ico" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://getdemocracy.com/news/feed" />

<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/scriptaculous.js" type="text/javascript"></script>
<script src="/js/effects.js" type="text/javascript"></script>
<script src="/js/mailinglist.js" type="text/javascript"></script>

<script language="javascript">

function showIndicator()
{
  Element.show('buttons_spinner');
}

function hideIndicator()
{
  Element.hide('buttons_spinner');
}

</script>
	
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

h4 {
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

.button {
width: 320px;
float: left;
padding-bottom: 15px;
padding-top: 5px;

}

</style>

	
</head>

<body>

<!--CONTAINER-->
<div id="container">

<!--HEADER-->
	<div id="header">
	
	<!--LOGO-->
	<div id="logo">
		<h1><a href="http://getdemocracy.com"><span></span>Democracy: Internet TV</a></h1>
	</div>
	<!--/LOGO-->	
	
	<!--NAV-->
	<div id="nav">
		<ul>
			<li><a href="http://getdemocracy.com/help">Help</a></li>
			<li><a href="http://getdemocracy.com/downloads">Downloads</a></li>
			<li><a href="http://getdemocracy.com/donate">Donate</a></li>

			<li><a href="http://getdemocracy.com/about">About</a></li>
			<li><a href="http://getdemocracy.com/news">Blog</a><a href="http://getdemocracy.com/news/feed" class="feed">&nbsp;</a></li>		
		</ul>
	</div>
	<!--/NAV-->
	
	<!--USERNAV-->		
	<div id="usernav">
		<ul>
			<li id="usernav-watch"><a href="http://getdemocracy.com/watch"></a></li>
			<li id="usernav-make"><a href="http://getdemocracy.com/make"></a></li>
			<li id="usernav-code"><a style="margin-right: 0;" href="http://getdemocracy.com/code"></a></li>
		</ul>
	</div>
	<!--/USERNAV-->
	
</div>	<!--/HEADER-->	


	<!--CONTENT BLOCK-->
  <div class="content" style="padding:0px;">
	



<Br />
<h4>Democracy 1-Click Subscribe Button Maker</h4>

<p>
Create buttons or a text link to subscribe your users to your video RSS feeds. 
</p>

<p>
Our 1-Click Subscribe system goes beyond typical subscribe buttons in two key ways:
<ul>
<li>
<strong>You can make a button for a single RSS feed or multiple feeds.</strong>  If you publish multiple video feeds, or if you want to recommend a bunch of feeds that you like, you can subscribe people to a whole batch of feeds in one fell swoop.
</li>
<li>
<strong>If a Windows user doesn't have Democracy Player installed, they can download the software with your channels pre-subscribed.</strong>  It's like your own branded version of the player that comes with your content. (We don't have the pre-subscribed installer available for Mac or Linux yet, but the subscribe buttons work for people who have the player installed and when they click on the button, they will get a link to download the application if they don't have it already.)
</li>
</ul>

<Br />
<p><strong>Step 1. Paste in the URLs of your video RSS feeds, one per line.</strong><Br />


<form name="button_form" action="ajax_generate_buttons.php" method="post" onsubmit="showIndicator(); Element.hide('generated_buttons'); new Ajax.Updater('generated_buttons', 'ajax_generate_buttons.php', {asynchronous:true, evalScripts:true, onComplete:function(request){Effect.SlideDown('generated_buttons'); hideIndicator()}, parameters:Form.serialize(this)}); return false;">

<textarea cols="45" id="urls" name="urls" rows="5"></textarea>
<br /><br />
<input name="commit" type="submit" value="Make My Buttons &gt;&gt;" />
<img alt="Indicator" class="spinner" height="5" id="buttons_spinner" src="/images/layout/indicator.gif" style="display: none; vertical-align: middle" width="21" />
</form>

</p>

<div id="generated_buttons">

</div>


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

</div>
</div> <!-- close container -->


</body>
