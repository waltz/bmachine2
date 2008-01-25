		<ul>

{foreach from=$channel.videos item=huh}
{foreach from=$huh item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
	<a href="{$settings.baseurl}video/{$video.title_url}"><img src="{$video.icon_url}" height="150" style="border: 0" alt="{$video.title}" /></a>
</div>

<div class="video_title" style="text-align:left;">
<div class="video_title" style="text-align:left;">
	<a href="{$settings.baseurl}video/{$video.title_url}">{$video.title}</a>
</div>

<div style="text-align:left; font-size: 10px; font-weight: normal;">
Runtime: {$video.runtime}<br />
Posted: {$video.modified} <br />
Video Tags: 
{foreach from=$video.tags item=tag}
<a href="{$settings.baseurl}tags/{$tag.name}">{$tag.name}</a>&nbsp;
{/foreach}

</div>

</div>
<div class="dl_links" style="text-align:center;">
<a href="{$video.title_url}/download" class="link-download">Direct Download</a> </div>
<div style="text-align:right;"><a href="{$video.title_url}">more...</a></div>
</li>
<!-- /VIDEO -->
{/foreach}
{/foreach}

</ul>

