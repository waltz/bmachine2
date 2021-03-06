{* Smarty *}
{* Displays all possible tags from both channels and videos. *}
{include file='header.tpl'}

<div id="wrap">
	<div id="inner_wrap">
	<br />
	<div id="library_header_wrap">
		<div id="library_title">All Tags</div>
	</div>
<div class="video_section">
	<div class="align-left">

	<h3>Channel Tags</h3>
	<p>
		{foreach from=$channelTags item=tag}
			<a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a>
		{/foreach}
	</p>

        <h3>Video Tags</h3>
        <p>
                {foreach from=$videoTags item=tag}
                        <a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a>
                {/foreach}
        </p>


	</div>
</div>

</div>
</div>



{include file='footer.tpl'}
