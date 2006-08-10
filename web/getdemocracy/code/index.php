<?php
include "../include/start.php";
?>
		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2>Code</h2>
				<p class="subhead">The Democracy platform is free and open source (GPL), built by a great group of developers who are dedicated to making mainstream media open and democratic.</p>
				<p style="color: red;">Now Hiring: <a href="<?= $base ?>/jobs">Software Developer</a></p>
				<p>The Democracy player is our central development project. The majority of the code is cross platform Python with platform specific frontends for Windows, OS X, and GTK/X11. The core of the GUI is written in cross platform HTML, but we strive for a native look and feel on each platform. We leverage free software projects wherever we can -- VLC, Xine, Bit Torrent, and Mozilla just to name a few.</p>

				<p>There are still many parts of development left to do and we can use all the help we can get. There are lots of ways you can pitch in-- report bugs, perform quality testing, submit patches, give feedback to the team, and share your ideas on how to make Democracy better.</p>
			</div>

			<h4>Sit down at the table to get started</h4>
			<p>If you're interested in being a part of the
			Democracy community, the best way to get involved is to join in on the conversation.  Here are a
			few things to look over before you get started.</p>

			<p>Find answers in our <a href="<?= $base ?>/help/faq">FAQ</a> - If you have a question,
			check here because it may have been answered.<p> <p>Sign up on the <A
			href="http://sourceforge.net/mail/?group_id=136141">Mailing List</a>-- The mailing list is a great
			way to ask and answer questions and keep up with development.</p>

			<h4>Democracy Code and Documentation</h4>
			<p>We've documented the development process so that there is
			useful information to help anyone get started. This is a good place to start learning about the
			Democracy code and the unique development strategy and code of this project.</p> <ul> <li><a
			href="https://develop.participatoryculture.org/projects/dtv">Democracy Trac Project</a></li> <li><a
			href="https://develop.participatoryculture.org/projects/dtv/wiki/DevelopmentDocs">Development
			Documents</a></li> <li><a
			href="https://develop.participatoryculture.org/projects/dtv/report/11">Bug List</a></li> <li><a
			href="http://participatoryculture.org/nightlies/">Nightly builds</a><br /> You can find the
			latest Democracy build, but <strong>only download if you are ready to get pre-release (buggy)
			versions</strong>.</li> </ul>

			<h4>Ways to Help Democracy</h4>
			<p>There are different ways you can get involved and be a part of
			our development team.</p>

			<p>1. <strong>TESTERS</strong>: Democracy gets better when people test the application and report
			bugs. You can help make Democracy a better application for watching video. Download Democracy,
			test, and become a tester here.</p>

			<p>2. <strong>DEVELOPERS</strong>: We need your help to follow our road map. You can check out
			Democracy code from the subversion repository. Just type:<br />svn co
			https://svn.participatoryculture.org/svn/dtv/<br />and report bugs and patches in our bug tracker
			here.</p>

			<p>3. <strong>DOCUMENTERS</strong>: There is a lot of documentation of Democracy that still needs
			to get written. You can add to this wishlist of documentation here.</p>

			<p>4. <strong>DESIGNERS</strong>: We designed the app so that the majority of the GUI is HTML just
			for you.</p>

			</div>
			<div id="content-right-2col">
				<ul class="sidebar-nav">
					<li><a href="<?= $base ?>/code">Code</a>
						<ul>
							<li><a href="http://develop.participatoryculture.org/">Developer Center</a></li>
								<li><a href="https://develop.participatoryculture.org/projects/dtv/browser/trunk/tv/">Source Code</a></li>
								<li><a href="https://develop.participatoryculture.org/projects/dtv/report">Bug Tracker</a></li>
								<!-- <li><a href="<?= $base ?>/">Mailing Lists</a></li> -->
							</ul>
						</li>
				</ul>
				<div id="lower-sidebar">
				<h6>Democracy Player Source</h6>
				<p>We recommend that developers use the <a href="https://develop.participatoryculture.org/projects/democracy/
				">lastest code from subversion</a>, but
				source code for releases is also available in <a href="ftp://ftp.osuosl.org/pub/pculture.org/democracy/src/">tarball format on our ftp
				site</a>.</p>

				<h6>Development News</h6>
				<p>Occasional updates about our development process, low traffic. This is different from the development discussion list (see below).
				<form
				action="http://participatoryculture.org/lists/?p=subscribe&id=5" method="post"
				name="subscribeform"> <input type="text" class="emailbox" name="email" value="email address"
				size="20" onfocus='this.value=""' /> <input type=hidden name="makeconfirmed" value="1" /> <input
				type="hidden" name="htmlemail" value="1" /> <input type="hidden" name="list[5]" value="signup" />
				<input type="hidden" name="listname[5]" value="Developers" /> <input type="submit" id="emailsubmit"
				name="subscribe" value="Subscribe" onClick="return checkform();" /> </form>
				</p>
				<h6>Key Resources</h6>
				<p><ul>

				<li><a href="https://develop.participatoryculture.org/">Development Center</a></li>

				<li><a href="https://develop.participatoryculture.org/projects/dtv/report">Bug Tracker</a></li>
				<li><a href="https://develop.participatoryculture.org/projects/dtv/browser/trunk/tv">Source
				Code</a></li> <li><a
				href="https://develop.participatoryculture.org/projects/dtv/wiki/DevelopmentDocs">Development
				Docs</a></li> </ul>
				</p>
				</div>

				</div>
			</div>
			<div class="clearer"></div>
		</div>
<?php include "../include/end.php"; ?>
