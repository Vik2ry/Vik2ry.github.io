<!DOCTYPE HTML>
<html <?php language_attributes() ?>>
<head>
<?php wp_head() ?>
<title>
<?php 
/*
  Encyclopedia Wordpress Theme
  (c) 2009-2015 Scriptol.com -   License GNU GPL 2.0
*/
wp_title();
?>
</title>
<meta http-equiv="content-type" content="<?php esc_attr_e(bloginfo('html_type')) ?>; charset=<?php bloginfo('charset') ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php bloginfo('stylesheet_url'); ?>" />	
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" <?php _e('RSS feed', 'encyclopedia' ) ?>" />
<link rel="pingback" href="<?php esc_attr_e(bloginfo('pingback_url')) ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="hfeed">

<div id="header">
  <div id="logo"  onclick="location.href='<?php echo home_url(); ?>/';">
      <?php bloginfo('name'); ?> <br>
      <span class="sitedesc"><?php bloginfo('description'); ?></span>  
  </div>  
  	
  <div id="tabs"> 
   <ul>
    <?php wp_list_categories('title_li=&sort_column=name&hierarchical=0&number=8') ?>
   </ul>
  </div>
</div>
	
