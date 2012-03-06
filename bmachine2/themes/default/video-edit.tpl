{include file='header.tpl'}

<form method="post"
      action="{$baseUri}video/{$video.title|urlencode}/edit"
      enctype="multipart/form-data"
      accept-charset="utf-8">

      <h1>Edit Video</h1>

      <fieldset>
		<legend>Video Info</legend>

		<label for="title">Title</label><br/>
		<input type="text" name="title" value="{$video.title}"/>
		<br/>
		<label for="description">Description</label><br/>
		<textarea name="description">{$video.description}</textarea>
		<br/>
		<label for="icon">Icon</label><br/>
		<input type="file" name="icon"/>	
		<br/>
		<img src="{$video.icon_url}" width="300px"/><br/>
	</fieldset>

	<fieldset>
		<legend>Associated Channels</legend>
		{foreach from=$channels item=channel}
			 {foreach from=$video.channels item=videoChannel}
			 	  {if $channel.id eq $videoChannel.id}
				      {assign var='selected' value='true'}
				  {/if}
			 {/foreach}
			 <input type="checkbox" name="channels[]" id="{$channel.id}" value="{$channel.id}"
			 {if $selected eq 'true'}checked="checked"{/if}/>
			 <label for="{$channel.id}">{$channel.title}</label>
			 {assign var='selected' value='false'}
		{/foreach}
	</fieldset>

	<fieldset>
		<legend>Tags</legend>
      		<label for="tags">Tags (Space delimited):</label>
		<input type="text" name="tags" value="{foreach from=$video.tags item=tag}{$tag.name} {/foreach}"/>
	</fieldset>

	<fieldset>
		<legend>License</legend>
	</fieldset>

	<fieldset>
		<legend>Dontations</legend>
	</fieldset>

	<input type="submit" name="submit" value="Edit"/>
</form>

{include file='footer.tpl'}
