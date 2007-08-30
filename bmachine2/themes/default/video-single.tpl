{* Smarty *}
{* Shows all videos *}
{*
$pagination.currentpage - the current page
$pagination.totalpages - the total number page
 *}
{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<br />
	<div id="library_header_wrap">
	<div id="library_title"><a href="{$settings.baseurl}">{$settings.name}</a>: Show All Videos</div>
<div id="rss_feed"><a href="{$settings.baseurl}videos/rss"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">


<!-- VIDEO -->
$video

<!-- /VIDEO -->





		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>


<br/>
{include file='footer.tpl'}
