{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

{foreach from=$channels item=channel}
<br />
<div id="library_header_wrap">
	<div id="library_title">
	     Channel Name: <a href="{$baseUri}channel/{$channel.title|urlencode}">
	     	     	   {$channel.title}</a>
	</div>
	<div id="rss_feed">
	     <a href="{$baseUri}channel/{$channel.title|urlencode}/rss">
	     <img src="{$baseUri}themes/default/images/rss_button.gif" alt="RSS Feed"/>
	     </a>
	</div>
</div>

<div class="video_section">
     <div id="tagsbox">
     <b>Channel Tags:</b>
     {foreach from=$channel.tags item=tag}
     	      <a href="{$baseUri}tags/{$tag.name|lower}">{$tag.name}</a>
     {/foreach}
     </div>

		<ul>

{include file='showallvideosinachannel.tpl'}

</ul>

<div id="tagsbox"><a href="{$baseUri}channel/{$channel.title|urlencode}"><b>>> See all videos in this channel >> </b></a></div>
		
		<div class="spacer_left">&nbsp;</div>

		</div>

{/foreach}

  </div>
</div>
<br/>

{include file='footer.tpl'}
