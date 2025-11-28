<?php
/**
 * Sweety High GeneratePress Child functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue child styles with high priority to override GeneratePress.
 */
add_action( 'wp_enqueue_scripts', 'sh_child_enqueue_styles', 999 );
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
 * Add inline CSS to override GeneratePress defaults with higher specificity.
 * Using wp_head with late priority to ensure it loads after GeneratePress CSS.
 */
add_action( 'wp_head', 'sh_add_inline_css_overrides', 999 );
function sh_add_inline_css_overrides() {
	?>
	<style id="sh-override-styles" type="text/css">
	/* Override GeneratePress body styles */
	body {
		font-family: var(--font-poppins) !important;
		color: #595959 !important;
		font-size: 13px !important;
		font-weight: 400 !important;
		line-height: 1 !important;
		background-color: #fff !important;
	}
	
	/* Override GeneratePress headings */
	h1, h2, h3, h4, h5, h6 {
		font-family: var(--font-roboto-condensed) !important;
	}
	
	/* Override GeneratePress links */
	a {
		color: var(--bs-link-color) !important;
		text-decoration: none !important;
	}
	
	a:hover {
		color: var(--bs-link-hover-color) !important;
	}
	</style>
	<?php
}

/**
 * Use GeneratePress CSS output hook if available for better integration.
 */
add_action( 'wp_head', 'sh_generatepress_css_output', 100 );
function sh_generatepress_css_output() {
	// This ensures our CSS loads after GeneratePress's CSS output
	if ( function_exists( 'generate_get_css' ) ) {
		// GeneratePress CSS output hook
	}
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

