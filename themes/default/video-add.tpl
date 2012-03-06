{* Smarty *}

{include file='header.tpl'}

<div id="wrap">
<h1>Add a new Video</h1>
<p>Creates a new video file and associates it with some important data.</p>
<form name="video/add" 
      method="POST" 
      action="{$baseUri}video/add"
      enctype="multipart/form-data"
      >

      <input type="hidden" name="video-id" value="{$video.id}"/>

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

      <!-- <fieldset>
  <legend>Video File</legend>
  <label for="video_file">Video</label><br/>
  <input type="hidden" name="MAX_FILE_SIZE" value="{$maxPost}"/>
  <input name="video_file" type="file"/><br/>
  <label for="icon_file">Icon:</label><br/>
  <input name="icon_file" type="file"/><br/>
     </fieldset> -->
     
         <fieldset>
     <legend>Video File</legend>
     <label for="file_url">Video</label><br/>
     <input name="file_url" type="text"/><br/>
     <label for="icon_url">Icon:</label><br/>
     <input name="icon_url" type="text"/><br/>
        </fieldset>

     <input name="submit" type="submit" value="Add" />
</form>
</div>

{include file='footer.tpl'}