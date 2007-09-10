<div class="video_section">
		<ul>

{foreach from=$allvideos item=video}
<!-- VIDEO -->

<li><div class='video_display'>

<div class="thumbnail">
	<a href="{$settings.baseurl}video/{$video.title_url}"><img src="{$video.icon_url}" height="150" style="border: 0" alt="{$video.title}" /></a>
</div>

<div class="video_title" style="text-align:left;">
<div class="video_title" style="text-align:left;">
	<a href="{$settings.baseurl}video/{$video.title_url}">{$video.title}</a>
</div>

<div style="text-align:left; font-size: 10px; font-weight: normal;">
Runtime: {$video.runtime}<br />
Posted: {$video.modified} <br />
Channel(s): 
{foreach from=$video.channels item=inchannel}
<a href="{$settings.baseurl}{$inchannel}">{$inchannel}</a>&nbsp;
{/foreach}<br />
Tags(s): 
{foreach from=$video.tags item=tag}
<a href="{$settings.baseurl}tags/{$tag}">{$tag}</a>&nbsp;
{/foreach}

</div>

</div>
<div class="dl_links" style="text-align:center;">
<a href="{$video.title_url}/download" class="link-download">Direct Download</a> </div>
<div style="text-align:right;"><a href="{$video.title_url}">more...</a></div>
</li>
<!-- /VIDEO -->
{/foreach}


</ul>

		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>

<div style="float:right"> 
{if $pagination.currentpage neq 1}
	<a href="#{$pagination.currentpage-1}">&laquo; Previous</a>
{/if}
{section name=pages loop=$pagination.totalpages}
{if $smarty.section.pages.iteration eq $pagination.currentpage} {* if printing current page, make it bold and non-clickable *}
	<b>{$smarty.section.pages.iteration}</b>
{else}
  <a href="#">{$smarty.section.pages.iteration}</a> {* this is your $i *}
{/if} 
{/section}
{if $pagination.totalpages gt 1}
	<a href="#{$pagination.currentpage+1}">Next &raquo;</a>
{/if}


</div>
