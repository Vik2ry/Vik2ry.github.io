
<?php 
/*
  Encyclopedia Wordpress Theme
  (c) 2009-2015 Scriptol.com
  Licence GNU GPL 2.0
*/

get_header(); 
get_sidebar(); 
?>

<div id="container">

<h1><?php _e('Page not found', 'encyclopedia' ); ?></h1>

<div>
<?php get_search_form(); ?>
</div>
<br>
<h2><?php _e('Last articles', 'encyclopedia' ); ?></h2>
<ul> 
    <?php wp_get_archives('type=postbypost&limit=10'); ?>
</ul> 
</div>

</div>


<?php get_footer(); ?>

