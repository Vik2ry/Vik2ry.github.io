<?php
/**
 * Knowledge Base Lite Theme Customizer
 *
 * @package Knowledge Base Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function knowledge_base_lite_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'knowledge_base_lite_custom_controls' );

function knowledge_base_lite_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'knowledge_base_lite_Customize_partial_blogname',
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_blogdescription',
	));

	//add home page setting pannel
	$knowledge_base_lite_parent_panel = new Knowledge_Base_Lite_WP_Customize_Panel( $wp_customize, 'knowledge_base_lite_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'knowledge-base-lite' ),
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'knowledge_base_lite_left_right', array(
    	'title' => esc_html__( 'General Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_panel_id'
	) );

	$wp_customize->add_setting('knowledge_base_lite_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Knowledge_Base_Lite_Image_Radio_Control($wp_customize, 'knowledge_base_lite_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','knowledge-base-lite'),
        'description' => esc_html__('Here you can change the width layout of Website.','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('knowledge_base_lite_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control('knowledge_base_lite_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','knowledge-base-lite'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','knowledge-base-lite'),
            'Right Sidebar' => esc_html__('Right Sidebar','knowledge-base-lite'),
            'One Column' => esc_html__('One Column','knowledge-base-lite'),
            'Three Columns' => esc_html__('Three Columns','knowledge-base-lite'),
            'Four Columns' => esc_html__('Four Columns','knowledge-base-lite'),
            'Grid Layout' => esc_html__('Grid Layout','knowledge-base-lite')
        ),
	) );

	$wp_customize->add_setting('knowledge_base_lite_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control('knowledge_base_lite_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','knowledge-base-lite'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','knowledge-base-lite'),
            'Right Sidebar' => esc_html__('Right Sidebar','knowledge-base-lite'),
            'One Column' => esc_html__('One Column','knowledge-base-lite')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'knowledge_base_lite_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'knowledge_base_lite_customize_partial_knowledge_base_lite_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'knowledge_base_lite_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_left_right'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'knowledge_base_lite_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'knowledge_base_lite_customize_partial_knowledge_base_lite_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'knowledge_base_lite_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_left_right'
    )));

    //Pre-Loader
	$wp_customize->add_setting( 'knowledge_base_lite_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','knowledge-base-lite' ),
        'section' => 'knowledge_base_lite_left_right'
    )));

	$wp_customize->add_setting('knowledge_base_lite_preloader_bg_color', array(
		'default'           => '#3bb7cf',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'knowledge_base_lite_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'knowledge-base-lite'),
		'section'  => 'knowledge_base_lite_left_right',
	)));

	$wp_customize->add_setting('knowledge_base_lite_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'knowledge_base_lite_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'knowledge-base-lite'),
		'section'  => 'knowledge_base_lite_left_right',
	)));

	//Top Header
	$wp_customize->add_section( 'knowledge_base_lite_top_header' , array(
    	'title' => esc_html__( 'Top Header', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_panel_id'
	) );

	$wp_customize->add_setting('knowledge_base_lite_signin_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('knowledge_base_lite_signin_text',array(
		'label'	=> esc_html__('Button Text','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Sign In', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_top_header',
		'type'=> 'text'
	));

	$wp_customize->add_setting('knowledge_base_lite_signin_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('knowledge_base_lite_signin_link',array(
		'label'	=> esc_html__('Button Link','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://www.example.com/signin', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_top_header',
		'type'=> 'url'
	));

	//Slider
	$wp_customize->add_section( 'knowledge_base_lite_slidersettings' , array(
    	'title' => esc_html__( 'Slider Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_panel_id'
	) );

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('knowledge_base_lite_slider_arrows',array(
		'selector'        => '#slider .carousel-caption h1',
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_slider_arrows',
	));

	$wp_customize->add_setting( 'knowledge_base_lite_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','knowledge-base-lite' ),
      	'section' => 'knowledge_base_lite_slidersettings'
    )));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'knowledge_base_lite_slider_page' . $count, array(
			'default'  => '',
			'sanitize_callback' => 'knowledge_base_lite_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'knowledge_base_lite_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'knowledge-base-lite' ),
			'description' => esc_html__('Slider image size (650 x 500)','knowledge-base-lite'),
			'section'  => 'knowledge_base_lite_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('knowledge_base_lite_slider_content_option',array(
        'default' => 'Center',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Knowledge_Base_Lite_Image_Radio_Control($wp_customize, 'knowledge_base_lite_slider_content_option', array(
        'type' => 'select',
        'label' => esc_html__('Slider Content Layouts','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

	//Services
	$wp_customize->add_section('knowledge_base_lite_services',array(
		'title'	=> __('Services Section','knowledge-base-lite'),
		'panel' => 'knowledge_base_lite_panel_id',
	));

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('knowledge_base_lite_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'knowledge_base_lite_sanitize_choices',
	));
	$wp_customize->add_control('knowledge_base_lite_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display services','knowledge-base-lite'),
		'section' => 'knowledge_base_lite_services',
	));

	//Blog Post
	$wp_customize->add_panel( $knowledge_base_lite_parent_panel );

	$BlogPostParentPanel = new Knowledge_Base_Lite_WP_Customize_Panel( $wp_customize, 'knowledge_base_lite_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'knowledge_base_lite_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('knowledge_base_lite_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_toggle_postdate', 
	));

	$wp_customize->add_setting( 'knowledge_base_lite_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','knowledge-base-lite' ),
        'section' => 'knowledge_base_lite_post_settings'
    )));

    $wp_customize->add_setting( 'knowledge_base_lite_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_toggle_author',array(
		'label' => esc_html__( 'Author','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_post_settings'
    )));

    $wp_customize->add_setting( 'knowledge_base_lite_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_toggle_comments',array(
		'label' => esc_html__( 'Comments','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_post_settings'
    )));

    $wp_customize->add_setting( 'knowledge_base_lite_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'knowledge_base_lite_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'knowledge_base_lite_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','knowledge-base-lite' ),
		'section'     => 'knowledge_base_lite_post_settings',
		'type'        => 'range',
		'settings'    => 'knowledge_base_lite_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('knowledge_base_lite_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
    ));
    $wp_customize->add_control(new Knowledge_Base_Lite_Image_Radio_Control($wp_customize, 'knowledge_base_lite_blog_layout_option', array(
        'type' => 'select',
        'label' => esc_html__('Blog Layouts','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('knowledge_base_lite_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control('knowledge_base_lite_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','knowledge-base-lite'),
            'Excerpt' => esc_html__('Excerpt','knowledge-base-lite'),
            'No Content' => esc_html__('No Content','knowledge-base-lite')
        ),
	) );

    // Button Settings
	$wp_customize->add_section( 'knowledge_base_lite_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'knowledge_base_lite_button_border_radius', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'knowledge_base_lite_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'knowledge_base_lite_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','knowledge-base-lite' ),
		'section'     => 'knowledge_base_lite_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('knowledge_base_lite_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_button_text', 
	));

    $wp_customize->add_setting('knowledge_base_lite_button_text',array(
		'default'=> esc_html__('READ MORE','knowledge-base-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('knowledge_base_lite_button_text',array(
		'label'	=> esc_html__('Add Button Text','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'READ MORE', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'knowledge_base_lite_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('knowledge_base_lite_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_related_post_title', 
	));

    $wp_customize->add_setting( 'knowledge_base_lite_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_related_post',array(
		'label' => esc_html__( 'Related Post','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_related_posts_settings'
    )));

    $wp_customize->add_setting('knowledge_base_lite_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('knowledge_base_lite_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('knowledge_base_lite_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('knowledge_base_lite_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_related_posts_settings',
		'type'=> 'number'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'knowledge_base_lite_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'knowledge-base-lite' ),
		'panel' => 'knowledge_base_lite_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'knowledge_base_lite_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_toggle_tags', array(
		'label' => esc_html__( 'Tags','knowledge-base-lite' ),
		'section' => 'knowledge_base_lite_single_blog_settings'
    )));

	//Responsive Media Settings
	$wp_customize->add_section('knowledge_base_lite_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','knowledge-base-lite'),
		'panel' => 'knowledge_base_lite_panel_id',
	));

    $wp_customize->add_setting( 'knowledge_base_lite_resp_slider_hide_show',array(
      	'default' => 0,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Slider','knowledge-base-lite' ),
      	'section' => 'knowledge_base_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'knowledge_base_lite_sidebar_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_sidebar_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Sidebar','knowledge-base-lite' ),
      	'section' => 'knowledge_base_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'knowledge_base_lite_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','knowledge-base-lite' ),
      	'section' => 'knowledge_base_lite_responsive_media'
    )));

	//Footer Text
	$wp_customize->add_section('knowledge_base_lite_footer',array(
		'title'	=> esc_html__('Footer Settings','knowledge-base-lite'),
		'panel' => 'knowledge_base_lite_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('knowledge_base_lite_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_footer_text', 
	));
	
	$wp_customize->add_setting('knowledge_base_lite_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('knowledge_base_lite_footer_text',array(
		'label'	=> esc_html__('Copyright Text','knowledge-base-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2020, .....', 'knowledge-base-lite' ),
        ),
		'section'=> 'knowledge_base_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('knowledge_base_lite_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Knowledge_Base_Lite_Image_Radio_Control($wp_customize, 'knowledge_base_lite_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_footer',
        'settings' => 'knowledge_base_lite_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'knowledge_base_lite_footer_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'knowledge_base_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Knowledge_Base_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'knowledge_base_lite_footer_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','knowledge-base-lite' ),
      	'section' => 'knowledge_base_lite_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('knowledge_base_lite_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'knowledge_base_lite_Customize_partial_knowledge_base_lite_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('knowledge_base_lite_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'knowledge_base_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Knowledge_Base_Lite_Image_Radio_Control($wp_customize, 'knowledge_base_lite_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','knowledge-base-lite'),
        'section' => 'knowledge_base_lite_footer',
        'settings' => 'knowledge_base_lite_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    // Has to be at the top
	$wp_customize->register_panel_type( 'Knowledge_Base_Lite_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Knowledge_Base_Lite_WP_Customize_Section' );
}

add_action( 'customize_register', 'knowledge_base_lite_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Knowledge_Base_Lite_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'knowledge_base_lite_panel';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;
			return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Knowledge_Base_Lite_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'knowledge_base_lite_section';
	    public function json() {
			$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
			$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content'] = $this->get_content();
			$array['active'] = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			if ( $this->panel ) {
			$array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
			} else {
			$array['customizeAction'] = 'Customizing';
			}
			return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function knowledge_base_lite_Customize_controls_scripts() {
	wp_enqueue_script( 'knowledge-base-lite-customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'knowledge_base_lite_Customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Knowledge_Base_Lite_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Knowledge_Base_Lite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Knowledge_Base_Lite_Customize_Section_Pro( $manager,'knowledge_base_lite_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Knowledge Base PRO', 'knowledge-base-lite' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'knowledge-base-lite' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/knowledge-base-wordpress-theme/'),
		) )	);

		$manager->add_section(new Knowledge_Base_Lite_Customize_Section_Pro($manager,'knowledge_base_lite_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENATATION', 'knowledge-base-lite' ),
			'pro_text' => esc_html__( 'DOCS', 'knowledge-base-lite' ),
			'pro_url'  => admin_url('themes.php?page=knowledge_base_lite_guide'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'knowledge-base-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'knowledge-base-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Knowledge_Base_Lite_Customize::get_instance();