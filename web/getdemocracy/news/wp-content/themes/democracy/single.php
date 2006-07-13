<?php get_header(); ?>	
	
	
	<div id="content-2col">
			<div id="content-left-2col">


			<!--NEWS & UPDATES-->

					<h2><a href="http://www.getdemocracy.com/news/">Democracy Internet TV Blog</a>&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></h2>


					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<h2><?php the_title(); ?></h2>
					<?php the_time('l, F jS, Y') ?> <span style="font-weight:normal;">at</span> <?php the_time() ?> <span style="font-weight:normal;">by</span> <?php the_author() ?><br /><br />
					
					<?php the_content(__('(more...)')); ?>
					
					<?php comments_template(); // Get wp-comments.php template ?>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
			
 </div>   <!--/left-->

		
		<?php get_sidebar(); ?>
		


			<div class="clearer"></div>
<?php get_footer(); ?>