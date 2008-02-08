{* Smarty *}
{* Displays all possible tags from both channels and videos. *}
{*
* 
* variables available to this template:
*  + tags (array of all tag names, both channel and video tags, and tag count)
*  + settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, donation_html, donation_url, 
*    donthideporn) user (username, admin, banned)
* 
* things that might be missing:
* 
*}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title"><img src="{$channel.icon_url}" /><a href="{$settings.baseurl}">{$settings.name}</a> : Tags</div>
<div id="rss_feed"><a href="{$settings.baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div><br />

</div>
<div class="video_section" style="text-align:left;">
<h2>All Tags</h2>
<p>
{foreach from=$tags item=tag}
<a href="{$settings.baseurl}tag/{$tag.name}">{$tag.name}</a>
{/foreach}
</p>

</div>



<br/>
{include file='footer.tpl'}
