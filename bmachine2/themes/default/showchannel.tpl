{* Smarty *}
{* This template uses the following variables:
$allvideos
	$video.name
	$video.url
	$video.thumbnailurl
$currentchannelid - the id of the channel currently being output
$allchannels[#]
	$allchannels[#].title
	$allchannels[#].rssurl
*}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

	<div id="library_header_wrap">
	<div id="library_title"><a href="{$baseurl}">{$settings.name}</a>: <a href="{$baseurl}channels/{$allchannels[$currentchannelid].title}">{$allchannels[$currentchannelid].title}</a></div>
<div id="rss_feed"><a href="{$channel.rssurl}"><img src="themes/default/images/rss_button.gif" alt="rss feed" border="0" /></a></div>
</div>

<div class="video_section">
		<h3 class="section_name">All Files</h3>
		<ul>

{include file='showallvideosinachannel.tpl'}

</ul>


		<div class="spacer_left">&nbsp;</div>

		</div>


  </div>
</div>
<br/>
</body>

</html>