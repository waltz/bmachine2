<!--SIDEBAR-->
<div id="content-right-2col">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>


			<h2>Older Posts</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			
<!--			
	<?php get_links_list(); ?> 
-->

	<?php include("/data/getdemocracy/site-live/include/stayuptodate.php"); ?>	
	

</div>
<!--/ SIDEBAR-->
