{* Smarty *}
{* Step 1 of setup *}

{include file='header.tpl'}

<body>
<div id="wrap">
<div id="inner_wrap">
<h1>Whoops!</h1>
<p>We had a slight problem connecting to Broadcast Machine's database. It's possible your database server may be down, or your connection settings 
may be incorrect. If you think that your settings are incorrect, you can change them here: <a href="{$baseUri}setup/database">Database setup</a></p>
{include file='footer.tpl'}
