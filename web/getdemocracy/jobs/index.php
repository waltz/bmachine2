<?php

include "/data/getdemocracy/site-live/include/start.php";

print<<<END

		<div id="content-2col">
			<div id="content-left-2col">
			<div id="sub-main-2col">
				<h2>Jobs at Participatory Culture</h2>
			</div>

			<p>Participatory Culture Foundation, which makes the Democracy platform, is looking for world-class talent to join our organization.  We are a new non-profit organization and are building a small, focused team that rivals the talent and quality of any for-profit software company. (Are you doing amazing work for a company that you don't really believe in?  Quit your job and work for us.  Seriously.)  We are based in Worcester, MA but we work with individuals around the world.  You don't need to be local, but if you are, even better.</p>

			<p>We want to fill the positions below as soon as possible.  If you're interested, please be in touch right away; we don't need fancy resumes, just good, clear info about what you've been up to.  Women and people of color are strongly encouraged to apply.</p>

			<h4>Software Developer</h4>
			<p><strong>Software Developer</strong> - We're looking for a solid programmer who can work
			independently, communicate well, and occasionally step back from the
			code to contemplate improvements to program architecture or our
			development process. Most of our code is in dynamic languages like Python and Ruby, so a clear understanding of language concepts is important.
			</p>
			<p><strong>TO APPLY</strong>: Send a short note about why you're interested in working with us along with a casual resume or description of what your skills / experience is to jobs[at]pculture.org.</p>

			<h4>Art Director</h4>
			<p>We're looking for someone who meshes with our vision of graphic and interface design (see more details in the section below this).</p>

			<p>Design is the trickiest piece of the puzzle for us.   We are looking to hire a full or part-time designer to create web designs, graphics, logos, and application interfaces, though we are also interested in contract work.  We want to find someone who is smart and flexible and has a good sense of style.  Design we like includes:  <a href="http://basecamphq.com/">this</a>, <a href="http://www.hicksdesign.co.uk/portfolio/mozilla-logos">this</a>, <a href="http://acquisitionx.com/">this</a>, <a href="http://www.apple.com/ilife/garageband/">this</a>, and <a href="http://www.mozilla.org">this</a> (also <a href="http://www.tuxdog.org/">this</a>).  In general, we care a lot about details and usability and are striving to make websites and applications that are world-class in look and feel.  If you are an ambitious designer and want to kick ass in the name of good, please send us your portfolio.</p>

			<p>We are expecting to hire for a half or full-time position, as described above, but if you'd like to apply for a long-term consulting contract, we would consider that as well.  Please let us know what kind of arrangement works best for you.</p>

			<p><strong>TO APPLY</strong>: Send a short note about why you're interested in working with us along with a casual resume, portfolio, or description of what your experience is to jobs[at]pculture.org.</p>

			<h4>Who We Are</h4>
			<p>For more about the Participatory Culture Foundation:<br /><br />
			<strong><a href="http://participatoryculture.org/">PCF Homepage</a><br />
			<a href="http://getdemocracy.com/news/">News and Blog</a><br />
			</strong>


			</div>
			<div id="content-right-2col">
				<ul class="sidebar-nav">
					<li><a href="http://getdemocracy.com/help/">About the Platform</a>
						<ul>
							<li><a href="http://getdemocracy.com/news">News / Blog</a></li>
							<li><a href="http://getdemocracy.com/press">Press</a></li>
							<li><a href="http://getdemocracy.com/contact">Contact</a></li>
							<li><a href="http://getdemocracy.com/store">Store</a></li>
							<li><a href="http://getdemocracy.com/jobs">Jobs</a></li>
							<li><a href="https://secure.democracyinaction.org/dia/organizations/pcf/shop/custom.jsp?donate_page_KEY=1283&t=Democracy.dwt">Donate</a></li>
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
					</p>
					<p><a href="http://getdemocracy.com/watch">Watch TV page >></a></p>

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
					</p>
					<p><a href="http://getdemocracy.com/make">Make TV page >></a></p>

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