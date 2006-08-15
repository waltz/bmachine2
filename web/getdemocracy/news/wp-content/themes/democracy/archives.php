<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>	
	
	<div id="content-2col">
			<div id="content-left-2col">
				
			<!--NEWS & UPDATES-->
			
			<div id="rssfeedca">Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></div>
			

				<div id="page_title">
					<h2>News &amp; Updates</h2>
				</div>
				

					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php smartArchives(); ?>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

			
			<!--/NEWS & UPDATES-->
		</div>
		
		<?php get_sidebar(); ?>
		
  </div>
  <!--/CONTENT BLOCK-->
<div class="clearer"></div>
<?php get_footer(); ?>