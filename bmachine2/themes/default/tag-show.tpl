{* Smarty *}

{assign var='rss' value='tag'}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

	<div id="library_header_wrap">
	<div id="library_title">Items tagged with '<a href="{$baseUri}tag/{$tagName}">{$tagName}</a>'

</div>
</div>

<div style="margin: 10px 0 0 0; padding: 10px 10px 10px 10px; text-align: center; border: 1px solid #ccc; 
text-align:left">

	{if $channelTags|@count gt 0}

		<h3>Channels tagged with '{$tagName}'</h3>




        <table align="center" border="0px" valign="top" padding="0" cellspacing="0">
        {foreach from=$channelTags item=channel}
        <tr bgcolor="{cycle values="#eee,#fff" advance=false}">
                <td rowspan="3">
                        <a href="{$baseUri}channel/{$channel.title|urlencode}">
                <img src="{$channel.icon_url}" alt="{$channel.title} thumbnail" 
width="200px"
/>
                </td>
        </tr>
        <tr bgcolor="{cycle values="#eee,#fff" advance=false}"><td><a
href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a>
        </td></tr>
        <tr bgcolor="{cycle
values="#eee,#fff"}"><td>{$channel.description|truncate:50}(<a
href="{$baseUri}channel/{$channel.title|urlencode}">more</a>)
        </td></tr>

        {/foreach}
        </table>
	{/if}
<br />
	{if $videoTags|@count gt 0}
		<h3>Videos tagged with '{$tagName}'
<a href="{$siteDomain}{$baseUri}tag/{$tagName}/rss">
<img src="{$baseUri}themes/default/images/rss_button.gif" alt="{$channel.title} video rss
feed" border="0" /></a>
<a
href="http://subscribe.getMiro.com/?url1={$siteDomain}{$baseUri}tag/{$tagName}/rss"
title="Miro: Internet TV">
<img src="http://subscribe.getmiro.com/img/buttons/pcf1.gif" alt="Miro Video Player"
border="0" /></a>
	</h3>


        <table align="center" border="0px" valign="top" padding="0" cellspacing="0">
        {foreach from=$videoTags item=video}
        <tr bgcolor="{cycle values="#eee,#fff" advance=false}">
                <td rowspan="4">
                        <a href="{$baseUri}video/{$video.title|urlencode}">
		<img src="{$video.icon_url}" alt="{$video.title} thumbnail" width="200px" 
/>
                </td>
        </tr>
        <tr bgcolor="{cycle values="#eee,#fff" advance=false}"><td><a
href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a> (<a
href="{$video.file_url}">download</a>)
        </td></tr>
        <tr  bgcolor="{cycle values="#eee,#fff" advance=false}"><td>modified:
{$video.modified}
        </td></tr>
        <tr bgcolor="{cycle
values="#eee,#fff"}"><td>{$video.description|truncate:50}(<a
href="{$baseUri}video/{$video.title|urlencode}">more</a>)
        </td></tr>

        {/foreach}
        </table>
	{/if}
</div>
		<div class="spacer_left">&nbsp;</div>

		</div>

  </div>
</div>
<br/>

{include file='footer.tpl'}
