<?php if ( post_password_required() ) return; ?>

<div id="comments">
<?php if ( have_comments() ) : ?>
<h3 class="comments-title">
<?php
	printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'encyclopedia' ), number_format_i18n( get_comments_number() ), get_the_title() );
?>
</h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'encyclopedia' ); ?></h3>
 <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'encyclopedia' ) ); ?></div>
 <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'encyclopedia' ) ); ?></div>
</nav>
<?php endif; ?>

<ol class="comment-list">
	<?php wp_list_comments( array('style'=> 'ol',	'short_ping' => true,'avatar_size'=> 34,) ); ?>
</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
 <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
	<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'encyclopedia' ); ?></h3>
	<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'encyclopedia' ) ); ?>
	</div>
	<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'encyclopedia' ) ); ?>
	</div>
 </nav>
<?php endif; ?>
<?php endif; ?>

<?php if ( ! comments_open() ) : ?>
 <p class="no-comments"><?php _e( 'Comments are closed.', 'encyclopedia' ); ?></p>
<?php endif; ?>

<?php comment_form(); ?>
</div>