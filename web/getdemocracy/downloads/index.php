<?php

include "../include/start.php";

?>

		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2 style="text-align: center;">Download Democracy Player</h2>
			</div>

			<div id="downloadarea-sub" style="padding-top: 10px; padding-bottom: 20px;">


<?php include "../include/download-button.php" ; ?>
			</div>

			<div id="downloads">
			<p><strong>OTHER VERSIONS:</strong></p>

							<div class="column3" style="width:150px; margin-right:20px;">
								<a href="osx.php" title="Download Democracy Player for Mac OS X"><img src="<?= $base ?>/downloads/images/os-apple.gif" alt="" /></a>
								<h2>Mac OS X</h2>
								<h2><a href="osx.php" title="Download Democracy Player for Mac OS X"> Download Now</a></h2><p>Version <?= $dtv_version ?> (beta)<br />
								
									<span class="small">Requires OS X 10.3+ and QuickTime 7</span></p>
							</div>
							<div class="column3" style="width:150px; margin-right:20px;">
								<a href="windows.php" title="Download Democracy Player for Windows XP"><img src="<?= $base ?>/downloads/images/os-windows.gif" alt="" /></a>
								<h2>Windows</h2>
								<h2><a href="windows.php" title="Download Democracy Player for Windows XP">Download Now</a></h2>
								<p>Version <?= $dtv_version ?> (Beta)<br />
									<span class="small">Requires Windows XP / 2000<br />128MB RAM<br /><br />Note: should work on Windows 95/98/ME with DirectX 3.0 or later,<br />but not officially supported.</span></p>
							</div>

							<div class="column3" style="width:150px; margin:0px;">
								<img src="<?= $base ?>/downloads/images/os-fedora.gif" alt="" />
								<h2>Fedora</h2>
								<p>Version: <?= $dtv_version ?> (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
								<Br /><Br />
								<strong>Fedora Core 5 Binaries:</strong><br />
								<a href="fc5std.php">Download Standard</a><br />
								<a href="fc5dbg.php">Download Debugging</a><Br />
								<a href="fc5src.php">Download Source</a><Br /><Br />

								<strong>Fedora Core 4 Binaries:</strong><Br />
								<a href="fc4std.php">Download Standard</a><br />
								<!--<a href="fc4dbg.php">Download Debugging</a><Br />-->
								<a href="fc4src.php">Source</a><Br /><Br />
							</div>


			<br style="clear: both;" />				<br style="clear: both;" />


							<!--<p><a name="linux"></a><strong>LINUX VERSIONS</strong></p>-->


							<div class="column3" style="width:150px; margin-right: 20px;">
								<img src="<?= $base ?>/downloads/images/os-ubuntu.gif" alt="" />
								<h2>Ubuntu</h2>
								<h2><a href="ubuntu.php">Download Now</a></h2>
								<p>Version: <?= $dtv_version ?> (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
							</div>


							<div class="column3" style="width:150px; margin-right:20px;">
								<img src="<?= $base ?>/downloads/images/os-debian.gif" alt="" />
								<h2>Debian</h2>
								<h2><a href="debian.php">Download Now</a></h2>
								<p>Version: <?= $dtv_version ?> (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
							</div>


							<div class="column3" style="width:150px; margin:0px;">
								<img src="<?= $base ?>/downloads/images/os-gentoo.png" alt="Gentoo Linux"/>
								<h2>Gentoo</h2>
								<h2><a href="gentoo.php">Download Now</a></h2>
								<p>Version: <?= $dtv_version ?> (Beta)<br />
								<a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Install Notes</a>
							</div>

							
							<div class="clearer"></div>
						</div>
						<div 
style="background-color: #f3f3f3; padding: 4px; font-size: 
11px;"><strong>Known Linux Bug</strong> - Some versions of libxine cause a crash when playing H.264 videos. <a href="https://develop.participatoryculture.org/projects/democracy/wiki/LinuxNotes">Learn More</a> </div>
			<h4>Democracy Player Source Code</h4>
			<p>Developers - We recommend that developers use the <a href="https://develop.participatoryculture.org/projects/democracy/
			">lastest code from subversion</a>, but
			source code for releases is also available in <a href="ftp://ftp.osuosl.org/pub/pculture.org/democracy/src/">tarball format on our ftp
			site</a>.</p>
			</div>
			<div id="content-right-2col">
				<ul class="sidebar-nav">
					<li><a href="<?= $base ?>/watch">Watch TV</a>
						<ul>
							<li><a href="<?= $base ?>/downloads">Download Player</a></li>
							<li><a href="<?= $base ?>/walkthrough">Screenshots</a></li>
							<li><a href="<?= $base ?>/walkthrough">Walkthrough</a></li>
						</ul>
					</li>
				</ul>
				<div id="lower-sidebar">
				<h6>Stay up to Date</h6>
					<p>Things are moving fast. Check out our blog and signup for email notifications below (we won't share your email address with anyone and we only send occasional, important announcements).</p>

				<?php include "../include/stayuptodate.php"; ?>

				</div>

				</div>
			</div>
			<div class="clearer"></div>
		</div>

<?php include "../include/end.php"; ?>
