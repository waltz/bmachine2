{* Smarty *}
{* replace channels[2] with channel *}


{include file='header.tpl'}



<body>

<br />
<br />
<br />
<div id="wrap">
<div id="inner_wrap">
<h2>Are you sure you want to permanently delete channel: <a href='{$settings.baseurl}{$channels[2].title}'>{$channels[2].title}</a>?</h2>
<div style="padding: 20px 200px 20px 200px">
<div style="float:left;"><h1><a href="#">YES</a></h1></div> <div style="float:right;"><a href="#"><h1>NO</a></h1></div>
</div>
</div>
</div>



<br/>
{include file='footer.tpl'}