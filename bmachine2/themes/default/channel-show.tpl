{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title"><img src="{$channel.icon_url}" width="100px" /><a 
href="{$settings.baseurl}">{$settings.name}</a> : {$channel.title}</a> : Show all videos </div>
<div id="rss_feed"><a href="{$settings.baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div><br />

<span class="smalltext" style="float:right"><b>Last modified {$channel.modified}
{if $channel.website_url neq ''}<br />Website <a href="{$channel.website}">{$channel.website_url}</a>{/if}</b></span>

		<table>
		<tr><td valign="top"  align="right"><span class="smalltext"><b>tags: </b></span></td>
		<td>
		<span class="smalltext">
		{foreach from=$channel.tags item=tag}
		<a href="{$settings.baseurl}/tag/{$tag}">{$tag.name}</a>
		{/foreach}
		</span>
		</td></tr>
		</table>

<blockquote>{$channel.description}</blockquote>





</div>


     {foreach from=$channel.videos item=video}
     <div class="small_video">
          <img src="{$video.icon_url}" alt="{$video.title}" width="100px" />
          <a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a>
 	  (<a href="{$video.file_url}">download</a>)

          <br/>
     </div>
     {/foreach}

<br/>
{include file='footer.tpl'}
