<!--SIDEBAR-->
<div id="content-right-2col">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>


<h2>Articles</h2>

<ul>
<li>
The future of video online: <a href="http://www.getdemocracy.com/articles/future_of_video.php">Openness Matters. RSS Can Help.</a>
</li>
<li>
Video podcast shootout: <a href="http://www.getdemocracy.com/articles/video_podcast_shootout.php">Democracy vs. iTunes</a><br />
</li>

			<h2>Older Posts</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			
<!--			
	<?php get_links_list(); ?> 
-->

<?php include("/data/getdemocracy/site-live/include/email/viewers.php"); ?>
<?php include("/data/getdemocracy/site-live/include/email/publishers.php"); ?>
<?php include("/data/getdemocracy/site-live/include/email/press.php"); ?>
<p>We won't share your email address with anyone.</p>
<?php include("/data/getdemocracy/site-live/include/email/translators.php"); ?>

					

</div>
<!--/ SIDEBAR-->
