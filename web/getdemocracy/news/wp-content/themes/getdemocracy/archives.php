<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>	
	
		<div class="left">
			<!--NEWS & UPDATES-->
			<div class="box box-mid box-left">
				<div id="page_title">
					<h1>News &amp; Updates</h1>
				</div>
				<div class="box-content">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php smartArchives(); ?>

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