{* Smarty *}
{* This template uses the following variables:
$allvideos
	$video.name
	$video.url
	$video.thumbnailurl
$currentchannelid - the id of the channel currently being output
$allchannels[#]
	$allchannels[#].title
	$allchannels[#].rssurl
*}

<body>
<div id="wrap">
<div id="inner_wrap">

	<div id="library_header_wrap">
	<div id="library_title">{$sitetitle}: {$allchannels[$currentchannelid].title}</div>
<div id="rss_feed"><a href="{$channel.rssurl}"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">
		<h3 class="section_name">All Files</h3>
		<ul>

{foreach from=$allvideos item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
	<a href="{$video.url}"><img src="{$video.thumbnailurl}" width="150"  style="border: 0" alt="{$video.name}" /></a>
</div>

<div class="video_title">
	<a href="{$video.url}">{$video.name}</a>
</div>
<a href="{$video.url}">more...</a>
</div>

<div class="dl_links">
<a href="{$video.directdownloadurl}" class="link-download">Direct Download</a> </div>
</li>
<!-- /VIDEO -->
{/foreach}

</ul>


		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>
</div>
<br/>
</body>

</html>