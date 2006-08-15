<?php get_header(); ?>	
	
	
	<div id="content-2col">
			<div id="content-left-2col">


			<!--NEWS & UPDATES-->

					<div id="rssfeedca">Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></div>
					<div id="homelink"><a href="/news/">&laquo; Blog Home</a></div>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="dateblock"><div class="datetop"><?php the_time('M') ?></div><div class="datebottom"><?php the_time('d') ?></div></div>
					<h2 class="posttitle"><?php the_title(); ?></h2>
					<div class="byaux">by</span> <?php the_author() ?></div>
					<div class="postline">
					<?php the_content(__('(more...)')); ?>
					</div>
					<?php comments_template(); // Get wp-comments.php template ?>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
			
 </div>   <!--/left-->

		
		<?php get_sidebar(); ?>
		


			<div class="clearer"></div>
<?php get_footer(); ?>