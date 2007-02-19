{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

{foreach from=$channels item=channel}
<br />
	<div id="library_header_wrap">
	<div id="library_title"><a href="{$settings.baseurl}">{$settings.name}</a>: <a href="{$settings.baseurl}/{$channel.title}">{$channel.title}</a></div>
<div id="rss_feed"><a href="{$settings.baseurl}channels/{$channel.title}"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">
		
		<div id="tagsbox"><b>Channel Tags: </b>
		{foreach from=$channel.tags item=tag}
			<a href="{$settings.baseurl}tags/{$tag}">{$tag}</a>&nbsp;
		{/foreach}</div>

		<ul>

{include file='showallvideosinachannel.tpl'}

</ul>

<div id="tagsbox"><a href="{$settings.baseurl}channels/{$channel.title}"><b>>> See all videos in this channel >> </b></a></div>
		
		<div class="spacer_left">&nbsp;</div>

		</div>

{/foreach}

  </div>
</div>
<br/>
</body>

</html>