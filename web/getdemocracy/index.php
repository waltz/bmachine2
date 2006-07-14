<?php

include ("/data/getdemocracy/site-live/include/start.php");

print<<<END

		<div id="main">
			<div id="callout">
				<h2>Democracy Player. Your internet television has arrived.</h2>
				<div id="callout-left">
					<p id="quote">"Want to see the future of Net video? Download the open source Democracy Player"<br />
						<span class="quote-byline">Wired Magazine, May 2006</span>
					</p>
					<p id="description"><strong>Stop squinting at tiny web video.</strong> Instead, download and watch all the best internet TV shows in one powerful application: any video RSS feed, video podcast, video blog, or BitTorrent file. Fullscreen, high resolution, 100% free and open source. New channels arrive daily in the built-in Channel Guide.</p>
					<div id="downloadarea">
						<div id="download-aux"><a href="/watch">Features</a> - <a href="/walkthrough">Screenshots</a></div>
END;

include("/data/getdemocracy/site-live/include/download-button.php");

print<<<END

					</div>
				</div>
END;

include("/data/getdemocracy/site-live/include/screenshot.php");

print<<<END
			</div>
		</div>
		<div id="subcallout">
			<div id="subcontent">
				<h2>Over 500 Free Channels in the Built-in Channel Guide</h2>
				<p id="subdesc">When you launch Democracy Player, you'll see the Channel Guide. New channels arrive every day and
				you can subscribe with a single-click. <a href="https://channelguide.participatoryculture.org/?q=submitchannel">Submit your channel</a>-- the Guide is open to everyone. A few examples of channels you'll find in the Guide:</p>
				<ul>
					<li id="channel1"><img id="channels" src="/images/frederator.png" height=157 width=235 border="4" />
					<h5>Channel Frederator (<a href="http://www.channelfrederator.com/">website</a>) </h5></li>
					<li id="channel2"><img id="channels" src="/images/lady_sovereign.jpg" border="4" height=157 width=235 />
					<h5>Telemusicvision <a href="http://telemusicvision.com/">(website)</a></h5></li>
					<li id="channel3"><img id="channels" src="/images/media_that_matters.png" border="4" height=157 width=235 />
					<h5>Media That Matters (<a href="http://mediathatmattersfest.org">website</a>)</h5></li>
				</ul>
				<div class="clearer"></div>
			</div>
		</div>
		<div id="otherplat">
			<h3>The Democracy Internet Television Platform</h3>
			<p>We are working to build the internet TV tools possible to ensure that people are <span class="hl">in control of their own media</span>. In addition to the player and the Channel Guide, our platform has two other components.</p>
			<div id="otherplat-left">
				<a href="/broadcast"><img src="images/img_broadcastmachine.gif" border="0" /></a>
				<a href="/broadcast" class="plathead">Broadcast Machine</a><br />Free software for your website to publish videos into a channel and create a browsable web gallery. RSS, BitTorrent, and an easy to use interface. <br /> <a href="/broadcast">Learn More >></a>
			</div>
			<div id="otherplat-right">
				<a href="http://videobomb.com"><img src="images/img_videobomb.gif" border="0" /></a>
				<a href="http://videobomb.com" class="plathead">Video Bomb</a><br /> The best videos from everywhere on the web. *Bomb* your favorites to push them to the front page. You can now bomb via Democracy Player.<br /> <a href="http://videobomb.com">Go to Video Bomb >></a>
			</div>
			<div class="clearer"></div>
		</div>
		<div id="content">
			<div id="content-left">
			<h4>What can I do with Democracy?</h4>
			<p>As we improve and expand Democracy Player, we hope it will become your homebase for video and to bring you a new, effortless way to watch internet television. We're just getting started, but already you can do a lot:</p>

			<h5>Subscribe to Channels</h5>
			<p>Democracy Player is a TV on your desktop-- it's the best application for watching internet TV channels. When you launch Democracy,
			you'll see the built-in Channel Guide which features hundreds of free channels that you can subscribe to with a single click. You can
			subscribe to podcasts, videoblogs, and Bittorrent RSS feeds.</p>

			<h5>Watch Fullscreen</h5>
			<p>Watch your videos in fullscreen mode. Lean back from your screen and relax-- videos will play one after another.</p>

			<h5>Search for Videos</h5>
			<p>If you're looking for a specific video or videos on a specific topic, the built-in Search tab will let you find videos from Yahoo!
			Video Search or Blogdigger. (Coming soon you'll be able to subscribe to a search and get new videos automatically.)</p>

			<h5>Get Smart About Disk Space</h5>
			<p>Videos take up a lot of disk space. You want to keep the best ones and clear out the rest. Democracy makes this easy. It works like a
			TiVo: after you watch a video, it will automatically 'expire' in 5 days, unless you click 'save'. You can set different channels to expire
			at different speeds-- clear out your daily news videos right away and keep videos from your favorite band forever!</p>

			<h5>Start Watching</h5>
			<p>Download Democracy Player above or <a href="/walkthrough">see screenshots and take a feature by feature tour >></a></p>
			</div>
			<div id="content-right">
				<p id="content-quote">"I'm pleased to support the Democracy platform, because it will enable, for the first time, a large-scale Internet video
				creation and distribution platform which, because it is based on open standards and open source software, will be available to everyone."<br />
					<span class="quote-byline">-Mitch Kapor, Chair, Open Source Applications Foundation</span></p>
				<p id="support-democracy">
				<strong>How to Support Democracy</strong>
				<img src="images/img_supportdemocracy.gif" /><br />
				<a href="/buttons">Promote Democracy: Put Up a Button</a>
				</p>
				<div id="storeimage"><a href="/store"><img src="images/img_democracystore.gif" border="0" /></a></div>
				<div id="workonsoftware"><h4>Work on the Software</h4>
				<p>The Democracy Player is free and open-source (GPL). Bringing in more volunteers is a big priority. We need web developers for Broadcast Machine,
				python developers for Democracy Player, and web designers to make the player's rendered HTML interface even more stylish. We also need testers to
				keep up with nightly builds and file bug reports. Can you commit some time to a great cause? <a href="/code">Learn more about the code</a> or <a href="/contact">contact us</a>. Know somebody
				who builds software or websites for a living and is always looking for a cool project? <a href="/tellafriend">Tell them about us</a>.</p>
				</div>
			</div>
			<div class="clearer"></div>
			<div id="callout-bottom">
				<img src="images/img_roadto.jpg" />
				<h4>We Need Your Help</h4>
				<p>As we continue to improve and refine Democracy Player, on the way to version 1.0, we need your help to continue our work. Give us a chance to convince
				you that our project is worth donating to.</p>
				<a href="/donate">Learn More >></a>
				<div class="clearer"></div>
			</div>
		</div>
END;

include ("/data/getdemocracy/site-live/include/end.php");

?>