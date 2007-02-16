{* Smarty *}


<body>
<div id="wrap">
<div id="inner_wrap">

<br />
	<div id="library_header_wrap">
	<div id="library_title"><a href="{$baseurl}">{$sitetitle}</a>: Show All Videos</div>
<div id="rss_feed"><a href="{$baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">

{foreach from=$allvideos item=video}
		
		<div id="tagsbox"><b>Channel Tags: </b>
		{foreach from=$channel.tags item=tag}
			<a href="{$baseurl}tags/{$tag}">{$tag}</a>&nbsp;
		{/foreach}</div>

		<ul>

{foreach from=$allvideos item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
	<a href="{$baseurl}video/{$video.title}"><img src="{$video.thumbnailurl}" width="150"  style="border: 0" alt="{$video.name}" /></a>
</div>

<div class="video_title">
	<a href="{$video.url}">{$video.name}</a>
</div>
<a href="{$baseurl}video/{$video.title}">more...</a>
</div>

<div class="dl_links">
<a href="{$video.url}" class="link-download">Direct Download</a> </div>
</li>
<!-- /VIDEO -->
{/foreach}

</ul>


		<div class="spacer_left">&nbsp;</div>

		</div>

{/foreach}

  </div>
</div>
<br/>
</body>

</html>