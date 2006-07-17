<!--SIDEBAR-->
<div id="sidebar" class="sidebar">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>


			<li><h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

				

	<?php include("../../../../includes/sidebar-newsletters.php"); ?>	
	
	<!--<h3>Deli.cio.us</h3>
	<ul>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
	</ul>
	
	<h3>Latest Links</h3>
	<ul>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
		<li><a href="#">LinkName</a></li>
	</ul> -->
</div>
<!--/ SIDEBAR-->