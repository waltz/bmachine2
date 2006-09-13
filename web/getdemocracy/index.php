
<?php include ("include/start.php"); ?>
		<div id="main">
			<div id="callout">

				<h2>Democracy Player. Your internet television has arrived.</h2>
				<div id="callout-left">
					<p id="quote">"Want to see the future of Net video? Download the open source Democracy Player"<br />
						<span class="quote-byline">Wired Magazine, May 2006</span>
					</p>
					<p id="description"><strong>Stop squinting at tiny web video.</strong> Instead, download and watch all the best internet TV shows in one powerful application: any video RSS feed, video podcast, video blog, or BitTorrent file. Fullscreen, high resolution, 100% free and open source. New channels arrive daily in the built-in Channel Guide.</p>
					<div id="downloadarea">
						<div id="download-aux"><a href="<?= $base ?>/watch/">Features</a> - <a href="<?= $base ?>/walkthrough/">Screenshots</a></div>
<?php

include("include/download-button.php");

?>
					</div>
				</div>
<?php

include("include/screenshot.php");

?>
			</div>
		</div>
		<div id="subcallout">
			<div id="subcontent">
				<h2>600 Channels, All Free</h2>
				<p id="subdesc">When you launch Democracy Player, you'll see the built-in Channel Guide. New channels arrive every day, and you can subscribe to any with a single-click.  The Guide is open to everyone: <a href="https://channelguide.participatoryculture.org/?q=submitchannel">Submit a Video Feed</a></p>
				<ul>
					<li id="channel1"><img id="channels" src="<?= $base ?>/images/frederator.jpg" width="171" height="114" />
						<h5><a href="http://www.channelfrederator.com/">Channel Frederator</a></h5>
						A great cartoon channel.</li>
				</ul>
			</div>
			<div id="subnews">
				<h2>Democracy News</h2>
				<a href="<?= $base ?>/news/feed/" class="newsrss">RSS Feed</a>
				<ul>
					
					<li><a href="http://www.getdemocracy.com/news/2006/09/democracy-player-09-released/">Democracy Player 0.9 Released!</a></li>
					<li><a href="http://www.getdemocracy.com/sheepsweek/">Sheeps Week</a></li>
					
					<li><a href="<?= $base ?>/news/2006/08/hiring-business-development-director/">Now Hiring: Business Development Director</a></li>
					
					<li><a href="<?= $base ?>/articles/video_podcast_shootout.php">Video Podcast Shootout: iTunes vs. Democracy Player</a></li>
									</ul>
				<a href="<?= $base ?>/news/" class="morenews">More news...</a>
			</div>
			<div class="clearer"></div>
		</div>
		<div id="otherplat">
			<h3>Democracy: A Platform, Not Just an Application</h3>
			<p>We are working to build the internet TV tools possible to ensure that people are in control of their own media. In addition to the player and the Channel Guide, our platform has two other major components. <a href="http://www.participatoryculture.org/">Learn more about our platform >></a></p>
			<div id="otherplat-left">
				<a href="<?= $base ?>/broadcast/"><img src="images/img_broadcastmachine.gif" border="0" /></a>
				<a href="<?= $base ?>/broadcast/" class="plathead">Broadcast Machine</a><br />Free software for your website to publish videos into a channel and create a browsable web gallery. RSS, BitTorrent, and an easy to use interface. <br /> <a href="<?= $base ?>/broadcast/">Learn More >></a>
			</div>
			<div id="otherplat-right">
				<a href="http://videobomb.com"><img src="images/img_videobomb.gif" border="0" /></a>
				<a href="http://videobomb.com" class="plathead">Video Bomb</a><br /> The best videos from everywhere on the web. *Bomb* your favorites to push them to the front page. You can now bomb via Democracy Player.<br /> <a href="http://videobomb.com">Go to Video Bomb >></a>
			</div>
			<div class="clearer"></div>
		</div>
		<div id="content">
			<div id="content-left">

<!--

			<h4>A TiVo for the Internet</h4>
&nbsp;
			<ul>
			
			<li>Choose from hundreds of internet video feeds in the Channel Guide, including podcasts, videoblogs, and HD BitTorrent channels.<br />&nbsp;</li>
			
			<li>Subscribe to any video RSS feed on the web.<br />&nbsp;</li>
			
<li>Search and download videos from Yahoo Video, Google Video, Blogdigger, and YouTube.<br />&nbsp;</li>

<li>Lean back and watch videos full screen.<br />&nbsp;</li>

<li>Organize your videos with playlists and folders.</li>
</ul>

-->

			<h4>Why We Make Democracy</h4>
			<p>Our mission is to support video publishers and give viewers an internet video experience beyond any other product.  We hope to build a platform that will let anyone around the world watch and publish channels of high quality video.</p>
			<p>We have two crucial advantages over traditional software development. First, being a non-profit organization means we focus on a mission to support our users, not on a mission to create returns for investors.  Second, by making our software free and open-source, anyone can contribute to helping us build the best video application in the world.
			</p>


<h4>Programmers: Help us Build</h4>
				<p>Democracy Player is free and open-source (GPL). Can you commit some time to a great cause? <a href="<?= $base ?>/code/">Learn more about the project</a>, then join the mailing list.</p>
				
				
				
				<p id="support-democracy">
<img src="images/img_supportdemocracy.gif" /><br />
				<strong><a href="<?= $base ?>/buttons/">Put a Democracy button on your site!</a></strong>
				</p>

				
			</div>
			<div id="content-right">
				
				<div id="storeimage"><a href="<?= $base ?>/store/"><img src="images/img_democracystore.gif" border="0" /></a></div>


			<p id="content-quote">"As easy as turning on a TV"<br />
			<span class="quote-byline">-Cory Doctorow, BoingBoing.net</span></p>

				<p id="content-quote">
				"I'm pleased to support the Democracy platform, because it will enable, for the first time, a large-scale Internet video creation and distribution platform which, because it is based on open standards and open source software, will be available to everyone."<br />
					<span class="quote-byline">-Mitch Kapor, Chair, Open Source Applications Foundation</span></p>





			
				
				
			</div>
			<div class="clearer"></div>
			<div id="callout-bottom">
				<img src="images/img_roadto.jpg" />
				<h4>Donate: Help us Do More</h4>
				<p>As we continue to improve and refine Democracy Player, on the way to version 1.0, we need your help to continue our work. Give us a chance to convince
				you that our project is worth donating to.</p>
				<a href="<?= $base ?>/donate/">Learn More and Donate >></a>
				<div class="clearer"></div>
			</div>
		</div>

<?php include ("include/end.php"); ?>
