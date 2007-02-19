{* Smarty *}

{* replace $channels[2]s[2] with $channels[2] when the DB is up *}

{include file='header.tpl'}

<div class="wrap">

<form method="post" action="edit_channel.php" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="{$channels[2].id}" class="hidden"/>
<div id="poststuff">
<div class="page_name">
   <h2>Edit Channel: <a href="{$baseurl}/{$channels[2].title}">{$channels[2].title}</a></h2>

   <div class="help_pop_link">
      <a href="javascript:popUp('http://www.getdemocracy.com/broadcast/help/channel_popup.php')">
<img src="themes/default/images/help_button.gif" alt="help"/></a>
   </div>
</div>

<div class="section">

<div class="section_header">Channel Info</div>
<fieldset>
<div class="section_header">Channel Name: </div><input type="text" name="Name" size="38" value="{$channels[2].title}" />
</fieldset>

<fieldset>
   <div class="section_header">Description:</div>
   <textarea rows="4" cols="40" name="Description" id="content">{$channels[2].description}</textarea>
</fieldset>


<fieldset><div class="section_header">Channel Icon: </div>

<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div style="display:none;" id="upload_image">
<input type="file" name="IconUpload" value="Choose File" />
</div>

<div id="specify_image" style="" >

<input type="text" name="Icon" size="38" value="{$channels[2].icon_url}"/>
</div>
</fieldset>
<!-- allow non admins to post 
<fieldset><div class="section_header">Allow Non-admins to Post: </div><input type="checkbox" name="OpenPublish" /></fieldset>
 -->
<!--Select a License
<fieldset><img src="themes/default/images/cc_logo_17px.png" alt="CC logo" /> Creative Commons (optional): <input type="text" name="LicenseName" size="38" value="" onFocus="this.blur();" autocomplete="off" class="blended"/><br/>

<a href="#" onClick="window.open('http://creativecommons.org/license/?partner=bmachine&exit_url=' + escape('http://localhost/hello/cc.php?license_url=[license_url]&license_name=[license_name]'),'cc_window','scrollbars=yes,status=no,directories=no,titlebar=no,menubar=no,location=no,toolbar=no,width=450,height=600'); return false;">Choose License</a>

<input type="hidden" name="LicenseURL" value="" class="hidden"/>

</fieldset>
-->
<!-- Tags -->
<br/>
    <fieldset>
      <div class="section_header">Channel Keywords / Tags (1 per line)</div>
<textarea name="Keywords" rows="4" cols="38">{foreach from=$channels[2].tags item=tag}{$tag}{/foreach}
</textarea>
    </fieldset>

<br />

</fieldset>


<fieldset><div class="section_header">Donation HTML (Optional) </div>
	<textarea name="Donation_HTML" rows="4" cols="38" value="{$channels[2].donation_html}">
	</textarea>
</fieldset>
<br />
<fieldset><div class="section_header">Donation URL (Optional) </div>
	<input type="text" name="Donation_URL" size="38" value="{$channels[2].donation_url}"/>
</fieldset>
<br />
<fieldset>
  <div class="section_header">Associated Webpage (Optional) </div>
	<input type="text" name="Webpage" size="40" value="{$channels[2].website_url}"/>
</fieldset>

<p class="publish_button" style="clear: both;">
<input style="border: 1px solid black;" type="submit" value="&gt;&gt; Save Changes" border=0 alt="Continue" />

</p>

</div>
</div>
</div>

</form>


	<div class="spacer">&nbsp;</div>

{include file='footer.tpl'}