{* Smarty *}

{include file='header.tpl'}

<h2>Add a new Video</h2>

<form name="video/add" method="POST" action="{$baseUri}video/add">
      <fieldset>
	<legend>Basic Info</legend>
	<label for="title">Title</label><br/>
	<input name="title" type="text" /><br/>
	<label for="description">Description:</label><br/>
	<input name="description" type="text"><br/>
      	<label for="tags">Tags:</label><br/>
	<input name="tags" type="text" /><br/>
	<label for="channel">Select a Channel:</label><br/>
      </fieldset>

      <fieldset>
	<legend>Channel(s):</legend>
	{if $channels == ''}
	    	No channels! Add one first!
	{else}
		{foreach from=$channels item=channel}
		<input type="checkbox" name="channels[]" value="{$channel.id}">
		{$channel.title}
		</option>
		<br/>
		{/foreach}
	{/if}	
      </fieldset>

      <fieldset>
	<legend>Video File</legend>
	<label for="icon_url">Icon URI:</label><br/>
	<input name="icon_url" type="text" /><br/>
	<label for="file_url">File URI:</label><br/>
	<input name="file_url" type="text" /><br/>
     </fieldset>

     <input name="submit" type="submit" value="Add" />
</form>

{include file='footer.tpl'}