<?php
include ("../include/base.php");
include("../include/start.php");
?>

<!--Content Block-->
<div id="content-2col">
<div id="content-left-2col">

<div id="sub-main-2col">
	<h2>Contact PCF</h2>

	<div style="float: right; padding: 0px 8px 8px 8px; width: 120px; margin-top: -4px;"><a href="http://www.ci.worcester.ma.us/"><img src="<?= $base ?>/images/city_seal.png" /></a></div>

	<p>The Participatory Culture Foundation develops Democracy.  We are based in Worcester, MA USA, but
	some of our staff live in other parts of the world, including Canada and France.</p>

	<p>For questions about Democracy Player or Broadcast Machine, please use the <a href="<?= $base ?>/help/">Help 
page</a>.  Other inquiries: </p><br />

	<h5 style="float: left; width: 160px; font-weight: bold;">press inquiries:</h5> <p style="margin-left:120px; text-align: left;"><a href="<?= $base ?>/press">Press Page</a></p><br />

	<h5 style="float: left; width: 160px; font-weight: bold;">our website:</h5> <p style="margin-left:120px; text-align: left;"><a href="http://www.participatoryculture.org">participatoryculture.org</a></p><br />

	<h5 style="float: left; width: 160px; font-weight: bold;">our address:</h5> <p style="margin-left:160px; text-align: left;">Participatory Culture Foundation<br />126 Eastern Ave<br />Worcester, MA, USA 01605</p><br />


	<h5 style="float: left; width: 160px; font-weight: bold;">email:</h5><p style="margin-left:120px; text-align: left;"><a href="mailto:feedback@pculture.org">feedback[at]pculture.org</a></p><br />

	<h5 style="float: left; width: 160px; font-weight: bold;">phone:</h5><p style="margin-left:120px; text-align: left;">508-756-7496</p><br />

	<h5 style="float: left; width: 160px; font-weight: bold;">fax:</h5><p style="margin-left:120px; text-align: left;">508-519-0490</p><br />

</div>

</div>

<div id = "content-right-2col">
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
<!--/Content Block-->

<!--FOOTER--> <?php include("../include/end.php"); ?> <!--/FOOTER-->
