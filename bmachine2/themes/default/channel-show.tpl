{* Smarty *}

{assign var='rss' value='channel'}

{include file='header.tpl'}

<div id="wrap">
	<div id="inner_wrap">
	<br />
	<div id="library_header_wrap">

		<div id="library_title">
			{$channel.title} - 
			{if $channel.videos|@count eq 0}
				No videos!
			{elseif $channel.videos|@count eq 1}
				showing 1 video
			{elseif $channel.videos|@count gt 1}
				showing {$channel.videos|@count} videos
			{/if}
<a href="{$siteDomain}{$baseUri}channel/{$channel.title|urlencode}/rss">
<img src="{$baseUri}themes/default/images/rss_button.gif" alt="{$channel.title} video rss feed" /></a> 
<a href="http://subscribe.getMiro.com/?url1={$siteDomain}{$baseUri}channel/{$channel.title|urlencode}/rss" title="Miro: Internet TV"><img src="http://subscribe.getmiro.com/img/buttons/pcf1.gif" alt="Miro Video Player" /></a>

		</div>
	</div>

<div class="video_section">
	<div class="align-left">

	<div id="tagsbox">
		<b>Channel Tags:</b>
			{foreach from=$channel.tags item=tag}
				<a href="{$baseUri}tags/{$tag|urlencode}">{$tag}</a>
			{/foreach}
	</div>

<div style="float:left; padding-right:20px;"><img src="{$channel.icon_url}" alt="icon for {$channel.title}" width="150px" /></div>
<h2><a href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a></h2>
	<div>
		last modified: {$channel.modified}<br />
		<em>{$channel.videos|@count} videos in channel</em>
	</div>
	
	<p>
	<em>Description:</em> {$channel.description}<br /><br />
	<em>All videos from {$channel.title}:</em><br />
	</p>
	<table>
	{foreach from=$channel.videos item=video}
	<tr class="{cycle values="alt-background,none" advance=false}">
		<td rowspan="4">
			<a href="{$baseUri}video/{$video.title|urlencode}"><img src="{$video.icon_url}" alt="{$video.title} thumbnail" width="200px"/></a>
		</td>
	</tr>
	<tr class="{cycle values="alt-background,none" advance=false}"><td><a 
href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a> (<a 
href="{$video.file_url}">download</a>)
	</td></tr>
	<tr  class="{cycle values="alt-background,none" advance=false}"><td>modified: 
{$video.modified}
	</td></tr>
	<tr class="{cycle values="alt-background,none"}"><td>{$video.description|truncate:50}(<a 
href="{$baseUri}video/{$video.title|urlencode}">more</a>)
	</td></tr>

	{/foreach}
	</table>

</div>

</div>
</div>
</div>



{include file='footer.tpl'}
