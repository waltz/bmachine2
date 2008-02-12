{* Smarty *}
{* Step 2 of setup *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">

<h1>Database Settings</h1>
<p>We're going to need some information to connect Broadcast Machine to a MySQL database. If you're unsure about what MySQL is, check out this <a 
href="">guide</a>. Enter your database information below:</p>
<form method="post" action="{$baseUri}setup" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="" class="hidden"/>
<div id="poststuff">
<div class="page_name">
<div class="section">

<div class="section_header">Database Information</div>
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

{include file='footer.tpl'}
