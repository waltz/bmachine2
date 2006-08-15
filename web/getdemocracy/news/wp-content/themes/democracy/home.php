<?php get_header(); ?>	
	
<div id="content-2col">
			<div id="content-left-2col">

			<!--NEWS & UPDATES-->

					<div id="rssfeedca">Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></div>

					
					<?php		c2c_get_recent_posts (
						$num_posts = 6,
						$format = "%post_date%<h2>%post_URL%</h2><div class=\"byaux\">by %post_author%</div>%post_content%\n<p><a href='%comments_url%'>Comments: %comments_count%</a></p>",
						$categories = '',
						$orderby = 'date',
						$order = 'DESC',
						$offset = '0',
						$date_format = '<div class="dateblock"><div class="datetop">M</div><div class="datebottom">d</div></div>',
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
									%post_date%
								<h2>%post_URL%</h2>
							 <div class=\"byaux\">by %post_author%</div>
								%post_excerpt%
								<p><a href='#'>Continue reading >></a></p>
							</div>
							",
							$categories = '',
							$orderby = 'date',
							$order = 'DESC',
							$offset = '3',
							$date_format = '<div class="dateblock"><div class="datetop">M</div><div class="datebottom">d</div></div>',
							$authors = '',
							$include_passworded_posts = 'false');
						?>	
					</div>	
				</div>


  </div>   <!--/left-->

		
		<?php get_sidebar(); ?>
		


			<div class="clearer"></div>
<?php get_footer(); ?>