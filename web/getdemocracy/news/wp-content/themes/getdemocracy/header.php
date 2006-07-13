<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

<?php include("/data/getdemocracy/site-live/includes/head.php"); ?>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php wp_head(); ?>
	
</head>

<body>

<!--CONTAINER-->
<div id="container">

	<!--HEADER-->
	<?php include("/data/getdemocracy/site-live/includes/header.php"); ?>
	<!--/HEADER-->
		
	<!--CONTENT BLOCK-->
  <div class="content">	