<?php 
include "../include/start.php";
?>

<div id="content">

<h2>Democracy RSS Feed Format</h2>

<p>The <a href="http://www.getdemocracy.com">Democracy video platform</a> uses RSS feeds, which we call 'Channels', to provide users access to the videos from a publisher.  We make a channel publishing tool called <a href="<?= $base ?>/broadcast">Broadcast Machine</a> which generates feeds that are designed for Democracy.  Publishers who already have RSS feeds or a content management system can make their RSS feeds compatible with Democracy without using Broadcast Machine.  In fact, most feeds that have video content in links or enclosures will already work in Democracy.  However, these feeds may lack thumbnail images and other video metadata, which we think is crucial for your viewers (and makes your channel look a lot cooler).  
</p>

<p>
Broadcast Machine makes and Democracy prefers RSS feeds of the following type:
</p>

<ul>
<li><a href="http://blogs.law.harvard.edu/tech/rss">RSS 2.0</a></li>
<li>with <a href="http://search.yahoo.com/mrss">Yahoo Media extensions</a></li>
<li> and <a href="http://www.kbcafe.com/rss/usm.html">USM - Universal Subscription Mechanism</a></li>
</ul>
<p>
RSS is intentionally loose about the semantics of tags.  This is how we do it for Democracy: 
</p>

<ul>
<li>Each RSS item corresponds to a single video item.</li>
<li>Title, description, and all other item elements correspond to the video (not a blog post <em>about</em> the video).</li>
<li>We use RSS enclosure tags rather than media content tags for backwards compatibility.</li>
</ul>

<p>We made these decisions for Democracy because it allows us to present rich metadata to users along with the associated video file.  This also reflects our belief that internet TV should not be a subset of blogging-- video is the medium that we're working with and each item in a video channel should be first and foremost a video file.</p>


<p>Eventually we may define some Democracy-specific channel subscription settings.</p>

</div>

<?php
include "../include/end.php";
?>
