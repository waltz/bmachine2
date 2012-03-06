{* Smarty *}

{include file='header.tpl'}

<div id="wrap">

	<div id="library_header_wrap">
		<div id="library_title">
			User info: 
			{if $user != ''}
				{$user.name}
			{else}
				no user specified!
			{/if}			
		</div>
	</div>

	<div class="video_section">
	<p>
		{if $user != ''}
			Username: {$user.username} <br/>
			Admin: {if $user.admin == 1}Yes{else}No{/if} <br/>
			Email: <a href="mailto:{$user.email}">{$user.email}</a> <br/>
		{else}
			No user specified!
		{/if}
	</p>

{include file='footer.tpl'}
