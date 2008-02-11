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

<div class="videosection">
                <ul>

{foreach from=$videos item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
        <a href="{$baseUri}video/show/{$video.title|replace:" ":"-"}"><img
src="{$video.icon_url}" width="180" style="border: 0" alt="{$video.title}" /></a>
</div>

<div class="video_title" style="text-align:left;">
<div class="video_title" style="text-align:left;">
        <a
href="{$baseUri}video/show/{$video.title|replace:" ":"-"}">{$video.title}</a>
</div>

<div style="text-align:left; font-size: 10px; font-weight: normal;">
Runtime: {$video.runtime}<br />
Posted: {$video.modified} <br />
Video Tags:
{foreach from=$video.tags item=tag}
<a href="{$baseUri}tag/show{$tag}">{$tag}</a>&nbsp;
{/foreach}

</div>

</div>
<div class="dl_links" style="text-align:center;">
<a href="{$video.file_url}" class="link-download">Direct Download</a> </div>
<div style="text-align:right;">
        <a href="{$baseUri}video/show/{$video.title|replace:" ":"-"}">more...</a>
</div>
</li>
<!-- /VIDEO -->
{/foreach}

</ul>
</div> <!-- end videosection -->



<br/>
{include file='footer.tpl'}
