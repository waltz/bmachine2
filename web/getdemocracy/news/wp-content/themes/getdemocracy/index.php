<?php get_header(); ?>	
	
		<div class="left">
			<!--NEWS & UPDATES-->
			<div class="box box-mid box-left">
				<div id="page_title">
					<h1>Democracy Internet TV Blog</h1>
				</div>
				<div class="box-content">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<h3><?php the_time('l, F jS, Y') ?> <span style="font-weight:normal;">at</span> <?php the_time() ?> <span style="font-weight:normal;">by</span> <?php the_author() ?></h3>
					
					<?php the_content(__('(more...)')); ?>
					
									<p class="postmetadata"><?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
					
					
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>	
			</div>
			<!--/NEWS & UPDATES-->
		</div>
		
		<?php get_sidebar(); ?>
		
  </div>
  <!--/CONTENT BLOCK-->

<?php get_footer(); ?>