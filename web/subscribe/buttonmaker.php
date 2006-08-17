<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Democracy - Internet TV Platform - Free and Open Source</title>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="http://www.getdemocracy.com/stylesheets/main.css" rel="stylesheet" type="text/css" />
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

function validate()
{
  for (i = 0; i < urls.length; i++) {
    if (urls[i]) {
      window.open("http://feedvalidator.org/check.cgi?url=" + escape(urls[i]))
    }
  }
}

// FIXME: we can test more than this
function validateurls() {
 for (i=0; i < urls.length; i++) {
   if (urls[i].substring(0,7) != 'http://' &&
       urls[i].substring(0,8) != 'https://')
     return 'There was a problem with one or more of your urls: <br /><blockquote>' + urls[i] + '</blockquote>Please only submit http:// or https:// urls<br />';
 }
 return null;
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
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-10.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-15.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-16.gif'
  );
  
  
  urlInput = document.getElementById('urls').value;

  if (urlInput == null || urlInput == '')
  {
    errorString = "You need to enter at least one valid URL.  Please try again in the above field.";
  }
  else
  {
    urlInput = urlInput.replace(/^\s+/g, '').replace(/\s+$/g,'');
    urls = urlInput.split(/\s+/);
    errorString = validateurls();
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
padding-bottom: 25px;
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

textarea {
font-size: 14px;
}

input {
font-size: 17px;
}

.code textarea {
border: 1px solid #999;
font-size: 11px;
}

h5 {
color: #990000;
}

.maker {

background-color: #ffd;
padding: 15px;

}

#users {
width: 255px;
border: 3px solid #afa;
background-color: #f4fff4;
padding: 4px 10px 8px 10px;
float: right;
margin: 20px 0 15px 15px;
font-size: 13px;
}

#users a {
font-size: 16px;
}


</style>
	
</head>

<body onLoad="onLoad();">
<!--HEADER-->
<?php include($base."include/wpheader.php"); ?>
<!--/HEADER-->

<!--CONTAINER-->
<div id="content">
<noscript> This page requires javascript to operate.  However, users of your feed will not need to have javascript turned on.</noscript>

<!--js-->
<div id="supportsjs" style="display: none;">

<script language="javascript">  document.getElementById('supportsjs').style.display = "block"; </script>

  <br />
  <h3>Democracy 1-Click Subscribe Button Maker <span style="color: #ccc;">Beta</span></h3>
  
  
  <div id="users">
  <div style="font-size: 15px; text-align: center; font-weight: bold; margin-bottom: 15px;">Some Sites Using 1-Click Buttons</div>
  
<a href="http://www.bestweekever.tv/">VH1's Best Week Ever</a><br />in the sidebar
<br /><br />
<a href="http://island94.org/">Island 94</a><br />in the sidebar
<br /><br />
<a href="http://www.twit.tv/mb">This Week in Tech - Mac Break</a><br />in the drop down menu 
<br /><br />
<a href="http://high-flow.com/blog/?p=22">High Flow Hip-Hop</a><br />in the blog post
<br /><br />
<a href="http://www.crushtv.com/blog/">Crush TV</a><br />in the sidebar<br /><br />
<a href="http://http://www.rocketboom.com/vlog/">Rocketboom</a><br />linked under "Democracy"<br /><br />

</p>

    </div>
  
  <p>This page helps you create buttons (and a text link) that subscribe people to your video RSS feeds in Democracy Player.  By posting these buttons, you can instantly share your favorite channels with your friends and family.  Just make a button below and then paste the code into a website, blog, or email.</p>
  
 
 <h5>Why Use 1-Click Buttons for Your Videos?</h5>
 
 
 <div style="text-align: center; font-size: 12px; float: right; width: 140px; padding: 12px; margin: 10px; background-color: #eee;"><img src="http://www.getdemocracy.com/buttons/img/subscribe-btn-14.gif" /><br /><br /><img src="http://www.getdemocracy.com/buttons/img/subscribe-btn-02.gif" /><br /><br />1-click button examples</div>
 
 <p>
 If you have a video RSS feed, then you already understand the benefits of video RSS compared to a website: when your viewers are subscribed, they receive new videos automatically, rather than having to remember to check your website.  1-Click buttons are the easiest way to get your viewers subscribed and Democracy Player provides the best viewing experience for your content. 
 </p>

  <p>For example: if I have a blog, I can create and post a button that will allow my readers to subscribe to my favorite internet TV channels. Or if my organization publishes a video RSS feed, I can post a button on our website and members who don't have the Democracy Player will be able to automatically download a version of the player that's pre-subscribed to our channel(s). Democracy is yours to share. Let us know if you've posted a button on your site! Write us anytime at info@pculture.org.
 </p>

 
  <h5>Democracy 1-Click Subscribe Goes Beyond Typical Subscribe Buttons.</h5>
  <ul>
  	<li><strong>You can make a button for a single RSS feed or multiple feeds.</strong><br/>If you publish multiple video feeds, you can subscribe people to a whole batch of feeds in one fell swoop.    If you want to recommend a bunch of feeds that you like, even if you don't publish them, you can quickly make a link and blog it-- your own 'Top 10 List' of internet TV shows.<Br />&nbsp;</li>
  	<li><strong>If a Windows user doesn't have Democracy Player installed, they can download it with your channels pre-subscribed.</strong><br />  It's your own branded version of Democracy Player.  Share your favorite channels with your community -- even if they don't already have Democracy Player. 	
  	(Note: this feature is not yet available for Mac or Linux.  However, 1-Click subscribe buttons work for people who have Democracy Player already and people who don't have the app will get a link to download it.)</li>
  </ul>
  
  
<div class="maker">
  <h5>STEP 1: Paste in URLs for video RSS feeds-- one per line.</h5>
  <textarea cols="65" id="urls" name="urls" rows="5"></textarea>
  <br />
  <input name="commit" type="submit" value="Make My Buttons &gt;&gt;" onClick="generateButtons(); return false;"/>
  <Br />
  </p>

  <!--Generated Buttons-->
  <div id="generated_buttons" style="display: none;">
  &nbsp;<br />
    <h5>STEP 2: Pick a button and paste the code into your site.</h5>
  
    <p>Text link: <span id="subscription_url_link"></span><Br />&nbsp;</p>
  
    <div id="buttons">
  
    </div>
    <p>Check if these feeds are valid RSS (opens in new windows): <a href="javascript:validate()">Validate These Feeds</a></p>
  </div>

  <!--/Generated Buttons-->

<!--/js-->
</div>


</div> <!-- maker -->



<!--/CONTAINER-->
</div>
<?php include "include/end.php" ?>
