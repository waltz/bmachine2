{* Smarty *}
{* Step 2 of setup *}

{include file='header.tpl'}

<div id="wrap">
<div id="inner_wrap">

<h1>Broadcast Machine Settings</h1>
<form method="post" action="{$baseUri}setup/settings" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="" class="hidden"/>
<div id="poststuff">
<div class="page_name">
<div class="section">

<div class="section_header">Site Settings</div>

<fieldset>
<div class="the_legend">Site Name</div><br /><input type="text" name="site_name" size="38" value="{$site_name}" />
</fieldset>

<fieldset>
        Description<br />
        <textarea rows="4" cols="40" name="site_description" id="content">{$site_description}</textarea>
</fieldset>

<fieldset>
<div class="the_legend">Icon URL </div><br /><input type="text" name="site_iconurl" size="38" value="{$site_iconurl}" />
</fieldset>

<!--<fieldset>
<div class="the_legend">Hide Adult Material? <input type="checkbox" name="hide_porn" value="" checked /><br />
<small>(items tagged with the phrase 'adult' will only appear to registered users)</small>
</div>
</fieldset>-->

<div class="section_header">Database</div>
<p>We need some information to connect Broadcast Machine to a MySQL database, where it stores all of the important data about your videos. If 
you're unsure about what MySQL is, check out this <a href="">guide</a>.</p>
<fieldset>
<div class="the_legend">Hostname: </div><br /><input type="text" name="hostname" size="38" value="{$hostname}" />
</fieldset>

<fieldset>
<div class="the_legend">Database Name: </div><br /><input type="text" name="database" size="38" value="{$database}" />
</fieldset>

<fieldset>
<div class="the_legend">Username: </div><br /><input type="text" name="username" size="38" value="{$username}" />
</fieldset>

<fieldset>
<div class="the_legend">Password: </div><br /><input type="password" name="password" size="38" value="" />
</fieldset>


<p class="publish_button" style="clear: both;">
<input style="border: 1px solid black;" type="submit" value="&gt;&gt; Continue" border=0 alt="Continue" />

</p>

</div>
</div>
</div>

</form> 
<p>Tip: Not sure what all of these settings mean? Don't worry, you can come back and change them later.</p>

{include file='footer.tpl'}
