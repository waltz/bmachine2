<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../wp-blog-header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>News from Participatory Culture</title>
<base href="http://www.conversate.org/" />
<link rel="stylesheet" type="text/css" media="all" href="../bm-dashboard/dashboard.css" title="default" />

<style>

body {
font-family: verdana, arial, sans-serif;
font-size: 13px;
}


.post h2 a, .post h2 {
text-decoration: none;
color: #339;
font-size: 15px;
font-weight: bold;
}

post h2 a:hover {
text-decoration: underline;
}

.post h2 {
margin: 0;
padding: 5px 0 2px 0;
}

.entry p {
margin-bottom: 0;
padding-bottom: 0;
}

small {
font-size: 12px;
color: #333;
}

a {
color: #009;
}


a visited {
color: #339;
}

h1 a, h1 {
text-decoration: none;
color: #333;
font-size: 12px;
font-weight: normal;
text-transform: uppercase;
line-height: 13px;
}



h1 a {
border-bottom: 1px dotted #333;
}

h1 a:hover {
border-bottom: 1px solid #333;
}

h1 {
text-align: center;
margin: 0;
padding: 5px 0 12px 0;
}


</style>

<!-- headers stuff and styles -->
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-163840-1";
urchinTracker();
</script>
</head>
<body>

<h1>News from <A target="_blank" href="http://www.participatoryculture.org">Participatory Culture</a></h1>


	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php wp_head(); ?>

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a target="_blank" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_author() ?> - <?php the_time('F jS, Y') ?></small>
				
				<div class="entry">
					<?php the_excerpt() ?> <div style="margin:0; padding: 0 5px 0 0; text-align: right"><a target="_blank" href="<?php the_permalink() ?>">Read More &#187;</a></div>
				</div>
		
				<?php edit_post_link('Edit','','|'); ?> <!-- <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> -->
				
				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
	
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php posts_nav_link('','','&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php posts_nav_link('','Next Entries &raquo;','') ?></div>
		</div>
		
	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
</body>