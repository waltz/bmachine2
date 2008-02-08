{* Smarty *}
{* Step 2 of setup *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<h1>Almost There!</h1>
<p>The last step of setup is creating an administrative username that you can use to manage your Broadcast Machine installation:</p>
<form method="post" action="" name="post" enctype="multipart/form-data" accept-charset="utf-8">
<!-- , iso-8859-1 -->
<input type="hidden" name="ID" value="" class="hidden"/>
<div id="poststuff">
<div class="page_name">
<div class="section">

<div class="section_header">Create User</div>
<fieldset>
<div class="the_legend">Username <small>(This is the handle you'll use to log in to Broadcast Machine)</small></div><br /><input type="text" 
name="username" size="38" value="{$username}" />
</fieldset>

<fieldset>
<div class="the_legend">Your Name <small>(What you go by in real life)</small></div><br /><input type="text" name="name" size="38" value="{$name}" />
</fieldset>

<fieldset>
<div class="the_legend">E-mail Address <small>(In case you forget your password)</small></div><br /><input type="text" name="email" size="38" value="{$email}" 
/>
</fieldset>

<fieldset>
<div class="the_legend">Password </div><br /><input type="password" name="pass" size="38" value="" />
</fieldset>

<fieldset>
<div class="the_legend">Confirm Password </div><br /><input type="password" name="password_confirm" size="38" value="" />
</fieldset>


<p class="publish_button" style="clear: both;">
<input style="border: 1px solid black;" type="submit" value="&gt;&gt; Create User" border=0 alt="Create User" />

</p>

</div>
</div>
</div>

</form> 

{include file='footer.tpl'}
