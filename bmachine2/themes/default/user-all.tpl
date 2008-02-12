{* Smarty *}

{include file='header.tpl'}

<h1>Show All Users</h1>

<div id="content">
{foreach from=$users item=user}
	 <div class="user">
	      {$user.name}:
	      <a href="{$baseUri}user/{$user.username}">{$user.username}</a>
	      <br/>
	 </div>
	 <br/>
{/foreach}
</div>

{include file='footer.tpl'}