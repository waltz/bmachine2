<!--SIDEBAR-->
<div id="content-right-2col">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" size="15" />
		<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>

<p>&nbps;</p>
<h2>Articles</h2>

<p>
<br />
Future of Online Video<br /><a href="http://www.getdemocracy.com/articles/future_of_video.php">Openness Matters. RSS Can Help.</a>
</p>

<p>
Video Podcast Shootout<br /><a href="http://www.getdemocracy.com/articles/video_podcast_shootout.php">Democracy vs. iTunes</a><br />
</p>

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
