<?php get_header(); ?>	
	
		<div class="left">
			<!--NEWS & UPDATES-->
			<div class="box box-mid box-left">
				<div id="page_title">
					<h1>Democracy Internet TV Blog<a href="http://getdemocracy.com/news/feed" class="feed">&nbsp;</a></h1>
				</div>				
				<div class="box-content">
					
					<?php		c2c_get_recent_posts (
						$num_posts = 6,
						$format = "<h1>%post_URL%</h1>\n<h3>%post_date% <span style='font-weight:normal;'>by</span> %post_author%</h3>\n%post_content%\n<p><a href='%comments_url%'>Comments: %comments_count%</a></p>",
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
				</div>	
			</div>
			<!--/NEWS & UPDATES-->
			
			<!--OLDER ENTRIES-->
			<div class="content">
			
				<div class="box box-mid box-left">
					<div class="header">
						<h1>Older Entries</h1>				
					</div>
					<div class="box-content">
					
						<?php		c2c_get_recent_posts (
							$num_posts = 3,
							$format = "							
							<div class='column3'>
								<h1>%post_URL%</h1>
								<h3>%post_date%<br />
		<span style='font-weight:normal;'>by</span> %post_author%</h3>
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
				
			</div>	
			<!--/OLDER ENTRIES-->
			
			<!--BLOGS-->
			<!--<div class="content">
			
				<div class="box box-mid box-left">
					<div class="header-shine">
						<h1>Great Video Blogs &amp; Sites</h1>				
					</div>
					<div class="box-content">
						<table width="100%" cellspacing="0" cellpadding="2" border="0">
							<tr>
								<td align="left" valign="top" width="33%"><p><a href="#">SiteName</a></p></td>
								<td align="left" valign="top" width="33%"><p><a href="#">SiteName</a></p></td>
								<td align="left" valign="top" width="33%"><p><a href="#">SiteName</a></p></td>
							</tr>
							<tr>
								<td><p><a href="#">SiteName</a></p></td>
								<td><p><a href="#">SiteName</a></p></td>
								<td><p><a href="#">SiteName</a></p></td>
							</tr>
							<tr>
								<td><p><a href="#">SiteName</a></p></td>
								<td><p><a href="#">SiteName</a></p></td>
								<td><p><a href="#">SiteName</a></p></td>
							</tr>
						</table>
					</div>
				</div>
				
			</div>	 -->
			<!--/BLOGS-->
		</div>
		
		<?php get_sidebar(); ?>
		
  </div>
  <!--/CONTENT BLOCK-->

<?php get_footer(); ?>