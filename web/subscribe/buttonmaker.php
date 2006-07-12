<?php include "include/start.php" ?>

<head>

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
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-01.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-02.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-08.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-09.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-15.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-16.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-10.gif',
    'http://www.getdemocracy.com/buttons/img/subscribe-btn-14.gif'
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
  
  
  for (i=0; i < buttons.length; i++)
  {
    buttonHTML += '<div class="button"><div class="image"><img src="' + buttons[i] +
      '" alt="" /></div><div class="code"><textarea name="code" cols="38" rows="4" style="background-color: #EEEEEE;"><a href="' + subscriptionUrl + '" title="Democracy: Internet TV"><img src="'+ buttons[i] + '" alt="Democracy: Internet TV" border="0" /></a></textarea></div></div>';
  }
  
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

}

</style>
	
</head>

<body onLoad="onLoad();">
<div id="content">

<noscript> This page requires javascript to operate.  However, users of your feed will not need to have javascript turned on.</noscript>

<!--CONTAINER-->
<div id="supportsjs" style="display: none;">

<script language="javascript">  document.getElementById('supportsjs').style.display = "block"; </script>

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
  <textarea cols="45" id="urls" name="urls" rows="5"></textarea>
  <br /><br />
  <input name="commit" type="submit" value="Make My Buttons &gt;&gt;" onClick="generateButtons(); return false;"/>
  </p>
  
  <div id="generated_buttons" style="display: none;">
  
    <p><strong>Step 2. Pick the button you want to use and paste the code into your site.</strong></p>
  
    <p>Subscribe URL: <span id="subscription_url_link"></span></p>
  
    <div id="buttons">
  
    </div>

    <p>We suggest you validate your feeds (opens in new windows): <a href="javascript:validate()"> FEED Validator </a></p>
  
  </div>
</div>
</div>

<?php include "include/end.php" ?>
