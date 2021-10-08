<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'knowledge_base_lite_before_slider' ); ?>

  <?php if( get_theme_mod( 'knowledge_base_lite_slider_arrows', false) != '' || get_theme_mod( 'knowledge_base_lite_resp_slider_hide_show', false) != '') { ?>
    <section id="slider">
       <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"> 
        <?php $knowledge_base_lite_pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'knowledge_base_lite_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $knowledge_base_lite_pages[] = $mod;
            }
          }
          if( !empty($knowledge_base_lite_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $knowledge_base_lite_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php if(has_post_thumbnail()) {?>
                <div class="slide-image">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php }?>
              <div class="carousel-caption">
                <div class="slider-inner-box">
                  <h1 class="mb-0 pt-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                  <p class="mt-2 mb-4"><?php $excerpt = get_the_excerpt(); echo esc_html( knowledge_base_lite_string_limit_words( $excerpt, 10)); ?></p>
                  <div class="search-box">
                    <?php get_search_form(); ?>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
          <span class="carousel-control-prev-icon px-3 py-2 w-auto h-auto" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','knowledge-base-lite' );?></span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
          <span class="carousel-control-next-icon px-3 py-2 w-auto h-auto" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','knowledge-base-lite' );?></span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'knowledge_base_lite_after_slider' ); ?>

  <?php if( get_theme_mod('knowledge_base_lite_services_category') != ''){ ?>
    <section id="services-sec">
      <div class="container">
        <div class="row">
          <?php
          $knowledge_base_lite_catData = get_theme_mod('knowledge_base_lite_services_category');
          if($knowledge_base_lite_catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html( $knowledge_base_lite_catData ,'knowledge-base-lite')));
            $bgcolor = 1; ?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="col-lg-4 col-md-4">
                <div class="inner-box pb-3 text-center">
                  <?php the_post_thumbnail(); ?>
                  <h4><a href="<?php the_permalink();?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
                  <p class="px-4"><?php $excerpt = get_the_excerpt(); echo esc_html( knowledge_base_lite_string_limit_words( $excerpt, 10)); ?></p>
                </div>
              </div>
            <?php if($bgcolor >= 6){ $bgcolor = 0; } $bgcolor++; endwhile;
            wp_reset_postdata();
          } ?>
        </div>
      </div>
    </section>
  <?php } ?>

  <?php do_action( 'knowledge_base_lite_after_service' ); ?>

  <div id="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>