{* Smarty *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

	<div id="library_header_wrap">
	<div id="library_title">Items tagged with '<a href="{$baseUri}tag/{$tagName}">{$tagName}</a>'
<div id="rss_feed"><a href="{$baseUri}tag/{$tagName}/rss"><img 
src="{$baseUri}themes/default/images/rss_button.gif"
alt="rss feed" border="0" /></a></div>
</div>

</div>

<div style="margin: 10px 0 0 0; padding: 10px 10px 10px 10px; text-align: center; border: 1px solid #ccc; 
text-align:left">

	{if $channelTags|@count gt 0}

		<h3>Channels tagged with '{$tagName}'</h3>
			<p>
				<ul>
					{foreach from=$channelTags item=channel}
					<li><img src="{$channel.icon_url}" 
alt="{$channel.description|truncate:50}..." width="100px" padding="20px" /> <a href="{$baseUri}channel/{$channel.title|urlencode}">{$channel.title}</a></li>
					{/foreach}
				</ul>
			</p>
	{/if}

	{if $videoTags|@count gt 0}
		<h3>Videos tagged with '{$tagName}'</h3>
			<p>
	        	        <ul>
	        	                {foreach from=$videoTags item=video}
        	        	        <li>
						<img src="{$video.icon_url}" 
alt="{$video.description|truncate:50}..." width="100px" padding="20px" /> 
						<a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a> (<a href="{$video.file_url}">download</a>)
					</li>
                        		{/foreach}
	                	</ul>
			</p>
	{/if}	

</div>
		<div class="spacer_left">&nbsp;</div>

		</div>

  </div>
</div>
<br/>

{include file='footer.tpl'}
