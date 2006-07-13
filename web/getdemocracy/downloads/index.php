<?php

include "/data/getdemocracy/site-live/include/start.php";

print<<<END

		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2>Download Democracy Player</h2>
			</div>

			<div id="downloadarea-sub">


END;

include "/data/getdemocracy/site-live/include/download-button.php" ;

print<<<END
			</div>

			<div id="downloads">
			<p><strong>Windows and Mac Versions</strong></p>

							<div class="column3" style="width:220px; margin-right:20px;">
								<a href="osx.php" title="Download Democracy Player for Mac OS X"><img src="http://getdemocracy.com/downloads/images/os-apple.gif" alt="" /></a>
								<h2><a href="osx.php" title="Download Democracy Player for Mac OS X">Mac OS X</a></h2>
								<p>Version: 0.8.4.1 (Beta)<br />
									<span class="small">Requires: OS X 10.3+ and QuickTime 7, 256MB RAM Suggested.</span></p>
							</div>
							<div class="column3" style="width:220px; margin-right:20px;">
								<a href="windows.php" title="Download Democracy Player for Windows XP"><img src="http://getdemocracy.com/downloads/images/os-windows.gif" alt="" /></a>
								<h2><a href="windows.php" title="Download Democracy Player for Windows XP">Windows XP</a></h2>
								<p>Version: 0.8.4.1 (Beta)<br />
									<span class="small">Requires: Windows XP or 2000, 128MB RAM (256MB Recommended).<br /><br />Note: should work on Windows 95/98/ME with DirectX 3.0 or later, but not officially supported.</span></p>
							</div>


			<br style="clear: both;" />				<br style="clear: both;" />


							<p><a name="linux"></a><strong>Linux Versions</strong></p>


							<div class="column3" style="width:150px; margin-right: 20px;">
								<img src="http://getdemocracy.com/downloads/images/os-ubuntu.gif" alt="" />
								<h2><a href="ubuntu.php">Ubuntu</a></h2>
								<p>Version: 0.8.4.1 (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
							</div>


							<div class="column3" style="width:150px; margin-right:20px;">
								<img src="http://getdemocracy.com/downloads/images/os-debian.gif" alt="" />
								<h2><a href="debian.php">Debian</a></h2>
								<p>Version: 0.8.4.1 (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
							</div>


							<div class="column3" style="width:150px; margin:0px;">
								<img src="http://getdemocracy.com/downloads/images/os-fedora.gif" alt="" />
								<h2>Fedora</h2>
								<p>Version: 0.8.4.1 (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
								<Br /><Br />
								<strong>Fedora Core 5 Binaries:</strong><br />
								<a href="fc5std.php">Standard</a><br />
								<a href="fc5dbg.php">Debugging</a><Br />
								<a href="fc5src.php">Source</a><Br /><Br />

								<strong>Fedora Core 4 Binaries:</strong><Br />
								<a href="fc4std.php">Standard</a><br />
								<a href="fc4dbg.php">Debugging</a><Br />
								<a href="fc4src.php">Source</a><Br /><Br />
							</div>
							<div class="clearer"></div>
						</div>
						<div style="background-color: #f3f3f3; padding: 4px; font-size: 11px;"><strong>Known Linux Bugs</strong> - There are 2 important known bugs on Linux: crash while playing H.264 videos and a focus control bug. <a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Learn More >></a> </div>
			<h4>Democracy Player Source Code</h4>
			<p>Developers - We recommend that developers use the <a href="https://develop.participatoryculture.org/projects/democracy/
			">lastest code from subversion</a>, but
			source code for releases is also available in <a href="ftp://ftp.osuosl.org/pub/pculture.org/democracy/src/">tarball format on our ftp
			site</a>.</p>
			</div>
			<div id="content-right-2col">
				<ul class="sidebar-nav">
					<li><a href="http://getdemocracy.com/watch">Watch TV</a>
						<ul>
							<li><a href="http://getdemocracy.com/downloads">Download Player</a></li>
							<li><a href="http://getdemocracy.com/walkthrough">Screenshots</a></li>
							<li><a href="http://getdemocracy.com/walkthrough">Walkthrough</a></li>
						</ul>
					</li>
				</ul>
				<div id="lower-sidebar">
				<h6>Stay up to Date</h6>
					<p>Things are moving fast. Check out our blog and signup for email notifications below (we won't share your email address with anyone and we only send occasional, important announcements).</p>

				<h6>Viewers: Sign-up</h6>
				<p>Be the first to know about new versions of the Democracy player:
				<form action="http://participatoryculture.org/lists/?p=subscribe&id=4" method="post" name="subscribeform">
					<input type="text" class="emailbox" name="email" value="email address" size="20" onfocus='this.value=""' />
					<input type=hidden name="makeconfirmed" value="1"/>
					<input type="hidden" name="htmlemail" value="1" />
					<input type="hidden" name="list[4]" value="signup" />
					<input type="hidden" name="listname[4]" value="Viewers" />
					<input type="submit" id="emailsubmit" name="subscribe" value="Subscribe" onClick="return checkform();" />
				</form>
				<a href="http://getdemocracy.com/watch">Watch TV page >></a></p>

				<h6>Videomakers / Publishers</h6>
				<p>Get updates about Broadcast Machine and channel creation:
				<form action="http://participatoryculture.org/lists/?p=subscribe&id=2" method="post" name="subscribeform">
					<input type="text" class="emailbox" name="email" value="email address" size="20" onfocus='this.value=""' />
					<input type=hidden name="makeconfirmed" value="1"/>
					<input type="hidden" name="htmlemail" value="1" />
					<input type="hidden" name="list[2]" value="signup" />
					<input type="hidden" name="listname[2]" value="Creators" />
					<input type="submit" id="emailsubmit" name="subscribe" value="Subscribe" onClick="return checkform();" />
				</form>
				<a href="http://getdemocracy.com/make">Make TV page >></a></p>

				<h6>Translators</h6>
				<p>DTV and Broadcast Machine will soon support translations.  Signup if you'd like to help:
				<form action="http://participatoryculture.org/lists/?p=subscribe&id=3" method="post" name="subscribeform">
					<input type="text" class="emailbox" name="email" value="email address" size="20" onfocus='this.value=""' />
					<input type=hidden name="makeconfirmed" value="1"/>
					<input type="hidden" name="htmlemail" value="1" />
					<input type="hidden" name="list[3]" value="signup" />
					<input type="hidden" name="listname[3]" value="Developers" />
					<input type="submit" id="emailsubmit" name="subscribe" value="Subscribe" onClick="return checkform();" />
				</form>
				</p>

				</div>

				</div>
			</div>
			<div class="clearer"></div>
		</div>

END;

include "/data/getdemocracy/site-live/include/end.php";

?>