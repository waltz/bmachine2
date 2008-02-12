{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">


<br />
	<div id="library_header_wrap">
	<div id="library_title">Items with '<a href="{$baseUri}tag/{$tagName}">{$tagName}</a>'</div>
<div id="rss_feed"><a href="{$baseUri}tag/{$tagName}/rss"><img 
src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div>
<br />
<h2>Channels tagged with '{$tagName}'</h2>
<p>
		<ul>
			{foreach from=$channelTags item=channel}
			<li><a href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a></li>
			{/foreach}
		</ul>
</p>


<h2>Videos tagged with '{$tagName}'</h2>
<p>
                <ul>
                        {foreach from=$videoTags item=video}
                        <li><a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a></li>
                        {/foreach}
                </ul>
</p>
		
		<div class="spacer_left">&nbsp;</div>

		</div>

  </div>
</div>
<br/>

{include file='footer.tpl'}
