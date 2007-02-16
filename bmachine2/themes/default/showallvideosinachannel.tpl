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