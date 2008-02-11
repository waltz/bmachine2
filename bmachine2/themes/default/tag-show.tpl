{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">


<br />
	<div id="library_header_wrap">
	<div id="library_title">Channels with tag: <a 
href="{$baseUri}tag/show/{$tagName}">{$tagName}</a></div>
<div id="rss_feed"><a href="{$baseUri}tag/show/{$tag}"><img 
src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">

		<ul>
			{foreach from=$channelTags item=channel}
			<li>Channel name: {$channel.channel_id}</li>
			{/foreach}
			

		</ul>

		
		<div class="spacer_left">&nbsp;</div>

		</div>

  </div>
</div>
<br/>

{include file='footer.tpl'}
