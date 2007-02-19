{* Smarty *}

{include file='header.tpl'}

<div class="wrap">

<form method="post" action="create_channel.php" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="" class="hidden"/>
<div id="poststuff">
<div class="page_name">
   <h2>Create a Channel</h2>

   <div class="help_pop_link">
      <a href="javascript:popUp('http://www.getdemocracy.com/broadcast/help/channel_popup.php')">
<img src="themes/default/images/help_button.gif" alt="help"/></a>
   </div>
</div>

<div class="section">

<div class="section_header">Channel Info</div>
<fieldset>
<div class="the_legend">Channel Name: </div><br /><input type="text" name="Name" size="38" value="" />
</fieldset>

<fieldset>
   <div class="the_legend">Description:</div><br />
   <textarea rows="4" cols="40" name="Description" id="content"></textarea>
</fieldset>


<fieldset><div class="the_legend">Channel Icon: </div>

<a href="#" onClick="document.getElementById('specify_image').style.display = 'none'; document.getElementById('upload_image').style.display = 'block'; return false;">Upload Image</a> or <a href="#" onClick="document.getElementById('upload_image').style.display = 'none'; document.getElementById('specify_image').style.display = 'block'; return false;">Specify URL</a>

<div style="" id="upload_image">
<input type="file" name="IconUpload" value="Choose File" />
</div>

<div id="specify_image" style="display:none;" >

<input type="text" name="Icon" size="38" value="http://"/>
</div>
</fieldset>

<fieldset><div class="the_legend">Allow Non-admins to Post: </div><input type="checkbox" name="OpenPublish" /></fieldset>

<fieldset>
<div class="the_legend">Publisher (optional): </div><br />
<input type="text" name="Publisher" size="38" value="" id="title" />
</fieldset>

<!--Select a License
<fieldset><img src="themes/default/images/cc_logo_17px.png" alt="CC logo" /> Creative Commons (optional): <input type="text" name="LicenseName" size="38" value="" onFocus="this.blur();" autocomplete="off" class="blended"/><br/>

<a href="#" onClick="window.open('http://creativecommons.org/license/?partner=bmachine&exit_url=' + escape('http://localhost/hello/cc.php?license_url=[license_url]&license_name=[license_name]'),'cc_window','scrollbars=yes,status=no,directories=no,titlebar=no,menubar=no,location=no,toolbar=no,width=450,height=600'); return false;">Choose License</a>

<input type="hidden" name="LicenseURL" value="" class="hidden"/>

</fieldset>
-->
<!-- Tags -->
    <fieldset>
      <div class="the_legend">Channel Keywords / Tags (1 per line)</div>

			<br/>
			<textarea name="Keywords" rows="4" cols="38">
</textarea>
    </fieldset>

<div class="section_header">Video Info</div>

<p><em>Select attributes to show for each file. Applies to all sections.</em></p>
<fieldset>
<ul style="edit_library_options">
<li><input type="checkbox" name="Options[Thumbnail]" checked="true">Thumbnail</li>
<li><input type="checkbox" name="Options[Name]" checked="true">Title</li>
<li><input type="checkbox" name="Options[Creator]">Creator's Name</li>
<li><input type="checkbox" name="Options[Description]">Description</li>
<li><input type="checkbox" name="Options[Length]">Play Length</li>

<li><input type="checkbox" name="Options[Filesize]">File Size</li>
<li><input type="checkbox" name="Options[Published]">Published Date</li>
<li><input type="checkbox" name="Options[Torrent]">Torrent Stats</li>
<li><input type="checkbox" name="Options[URL]">Associated URL</li>
</ul>
</fieldset>
<br />

<div class="section_header">Other Settings</div>
<fieldset>
<ul>
<li><input type="checkbox" name="Options[Keywords]" checked="true"> Display Tags list.</li>

</ul>
</fieldset>

</fieldset>


<div class="section_header">Subscription Links</div>
<p><em>Show subscription links for:</em></p>

<fieldset>
<ul>
<li><input type="checkbox" name="SubscribeOptions[]" checked="true" value="1"> RSS Feed</li>
<li><input type="checkbox" name="SubscribeOptions[]" checked="true" value="2"> Democracy</li>
<li><input type="checkbox" 
           name="SubscribeOptions[]" 
           value="4"> iTunes (You must have direct URLs enabled in the <a href="settings.php">settings tab</a> for iTunes compatibility.)</li>

</ul>
</fieldset>

<fieldset><div class="section_header">Donation HTML (Optional) </div>
	<textarea name="Donation_HTML" rows="4" cols="38">
	</textarea>
</fieldset>

<fieldset><div class="section_header">Donation URL (Optional) </div>
	<input type="text" name="Donation_URL" size="38" value="http://"/>
</fieldset>

<fieldset>
  <div class="the_legend">Associated Webpage (Optional) </div>
	<br />
	<input type="text" name="Webpage" size="40" value="http://"/>
</fieldset>

<p class="publish_button" style="clear: both;">
<input style="border: 1px solid black;" type="submit" value="&gt;&gt; Create Channel" border=0 alt="Continue" />

</p>

</div>
</div>
</div>

</form>


	<div class="spacer">&nbsp;</div>

{include file='footer.tpl'}