<?php
include "../include/start.php";
?>
		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2>Make Internet TV</h2>
				<p class="subhead">Videomakers and publishers: you can use the Democracy internet TV platform to get your videos out to thousands of people. We have tools that make it simple and can even help you share high resolution video without high bandwidth costs.</p>
			</div>

			<h4>Here's how it goes down</h4>
			<p>
			<ol>
				<li>Get your videos ready: <a href="http://www.current.tv/studio/survivalguide/?section=compression">here's a helpful guide</a>.</li>
				<li>Make a channel: details below.</li>
				<li>Submit your channel to our Channel Guide: <a href="https://channelguide.participatoryculture.org/?q=submitchannel">submit here</a>.</li>
			</ol>
			</p>

			<h5>On your own website:</h5>
			<p>You can use our <a href="<?= $base ?>/broadcast/">Broadcast Machine</a> software to create channels and publish videos as easily as posting to your blog. Quickly upload files, create torrents, add metadata, and donation links. Broadcast Machine gives you the most control of any option but needs to be installed on a website. <a href="<?= $base ?>/broadcast">Get Broadcast Machine</a> and check out our <a href="channel-guide/">Step by Step Guide</a>.</p>

			<h5>On your blog:</h5>
			<p>If you have a blog you can use free hosting at Archive.org to add videos to your text and photo blogging. <a href="http://www.archive.org">Learn More</a></p>

			<h5>On Ourmedia:</h5>
			<p>Ourmedia.org provides free video hosting and generates a channel for each user. <a href="http://www.ourmedia.org/user/register">Signup</a> and get the video publisher.</p>

			<h5>On Video Bomb:</h5>
			<p>With <a href="http://www.videobomb.com">Video Bomb</a> you can link to ('bomb') interesting videos that you find on the web and it will pull them into a channel-- it's easy. Video Bomb does not provide hosting, so the videos need to be available online somewhere first.</p>

			<h5>On your website with your existing CMS:</h5>
			<p>If you already have a content management system on your website that will let users post videos, you can generate <a href="<?= $base ?>/help/feeds.php">compatible RSS feeds</a> to give everyone a channel.</p>

			<h4>Who's making channels?</h4>
			<p><a href="channel-examples.php">Meet some of the people and organizations</a> using Democracy, everyone from video bloggers to teachers, from public-interest media to independent musicians.</p>

			<h4>Help, FAQ, and Forums</h4>
			<p>There's a lot of different ways to make and troubleshoot your channels. Try our <a href="<?= $base ?>/help">Help Center</a>, <a href="<?= $base ?>/help/faq">FAQ</a>, and <a href="http://forum.getdemocracy.com">Support Forums</a>.</p>

			</div>
			<div id="content-right-2col">
			
			<h3>Have a video RSS Feed? Make a button!</h3>
			
			<p>If you have a video RSS feed, you can make a 1-Click subscribe button that will give people your feed with a single click.  <a href="http://subscribe.getdemocracy.com/">Learn more and make a button >></a>.</p>
			
				<ul class="sidebar-nav">
					<li><a href="<?= $base ?>/make">Make TV</a>
						<ul>
							<li><a href="<?= $base ?>/help/faq/index.php#05-02">FAQ - Channel Possibilities</a></li>
							<li><a href="<?= $base ?>/broadcast">Broadcast Machine</a></li>
							<li><a href="<?= $base ?>/make/channel-guide">Make a Channel</a></li>
							<li><a href="http://channelguide.participatoryculture.org">Channel Guide</a></li>
							<li><a href="<?= $base ?>/make/channel-examples.php">Examples of channels</a></li>
						</ul>
					</li>
				</ul>
				<div id="lower-sidebar">
				<h6>Stay Up to Date</h6>
				<p>Get updates about Broadcast Machine and channel creation:
				<form action="http://participatoryculture.org/lists/?p=subscribe&id=2" method="post" name="subscribeform">
					<input type="text" class="emailbox" name="email" value="email address" size="18" onfocus='this.value=""' />
					<input type=hidden name="makeconfirmed" value="1"/>
					<input type="hidden" name="htmlemail" value="1" />
					<input type="hidden" name="list[2]" value="signup" />
					<input type="hidden" name="listname[2]" value="Creators" />
					<input type="submit" id="emailsubmit" name="subscribe" value="Subscribe" onClick="return checkform();" />
				</form></p>
				<h6>Get Help</h6>
				<p>Having problems making a channel, using Broadcast Machine, or anything else? Try our <a href="<?= $base ?>/help/faq">FAQ</a>, documentation or <a href="http://forum.getdemocracy.com">support forum</a>:</p>
				<h6>Broadcast Machine</h6>
							  <script language="JavaScript">
									<!--
									if (navigator.appVersion.indexOf("Win")!=-1)
										{
										document.write('<a href="<?= $base ?>/broadcast/"><img src="<?= $base ?>/images/broadcastmachine-windows.jpg" alt="screenshot of publish page" /></a>');
										}
									else if (navigator.appVersion.indexOf("Mac")!=-1)
										{
										document.write('<a href="<?= $base ?>/broadcast/"><img src="<?= $base ?>/images/layout/broadcastmachine-mac.jpg" alt="screenshot of publish page" /></a>');
										}
									else
										{
										document.write('<a href="<?= $base ?>/broadcast/"><img src="<?= $base ?>/images/layout/broadcastmachine-mac.jpg" alt="screenshot of publish page" /></a>');
										}
									//-->
									</script>

							  <p><a href="<?= $base ?>/broadcast/">Broadcast Machine</a> is software you install on your website to create Democracy-style channels.</p>
				</div>

				</div>
			</div>
			<div class="clearer"></div>
		</div>
<?php include "../include/end.php"; ?>
