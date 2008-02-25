{* Smarty *}
{* Displays all channels. *}
{include file='header.tpl'}

<div id="wrap">
	<div id="inner_wrap">
	<br />
	<div id="library_header_wrap">

		<div id="library_title">
			{if $channels|@count eq 0}
				No channels!
			{elseif $channels|@count eq 1}
				Showing 1 Channel
			{elseif $channels|@count gt 1}
				Showing {$channels|@count} Channels
			{/if}
		</div>
	</div>

<div class="video_section">
	<div class="align-left">

	{foreach from=$channels item=channel}
	<div id="tagsbox">
		<b>Channel Tags:</b>
			{foreach from=$channel.tags item=tag}
				<a href="{$baseUri}tags/{$tag|urlencode}">{$tag}</a>
			{/foreach}
	</div>

<div style="float:left; padding-right:20px;"><img src="{$channel.icon_url}" alt="icon for {$channel.title}" width="150px" /></div>
<h2><a href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a></h2>
<a href="{$siteDomain}{$baseUri}channel/{$channel.title|urlencode}/rss"><img src="{$baseUri}themes/default/images/rss_button.gif" alt="{$channel.title} video rss feed" border="0" /></a> 
<a href="http://subscribe.getMiro.com/?url1={$siteDomain}{$baseUri}channel/{$channel.title|urlencode}/rss" title="Miro: Internet TV"><img src="http://subscribe.getmiro.com/img/buttons/pcf1.gif" alt="Miro Video Player" border="0" /></a>
	<div>
		last modified: {$channel.modified}<br />
		<em>{$channel.videos|@count} videos in channel</em>
	</div>
	
	<p>
	<em>Description:</em> {$channel.description|truncate:350}<a href="{$baseUri}channel/{$channel.title|urlencode}">(read more)</a><br /><br />
	<em>Recent videos from {$channel.title}:</em><br />
	<table align="center">
	<tr>
	{section name=foo loop=3}
		<td>
			<a href="{$baseUri}video/{$channel.videos[foo].title|urlencode}"><img src="{$channel.videos[foo].icon_url}" alt="{$channel.videos[foo].title} thumbnail" width="200px"/>
		</td>
	{/section}
	</tr>
	</table>
	</p>
	{/foreach}
<hr />
</div>

</div>
</div>



{include file='footer.tpl'}
