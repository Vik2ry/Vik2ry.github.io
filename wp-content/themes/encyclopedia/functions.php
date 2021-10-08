<?php
/** Encyclopedia, based on standard Wordpress included themes  */

if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}

function encyclopedia_setup() {
	load_theme_textdomain( 'encyclopedia', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'encyclopedia_setup' );

function encyclopedia_widgets_init() {
register_sidebar(array(
	'name'          => __( 'Encyclopedia_sidebar', 'encyclopedia' ),
	'id'            => 'sb0001',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '',
	'after_title' => '',
));
}
add_action( 'widgets_init', 'encyclopedia_widgets_init' );

function encyclopedia_wp_title( $title, $sep ) {
	if(is_feed()) 		return $title;
	if(is_404())           $title= _e('Page not found',''); 
	elseif (is_home())     $title= bloginfo('description')." - ".bloginfo('name'); 
	elseif (is_category()) $title= single_cat_title();
	elseif (is_date())     $title= _e('Archives', ''). " of ".bloginfo('name'); 
	elseif (is_search())   $title= _e('Search results', ''); 
	else $title=the_title();
	return $title; 
}

add_filter( 'wp_title', 'encyclopedia_wp_title', 10, 2 );

function my_comments_open( $open, $post_id ) {

	$post = get_post( $post_id );

	if ( 'page' == $post->post_type )
		$open = false;

	return $open;
}
add_filter( 'comments_open', 'my_comments_open', 10, 2 );

function encyclopedia_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'encyclopedia' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'encyclopedia' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'encyclopedia' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'encyclopedia' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'encyclopedia' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'encyclopedia' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'encyclopedia' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>

	<?php
			break;
	endswitch;
}


function encyclopedia_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
  wp_enqueue_script('tabs', get_template_directory_uri().'/tabs.js');
}	

add_action( 'wp_enqueue_scripts', 'encyclopedia_scripts' );


?>
