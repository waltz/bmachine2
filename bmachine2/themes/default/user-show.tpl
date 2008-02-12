{* Smarty *}

{include file='header.tpl'}

{if $user != ''}
<h1>{$user.name}</h1>

<p>
Username: {$user.username} <br/>
Admin: {if $user.admin == 1}Yes{else}No{/if} <br/>
Email: <a href="mailto:{$user.email}">{$user.email}</a> <br/>
{/if}
</p>

{include file='footer.tpl'}
