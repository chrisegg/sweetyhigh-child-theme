<?php
/**
 * Sweety High GeneratePress Child functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue child styles.
 */
add_action( 'wp_enqueue_scripts', 'sh_child_enqueue_styles', 20 );
function sh_child_enqueue_styles() {
	// Parent theme style handle is "generate-style".
	wp_enqueue_style(
		'sh-child-style',
		get_stylesheet_uri(),
		array( 'generate-style' ),
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Add image sizes for hero / cards (adjust as needed).
 */
add_action( 'after_setup_theme', 'sh_child_image_sizes' );
function sh_child_image_sizes() {
	add_image_size( 'sh-hero', 1200, 675, true );   // 16:9 hero
	add_image_size( 'sh-card', 600, 400, true );    // card/thumb
}

/**
 * Helper: get first post of a query and then rewind.
 */
function sh_get_first_post( $query ) {
	if ( ! $query->have_posts() ) {
		return null;
	}

	$query->the_post();
	$first_post = get_post();
	rewind_posts();

	return $first_post;
}

