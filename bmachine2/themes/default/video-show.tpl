{* Smarty *}
{* Shows a single video *}

{include file='header.tpl'}

<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title">
		<h2>{$video.title}</h2>
		{if $isAdmin}
		<a href="{$baseUri}video/{$video.title|urlencode}/edit">Edit</a> |
		<a href="{$baseUri}video/{$video.title|urlencode}/remove">Remove</a><br/>
		{/if}
		<br />
		Last modified: {$video.modified}<br />

	</div>
</div>

<div class="video_section">

<!-- VIDEO -->
<div>
<div id="download_now"><a href="{$video.file_url}">Download Now</a> <sup><span class="smalltext">({$video.size} bytes)</span></sup>
</div>

</div>
<div>

<div class="video_display_big" style="text-align:left;">
	<div id="big-video-icon">
		<img src="{$video.icon_url}" width="400" style="border: 0" alt="{$video.title}" />
	</div>
	{if $video.website_url neq ''}
		<span class="smalltext">&raquo; Associated Website: {$video.website_url}</span><br />	
	{/if}
	<br />
	&raquo; Channels: 
		{foreach from=$video.channels item=channel}
			<a href="{$baseUri}channel/{$channel.title|urlencode}">
				{$channel.title}
			</a>
		{/foreach}<br />
	&raquo; Tags: 
		{foreach from=$video.tags item=tag}
			<a href="{$baseUri}tag/{$tag.name}">
				{$tag.name}</a>  
		{/foreach} <br />
	&raquo; Released: {$video.release_date}<br />
	&raquo; Downloaded {$video.downloads} times.<br /><br />
	<h3>Description</h3>
	<p>{$video.description}
	<br /><br />{$video.donation_html}
	</p>
	<h3>Video Credits</h3>

	<table>
	{foreach from=$video.credits item=credit}
		<tr><td><em>{$credit.role}</em></td> <td>{$credit.name}</td></tr>
	{/foreach}
	</table>

</div>



<div class="dl_links" style="text-align:center;">
<a href="{$video.file_url}">Download</a> | <a href="{$video.title_url}">Permalink</a>
</div>

<!-- /VIDEO -->



</div>
</div>
</div>
</div>

{include file='footer.tpl'}
