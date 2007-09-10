{* Smarty *}
{* Displays all videos and channel with a given tag. *}
{*
* 
* variables available to this template:
*  + tags (array of all tag names, both channel and video tags, and tag count)
*  + settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, donation_html, donation_url, 
*    donthideporn) user (username, admin, banned)
* 
* things that might be missing:
*  + channel.title_url needs to be in the API
*}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
<h2>Channels tagged as <i>'{$tag}'</i></h2><br />

</div>
<div class="video_section" style="text-align:left;">
<p>
<table>
{foreach from=$channels item=channel}
<tr><td colspan="2"><hr /></td></tr>
	<tr><td colspan="2"><h3><a href="{$channel.title_url}">{$channel.title}</a></h3></td></tr>
	<tr><td ><a href="{$channel.title_url}"><img src="{$channel.icon_url}" width="100px" height="100px" /></a></td><td  valign="top"><p>{$channel.description}</p></td></tr>
	<tr><td><span class="smalltext">Modified {$channel.modified}</span></td>
	<td style="text-align: right;"><span class="smalltext"><b>Tags:</b> 
		{foreach from=$channel.tags item=currentTag}
			{if $currentTag eq $tag}<b>{/if}<a href="{$settings.baseurl}tag/{$currentTag}">{$currentTag}</a>{if $currentTag eq $tag}</b>{/if}
		{/foreach}
	</span></td></tr>
	<tr><td colspan="2" style="text-align: center;"> <a href="{$channel.title_url}">&raquo; view this channel &raquo;</a></td></tr>

{/foreach}
<tr><td colspan="2"><hr /></td></tr>
</table>
</p>

</div>
<br />
	<div id="library_header_wrap">
	<h2>Videos tagged as <i>'{$tag}'</i></h2><br />

</div>

{include file='showallvideos.tpl'}


<br/>
{include file='footer.tpl'}
