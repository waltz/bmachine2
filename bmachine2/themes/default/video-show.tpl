{* Smarty *}
{* Shows all videos *}
{*
$pagination.currentpage - the current page
$pagination.totalpages - the total number page
 *}
{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title">
		<h1>{$video.title|truncate}</h1>
		{if $isAdmin}
		<a href="{$baseUri}video/{$video.title|urlencode}/edit">Edit</a> |
		<a href="{$baseUri}video/{$video.title|urlencode}/remove">Remove</a><br/>
		{/if}
		<table><tr><td valign="top" align="right"><span class="smalltext"><b>channels: </b></span></td>
		<td>
		<span class="smalltext">
		{foreach from=$video.channels item=channel}
		<a href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a>
		{/foreach}
		</span>
		</td></tr>
		<tr><td valign="top"  align="right"><span class="smalltext"><b>tags: </b></span></td>
		<td>
		<span class="smalltext">
		{foreach from=$video.tags item=tag}
		<a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a>
		{/foreach}
		</span>
		</td></tr>
		</table>
	</div>
</div>

<div class="video_section">

<!-- VIDEO -->
<div>
<div style="float:right;">Support this video: <a href="{$video.donation_url}">Donate</a></div>
<div id="download_now"><a href="{$baseUri}video/{$video.title|urlencode}/download">Download Now</a> <sup><span class="smalltext">({$video.size})</span></sup>
</div>

</div>
<div>

<div class="video_display_big" style="text-align:left;">
	<div style="float:right; padding-right:20px; text-align:center;">
		<img src="{$video.icon_url}" width="300" height="300" style="border: 0" alt="{$video.title}" />
	</div>
	{if $video.website_url neq ''}
		<span class="smalltext">&raquo; Associated Website: {$video.website_url}</span><br />	
	{/if}
	<span class="smalltext">&raquo; Last Modified: {$video.modified}</span><br />
	<span class="smalltext"> &raquo; This video is licensed under <a href="{$video.license_url}">{$video.license_name}</a>.</span><br />
	<span class="smalltext">&raquo; Released: {$video.release_date}</span><br />
	<span class="smalltext">&raquo; Downloaded {$video.downloads} times.</span><br /><br />
	<h2>Description</h2>
	<p>{$video.description}
	<br /><br />{$video.donation_html}
	</p>
	<h2>Credits</h2>
	<p>
	<table>
	{foreach from=$video.credits item=credit}
		<tr><td><b>{$credit.role}</b></td> <td>{$credit.name}</td></tr>
	{/foreach}
	</table>
	</p>

</div>


<div class="dl_links" style="text-align:center;">
<a href="{$video.title_url}/download">Download</a> | <a href="{$video.title_url}">Permalink</a> | <a href="{$video.donation_url}">Donate</a>
</div>

<!-- /VIDEO -->




		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>


<br/>
{include file='footer.tpl'}
