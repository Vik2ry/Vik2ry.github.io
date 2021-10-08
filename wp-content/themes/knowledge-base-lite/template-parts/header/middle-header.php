<?php
/**
 * The template part for top header
 *
 * @package Knowledge Base Lite
 * @subpackage knowledge-base-lite
 * @since knowledge-base-lite 1.0
 */
?>

<div class="middle-bar py-3">
  <div class="container">
    <div class="inner-head-box">
      <div class="row">
        <div class="col-lg-3 col-md-5 align-self-center">
          <div class="logo text-center text-md-start text-lg-start pb-3 pb-lg-0 pb-md-0">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <?php if( get_theme_mod('knowledge_base_lite_logo_title_hide_show',true) != ''){ ?>
                    <h1 class="site-title py-1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php } ?>
                <?php else : ?>
                  <?php if( get_theme_mod('knowledge_base_lite_logo_title_hide_show',true) != ''){ ?>
                    <p class="site-title py-1 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php } ?>
                <?php endif; ?>
              <?php endif; ?>
              <?php
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
              ?>
              <?php if( get_theme_mod('knowledge_base_lite_tagline_hide_show',true) != ''){ ?>
                <p class="site-description mb-0">
                  <?php echo esc_html($description); ?>
                </p>
              <?php } ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-7 col-md-3 col-5 py-0 py-lg-2 py-md-2 align-self-center">
          <?php get_template_part('template-parts/header/navigation'); ?>
        </div>        
        <div class="col-lg-2 col-md-4 col-7 align-self-center">
          <?php if( get_theme_mod('knowledge_base_lite_signin_link') != '' || get_theme_mod('knowledge_base_lite_signin_text') != '' ){ ?>
            <div class="topbar-btn my-3 text-center text-lg-end text-md-end">
              <a href="<?php echo esc_html(get_theme_mod('knowledge_base_lite_signin_link',''));?>" class="py-3 px-4"><?php echo esc_html(get_theme_mod('knowledge_base_lite_signin_text',''));?></a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>