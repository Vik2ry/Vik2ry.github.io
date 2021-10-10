<?php
/**
 * Knowledge Base Lite: Block Patterns
 *
 * @package Knowledge Base Lite
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'knowledge-base-lite',
		array( 'label' => __( 'Knowledge Base Lite', 'knowledge-base-lite' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'knowledge-base-lite/banner-section',
		array(
			'title'      => __( 'Banner Section', 'knowledge-base-lite' ),
			'categories' => array( 'knowledge-base-lite' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":1074,\"minHeight\":800,\"align\":\"full\",\"className\":\"main-banner\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim main-banner\" style=\"min-height:800px\"><img class=\"wp-block-cover__image-background wp-image-1074\" alt=\"\" src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\" data-object-fit=\"cover\"/><div class=\"wp-block-cover__inner-container\"><!-- wp:group {\"align\":\"full\",\"className\":\"main-banner-content\"} -->\n<div class=\"wp-block-group alignfull main-banner-content\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":1,\"align\":\"full\",\"style\":{\"typography\":{\"fontSize\":55}},\"textColor\":\"white\"} -->\n<h1 class=\"alignfull has-text-align-center has-white-color has-text-color\" style=\"font-size:55px\">Get help with the Advanced</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":18}},\"textColor\":\"white\"} -->\n<p class=\"has-text-align-center has-white-color has-text-color\" style=\"font-size:18px\">If you have any question you can ask below or enter</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:search {\"label\":\"Search\",\"showLabel\":false,\"placeholder\":\"Search Knowledge Base Lite ..\",\"widthUnit\":\"%\",\"buttonText\":\"Search\",\"buttonPosition\":\"button-inside\",\"buttonUseIcon\":true,\"align\":\"center\",\"className\":\"m-0\"} /--></div></div>\n<!-- /wp:group --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'knowledge-base-lite/services-section',
		array(
			'title'      => __( 'Services Section', 'knowledge-base-lite' ),
			'categories' => array( 'knowledge-base-lite' ),
			'content'    => "<!-- wp:columns {\"align\":\"wide\",\"className\":\"main-servicesbox mx-0\"} -->\n<div class=\"wp-block-columns alignwide main-servicesbox mx-0\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"id\":1076,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/post-1.png\" alt=\"\" class=\"wp-image-1076\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18}},\"textColor\":\"black\"} -->\n<h2 class=\"has-text-align-center has-black-color has-text-color\" style=\"font-size:18px\">E-Mail Support</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#808993\"}},\"className\":\"px-3\"} -->\n<p class=\"has-text-align-center px-3 has-text-color\" style=\"color:#808993;font-size:14px\">Lorem Ipsum is simply dummy text of the printing and typesetting</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"id\":1077,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/post-2.png\" alt=\"\" class=\"wp-image-1077\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18}},\"textColor\":\"black\"} -->\n<h2 class=\"has-text-align-center has-black-color has-text-color\" style=\"font-size:18px\">Chat</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#808993\"}},\"className\":\"px-3\"} -->\n<p class=\"has-text-align-center px-3 has-text-color\" style=\"color:#808993;font-size:14px\">Lorem Ipsum is simply dummy text of the printing and typesetting</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"id\":1078,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/post-3.png\" alt=\"\" class=\"wp-image-1078\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18}},\"textColor\":\"black\"} -->\n<h2 class=\"has-text-align-center has-black-color has-text-color\" style=\"font-size:18px\">Phone</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#808993\"}},\"className\":\"px-3\"} -->\n<p class=\"has-text-align-center px-3 has-text-color\" style=\"color:#808993;font-size:14px\">Lorem Ipsum is simply dummy text of the printing and typesetting</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
		)
	);
}