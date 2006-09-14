<?php get_header(); ?>	
	
<div id="content-2col">
			<div id="content-left-2col">

			<!--NEWS & UPDATES-->

					<div id="rssfeedca">Democracy Internet TV Blog&nbsp;&nbsp;&nbsp;<a href="http://getdemocracy.com/news/feed" class="feed">RSS Feed</a></div>

					
					<?php		c2c_get_recent_posts (
						$num_posts = 8,
						$format = "%post_date%<h2 class=\"posttitle\">%post_title%</h2><div class=\"byaux\">%post_author%</div>%post_content%\n<p class=\"commentline\"><a style=\"font-weight: normal;\" href='%comments_url%'>Comments: %comments_count%</a> - <a style=\"font-weight: normal;\" href=\"%comments_url%\">permalink</a></p>",
						$categories = '',
						$orderby = 'date',
						$order = 'DESC',
						$offset = '0',
						$date_format = '\<\d\i\v \c\l\a\s\s\=\"\d\a\t\e\b\l\o\c\k\"\>\<\d\i\v\ \c\l\a\s\s\=\"\d\a\t\e\t\o\p\"\>M\<\/\d\i\v\>\<\d\i\v\ \c\l\a\s\s\=\"\d\a\t\e\b\o\t\t\o\m\"\>d\<\/\d\i\v\>\<\/\d\i\v\>',
						$authors = '',
						$include_passworded_posts = 'false');
					?>	
					
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					
					<?php comments_template(); // Get wp-comments.php template ?>

					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

			<!--/NEWS & UPDATES-->

			
  </div>   <!--/left-->

		
		<?php get_sidebar(); ?>
		


			<div class="clearer"></div>
<?php get_footer(); ?>