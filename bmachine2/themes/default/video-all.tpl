{* Smarty *}

{* Shows all videos *}

{include file='header.tpl'}

{foreach from=$videos item=video}
<div class="video">
     <div class="icon">
     	  <a href="{$baseUri}video/{$video.title|urlencode}">
	  <img src="{$video.icon_url}" alt="{$video.title}" width="200px"/>
	  </a>
     </div>

     <div class="title">
	<a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a>
     </div>

     <div class="description">
     	  {$video.description}
     </div>

     <div class="details">
     	  Runtime: {$video.runtime}<br/>
     	  Posted: {$video.modified}<br/>
     	  Channel(s):
     	  {foreach from=$video.channels item=channel}
	     <a href="{$baseUri}channel/{$channel}">{$channel}</a>
     	  {/foreach}
          <br/>
     	  Tags(s):
     	  {foreach from=$video.tags item=tag}
	     <a href="{$baseUri}tag/{$tag.name}">{$tag.name}</a>
     	  {/foreach}
     	  <br/>
     </div>

     <div class="links">
     	  <a href="{$baseUri}video/{$video.title|urlencode}/download">Download</a>
     </div>
</div>
<br/>
{/foreach}

{include file='footer.tpl'}
