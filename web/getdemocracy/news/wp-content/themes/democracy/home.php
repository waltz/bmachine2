<?php get_header(); ?>	
	
<div id="content-2col">
			<div id="content-left-2col">

			<!--NEWS & UPDATES-->

					<h2>Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></h2>

					
					<?php		c2c_get_recent_posts (
						$num_posts = 6,
						$format = "<h2>%post_URL%</h2>%post_date% <span style='font-weight:normal;'>by</span> %post_author%<br /><Br />%post_content%\n<p><a href='%comments_url%'>Comments: %comments_count%</a></p>",
						$categories = '',
						$orderby = 'date',
						$order = 'DESC',
						$offset = '0',
						$date_format = '',
						$authors = '',
						$include_passworded_posts = 'false');
					?>	
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php comments_template(); // Get wp-comments.php template ?>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

			<!--/NEWS & UPDATES-->
			
			<!--OLDER ENTRIES-->

			
				<div class="box box-mid box-left">
					<div class="header">
						<h1>Older Entries</h1>				
					</div>
					<div class="box-content">
					
						<?php		c2c_get_recent_posts (
							$num_posts = 3,
							$format = "							
							<div class='column3'>
								<h2>%post_URL%</h2>
								%post_date% <span style='font-weight:normal;'>by</span> %post_author%
								%post_excerpt%
								<p><a href='#'>Continue reading >></a></p>
							</div>
							",
							$categories = '',
							$orderby = 'date',
							$order = 'DESC',
							$offset = '3',
							$date_format = '',
							$authors = '',
							$include_passworded_posts = 'false');
						?>	
					</div>	
				</div>


  </div>   <!--/left-->

		
		<?php get_sidebar(); ?>
		


			<div class="clearer"></div>
<?php get_footer(); ?>