{* Smarty *}
{* Shows all videos across all channels and tags*}
{assign var='rss' value='video-all'}

{include file='header.tpl'}

<div id="wrap">

	<div id="library_header_wrap">
		<div id="library_title">
			{if $videos|@count eq 0}
				No videos found!
			{elseif $videos|@count eq 1}
				Showing 1 Video
			{elseif $videos|@count gt 1}
				Showing all {$videos|@count} videos
			{/if}
			<a href="{$siteDomain}{$baseUri}video/all/rss"><img src="{$baseUri}themes/default/images/rss_button.gif" alt="{$channel.title} video rss feed" /></a> 
<a href="http://subscribe.getMiro.com/?url1={$siteDomain}{$baseUri}video/all/rss" title="Miro: Internet TV"><img src="http://subscribe.getmiro.com/img/buttons/pcf1.gif" alt="Miro Video Player" /></a>
		</div>
	</div>

<div class="video_section">
	{foreach from=$videos item=video}
	<h2><a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a></h2>
	<h3>Last modified: {$video.modified}</h3>
	<table>
		<tr>
			<td rowspan="5">
				<a href="{$baseUri}video/{$video.title|urlencode}"><img src="{$video.icon_url}" alt="{$video.title} thumbnail" width="200px"/></a>
			</td>
		</tr>
		 <tr><td>Runtime: {$video.runtime}</td></tr>
		 <tr><td>	  Channel(s):
	  {foreach from=$video.channels item=channel}
			 <a href="{$baseUri}channel/{$channel.title}">{$channel.title}</a>
		 	  {/foreach}
		      </td></tr>
		 <tr><td>
		 	  Tags(s):
		 	  {foreach from=$video.tags item=tag}
			 <a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a>
		 	  {/foreach}
		</td></tr>
		<tr><td>
		 <a 
	href="{$video.file_url}">Download now!</a>
		</td></tr>

	</table>
		 <div class="description">
		 	  <em>Description:</em>{$video.description|truncate:350}(<a href="{$baseUri}video/{$video.title|urlencode}">more</a>)
		 </div>
	<hr />
	{/foreach}
</div>
</div>





{include file='footer.tpl'}
