{* Smarty *}

{include file='header.tpl'}

<div id="wrap">

	<div id="library_header_wrap">
		<div id="library_title">
			{if $users|@count eq 0}
				No users!
			{elseif $users|@count eq 1}
				Showing 1 user
			{else}
				Showing All {$users|@count} Users
			{/if}
		</div>
	</div>

<div class="video_section">

	 <div class="user">
	 	<em>User name : User's page</em><br />
		{foreach from=$users item=user}
				  {$user.name}:
				  <a href="{$baseUri}user/{$user.username}">{$user.username}</a>
				  <br />
		{/foreach}
	 </div>
	 <br/>

</div>

{include file='footer.tpl'}
