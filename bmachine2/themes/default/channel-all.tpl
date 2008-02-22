{* Smarty *}

{include file='header.tpl'}

<div id="view_container">
{foreach from=$channels item=channel}
<div class="channel_containter">
<div id="library_header_wrap">
	<div id="library_title">
	     Channel Name:
	     <a href="{$baseUri}channel/{$channel.title|urlencode}">
	     {$channel.title}
	     </a>
	</div>
	<div id="rss_feed">
	     <a href="{$baseUri}channel/{$channel.title|urlencode}/rss">
	     <img src="{$baseUri}themes/default/images/rss_button.gif" alt="RSS Feed"/>
	     </a>
	</div>
</div>


<div class="video_section">
<div class="align-left">
     <div id="tagsbox">
          <b>Channel Tags:</b>
     	  {foreach from=$channel.tags item=tag}
     	      <a href="{$baseUri}tags/{$tag.name|lower}">{$tag.name}</a>
     	  {/foreach}
     </div>

     {foreach from=$channel.videos item=video}
     <div class="small_video">
     	  <img src="{$video.icon_url}" alt="{$video.title}" width="200px" />
	  <a href="{$baseUri}video/{$video.title|urlencode}">{$video.title}</a>
	  <br/>     
     </div>
     {/foreach}
     {if $isAdmin}
	<a href="{$baseuri}channel/{$channel.title|urlencode}/edit">Edit</a> | 
	<a href="{$baseuri}channel/{$channel.title|urlencode}/remove">Remove</a>
     {/if}
</div>
</div>
<div>
{/foreach}
</div>

{include file='footer.tpl'}
