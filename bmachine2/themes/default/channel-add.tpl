{* Smarty *}

{include file='header.tpl'}

<h2>Add a new Channel</h2>

<form name="channel/add" method="POST" action="{$baseUri}channel/add" >
      <fieldset>
	<legend>General Info</legend>
	<label for="title">Channel Name:</label><br/>
	<input name="title" type="text" /><br/>
	<label for="description">Channel Description</label><br/>
	<textarea name="description"></textarea>
      </fieldset>      

      <fieldset>
	<legend>Additional Settings</legend>
	<label for="tags">Tags: (Space separated!)</label><br/>
	<input name="tags" type="text" /><br/>
	<label for="icon">Icon:</label></br>
	<input disabled name="icon" type="file" />
      </fieldset>

      <fieldset>
	<legend>License</legend>
	<!-- TODO: Options for Creative Commons licenses. -->
      </fieldset>

      <input name="submit" type="submit" value="Add" />
</form>

{include file='footer.tpl'}
