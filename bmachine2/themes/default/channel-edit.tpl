{* Smarty *}
{* Edit a channel *}


{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

<!--done--->
<form method="post" action="{$baseUri}channel/{$channel.title}/edit/" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<div class="page_name">
   <h2>Edit Channel</h2>

</div>

<div class="section">
<div id="delete-button"><a href="#">Delete this channel</a></div>
<h3>Channel Info</h3>
<input type="hidden" name="id" value="{$channel.id}" />
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

<input type="text" name="icon_url" size="60" value="{$channel.icon_url}"/>
</div>
</fieldset>

<fieldset>
	Description<br />
	<textarea rows="4" cols="40" name="description" id="content">{$channel.description}</textarea>
</fieldset>

<fieldset>

<fieldset>
	<label for="tags">Tags <small>seperated by spaces</small></label><br/>
        <input name="tags" type="text" value="{$channel.tags}" size="38" /><br/>
</fieldset>
<fieldset>
	Associated Webpage (Optional)<br />
	<input type="text" name="website_url" size="40" value="{$channel.website_url}"/>
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
