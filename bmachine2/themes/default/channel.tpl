{* Smarty *}

{include file='header.tpl'}

<h2>{$channel.title}</h2>

Channel Tags:
{foreach from=$channel.tags item=tag}
	 <a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a> 
{/foreach}

Videos:
{foreach from=$channel.videos item=video}
{$video.title}, 
{/foreach}

{include file='footer.tpl'}