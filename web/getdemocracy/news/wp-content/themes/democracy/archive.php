<?php get_header(); ?>	
	
		<div id="content-2col">
				<div id="content-left-2col">
					
			<!--NEWS & UPDATES-->
			
			<div id="rssfeedca">Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></div>
			

				<div id="page_title">
					<h1>News &amp; Updates</h1>
				</div>

					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<h3><?php the_time('l, F jS, Y') ?> <span style="font-weight:normal;">at</span> <?php the_time() ?> <span style="font-weight:normal;">by</span> <?php the_author() ?></h3>
					
					<?php the_content(__('(more...)')); ?>
					
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

			<!--/NEWS & UPDATES-->

		
		<?php get_sidebar(); ?>
		
  </div>
  <!--/CONTENT BLOCK-->
	<div class="clearer"></div>
<?php get_footer(); ?>