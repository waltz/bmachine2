{* Smarty *}
{* Displays all videos in a channel, along with some metadata about a channel. *}
{*
*
*
* channel (id, title, description, modified, icon_url, website_url, tags (array of channel tags), videos (array of 10 most 
* recent videos (id, title, title_url, modified, icon_url, website_url, release_date, runtime, adult, size, downloads, tags, * channels))
*}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title"><img src="{$channel.icon_url}" /><a href="{$settings.baseurl}">{$settings.name}</a> : {$channel.title}</a> : Show all videos </div>
<div id="rss_feed"><a href="{$settings.baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div><br />

<span class="smalltext" style="float:right"><b>Last modified {$channel.modified}
{if $channel.website_url neq ''}<br />Website {$channel.website_url}{/if}</b></span>

		<table>
		<tr><td valign="top"  align="right"><span class="smalltext"><b>tags: </b></span></td>
		<td>
		<span class="smalltext">
		{foreach from=$channel.tags item=tag}
		<a href="{$settings.baseurl}/tag/{$tag}">{$tag}</a>
		{/foreach}
		</span>
		</td></tr>
		</table>

<blockquote>{$channel.description}</blockquote>





</div>


{include file='showallvideos.tpl'}

<br/>
{include file='footer.tpl'}
