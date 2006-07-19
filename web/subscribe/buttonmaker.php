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


<script language="javascript">

var originalButtonsHTML;

function onLoad()
{
  originalButtonsHTML = document.getElementById('generated_buttons').innerHTML;
}

var urls;

function validate()
{
  for (i = 0; i < urls.length; i++) {
    if (urls[i]) {
      window.open("http://feedvalidator.org/check.cgi?url=" + escape(urls[i]))
    }
  }
}

function generateButtons()
{
  var buttonHTML = '';
  var i;
  var errorString = '';
  var urlInput;
  var subscriptionUrl = "http://subscribe.getdemocracy.com/?";
  
  // add new buttons here
  // add url to button img
  // (make sure to add comma to current last img)
  var buttons = new Array(
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-14.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-01.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-02.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-08.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-09.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-15.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-16.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-10.gif'

  );
  
  
  urlInput = document.getElementById('urls').value;

  if (urlInput == null || urlInput == '')
  {
    errorString = "You need to enter at least one valid URL.  Please try again in the above field.";
  }
  else
  {
    urls = urlInput.split(/\s+/);

    for (i = 0, j = 1; i < urls.length; i++)
    {
      if (urls[i])
	{
	  if (j != 1)
	    {
	      subscriptionUrl += "&";
	    }
	  subscriptionUrl += "url" + j + "=" + escape(urls[i]);
	  j ++;
	}
    }

  }
  
  buttonHTML+='<form name="buttoncode"><div id="content-left">';
  for (i=0; i < buttons.length; i++)
  {
    buttonHTML += '<div class="button"><div class="image"><img src="' + buttons[i] +
      '" alt="" /></div><div class="code"><textarea name="btn' + i + 
      '" onClick="document.buttoncode.btn' + i + '.select();" cols="40" rows="4" style="background-color:#EEEEEE;"><a href="' + 
	subscriptionUrl + '" title="Democracy: Internet TV"><img src="'+ buttons[i] + '" alt="Democracy: Internet TV" border="0" /></a></textarea></div></div>';
    if (i == Math.floor((buttons.length - 1) / 2)) {
      buttonHTML+='</div><div id="content-right">';
    }
  }
  buttonHTML+='</div></form><br clear="all" />'; 
  
  if (errorString != null && errorString != '') {
    document.getElementById('generated_buttons').innerHTML = 
   '<p><strong>Error!</strong></p><p>' + errorString + '</p>';
  } else {
    document.getElementById('generated_buttons').innerHTML = originalButtonsHTML;
  
    document.getElementById('subscription_url_link').innerHTML = 
      '<a href="' + subscriptionUrl + '">' + subscriptionUrl + '</a>';
    document.getElementById('buttons').innerHTML = buttonHTML;
  }
  
  document.getElementById('generated_buttons').style.display = "block"
}
</script>
	
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
height: 125px;
}

.button .image {
height: 52px;
padding-left: 4px;
}

.button .image img {
vertical-align: bottom;
}

.code textarea {
border: 1px solid #999;
}

</style>
	
</head>

<body onLoad="onLoad();">
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

<!--CONTAINER-->
<div id="content">
<noscript> This page requires javascript to operate.  However, users of your feed will not need to have javascript turned on.</noscript>

<!--js-->
<div id="supportsjs" style="display: none;">

<script language="javascript">  document.getElementById('supportsjs').style.display = "block"; </script>

  <br />
  <h4>Democracy 1-Click Subscribe Button Maker</h4>
  
  <p>Create buttons or a text link to subscribe your users to your video RSS feeds.</p>
  
  <p>Our 1-Click Subscribe system goes beyond typical subscribe buttons in two key ways:</p>
  <ul>
  	<li><strong>You can make a button for a single RSS feed or multiple feeds.</strong><br/>If you publish multiple video feeds, or if you want to recommend a bunch of feeds that you like, you can subscribe people to a whole batch of feeds in one fell swoop.</li>
  	<li><strong>If a Windows user doesn't have Democracy Player installed, they can download the software with your channels pre-subscribed.</strong><br />  It's like your own branded version of the player that comes with your content. (We don't have the pre-subscribed installer available for Mac or Linux yet, but the subscribe buttons work for people who have the player installed and when they click on the button, they will get a link to download the application if they don't have it already.)</li>
  </ul>
  
  <p><strong>Step 1. Paste in the URLs of your video RSS feeds, one per line:</strong><br />
  <textarea cols="45" id="urls" name="urls" rows="5"></textarea>
  <br />
  <input name="commit" type="submit" value="Make My Buttons &gt;&gt;" onClick="generateButtons(); return false;"/>
  <Br />
  </p>

  <!--Generated Buttons-->
  <div id="generated_buttons" style="display: none;">
  
    <p><strong>Step 2. Pick the button you want to use and paste the code into your site.</strong></p>
  
    <p>Subscribe URL: <span id="subscription_url_link"></span></p>
  
    <div id="buttons">
  
    </div>
    <p>We suggest you validate your feeds (opens in new windows): <a href="javascript:validate()">Feed Validator</a></p>
  </div>

  <!--/Generated Buttons-->

<!--/js-->
</div>

<!--/CONTAINER-->
</div>
<?php include "include/end.php" ?>
