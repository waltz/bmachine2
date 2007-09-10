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

<!--done--->
<form method="post" action="create_channel.php" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="" class="hidden"/>
<div id="poststuff">
<div class="page_name">
   <h2>Edit Video</h2>

</div>

<div class="section">
<div style="float: right; font-size: 1.4em; font-weight:bold;">
<a href="#">Delete this video</a>
</div>
<h3>Video Info</h3>
<fieldset>
	Title<br />
	<input type="text" name="title" size="60" value="{$video.title}" />
</fieldset>

<fieldset>
	Title URL <i>(You'll probably never need to change this)</i><br />
	<input type="text" name="title_url" size="60" value="{$video.title_url}" />
</fieldset>


<fieldset>Channel Icon<br />
<img src="{$video.icon_url}" width="300px" /><br/>

<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div id="upload_image" style="display:none;">
<input type="file" name="IconUpload" value="Choose File" />
</div>

<div id="specify_image" style="display:block;" >

<input type="text" name="Icon" size="60" value="{$video.icon_url}"/>
</div>
</fieldset>

<fieldset>
	Description<br />
	<textarea rows="4" cols="40" name="Description" id="content">{$video.description}</textarea>
</fieldset>

<fieldset>
	Release Date <br />
	<input type="text" name="release_date" size="38" value="{$video.release_date}" />
</fieldset>

<fieldset>
	Runtime <br />
	<input type="text" name="runtime-hour" size="2" value="0" />h <input type="text" name="runtime-min" size="2" value="0" />m <input type="text" name="runtime-sec" size="2" value="0" />s
</fieldset>

<fieldset>
Channels <br />
<ul>
{assign var=exists value='false'}
{foreach from=$allchannels item=allChannel}
	{foreach from=$video.channels item=channel}
			{if $allChannel eq $channel}
				{assign var='exists' value='true'}
			{/if}
	{/foreach}


	<li><input type="checkbox" name="channels-{$allChannel}" value="channels-{$allChannel}" {if $exists eq 'true'}checked {/if} /> {$allChannel} </li>
{assign var=exists value='false'}
{/foreach}
</ul>

</fieldset>


<fieldset>
Tags <br />
{foreach from=$video.tags item=tag}
	<li><input type="checkbox" name="tags-{$tag}" value="tags-{$tag}" checked /> {$tag}</li>
{/foreach}
</ul>
	...Or add new tags<br />
<div style="block:none;">
	<input type="textbox" name="newTag1" value="" />
	<input type="textbox" name="newTag2" value="" />
	<input type="textbox" name="newTag3" value="" />
	<input type="textbox" name="newTag4" value="" />
	<input type="textbox" name="newTag5" value="" />
	<input type="textbox" name="newTag5" value="" />
</div>
</fieldset>

<fieldset>
Adult <br />
{if $video.adult eq 'yes'}
<ul><li><input type="checkbox" name="adult" value="adult" checked /> Contains adult content</li></ul>
{/if}
{if $video.adult neq 'yes'}
<ul><li><input type="checkbox" name="adult" value="adult" /></li></ul>
{/if}
</fieldset>

<fieldset>
Roles <br />
<table>
{foreach from=$video.credits item=credit}

<tr><td><input type="textbox" name="credit-{$credit.role}" value="{$credit.role}" /></td><td><input type="textbox" name="credit-{$credit.name}" value="{$credit.name}" /></td></tr>
{/foreach}
</table>
	...Or add new roles<br />
<table>
<tr><td><input type="textbox" name="newcredit1-role" value="" /></td><td><input type="textbox" name="newcredit1-name" value="" /></td></tr>
<tr><td><input type="textbox" name="newcredit2-role" value="" /></td><td><input type="textbox" name="newcredit2-name" value="" /></td></tr>
<tr><td><input type="textbox" name="newcredit3-role" value="" /></td><td><input type="textbox" name="newcredit3-name" value="" /></td></tr>
<tr><td><input type="textbox" name="newcredit4-role" value="" /></td><td><input type="textbox" name="newcredit4-name" value="" /></td></tr>
<tr><td><input type="textbox" name="newcredit5-role" value="" /></td><td><input type="textbox" name="newcredit5-name" value="" /></td></tr>	
</table>
</fieldset>

<fieldset>Donation HTML (Optional)<br />
	<textarea name="Donation_HTML" rows="4" cols="38">{$video.donation_html}</textarea>
</fieldset>

<fieldset>
Donation URL (Optional)<br />
	<input type="text" name="Donation_URL" size="38" value="{$video.donation_url}"/>
</fieldset>

<fieldset>
	Associated Webpage (Optional)<br />
	<input type="text" name="Webpage" size="40" value="{$video.website_url}"/>
</fieldset>

<p class="publish_button" style="clear: both;">
<input style="border: 1px solid black; font-size:1.6em;" type="submit" value="&raquo; Commit Changes &raquo;" border=0 alt="Continue" />

</p>

</div>
</div>
</div>

</form>
<!--done--->


  </div>


<br/>
{include file='footer.tpl'}
