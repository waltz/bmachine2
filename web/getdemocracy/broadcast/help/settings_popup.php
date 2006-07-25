<?php 
include 'popup_head.html';
?>

<div class="help_pop">

<h2>Help: Settings</h2>

<h3>Front Page Display</h3>

<p>
The Front Page Display settings control what appears when a user visits the front page of your Broadcast Machine installation  (for example: www.yoursite.com/bm/).  You can set this front page to display one of your channels, or it can display a list / preview of all the channels you have available.
</p>


<h3>Direct URLs</h3>

<p>
The Direct URLs setting changes the way that Broadcast Machine links to videos on the web and in the RSS feed.  iTunes does not completely follow the correct standards for dealing with RSS feeds and was not able to read early Broadcast Machine feeds.  Direct URLs makes it possible for iTunes to read the feed (turning on direct URLs also works better with some search engines).  The Direct URLs setting works on most servers, but not all.  To test it, check off the box on the settings page, save changes, and then view the front page of your Broadcast Machine installation.  Try downloading one of your files-- if the file works as usual, Direct URLs is working fine.  If not, contact your server administrator for assistance.
</p>


<h3>Server Sharing Settings</h3>

<p>
Server sharing lets you host a file on your server while running BitTorrent to reduce bandwidth costs.  Server sharing will be enabled by default on most Linux servers.  You can choose to share every file you post from your server, or you can share files from the server on a case-by-case basis.  If you don't share every file automatically, you'll see a checkbox next to files when you post them that says: "share this file from the server".  Any file that is being shared from the server first needs to be transferred from your computer to the server.  You'll still need to keep 'Broadcast Machine helper' open until you see that the server has a full copy of the file (look on the files page).
</p>

<h3>MySQL Settings</h3>

<p>
If your site becomes very popular (thousands of viewers) or if you have a high number of videos that you're sharing (hundreds, perhaps), then you may want to enable the MySQL database for greater efficiency.  You'll need to create a MySQL database (ask your server administrator to help) and enter the appropriate info in the settings area.
</p>

</div>

<?php 
include 'popup_footer.html';
?>
