{* Smarty *}

{include file='header.tpl'}

<div id="wrap">

	<h1>Add a new Channel</h1>
	<p>A channel is a collection of related videos. Users can automatically subscribe to channels using software such as Miro, or any RSS reader.</p>

	<form name="channel/add" method="POST" action="{$baseUri}channel/add" >
		<div class="page_name">
			<div class="section">

				<div class="section_header">Channel Information</div>
				  <fieldset>
					<div class="the_legend"><label for="title">Channel Name</label></div><br/>
					<input name="title" type="text" value="{$title}" size="38" /><br/>

					<div class="the_legend">
						<label for="description">Channel Description</label>
					</div><br/>
					<textarea name="description" size="38">{$description}</textarea><br/>

					<label for="tags">Tags <small>seperated by spaces</small></label><br/>
					<input name="tags" type="text" value="{$tags}" size="38" /><br/>
					<label for="icon_url">Icon URL:</label><br/>
					<input name="icon_url" type="text" value="{$icon}" size="38"/><br/>
	
					<label for="website_url">Website URL:</label><br/>
						<input name="website_url" type="text" value="{$website_url}" size="38"/>

				  </fieldset>

					  <input name="submit" type="submit" value="Add" />

				</div>
		</div>
	</form>

</div>

{include file='footer.tpl'}
