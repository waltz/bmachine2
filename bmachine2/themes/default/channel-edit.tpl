{* Smarty *}
{* Edit a channel
* 
* variables available to this template:
*  + channel (id, title, description, modified, icon_url, website_url, tags (array of channel tags)
*  + videos (array of 10 most recent videos (id, title, title_url, modified, icon_url, website_url, release_date, runtime, *    adult, size, downloads, tags, channels))
*  + settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, , donation_html, donation_url, donthideporn)
*  + user (username, admin, banned)
* 
* things that might be missing:
*  + adult
*  + donation_url
*  + donation_html
* 
*  + settings (name, description, open_reg, reg_approval, bandwidth_limit, baseurl, iconurl, donation_html, donation_url, 
*    donthideporn)
*
}


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
   <h2>Edit Channel</h2>

</div>

<div class="section">
<div style="float: right; font-size: 1.4em; font-weight:bold;">
<a href="#">Delete this channel</a>
</div>
<h3>Channel Info</h3>
<fieldset>
	Title<br />
	<input type="text" name="title" size="60" value="{$channel.title}" />
</fieldset>

<fieldset>Channel Icon<br />
<img src="{$channel.icon_url}" width="300px" /><br/>

<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div id="upload_image" style="display:none;">
<input type="file" name="IconUpload" value="Choose File" />
</div>

<div id="specify_image" style="display:block;" >

<input type="text" name="Icon" size="60" value="{$channel.icon_url}"/>
</div>
</fieldset>

<fieldset>
	Description<br />
	<textarea rows="4" cols="40" name="Description" id="content">{$channel.description}</textarea>
</fieldset>

<fieldset>
Tags <br />
{foreach from=$channel.tags item=tag}
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
	Associated Webpage (Optional)<br />
	<input type="text" name="Webpage" size="40" value="{$channel.website_url}"/>
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