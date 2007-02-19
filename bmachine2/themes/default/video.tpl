{* Smarty *}
{* Shows all videos *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

<br />
	<div id="library_header_wrap">
	<div id="library_title"><a href="{$settings.baseurl}">{$settings.name}</a>: Show All Videos</div>
<div id="rss_feed"><a href="{$settings.baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">

		<ul>

{foreach from=$videos item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
	<a href="{$baseurl}video/{$video.title}"><img src="{$video.thumbnailurl}" width="150"  style="border: 0" alt="{$video.name}" /></a>
</div>

<div class="video_title" style="text-align:left;">
<div class="video_title" style="text-align:left;">
	<a href="{$settings.baseurl}video/{$video.title}">{$video.title}</a>
</div>

<div style="text-align:left; font-size: 10px; font-weight: normal;">
Runtime: {$video.runtime.hours}h {$video.runtime.minutes}m {$video.runtime.seconds}s <br />
Posted: {$video.modified.month}-{$video.modified.day}-{$video.modified.year} @ {$video.modified.hour}:{$video.modified.minute}:{$video.modified.second} <br />
Channel(s): 
{foreach from=$video.channels item=inchannel}
<a href="{$settings.baseurl}{$inchannel}">{$inchannel}</a>&nbsp;
{/foreach}<br />
Tags(s): 
{foreach from=$video.tags item=tag}
<a href="{$settings.baseurl}tags/{$tag}">{$tag}</a>&nbsp;
{/foreach}

</div>

</div>
<div class="dl_links" style="text-align:center;">
<a href="{$video.url}" class="link-download">Direct Download</a> </div>
<div style="text-align:right;"><a href="{$baseurl}video/{$video.title}">more...</a></div>
</li>
<!-- /VIDEO -->
{/foreach}


</ul>


		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>
</div>
<br/>
{include file='footer.tpl'}