<?php
include ("../include/start.php");
?>

		<div id="sub-main">
			<h2>Watch Internet TV with Democracy Player</h2>
			<p class="subhead">You've probably watched hundreds of tiny videos on websites. It's tedious. Democracy Player makes video on the internet way
			less frustrating and way more enjoyable. You can subscribe to channels of internet video, download videos, and watch them fullscreen,
			one after the other, all in one application. Internet video becomes internet TV. It's free and open for everyone to watch and to broadcast.</p>
		</div>
		<div id="steps">
			<ul>
				<li><img src="<?= $base ?>/images/img_subscribechannels.png" /><strong>1. Subscribe to Channels</strong><br />
				Democracy has a built-in Channel Guide.  It's an open catalog of hundreds of free channels. Subscribe to any channel with a single click.</li>
				<li><img src="<?= $base ?>/images/img_downloadvideos.png" /><strong>2. Download from Channels</strong><br />
				Pick videos to download or set the channel to automatically get new stuff as it comes out (like a Tivo).</li>
				<li><img src="<?= $base ?>/images/img_watchvideo.png" /><strong>3. Watch Videos</strong><br />
				Lean back and watch your new videos in standard mode or full screen. Democracy plays almost every video format.</li>
			</ul>
			<div class="clearer"></div>
		</div>
		<div id="sub-channels">
			<h2>Over 600 Channels Waiting for You</h2>
			<p class="subhead">There are more than 600 channels in the Channel Guide that is built-in to Democracy and new ones are added every day. They're as interesting and diverse as the
			internet itself. Subscribe to any of them for free with a single click. Here are a few examples.</p>
			<ul>
				<li id="channel1"><img src="<?= $base ?>/images/frederator.png" border="4" height=157 width=235 />
				<h5><a href="http://www.channelfrederator.com/">Channel Frederator</a></h5></li>
				<li id="channel2"><img src="<?= $base ?>/images/lady_sovereign.jpg" border="4" height=157 width=235 />
				<h5><a href="http://telemusicvision.com/">Telemusicvision</a></h5></li>
				<li id="channel3"><img src="<?= $base ?>/images/media_that_matters.png" border="4" height=157 width=235 />
				<h5><a href="http://mediathatmattersfest.org">Media That Matters</a></h5></li>
			</ul>
			<br style="clear: both;" />
		</div>
		<div id="content">
			<div id="content-left">
			<h4>Download Democracy Player</h4>
			<p class="subhead2"><strong>Stop Reading and Start Watching!</strong> Ready to try internet TV?  It's a lot more fun to watch it than to read about it.</p>

				<div id="downloadarea-sub">
<?php include("../include/download-button.php"); ?>
				</div>

			</div>
			<div id="content-right">
				<h4>More Features</h4>
					<ul>
						<li><h6>Search</h6>
							Search YouTube, Google Video, and Yahoo Video for anything you could imagine.</li>
						<li><h6>Auto-Download</h6>
							Set your favorite channels to Auto-Download new videos as soon as they are available. You'll always have something new to watch.</li>
						<li><h6>RSS is everywhere</h6>
							Democracy can subscribe to any video RSS feed (video podcasts). Look for 'Subscribe' buttons on your favorite web sites.</li>
						<li><h6>Seamless Bittorrent</h6>
							Democracy seamlessly integrates Bittorrent and can work as a standalone BitTorrent client.</li>
						<li><h6>Fullscreen</h6>
							Lean back and watch fullscreen with beautiful controls.</li>
						<li><h6>Manage Videos</h6>
							My Collection lists all the videos you've downloaded and can be quickly searched. Create playlists and folders to organize your videos and channels.</li>
					</ul>
			</div>
			<div class="clearer"></div>
		</div>
<?php include ("../include/end.php"); ?>
