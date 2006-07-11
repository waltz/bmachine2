<?php

include "/data/getdemocracy/site-live/include/start.php";

print<<<END

		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2>Frequently Asked Questions</h2>
			</div>

			<h4>Contacting Us</h4>
			<h6><a name="01-01"></a>What is the Participatory Culture Foundation?</h6>
			<p>The Participatory Culture Foundation is a non-profit organization founded in February 2005. We're based in Worcester, MA, but many of us are based elsewhere. There are ten full-time staff, and many volunteers. Our funding currently comes from private philanthropists and we'll soon be asking users for their support as well. Our mission is to build software and websites to create an independent, creative, engaging, and meritocratic TV system for millions of people around the world.</p>

							<h6><a name="01-02"></a>How do I contact the Participatory Culture Foundation?</h6>

							<p>For technical questions, please check out the rest of this FAQ and our user forums, and if your question is still unanswered, then feel free to e-mail us at <strong>feedback(at)pculture.org</strong>.</p>

							<p>Press, please see our <a href="http://getdemocracy.com/press">Press Page</a>.</p>

							<p>We love hearing general feedback -- for example, features that you'd like to see in Democracy player, or suggestions for the user interface. Write us an e-mail anytime at feedback(at)pculture.org.</p>

							<h6><a name="01-03"></a>It seems like Democracy player has some bugs, is this getting fixed?</h6>

							<p>Yes! We're always working to fix bugs in Democracy player and we're releasing new versions regularly.</p>

			<h4><a name="viewers"></a>FAQ for Viewers</h4>

			<h6><a name="02-0"></a>What is Democracy player?</h6>

							<p>Democracy player is a free application that turns your computer into an internet TV video player. You can <a href="http://www.getdemocracy.com">download it here</a> for Windows, Mac, or Linux. This release is still a beta version, which means that there are some bugs, but we're moving quickly to fix them and will be releasing bug fixes on a regular basis.</p>

							<h6><a name="02-02"></a><a name="requirements"></a>What are the system requirements to run Democracy player?</h6>

							<p>
							<strong>Windows version:</strong> Windows XP, 128MB of RAM.<br />
							<strong>Mac version:</strong> Mac OS X 10.3 or higher and QuickTime version 7 (which you should be able to get through Software Update).</p>

							<h6><a name="02-03"></a>Where can I see the open-source code for Democracy player?</h6>

							<p>Our source code is licensed under the GPL and is available at our <a href="http://develop.participatoryculture.org/projects/Democracy player">development center</a>.</p>

							<p>Open standards like RSS and Bittorrent mean that our technology is open for everyone to read and implement and is compatible with other standards based efforts.</p>

							<h6><a name="02-04"></a>What video formats can the Democracy player play?</h6>

							<p>Video playback works differently in the Mac and Windows versions of Democracy player, so the files that they can play vary to some extent.<p>

							<p><strong>Windows:</strong> The Windows version of Democracy player embeds VLC to play videos.  This will play Windows Media, Quicktime, MPEG 1, 2, 4, H264, AVI, DivX, XviD, OGM, and lots more.  You can see a full chart of what VLC can play <a href="http://www.videolan.org/vlc/features.html">right here</a>.


							<p><strong>Mac:</strong>The Mac version of Democracy player uses Quicktime 7, which is built into the operating system, to play video. Anything that plays in Quicktime will play, including MPEG, MP4, MOV, H264, and others.  There is a free extension for OS X that will play Windows Media files seamlessly within quicktime.  We strongly suggest that you <a href="http://www.flip4mac.com/wmv.htm">download it</a>.  And when you encouter a video that can't be played in the main window, Democracy will let you launch an external player.</p>

							<p>We strongly believe that format wars among commercial entities have been a huge stumbling block to advancing internet video. The best way out of the "format wars" is to support as many formats as possible -- and users shouldn't have to think about formats at all. We will be adding support on a continuing basis for AVIs, Flash, Real, and Windows Media.</p>

							<p>In terms of open-source, patent-unencumbered codecs like Theora, our goal is to support them as soon as we can, and -- once open-source media players and publishing tools get a bit more solid and commonplace -- to nudge publishers to use them.</p>

			<h4>Download &amp; Installation</h4>

			<h6><a name="03-01"></a>How do I install Democracy player?</h6>

							<p>Windows: clicking on the download link saves a .exe file to your desktop. Double click on that to run the installer.</p>

							<p>Apple: clicking on the download link saves a .dmg (disk image) to your desktop. Double click on that to open it (if it doesn't open automatically). Drag the Democracy player icon into your applications folder and wait for it to copy over, then open the applications folder and double-click the Democracy player icon.</p>

							<p>If you're upgrading Democracy player, just 'replace' your existing version and your Channel subscriptions and video collections will remain.</p>

							<h6><a name="03-02"></a>Democracy player won't launch.</h6>

							<p>Windows: make sure you meet the system requirements of Windows XP, 128MB of RAM.</p>

							<p>Apple: Mac OS X 10.3 or higher and also QuickTime version 7, which is a software auto-update on Macs (run the second option under your Apple icon). This is most likely the cause. QuickTime 7 is also available <a href="http://www.quicktime.com">here</a>.</p>

			<h4>Using Democracy Player</h4>

			<h6><a name="04-01"></a>How do I use the Democracy player?</h6>

							<p>Here's the basic flow of using the Democracy player, with more details below. The Channel Guide is your home base. Look around it and subscribe to any channels that look interesting -- there's no limit, they're free of charge and you can unsubscribe from any channel at any point. Once you're subscribed to a channel, you can download videos that seem interesting and watch them at your convenience. You can delete any video at any point and download it again, so feel free to explore.</p>

							<h6><a name="04-02"></a>What are the basic features of the Democracy player?</h6>

							<p>These versions of the player are still beta, so we'll be adding more features on a rolling basis, making small interface improvements, and releasing bug fixes. Also, it's all open-source so we absolutely invite any programmers to dive in and remix the player under the GPL. That said, basic features on this version are as follows:</p>

							<p>On the left-hand sidebar of Democracy player, above your list of channel subscriptions, there are four items that remain constant. The first, Channel Guide, lets you return to the front page of the Channel Guide wherever you are in the player. The second, My Collection, shows you all the videos you have downloaded and are ready to watch at that moment. The third, New Videos, shows you what videos you have downloaded but not yet watched. The fourth item, Search, lets you search the internet for search terms from within the Democracy player. You can then download and watch videos from the search results in Democracy as usual.</p>

							<p>In the upper-right hand corner of Democracy player, three options remain constant. The first, Settings, is described in more detail below (see "how do I manage my videos") -- it allows you to set how often your channels refresh, how long videos remain on your hard drive, and more. The second, Recommend, launches your e-mail application so you can recommend an interesting channel to your friends and family and others over e-mail. The third, Search, searches within the current page of the player -- for example, if you're on a channel with lots of videos available, entering search terms will return videos with the matching terms. It's especially useful in your "My collection" section of the player, where you can use the search to quickly return to videos you'd like to watch again without scrolling down through your collection.</p>

							<p>Once you've downloaded a video, there are several options that remain more or less constant on the right-hand side of the Democracy player, alongside each video. The top line is usually an acronym such as MOV or MP4 -- this is the format (or codec) of the file, along with a number such as 16MB, which stands for 16 MegaBytes, the size of the file. The second line displays the status of the video within the player -- either unwatched or how long the video will remain accessible to Democracy before expiring (in order to save you disk space). You can choose to save any video indefinitely (until you choose to delete it later on) by clicking "save". Below those options are three more. The first, an icon of a garbage can, deletes that individual video. (You can always re-download videos so feel free to delete at will). The second, an icon of an envelope, launches your e-mail application with a standardized form message for sharing videos and channels with your friends, family, co-workers, and anyone you wish. The third, an icon of a bomb, allows you to "bomb" a video in our website <a href="http://videobomb.com/">Videobomb.com</a>. See below for more info on how that option works.</p>

							<h6><a name="04-03"></a>How do I play videos in fullscreen mode?</h6>

							<p>There are two ways: either by using the menu at the top of your screen to select Video --> Fullscreen; or, once a video is already playing, by clicking on the "play fullscreen" button -- this is the smaller "play" arrow with a square around it, located directly to the right of the normal "play" button at the bottom of the player.</P>

							<h6><a name="04-04"></a>How do I exit fullscreen mode while a video is playing?</h6>

							<p>Double click on the screen to exit.</p>

							<h6><a name="04-05"></a>Why are there channels already subscribed when I first installed Democracy?</h6>

							<p>Just to help you get started in the fascinating new ecosystem of open internet TV. You can unsubscribe from any of the default channels at any time, of course, and re-subscribe whenever you want by finding them again in the Channel Guide and subscribing.</p>

							<h6><a name="04-06"></a>How do I subscribe to channels?</h6>

							<p>Use the Democracy player Channel Guide to find whatever interests you. You can browse the Guide by category, tag (submitted by the channel publishers), date submitted, popularity, or by searching for keywords. Click on any channel's "subscribe" button in the Guide and it will be added to your list of subscriptions in the left-hand sidebar of the Democracy player.</p>

							<h6><a name="04-07"></a>How do I un-subscribe from channels?</h6>

							<p>Right-click (Mac users: control-click) on the name of the channel in the left-hand sidebar of the Democracy player and select "Remove" -- the channel will disappear right away. You may re-subscribe to any channel again by finding it in the Guide and clicking "subscribe," nothing special required. Feel free to browse and subscribe to channels with a sense of curiosity and impunity.</p>

						<h6><a name="04-08"></a>How do I automatically download (auto-download) everything from a channel?</h6>

						<p>At the top, in the center of the Democracy player, is a single checkbox for "auto download." You can check or un-check it at any time.</p>


							<h6><a name="04-09"></a>How do I watch videos?</h6>

							<p>Click the 'down' arrow on a video to download it. Check off 'auto-download' box on a channel and the Democracy player will automatically download new videos on that channel. Click on 'play' or 'play fullscreen' buttons, at the bottom of the player, whenever you'd like to watch the videos.</p>

							<h6><a name="04-10"></a>How do I know when new videos are available to download, or have already downloaded and are ready to watch?</h6>

							<p>Next to each channel's name, two indicators may appear: a blue circle indicates that the channel has published new videos that you haven't seen and a green circle indicates that you have videos in that channel that you've downloaded but haven't watched. Democracy's default is for videos to remain on your hard drive for 6 days, but you can change that in the "settings" panel of Democracy (upper-right hand corner).</p>

							<h6><a name="04-11"></a><a name="nodownload">I'm trying to download a video, but the video isn't downloading.</a></h6>

							<p>First, give Democracy player some time to make the connection. If after a few minutes the download hasn't started, there are a number of possible causes. Most likely, the publisher of the videos you've selected is experiencing difficulties. Their video publishing connection might have been interrupted, or the video might have been published using BitTorrent but no longer has seeders. You can try to click on the download button in a few mintues to see if the publisher's connection is back up. If you have a channel set to "Automatic Download" and you see the message "Pending Download" next to each video in the channel, don't worry, videos will download shortly. Videos in pending download mode are added to the download queue and will start downloading when there is space for more downloads (there is a maximum number of downloads at a time).</p>

							<h6><a name="04-12"></a>I subscribed to a channel but it's empty. The channel does not show any videos available to download.</h6>

							<p>First, give Democracy a moment to find all the available videos. It sometimes takes a minute or so after you first subscribe to a channel for all the images and videos to appear, though usually it happens right away. (By the way, this is because there's a myriad of publishing and RSS formatting options.) Second, if the channel still doesn't show any videos, right-click (Mac peeps, ctrl-click) on the channel name in the left-hand sidebar of the Democracy player and select "Update Channel Now." This will refresh the channel and may cause new images or videos to appear. If no videos appear even after refresh, the channel is likely exeperiencing difficulties -- you may choose to contact the channel publisher to alert them, using the contact information they have made public on their channel's profile in the Democracy Channel Guide.</p>

							<p>The blue-colored rows in each channel's gallery of available videos, viz. "On This Channel," "Downloading," "Watched," and "Expiring," can also collapse and expand -- don't forget to check those for videos that might have slipped your vision.</p>

							<h6><a name="04-13"></a>I downloaded a video, but it won't play.</h6>

							<p>First, check the file format to make sure it's compatible with Democracy -- if you're on Windows, that it would play in VLC, and if you're on a Mac, that it would play on QuickTime v. 7. Second, check the file format of what you downloaded to make sure it's a video -- the publisher might have put out some audio files (for example, .mp3 files), which of course do not include video. Third, check the size of the file you downloaded to ensure that it's not zero. If none of those work, the publisher is likely experiencing difficulties and may have published an invalid file.</p>

							<h6><a name="04-14"></a>How do I view a channel that's not listed in the Guide?</h6>

							<p>Simple: click "add channel" in the bottom left-hand corner of the Democracy player, paste in the RSS feed, and let Democracy player find the available content. Democracy can sometimes scrape websites for video content, in cases where RSS feeds aren't available and you'd like to enjoy video in Democracy, though often the player takes a little while to find all the available videos on the website -- try refreshing the channel, that usually helps.</p>

							<h6><a name="04-15"></a>How do I share videos or channels I like? How do I tell a friend about interesting videos or channels?</h6>

							<p>In the upper-right hand corner of Democracy, click "Recommend" -- that will launch your default e-mail application and fill in a standard message that you may alter however you choose. Just fill in the e-mail addresses of whoever you'd like to share with -- friends, family, co-workers, nieces, nephews, potential employers.</p>

							<h6><a name="04-16"></a>How do I set preferences to manage the videos I've downloaded?</h6>

							<p>Democracy player has a full set of preferences for how many videos you download and how long they remain on your hard drive before expiring. In the upper-right hand corner of the player, click on "Settings." Or you may access it using the top menu -- if you're using Windows, go to Edit --> Preferences; if you're using a Mac, go to Democracy --> Preferences.</p>

							<p>On these settings menus, users have several options: you may choose to run Democracy at startup; you can set how often you check channels for new content; you can set your rate of upstream; and you can manage how much disk space Democracy should leave available, including the default rate by which videos expire.</p>

							<p>Feel free to delete any videos you like from within the Democracy player, you can always download the videos again at a later date. The default rate by which videos expire off your hard drive is set to 6 days -- you may adjust this however you choose by going to Preferences --> Disk Space. It's a really simple process, just use the drop-down box to select the number of days you wish to keep videos, and set the amount of disk space you wish to remain available, nothing technical required.</p>

							<h6><a name="04-17"></a>I downloaded a video but it's gone from my collection.</h6>

							<p>The video most likely expired -- Democracy has a default setting that videos 6 days old, that have not been specifically 'saved,' expire in order to preserve disk space on your hard drive. Feel free to adjust your preferences on the "settings" section of the player (look in the upper-right).</p>

							<h6><a name="04-18"></a>How do I "bomb" a video, as in, link up with Videobomb.com, from within the Democracy player?</h6>

							<p>Next to each video on the far right side of the Democracy player is the "bomb" icon that links up with PCF's free social bookmarking website <a href="http://www.videobomb.com/">Videobomb</a>. Clicking on the "bomb" means that you have added your individual "bomb" (i.e., your vote) to the video, meaning that it will gain another "bomb" in the site-wide Videobomb rankings (whereby the most popular videos are promoted to the front page), and that it will be re-published to your individual channel in Videobomb.</p>

						<p>This has some cool implications: if you "bomb" someone's video from within Democracy player, it will be re-published to your online Videobomb channel for anyone to watch on the Videobomb website. And for whoever is subscribed to your Videobomb channel (your Videobomb RSS feed) within Democracy, that video will then show up in their Democracy player -- basically, taking the video from your Democracy into Videobomb back into other people's Democracy. It's like being able to share videos with your friends, members, or audience without the muss and fuss of e-mailing links -- just "bomb" it in the player, and if they're subscribed to your channel, it will show up automatically in their Democracy player. Even better if they're auto-downloading it, it's instant easy sharing.</p>


							<h6><a name="04-19"></a>Can I sync my videos to an iPod or other video device?</h6>

							<p>Right now Democracy Player does not allow direct syncing to portable devices.  However, we will be working on this in future versions.  In the meantime, you may be able to sync the video files themselves with a seperate program.
							</p>

			<h4><a name="creators"></a>FAQ for Creators</h4>

			<h6><a name="05-01"></a>What is Broadcast Machine? Where can I find user support for Broadcast Machine and making channels?</h6>

							<p><a href="http://participatoryculture.org/broadcast">Broadcast Machine</a> is our open source publishing software for videos. It's a bit like blogging software for video. It walks you through making a Democracy player-compatible internet TV channel out of your videos. To use Broadcast Machine you need to have a website on which to install it (it's server-side software written in PHP). But even if you don't have a website on which to install Broadcast Machine, you can still create your own internet TV channel that plays in Democracy using our free website <a href="http://videobomb.com/index/faq">Videobomb.com</a>.</p>

							<p>Broadcast Machine allows anyone to publish video affordably using BitTorrent or HTTP, or by linking to a file anywhere on the web, with an easy, blogging-like interface. You can find out more about Broadcast Machine and upload the tool to your website <a ahref="http://participatoryculture.org/broadcast/">here</a>, and please see our Broadcast Machine <a href="http://participatoryculture.org/broadcast/help/">help FAQ</a>. For additional help, please e-mail: feedback(at)pculture.org.</p>


							<h2>MAKING A CHANNEL</h2>
							<h6><a name="05-02"></a>What is an internet TV channel and how can I make one?</h6>

							<p>An internet TV channel is an RSS feed with video enclosures. An easy way to create a channel is to use our free video publishing software, <a href="../../../help/faq/broadcast">Broadcast Machine</a>, which is designed to dovetail with Democracy player. Broadcast Machine allows anyone to publish video affordably using BitTorrent or HTTP, with an easy, blogging-like interface. Broadcast Machine is software for websites, so you'll need your own web server on which to install it.</p>

							<p>Another way to create an internet TV channel is to use our free website <a href="http://videobomb.com/">Videobomb.com</a> -- you can submit links to video located anywhere on the web, as well as re-publish other videos anywhere you find them, and anyone can subscribe to your channel (RSS feed) to view in the Democracy Player.</p>

							<p>If you have already have an RSS feed and you'd like to make it Democracy player-compatible, <a href="/help/feeds.php">click here for more info</a> on Democracy's open RSS standard.</p>

							<p>If you'd like to publish a Democracy player channel from your free webpage (e.g., Blogspot pages), please visit <a href="http://freevlog.org/">FreeVlog</a> for step-by-step tutorials on how to get an RSS feed with video enclosures using entirely free services. On Freevlog you can follow along with QuickTime movie tutorials or read .pdf transcripts of the steps involved, no extensive tech expertise necessary.</p>

							<h2>SUBMITTING A CHANNEL</h2>
							<h6><a name="05-03"></a>How do I submit a channel to the Channel Guide?</h6>

							<p>We're proud to offer open submissions to our Channel Guide, and Democracy player will play most video RSS feeds out there already. Channels can be RSS feeds with video links in them or webpages with links to videos. We encourage everyone to submit their channel to the Guide and we hope to grow it into a fascinating but welcoming labyrinth of internet TV offerings. We accept most channels, barring highly offensive or adult content. For more information, please read our <a href="http://participatoryculture.org/terms/">Terms of Use</a>. So by all means, come on in...</p>

							<p>First, thanks for submitting your channel and including your voice in the growing mass medium of internet TV.</p>

							<h6>We recommend that channels:</h6>
							<ul>
								<li>Have a Democracy player-compatible video RSS feed. Please consult our <a href="/help/feeds.php">ideal RSS format</a> for more info -- it's RSS 2.0 with media extensions.</li>
								<li>Have videos in a Democracy player-compatible format. Anything that plays in VLC will play in the Windows beta version of Democracy, and anything that will play in QuickTime v. 7 will play in the Mac version of Democracy player.</li>
								<li>Have an associated image for the channel that will display in the Guide. The preferred dimensions for the channel image are 360px by 240px, and it should be less than 40kb. Channel images tend to look best when they have the name of the channel in the image itself. If you don't have an image, we recommend you take a screenshot of one of your videos -- but you may need to reduce the image size.</li>
								<li>We recommend -- but do not require -- that each video in your channel have an associated thumbnail image. These thumbnails can be any size you like, but generally don't need to be bigger than 200px by 133px. Thumbnails make a much, much nicer viewing experience for the user, so please try to make sure your channel's thumbnails are coming through in your feed.</li>
								<li>It will greatly facilitate your channel's approval process if you test it yourself in Democracy player before submitting it to the guide. You can test your video RSS feed at any time (even if it's not in the Guide) by manually adding it -- just click "add channel" in the lower-left corner of Democracy player. Please ensure that your videos download and play in Democracy player, that your channel icon is displaying properly, and ideally that each video has an accompanying thumbnail image.</li>
							</ul>

							<p>If you meet the above requirements, then go into the Democracy player Channel Guide and click on "submit a channel" (on the right-hand sidebar). You'll first need to register with the Channel Guide, and then you'll be able to log in and submit your channel, which will then go into our moderation queue for approval by a member of the Participatory Culture team.</p>

							<h6><a name="05-04"></a>I tried to register with the Democracy player Channel Guide and I did not receive a registration e-mail to my specified e-mail address.</h6>

							<p>Check your junk mail, or your email spam filter, for an e-mail with the subject heading that includes the terms "Democracy Channel Guide" or other relevant terms -- it may come from the e-mail address channels/at/pculture|dot|org, but not necessarily. If you have not received anything, please email feedback(at)pculture.org and we can help you get an account working.</p>

							<h6><a name="05-05"></a>I submitted a channel to the Guide, and it hasn't shown up yet.</h6>

							<p>It's likely that your channel is in the moderation queue, where it will be tested and reviewed by someone from the Participatory Culture team or a trusted volunteer. We test all new channels for a couple of things: first, that it meets the PCF <a href="http://participatoryculture.org/terms/">Terms of Use</a>; second, that the requirements outlined above are met -- basically, that videos play, and hopefully that thumbnails are plentiful.</p>

							<p>If your channel is ready to publish in Democracy player, it will likely be added to the guide in less than 24 hours. Otherwise, we'll be in touch to let you know what needs to be fixed.</p>


							<p>Anything we're missing? Send questions / comments to feedback(at)pculture.org.</p>



			</div>
			<div id="content-right-2col">
				<div id="lower-sidebar2">
				<h6>Contacting Us</h6>
					<ul>
						<li><a href="#01-01">What is the Participatory Culture Foundation?</a></li>
						<li><a href="#01-02">How do I contact the Participatory Culture Foundation?</a></li>
						<li><a href="#01-03">It seems like Democracy player has some bugs, is this getting fixed?</a></li>
					</ul>

					<h6>FAQ for Viewers</h6>
											<ul>
												<li><a href="#02-01">What is Democracy player?</a></li>
												<li><a href="#02-02">What are the system requirements to run Democracy player?</a></li>
												<li><a href="#02-03">Where can I see the open-source code for Democracy player?</a></li>
												<li><a href="#02-04">What video formats can the Democracy player play?</a></li>
											</ul>
					<h6>Download &amp; Installation</h6>
							<ul>
								<li><a href="#03-01">How do I install Democracy player?</a></li>
								<li><a href="#03-02">Democracy player won't launch.</a></li>
							</ul>

					<h6>Using Democracy Player</h6>
						<ul>
							<li><a href="#04-01">How do I use the Democracy player?</a></li>
							<li><a href="#04-02">What are the basic features of the Democracy player?</a></li>
							<li><a href="#04-03">How do I play videos in fullscreen mode?</a></li>
							<li><a href="#04-04">How do I exit fullscreen mode while a video is playing?</a></li>
							<li><a href="#04-05">Why are there channels already subscribed when I first installed Democracy?</a></li>
							<li><a href="#04-06">How do I subscribe to channels?</a></li>
							<li><a href="#04-07">How do I un-subscribe from channels?</a></li>
							<li><a href="#04-08">How do I automatically download (auto-download) everything from a channel?</a></li>
							<li><a href="#04-09">How do I watch videos?</a></li>
							<li><a href="#04-10">How do I know when new videos are available to download, or have already downloaded and are ready to watch?</a></li>
							<li><a href="#04-11">I'm trying to download a video, but the video isn't downloading.</a></li>
							<li><a href="#04-12">I subscribed to a channel but it's empty. The channel does not show any videos available to download.</a></li>
							<li><a href="#04-13">I downloaded a video, but it won't play.</a></li>
							<li><a href="#04-14">How do I view a channel that's not listed in the Guide?</a></li>
							<li><a href="#04-15">How do I share videos or channels I like? How do I tell a friend about interesting videos or channels?</a></li>
							<li><a href="#04-16">How do I set preferences to manage the videos I've downloaded?</a></li>
							<li><a href="#04-17">I downloaded a video but it's gone from my collection.</a></li>
							<li><a href="#04-18">How do I "bomb" a video, as in, link up with Videobomb.com, from within the Democracy player?</a></li>
						</ul>

				<h6>FAQ for Creators</h6>
					<ul>
						<li><a href="#05-01">What is Broadcast Machine? Where can I find user support for Broadcast Machine and making channels?</a></li>
						<li><a href="#05-02">What is an internet TV channel and how can I make one?</a></li>
						<li><a href="#05-03">How do I submit a channel to the Channel Guide?</a></li>
						<li><a href="#05-04">I tried to register with the Democracy player Channel Guide and I did not receive a registration e-mail to my specified e-mail address.</a></li>
							<li><a href="#05-05">I submitted a channel to the Guide, and it hasn't shown up yet.</a></li>
					</ul>

				</div>

				</div>
			</div>
			<div class="clearer"></div>
		</div>

END;

include "/data/getdemocracy/site-live/include/end.php";

?>