<?php
include "../include/start.php";
?>

		<div id="sub-main">
			<h2>Broadcast Machine</h2>
			<p class="subhead">Free software that you install on your website. Post your videos to create internet TV channels, including video blogs and video podcasts (video RSS feeds). Easy to install, easy to use.</p>
			<img src="<?= $base ?>/images/img_broadcastmain.jpg" style="margin:15px 0" />
		</div>
		<div id="content">
			<div id="content-left-broad">
			<h4>What is Broadcast Machine?</h4>
			<p>Broadcast Machine is software you install on your website to easily publish video files and create internet TV channels (video blogs, video podcasts, video RSS feeds). Broadcast Machine gives you the option of using torrent technology to reduce or eliminate bandwidth costs, even when you are posting high quality video to thousands of people.  It's free, open source software, and is designed for easy installation.</p>
								<p>Broadcast Machine features an intuitive interface, integrated torrent creation, and flexible channel management.  It also creates a browsable archive of videos on your website. Broadcast Machine is the perfect publishing tool for making channels that work with <a href="<?= $base ?>/">Democracy Player</a>.</p>
			<h4>Download and Install</h4>

			<p><strong><a href="bm.zip">Broadcast Machine (Version 23)</a></strong> - <strong><a href="<?= $base ?>/make/channel-guide/installation_instructions.php">Installation Instructions</a></strong><br /><a href="<?= $base ?>/broadcast/help/">Help / Documentation</a> - <a href="<?= $base ?>/make/channel-guide/">Tutorial</a> - <a href="https://develop.participatoryculture.org/projects/democracy/wiki/BroadcastMachineThemes">How to Customize a Theme</a></p>

			<h4>Installs easily.</h4>
				<ul>
					<li>Written in PHP, runs on most websites</li>
					<li>No MySQL setup required, just ftp a folder</li>
				</ul>

			<h4>Everything you need to broadcast video online.</h4>
				<ul>
					<li>Creates internet TV channels (video RSS feeds)</li>
					<li>Describe and tag your videos</li>
					<li>Supports <a href="http://creativecommons.org">Creative Commons</a> licenses</li>
					<li>Public and private channels</li>
					<li>Personal and community channels</li>
					<li>Innovative one-step Bittorrent publishing (or just direct link to hosted videos)</li>
					<li>Optional Bittorrent "server seeding"</li>
				</ul>
			<h4>For your viewers, everything is easy.</h4>
				<ul>
					<li>Browse videos on a web page, by channel or tag</li>
					<li>Easy BitTorrent downloads for Mac and Windows</li>
					<li>Users can subscribe to your channels with <a href="<?= $base ?>/">Democracy</a> and watch videos like a TiVo.</li>
				</ul>

			<h3>What kind of internet TV Channels can I make?</h3>
			<h4>1. Publish Your Own Content</h4>
			<p>Broadcast Machine lets you post your own videos or other files with the easiest torrent posting around.  Peer-to-peer distribution eliminates bandwidth costs.  Optional server-sharing lets you always have a fast seeder available.  The RSS channels that Broadcast Machine creates are the perfect way for users to stay continuously connected to your content, even if you only add new work occasionally.  <a href="<?= $base ?>/">Democracy Player</a> makes it simple for your fans to get your stuff and know right away when you publish something new.  It's a good way to build a fanbase.
			</p>

			<h4>2. Make Channels of Video from Around the Web</h4>
			<p>Use Broadcast Machine to pull together your favorite videos from anywhere you find them.  Just like blogging websites, Broadcast Machine lets you link to any video or file that is available on the web.  Enter the URL of a file, add metadata, and publish to your channels.  This also means that you can use a free hosting site such as <a href="http://www.archive.org">archive.org</a> or <a href="http://www.ourmedia.org">Ourmedia</a> or <a href="http://www.vimeo.com">vimeo</a> to host your videos and then use Broadcast Machine to put together an internet TV channel.</p>

			<h4>3. Run a Community Site</h4>
			<p>Want to get everyone involved?  Broadcast Machine has a simple user management system that lets you accept submissions of videos and video links from visitors to your site (you can require them to register first, if you choose to).  This means you can create a channel for a community: let anyone post to an "open" channel and then pick the best stuff to include in more selective channels-- "Featured Videos", perhaps.  Perfect for communities and organizations of every kind.</p>

			<h3>Broadcast Machine Help and FAQ</h3>
			<p>Check out the <a href="<?= $base ?>/broadcast/help/">Broadcast Machine Help</a> page for info on: publishing files, creating channels, Broadcast Machine settings, user permissions, iTunes compatibility, BitTorrent troubleshooting, upgrade instructions, and more.</p>

			</div>
			<div id="content-right-broad">
				<h4>iTunes Compatible</h4>
				<img src="<?= $base ?>/images/img_itunesscreen.png" />
				<p>Turn on iTunes compatibilty in the settings tab. Note: iTunes cannot play some video formats (such as Windows Media) and cannot download torrents.</p>

				<h4>Use Torrents - Save Bandwidth</h4>
				<img src="<?= $base ?>/images/img_torrentscreen.png" />
				<p>Broadcast Machine provides by far the easiest way to make a torrent and track it on your website.  That means you can share very large files with no bandwidth costs.  <a href="http://www.kottke.org">Kottke.org</a> says: <strong><em>"Broadcast Machine is the best interface to BitTorrent I've ever seen."</em></strong></p>

				<h4>Easy to Use</h4>
				<img src="<?= $base ?>/images/img_easyscreen.png" />
				<p>To install Broadcast Machine, you just FTP it to your server and make a couple directories.  No MySQL setup required.  Posting files is easy and can be done three different ways: link to a file on your server or anywhere else online, upload a file in the web interface, or post a torrent.</p>

				<h4>Sites Using Broadcast Machine</h4>
					<p>Broadcast Machine powers hundreds of video sites.  Here's a few:
					<ul>
						<li><a href="http://feevlog.com/bm/">Steve Garfield: FeeVlog</a></li>
						<li><a href="http://www.surrealroad.com/broadcast/library.php?i=2">Surreal Road Films</a></li>
						<li><a href="http://81.169.134.26/bm/library.php?i=1">Reality Hacks</a></li>
						<li><a href="http://claude.le.berre.free.fr/bm/library.php?i=1">Media Instantes</a>	</li>
					</ul>
					</p>
					<h4>Get Updates</h4>
						<p>Broadcast Machine is improving all the time - enter your email and be the first to hear about new versions. We won't share it with anyone.
						<form action="http://participatoryculture.org/lists/?p=subscribe&id=2" method="post" name="subscribeform">
							<input type="text" class="emailbox" name="email" value="email address" size="20" onfocus='this.value=""' />
							<input type=hidden name="makeconfirmed" value="1"/>
							<input type="hidden" name="htmlemail" value="1" />
							<input type="hidden" name="list[2]" value="signup" />
							<input type="hidden" name="listname[2]" value="Creators" />
							<input type="submit" id="emailsubmit" name="subscribe" value="Subscribe" onClick="return checkform();" />
							</form></p>
					<p>For additional news <a href="<?= $base ?>/news/feed" class="feed">subscribe to our blog feed</a>.</p>

					<h4>Broadcast Machine Support</h4>
						<ul>
							<li><a href="<?= $base ?>/broadcast/help/">Help and FAQ</a></li>
				  		</ul>

					<h4>Developers</h4>
						<ul>
							<li><a href="https://develop.participatoryculture.org/projects/dtv/browser/trunk/bmachine">Source Code</a></li>
							<li><a href="https://develop.participatoryculture.org/projects/dtv/report/10">Bug Tracker</a></li>
						</ul>


			</div>
			<div class="clearer"></div>
		</div>

<?php include "../include/end.php"; ?>
